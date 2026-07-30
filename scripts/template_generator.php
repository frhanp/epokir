<?php

// Check if run from CLI
if (php_sapi_name() !== 'cli') {
    die("This script can only be run via CLI.\n");
}

$workspacePath = 'd:\Laragon\www\epokir';
$originalDocx = $workspacePath . '/storage/app/Laporan Bulanan Pak Kun Bulan Agustus.docx';
$templateDocx = $workspacePath . '/storage/app/template_laporan.docx';

if (!file_exists($originalDocx)) {
    die("Original DOCX not found at $originalDocx\n");
}

// Copy original to template path so we can modify it
if (!copy($originalDocx, $templateDocx)) {
    die("Failed to copy original DOCX to template path\n");
}

$zip = new ZipArchive();
if ($zip->open($templateDocx) !== TRUE) {
    die("Failed to open template DOCX as zip archive\n");
}

$xmlContent = $zip->getFromName('word/document.xml');
if ($xmlContent === false) {
    $zip->close();
    die("Failed to read word/document.xml from ZIP\n");
}

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadXML($xmlContent);
libxml_clear_errors();

$xpath = new DOMXPath($dom);
$xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

// 1. Process Paragraphs for cover letter & footer placeholders
$paragraphs = $xpath->query('//w:p');
echo "Processing " . $paragraphs->length . " paragraphs...\n";

foreach ($paragraphs as $p) {
    // Get clean text of the paragraph
    $pText = '';
    $texts = $xpath->query('.//w:t', $p);
    foreach ($texts as $t) {
        $pText .= $t->nodeValue;
    }
    
    // Check if it is the Date paragraph (e.g. Gorontalo, 1 Agustus 2026)
    if (preg_match('/Gorontalo,\s*\d+\s*Agustus\s*2026/i', $pText)) {
        echo "Found Date Paragraph: '" . trim($pText) . "'\n";
        replaceParagraphText($xpath, $p, '${tanggal_laporan}');
    }
    // Check for Hal: Laporan Kinerja Periode Juli
    elseif (preg_match('/Hal\s*:\s*Laporan\s*Kinerja\s*Periode\s*Juli/i', $pText)) {
        echo "Found Hal Paragraph: '" . trim($pText) . "'\n";
        replaceParagraphText($xpath, $p, 'Hal : Laporan Kinerja Periode ${periode_laporan}');
    }
    // Check for "periode Juli 2026 sebagaimana terlampir"
    elseif (preg_match('/periode\s*Juli\s*2026\s*sebagaimana\s*terlampir/i', $pText)) {
        echo "Found Periode Paragraph 1: '" . trim($pText) . "'\n";
        $newTxt = str_replace('periode Juli 2026 sebagaimana terlampir', 'periode ${periode_laporan} ${tahun_laporan} sebagaimana terlampir', $pText);
        replaceParagraphText($xpath, $p, $newTxt);
    }
    // Check for title "LAPORAN KINERJA PELAKSANAAN TUGAS DAN TANGGUNG JAWAB ... PERIODE BULAN JULI 2026"
    elseif (preg_match('/PERIODE\s*BULAN\s*JULI\s*2026/i', $pText)) {
        echo "Found Title/Header: '" . trim($pText) . "'\n";
        $newTxt = str_replace('PERIODE BULAN JULI 2026', 'PERIODE BULAN ${periode_laporan_upper} ${tahun_laporan}', $pText);
        replaceParagraphText($xpath, $p, $newTxt);
    }
    // Check for "sebagai Tenaga Ahli ...,untuk periode Juli 2026."
    elseif (preg_match('/untuk\s*periode\s*Juli\s*2026/i', $pText)) {
        echo "Found Periode Paragraph 2: '" . trim($pText) . "'\n";
        $newTxt = str_replace('untuk periode Juli 2026', 'untuk periode ${periode_laporan} ${tahun_laporan}', $pText);
        replaceParagraphText($xpath, $p, $newTxt);
    }
    // Check for "selama periode Juli 2026"
    elseif (preg_match('/selama\s*periode\s*Juli\s*2026/i', $pText)) {
        echo "Found Periode Paragraph 3: '" . trim($pText) . "'\n";
        $newTxt = str_replace('selama periode Juli 2026', 'selama periode ${periode_laporan} ${tahun_laporan}', $pText);
        replaceParagraphText($xpath, $p, $newTxt);
    }
    // Check for "selama bulan Juli 2026" (multiple occurrences, let's replace all)
    elseif (preg_match('/selama\s*bulan\s*Juli\s*2026/i', $pText)) {
        echo "Found Periode Paragraph 4: '" . trim($pText) . "'\n";
        $newTxt = str_replace('selama bulan Juli 2026', 'selama bulan ${periode_laporan} ${tahun_laporan}', $pText);
        // also check if (Terlampir) is in it
        $newTxt = str_replace('(Terlampir)', '(Terlampir)', $newTxt);
        replaceParagraphText($xpath, $p, $newTxt);
    }
    // Check for "pada bulan Juli 2026 ini"
    elseif (preg_match('/pada\s*bulan\s*Juli\s*2026\s*ini/i', $pText)) {
        echo "Found Periode Paragraph 5: '" . trim($pText) . "'\n";
        $newTxt = str_replace('pada bulan Juli 2026 ini', 'pada bulan ${periode_laporan} ${tahun_laporan} ini', $pText);
        replaceParagraphText($xpath, $p, $newTxt);
    }
    // Check for footer "periode Juli 2026, atas perhatian"
    elseif (preg_match('/periode\s*Juli\s*2026,\s*atas\s*perhatian/i', $pText)) {
        echo "Found Periode Paragraph 6: '" . trim($pText) . "'\n";
        $newTxt = str_replace('periode Juli 2026, atas perhatian', 'periode ${periode_laporan} ${tahun_laporan}, atas perhatian', $pText);
        replaceParagraphText($xpath, $p, $newTxt);
    }
}

