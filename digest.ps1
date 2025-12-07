# digest.ps1 (v4 — Tampilkan isi file lebih lengkap)

[CmdletBinding()]
param(
  [string]$OutFile = "project_digest_full.md",
  [string]$Root = (Get-Location).Path,
  [string[]]$ExcludePatterns = @(
    '\.git\', '\.github\', '\.vscode\', '\.idea\',
    '\node_modules\', '\vendor\',
    '\storage\debugbar\', '\storage\logs\', '\public\build\', '\public\storage\',
    '\dist\', '\build\', '\.next\', '\.nuxt\', '\.parcel-cache\', '\.cache\',
    '\venv\', '\.venv\', '__pycache__\', '\target\', '\bin\', '\obj\'
  ),
  [string[]]$IncludeExtensions = @(
    '.php','.blade.php','.js','.ts','.jsx','.tsx','.vue',
    '.json','.md','.yml','.yaml','.env','.env.example',
    '.py','.go','.rb','.java','.cs',
    '.css','.scss','.sass','.html','.twig'
  )
)

$ErrorActionPreference = "SilentlyContinue"
Set-Location $Root

# --- Helper Functions ---
function Is-IncludedPath([string]$path) {
  foreach ($p in $ExcludePatterns) {
    if ($path -replace '/','\' -match [regex]::Escape($p)) { return $false }
  }
  return $true
}

function Write-Title([string]$text) {
  Add-Content -Encoding UTF8 -Path $OutFile -Value ""
  Add-Content -Encoding UTF8 -Path $OutFile -Value "## $text"
}

function Write-CodeBlock([object]$content) {
  Add-Content -Encoding UTF8 -Path $OutFile -Value '```'
  if ($null -ne $content) {
    if ($content -is [System.Array]) {
      Add-Content -Encoding UTF8 -Path $OutFile -Value $content
    } else {
      Add-Content -Encoding UTF8 -Path $OutFile -Value ($content | Out-String)
    }
  }
  Add-Content -Encoding UTF8 -Path $OutFile -Value '```'
  Add-Content -Encoding UTF8 -Path $OutFile -Value ""
}

# Fungsi baru untuk menulis konten file
function Write-FileContents([array]$files) {
    $output = @()
    if ($files.Count -eq 0) {
        $output += "No files found for this section."
    } else {
        foreach ($f in $files) {
            $output += "===== $($f.FullName.Replace($Root,'').TrimStart('\','/')) ====="
            $output += (Get-Content $f.FullName) -replace "`t","    "
            $output += ""
        }
    }
    Write-CodeBlock $output
}
# --- End Helper Functions ---


# Reset output file
"# Project Digest (Full Content)" | Set-Content -Encoding UTF8 $OutFile
"_Generated: $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')_" | Add-Content -Encoding UTF8 $OutFile
"**Root:** $Root" | Add-Content -Encoding UTF8 $OutFile
"" | Add-Content -Encoding UTF8 $OutFile

# 1) Struktur Proyek
Write-Title "Struktur Proyek (filtered, no depth limit)"
$structure = Get-ChildItem -Recurse -Force |
  Where-Object { Is-IncludedPath $_.FullName -and ( $_.PSIsContainer -or ($IncludeExtensions -contains $_.Extension) ) } |
  Select-Object -ExpandProperty FullName |
  ForEach-Object { $_.Replace($Root,'').TrimStart('\','/') }
Write-CodeBlock $structure

# 2) Info Git
Write-Title "Info Git"
$gitOut = & {
  git -C $Root rev-parse --is-inside-work-tree | Out-Null
  if ($LASTEXITCODE -eq 0) {
    "Remote:"; git remote -v
    ""; "Branch:"; git rev-parse --abbrev-ref HEAD
    ""; "Last 5 commits:"; git --no-pager log --oneline -5
  } else { "Not a git repo" }
}
Write-CodeBlock $gitOut

# 3) Dependencies
Write-Title "Dependencies (summary)"
# (Tidak ada perubahan di bagian ini)
$depOut = & {
  if (Test-Path "$Root\composer.json") {
    "composer.json (require):"
    try { (Get-Content "$Root\composer.json" | ConvertFrom-Json).require.GetEnumerator() | % { "  $($_.Key): $($_.Value)" } } catch { "  (parse error / none)" }
    "composer.json (require-dev):"
    try { (Get-Content "$Root\composer.json" | ConvertFrom-Json).'require-dev'.GetEnumerator() | % { "  $($_.Key): $($_.Value)" } } catch { "  (parse error / none)" }
  }
  if (Test-Path "$Root\package.json") {
    ""; "package.json (dependencies):"
    try { (Get-Content "$Root\package.json" | ConvertFrom-Json).dependencies.GetEnumerator() | % { "  $($_.Key): $($_.Value)" } } catch { "  (parse error / none)" }
    "package.json (devDependencies):"
    try { (Get-Content "$Root\package.json" | ConvertFrom-Json).devDependencies.GetEnumerator() | % { "  $($_.Key): $($_.Value)" } } catch { "  (parse error / none)" }
  }
  if (Test-Path "$Root\requirements.txt") { ""; "requirements.txt:"; Get-Content "$Root\requirements.txt" }
  if (Test-Path "$Root\pyproject.toml") { ""; "pyproject.toml (head):"; Get-Content "$Root\pyproject.toml" -TotalCount 80 }
}
Write-CodeBlock $depOut


# 4) Konfigurasi .env & Docker
if (Test-Path "$Root\.env" -or Test-Path "$Root\.env.example") {
  Write-Title "Konfigurasi Penting (.env redacted)"
  $envPath = if (Test-Path "$Root\.env") { "$Root\.env" } else { "$Root\.env.example" }
  $envOut = Get-Content $envPath | ForEach-Object {
    if ($_ -match '^\s*#' -or $_ -match '^\s*$') { $_ }
    elseif ($_ -match '^\s*([\w\.\-]+)\s*=\s*(.+)$') { "$($Matches[1])=****" } else { $_ }
  }
  Write-CodeBlock $envOut
}
if (Test-Path "$Root\docker-compose.yml") {
  Write-Title "docker-compose.yml"
  Write-CodeBlock (Get-Content "$Root\docker-compose.yml")
}
if (Test-Path "$Root\Dockerfile") {
  Write-Title "Dockerfile"
  Write-CodeBlock (Get-Content "$Root\Dockerfile")
}


# 5) Routes (diubah untuk menampilkan isi file)
Write-Title "Routes Files Content"
$routeFiles = Get-ChildItem -Recurse -Path "routes\*.php", "config\routes.rb", "src\routes\*" -Force | Where-Object { Is-IncludedPath $_.FullName }
Write-FileContents $routeFiles
# Bagian lama untuk list command tetap dijalankan
Write-Title "Routes (from command)"
$routesOut = & {
  try {
    if (Test-Path "$Root\artisan") {
      $r = php artisan route:list 2>$null
      if ($r) { $r } else { "Laravel detected, but 'php artisan route:list' failed or empty." }
    } elseif (Get-ChildItem -Recurse -Filter "bin/console" | Select-Object -First 1) {
      $c = (Get-ChildItem -Recurse -Filter "bin/console" | Select-Object -First 1).FullName
      & $c debug:router 2>$null
    } elseif (Test-Path "$Root\config\routes.rb") {
      rails routes 2>$null
    } else { "No known route command detected." }
  } catch { "Route scan failed (ignored)." }
}
Write-CodeBlock $routesOut


# 6) Controllers
Write-Title "Controllers Content"
$controllerGlobs = @("app\Http\Controllers\*.php", "app\Controllers\*.php", "src\Controller\*.php")
$controllerFiles = @()
foreach ($g in $controllerGlobs) {
  if (Test-Path (Join-Path $Root $g)) {
    $controllerFiles += Get-ChildItem -Recurse (Join-Path $Root $g) -Force | Where-Object { Is-IncludedPath $_.FullName }
  }
}
Write-FileContents $controllerFiles


# 7) Models
Write-Title "Models Content"
$modelDirs = @("app\Models", "src\Models", "app", "src\Entity")
$modelFiles = @()
foreach ($d in $modelDirs) {
    if(Test-Path (Join-Path $Root $d)) {
        $modelFiles += Get-ChildItem -Recurse (Join-Path $Root $d) -Filter *.php -Force | Where-Object { 
            (Is-IncludedPath $_.FullName) -and ((Get-Content $_.FullName -Raw) -match "class\s+\w+\s+extends\s+Model|class\s+\w+\s+implements\s+Authenticatable")
        }
    }
}
$modelFiles = $modelFiles | Sort-Object FullName -Unique
Write-FileContents $modelFiles


# 8) Views & UI Files (diubah untuk menampilkan isi)
Write-Title "Views & UI Files Content"
$viewFiles = @()
$viewGlobs = @("resources\views\*.blade.php", "templates\*.twig", "src\components\*.vue", "src\pages\*.jsx", "src\pages\*.tsx")
foreach ($g in $viewGlobs) {
    if(Test-Path (Join-Path $Root $g)) {
        $viewFiles += Get-ChildItem -Recurse (Join-Path $Root $g) -Force | Where-Object { Is-IncludedPath $_.FullName }
    }
}
Write-FileContents $viewFiles


# 9) Entry Points & Config Files
Write-Title "Entry Points & Main Configs Content"
$entryFiles = @()
$entryGlobs = @(
    "public\index.php", "server.php", "artisan", "app\Console\Kernel.php", # PHP
    "src\main.ts", "src\main.js", "resources\js\app.js", "vite.config.*", "webpack.*", # JS
    "manage.py", "wsgi.py", "asgi.py", "main.py", # Python
    "config\app.php", "config\database.php" # Configs
)
foreach($g in $entryGlobs){
    if(Test-Path (Join-Path $Root $g)) {
        $entryFiles += Get-ChildItem -Recurse (Join-Path $Root $g) -Force | Where-Object { Is-IncludedPath $_.FullName }
    }
}
Write-FileContents $entryFiles


"== Selesai ==" | Add-Content -Encoding UTF8 $OutFile
Write-Host ("Digest generated: {0}" -f $OutFile)