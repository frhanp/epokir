# digest.ps1 (v5 — LLM Context Generator)

[CmdletBinding()]
param(
  [string]$OutFile = "project_digest_full.md",
  [string]$Root = (Get-Location).Path,
  [string[]]$ExcludePatterns = @(
    '\.git\', '\.github\workflows\.*\.log', '\.vscode\', '\.idea\',
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
  Add-Content -Encoding UTF8 -Path $OutFile -Value ""
}

function Get-LanguageTag([string]$filePath) {
  if ($filePath -like "*.blade.php") { return "html" }
  $ext = [System.IO.Path]::GetExtension($filePath).ToLower()
  switch ($ext) {
    ".php" { return "php" }
    ".js"  { return "javascript" }
    ".ts"  { return "typescript" }
    ".jsx" { return "jsx" }
    ".tsx" { return "tsx" }
    ".vue" { return "vue" }
    ".json" { return "json" }
    ".yml"  { return "yaml" }
    ".yaml" { return "yaml" }
    ".css"  { return "css" }
    ".scss" { return "scss" }
    ".html" { return "html" }
    ".md"   { return "markdown" }
    default { return "" }
  }
}

function Write-CodeBlock([object]$content, [string]$lang = "") {
  Add-Content -Encoding UTF8 -Path $OutFile -Value ('```' + $lang)
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

function Write-FileContents([array]$files) {
    if ($files.Count -eq 0) {
        Add-Content -Encoding UTF8 -Path $OutFile -Value "*Tidak ada berkas yang ditemukan dalam kategori ini.*"
        Add-Content -Encoding UTF8 -Path $OutFile -Value ""
    } else {
        foreach ($f in $files) {
            $relPath = $f.FullName.Replace($Root,'').TrimStart('\','/').Replace('\','/')
            $lang = Get-LanguageTag $f.FullName
            
            Add-Content -Encoding UTF8 -Path $OutFile -Value ('### File: `' + $relPath + '`')
            Add-Content -Encoding UTF8 -Path $OutFile -Value ""
            
            $fileContent = (Get-Content $f.FullName) -replace "`t","    "
            Write-CodeBlock $fileContent $lang
        }
    }
}
# --- End Helper Functions ---


$systemPrompt = "
# Project Digest: E-POKIR Golkar
_Dihasilkan otomatis pada: $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')_

> **PETUNJUK UNTUK LLM (Google Gemini / Claude):**
> Dokumen ini memuat arsitektur lengkap, dependensi, konfigurasi, migrasi database, dan kode sumber aplikasi **E-POKIR**.
> Gunakan informasi ini untuk memahami relasi antarkomponen, model data, sistem CI/CD, dan logika bisnis aplikasi.
>
> **Tech Stack Utama:**
> - Backend: Laravel 12 (PHP 8.3)
> - Frontend: Tailwind CSS, Alpine.js, Vite
> - Database: MySQL
> - Infrastruktur: Armbian Server, Tailscale VPN
"

$systemPrompt | Set-Content -Encoding UTF8 $OutFile

# 1) Struktur Proyek
Write-Title "Struktur Direktori Proyek"
$structure = Get-ChildItem -Recurse -Force |
  Where-Object { Is-IncludedPath $_.FullName -and ( $_.PSIsContainer -or ($IncludeExtensions -contains $_.Extension) ) } |
  Select-Object -ExpandProperty FullName |
  ForEach-Object { $_.Replace($Root,'').TrimStart('\','/').Replace('\','/') }
Write-CodeBlock $structure

# 2) Info Git & Remote
Write-Title "Status Git & Log Commit"
$gitOut = & {
  git -C $Root rev-parse --is-inside-work-tree | Out-Null
  if ($LASTEXITCODE -eq 0) {
    "Remote Origin:"; git remote -v
    ""; "Branch Aktif:"; git rev-parse --abbrev-ref HEAD
    ""; "5 Commit Terakhir:"; git --no-pager log --oneline -5
  } else { "Bukan repositori git." }
}
Write-CodeBlock $gitOut

# 3) Dependensi Paket (composer.json & package.json)
Write-Title "Spesifikasi Dependensi Aplikasi"
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
}
Write-CodeBlock $depOut "yaml"

# 4) Konfigurasi Environment & CI/CD
Write-Title "Konfigurasi Environment & Workflow CI/CD"
$configFiles = @()
$configGlobs = @(".env.example", ".github\workflows\*.yml", "vite.config.*", "tailwind.config.js")
foreach ($g in $configGlobs) {
  if (Test-Path (Join-Path $Root $g)) {
    $configFiles += Get-ChildItem -Recurse (Join-Path $Root $g) -Force | Where-Object { Is-IncludedPath $_.FullName }
  }
}
Write-FileContents $configFiles

# 5) Migrasi & Struktur Database (Sangat Penting untuk Gemini)
Write-Title "Skema & Migrasi Database"
$migrationFiles = @()
if (Test-Path "$Root\database\migrations") {
  $migrationFiles = Get-ChildItem -Path "database\migrations\*.php" -Force | Where-Object { Is-IncludedPath $_.FullName }
}
Write-FileContents $migrationFiles

# 6) Seeders & Factories
Write-Title "Database Seeders & Factories"
$seederFiles = @()
if (Test-Path "$Root\database\seeders") {
  $seederFiles += Get-ChildItem -Path "database\seeders\*.php" -Force | Where-Object { Is-IncludedPath $_.FullName }
}
if (Test-Path "$Root\database\factories") {
  $seederFiles += Get-ChildItem -Path "database\factories\*.php" -Force | Where-Object { Is-IncludedPath $_.FullName }
}
Write-FileContents $seederFiles

# 7) File Routing
Write-Title "Definisi Routing"
$routeFiles = Get-ChildItem -Recurse -Path "routes\*.php" -Force | Where-Object { Is-IncludedPath $_.FullName }
Write-FileContents $routeFiles

# 8) Controllers
Write-Title "Controllers"
$controllerGlobs = @("app\Http\Controllers\*.php", "app\Controllers\*.php")
$controllerFiles = @()
foreach ($g in $controllerGlobs) {
  if (Test-Path (Join-Path $Root $g)) {
    $controllerFiles += Get-ChildItem -Recurse (Join-Path $Root $g) -Force | Where-Object { Is-IncludedPath $_.FullName }
  }
}
Write-FileContents $controllerFiles

# 9) Models
Write-Title "Models & Data Entities"
$modelFiles = @()
if (Test-Path "$Root\app\Models") {
  $modelFiles = Get-ChildItem -Recurse -Path "app\Models\*.php" -Force | Where-Object { Is-IncludedPath $_.FullName }
}
Write-FileContents $modelFiles

# 10) Tampilan & UI (Views)
Write-Title "Front-End Views & Components"
$viewFiles = @()
$viewGlobs = @("resources\views\welcome.blade.php", "resources\views\layouts\*.blade.php", "resources\views\dashboard\*.blade.php", "resources\views\plan\*.blade.php", "resources\views\pokir\*.blade.php")
foreach ($g in $viewGlobs) {
  if (Test-Path (Join-Path $Root $g)) {
    $viewFiles += Get-ChildItem -Recurse (Join-Path $Root $g) -Force | Where-Object { Is-IncludedPath $_.FullName }
  }
}
Write-FileContents $viewFiles

# 11) Script Khusus/Helper
Write-Title "Deployment & Helper Scripts"
$helperFiles = @()
$helperGlobs = @("deploy.sh", "scripts\*.sh")
foreach ($g in $helperGlobs) {
  if (Test-Path (Join-Path $Root $g)) {
    $helperFiles += Get-ChildItem -Recurse (Join-Path $Root $g) -Force | Where-Object { Is-IncludedPath $_.FullName }
  }
}
Write-FileContents $helperFiles

Add-Content -Encoding UTF8 -Path $OutFile -Value ""
Add-Content -Encoding UTF8 -Path $OutFile -Value "---"
Add-Content -Encoding UTF8 -Path $OutFile -Value "## Akhir Dokumen Rangkuman"

Write-Host ("Rangkuman Konteks LLM Berhasil Dibuat: {0}" -f $OutFile)