// 2. Process Tables (Convert rows 2+ to template row)
$tables = $xpath->query('//w:tbl');
echo "Processing tables (Found " . $tables->length . ")...\n";

foreach ($tables as $table) {
    $rows = $xpath->query('.//w:tr', $table);
    if ($rows->length < 2) continue; // Skip header-only tables
    
    echo "Table has " . $rows->length . " rows. Converting to template row...\n";
    
    // Row 2 is our first data row. We will keep Row 2 as the placeholder row.
    $row2 = $rows->item(1); 
    $cells = $xpath->query('.//w:tc', $row2);
    
    if ($cells->length >= 3) {
        // Cell 1: No -> replace text with ${no}
        replaceCellText($xpath, $cells->item(0), '${no}');
        // Cell 2: Tanggal -> replace text with ${tanggal}
        replaceCellText($xpath, $cells->item(1), '${tanggal}');
        // Cell 3: Kegiatan -> replace text with ${kegiatan}
        replaceCellText($xpath, $cells->item(2), '${kegiatan}');
        echo "Converted Row 2 to template row containing placeholders: \${no}, \${tanggal}, \${kegiatan}.\n";
    }
    
    // Delete Row 3 to the end
    for ($i = 2; $i < $rows->length; $i++) {
        $rowToDelete = $rows->item($i);
        $table->removeChild($rowToDelete);
    }
    echo "Removed " . ($rows->length - 2) . " extra data rows.\n";
}

// 3. Process Saran/Masukan list to create dynamic block placeholders
$pSaran = null;
$pPenutup = null;
$pTemplateItem = null;

$paragraphs = $xpath->query('//w:p');
foreach ($paragraphs as $p) {
    $pText = '';
    $texts = $xpath->query('.//w:t', $p);
    foreach ($texts as $t) {
        $pText .= $t->nodeValue;
    }
    
    if (trim($pText) === 'IV. SARAN/MASUKAN') {
        $pSaran = $p;
    }
    elseif (trim($pText) === 'PENUTUP') {
        $pPenutup = $p;
    }
    elseif (strpos($pText, 'Penyelesaian tindak lanjut') !== false) {
        $pTemplateItem = $p;
    }
}

if ($pSaran && $pPenutup && $pTemplateItem) {
    echo "Found Saran, Penutup, and Template list item. Converting to dynamic block...\n";
    
    // Prepare template item: replace its text with ${saran_text}
    $pTemplateItemClone = $pTemplateItem->cloneNode(true);
    replaceParagraphText($xpath, $pTemplateItemClone, '${saran_text}');
    
    // Create paragraph for block start: ${saran_block}
    $dom = $pSaran->ownerDocument;
    $pBlockStart = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:p');
    $rStart = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:r');
    $tStart = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:t');
    $tStart->nodeValue = '${saran_block}';
    $rStart->appendChild($tStart);
    $pBlockStart->appendChild($rStart);
    
    // Create paragraph for block end: ${/saran_block}
    $pBlockEnd = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:p');
    $rEnd = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:r');
    $tEnd = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:t');
    $tEnd->nodeValue = '${/saran_block}';
    $rEnd->appendChild($tEnd);
    $pBlockEnd->appendChild($rEnd);
    
    // Get sibling list to delete
    $nodesToDelete = [];
    $curr = $pSaran->nextSibling;
    while ($curr && $curr !== $pPenutup) {
        $nodesToDelete[] = $curr;
        $curr = $curr->nextSibling;
    }
    
    // Delete them
    $parent = $pSaran->parentNode;
    foreach ($nodesToDelete as $node) {
        $parent->removeChild($node);
    }
    
    // Insert new structure before PENUTUP
    $pSpacing1 = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:p');
    
    $parent->insertBefore($pSpacing1, $pPenutup);
    $parent->insertBefore($pBlockStart, $pPenutup);
    $parent->insertBefore($pTemplateItemClone, $pPenutup);
    $parent->insertBefore($pBlockEnd, $pPenutup);
    
    echo "Successfully converted Saran/Masukan section to dynamic block.\n";
}

// Save modified XML back to the ZIP
$newXml = $dom->saveXML();
$zip->deleteName('word/document.xml');
$zip->addFromString('word/document.xml', $newXml);
$zip->close();
echo "Successfully generated template at $templateDocx\n";

/**
 * Helper to replace all text nodes in a paragraph with a single text node preserving paragraph layout/formatting
 */
function replaceParagraphText($xpath, $p, $newText) {
    // Get all runs
    $runs = $xpath->query('.//w:r', $p);
    if ($runs->length == 0) return;
    
    // Keep the first run and remove its text elements, insert our new text
    $firstRun = $runs->item(0);
    
    // Remove all text elements from first run
    $texts = $xpath->query('.//w:t', $firstRun);
    foreach ($texts as $t) {
        $firstRun->removeChild($t);
    }
    
    // Create new text node
    $dom = $p->ownerDocument;
    $newT = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:t');
    // Handle spaces
    if (strpos($newText, ' ') !== false) {
        $newT->setAttribute('xml:space', 'preserve');
    }
    $newT->nodeValue = $newText;
    $firstRun->appendChild($newT);
    
    // Remove all subsequent runs in the paragraph
    for ($i = 1; $i < $runs->length; $i++) {
        $p->removeChild($runs->item($i));
    }
}

/**
 * Helper to replace all text in a cell (w:tc) with a single text node in the first paragraph, keeping font/layout
 */
function replaceCellText($xpath, $cell, $newText) {
    $paragraphs = $xpath->query('.//w:p', $cell);
    if ($paragraphs->length == 0) return;
    
    // Get first paragraph
    $firstP = $paragraphs->item(0);
    replaceParagraphText($xpath, $firstP, $newText);
    
    // Remove other paragraphs if any
    for ($i = 1; $i < $paragraphs->length; $i++) {
        $cell->removeChild($paragraphs->item($i));
    }
}
