<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanBulanan;
use App\Models\LaporanBulananItem;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\DB;

class LaporanBulananController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index()
    {
        $reports = LaporanBulanan::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('laporan.index', compact('reports'));
    }

    /**
     * Create and initialize a new monthly report.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'bulan' => 'required|integer|between:1,12',
            'tahun' => 'required|integer',
        ]);

        // Check if report already exists for this month/year
        $existing = LaporanBulanan::where('bulan', $data['bulan'])
            ->where('tahun', $data['tahun'])
            ->first();

        if ($existing) {
            return redirect()->route('laporan.edit', $existing->id)
                ->with('info', 'Laporan untuk periode tersebut sudah ada. Mengalihkan ke halaman edit.');
        }

        DB::beginTransaction();
        try {
            // Generate default date string
            $tanggalLaporan = $this->getFirstWorkdayOfNextMonth($data['tahun'], $data['bulan']);

            // Default saran/masukan sesuai template asli
            $saranDefault = [
                "Penyelesaian tindak lanjut atas rekomendasi LHP BPK terhadap Laporan Keuangan Pemerintah Daerah (LKPD) Provinsi Gorontalo harus dipandang sebagai instrumen strategis untuk memperkuat integritas tata kelola keuangan, bukan sekadar pemenuhan formalitas administratif. Dengan merujuk pada UU No. 15 Tahun 2004 tentang Pemeriksaan Pengelolaan dan Tanggung Jawab Keuangan Negara serta PP No. 71 Tahun 2010 tentang Standar Akuntansi Pemerintahan, seluruh perangkat daerah wajib melakukan percepatan perbaikan atas kelemahan Sistem Pengendalian Intern (SPI) dan kepatuhan terhadap peraturan perundang-undangan. Langkah progresif dan terukur ini sangat krusial untuk meminimalisir temuan berulang, menjamin akurasi data fiskal yang akuntabel, serta memastikan bahwa setiap rupiah anggaran daerah dikelola secara efektif dan efisien guna mewujudkan pembangunan Provinsi Gorontalo yang transparan dan tepat sasaran.",
                "Pelaksanaan masa reses di tengah tuntutan efisiensi anggaran daerah menuntut pergeseran paradigma dari pendekatan seremonial menuju pendekatan yang lebih substansial dan berorientasi pada hasil (outcome-oriented). Anggota DPRD diharapkan mampu mengoptimalkan fungsi penjaringan aspirasi melalui metode yang lebih efisien, terukur, dan tepat sasaran, sehingga pokok-pokok pikiran (pokir) yang dihasilkan benar-benar merepresentasikan kebutuhan mendesak masyarakat serta selaras dengan prioritas pembangunan dalam RKPD. Dengan menekankan pada kualitas pertemuan yang efektif dan selektivitas usulan, agenda reses akan tetap mampu menjadi instrumen strategis yang kuat dalam mengawal kebijakan publik yang responsif, sekaligus memastikan bahwa alokasi anggaran yang digunakan benar-benar memberikan dampak maksimal bagi kesejahteraan masyarakat di Provinsi Gorontalo tanpa mengabaikan prinsip tata kelola keuangan yang efektif."
            ];

            // Create main report record
            $laporan = LaporanBulanan::create([
                'bulan' => $data['bulan'],
                'tahun' => $data['tahun'],
                'nama_ta' => 'Ir. KUN IDRUS',
                'jabatan_ta' => 'Tenaga Ahli Fraksi Partai Golkar DPRD Provinsi Gorontalo',
                'tanggal_laporan' => $tanggalLaporan,
                'yth' => "Kepada Yth,\nSekretaris DPRD Provinsi Gorontalo\ndi Gorontalo",
                'tembusan' => "Yth :\n1. Ketua Fraksi Partai Golkar DPRD Provinsi Gorontalo\n2. Arsip",
                'saran' => $saranDefault,
            ]);

            // Generate workdays for the month (Monday, Tuesday, Thursday, Friday)
            $workdays = $this->getWorkdays($data['tahun'], $data['bulan']);

            foreach ($workdays as $index => $day) {
                LaporanBulananItem::create([
                    'laporan_bulanan_id' => $laporan->id,
                    'tanggal' => $day['formatted'],
                    'hari' => $day['day_name'],
                    'kegiatan' => '',
                    'no_urut' => $index + 1,
                ]);
            }

            DB::commit();
            return redirect()->route('laporan.edit', $laporan->id)
                ->with('success', 'Laporan bulanan berhasil diinisialisasi.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat laporan: ' . $e->getMessage());
        }
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $laporan = LaporanBulanan::with('items')->findOrFail($id);
        return view('laporan.edit', compact('laporan'));
    }

    /**
     * AJAX/Post endpoint to save draft (autosave).
     */
    public function storeOrUpdate(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:laporan_bulanans,id',
            'nama_ta' => 'required|string|max:255',
            'jabatan_ta' => 'required|string|max:255',
            'tanggal_laporan' => 'required|string|max:255',
            'yth' => 'required|string',
            'tembusan' => 'required|string',
            'saran' => 'nullable|array',
            'saran.*' => 'nullable|string',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:laporan_bulanan_items,id',
            'items.*.kegiatan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $laporan = LaporanBulanan::findOrFail($data['id']);
            $laporan->update([
                'nama_ta' => $data['nama_ta'],
                'jabatan_ta' => $data['jabatan_ta'],
                'tanggal_laporan' => $data['tanggal_laporan'],
                'yth' => $data['yth'],
                'tembusan' => $data['tembusan'],
                'saran' => $data['saran'] ?? [],
            ]);

            foreach ($data['items'] as $itemData) {
                LaporanBulananItem::where('id', $itemData['id'])
                    ->where('laporan_bulanan_id', $laporan->id)
                    ->update([
                        'kegiatan' => $itemData['kegiatan'] ?? '',
                    ]);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Draf berhasil disimpan otomatis.',
                'updated_at' => $laporan->updated_at->timezone('Asia/Makassar')->format('H:i:s'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan draf: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export report to DOCX.
     */
    public function exportDocx($id)
    {
        $laporan = LaporanBulanan::with('items')->findOrFail($id);

        $originalDocx = storage_path('app/Laporan Bulanan Pak Kun Bulan Agustus.docx');
        if (!file_exists($originalDocx)) {
            return redirect()->back()->with('error', 'Berkas asli Laporan Bulanan Pak Kun Bulan Agustus.docx tidak ditemukan di storage/app.');
        }

        $tempTemplate = tempnam(sys_get_temp_dir(), 'docx');

        try {
            // Compile template dynamically on-the-fly from the original document
            $this->compileTemplate($originalDocx, $tempTemplate);

            $template = new TemplateProcessor($tempTemplate);

            $monthNames = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
            $namaBulan = $monthNames[$laporan->bulan];
            $namaBulanUpper = strtoupper($namaBulan);

            // Replace template variables
            $template->setValue('tanggal_laporan', $laporan->tanggal_laporan);
            $template->setValue('nama_ta', $laporan->nama_ta);
            $template->setValue('jabatan_ta', $laporan->jabatan_ta);
            $template->setValue('yth', $laporan->yth);
            $template->setValue('tembusan', $laporan->tembusan);
            $template->setValue('periode_laporan', $namaBulan);
            $template->setValue('periode_laporan_upper', $namaBulanUpper);
            $template->setValue('tahun_laporan', $laporan->tahun);

            // Populate Saran/Masukan dynamic list block
            $saranList = $laporan->saran ?? [];
            if (!empty($saranList)) {
                $template->cloneBlock('saran_block', count($saranList), true, true);
                foreach ($saranList as $idx => $saranText) {
                    $rowNum = $idx + 1;
                    $template->setValue('saran_text#' . $rowNum, $saranText);
                }
            } else {
                $template->deleteBlock('saran_block');
            }

            // Populate table rows
            $items = $laporan->items;
            if (count($items) > 0) {
                $template->cloneRow('no', count($items));

                foreach ($items as $idx => $item) {
                    $rowNum = $idx + 1;

                    // Format date to: 2 Juli 2026
                    $time = strtotime($item->tanggal);
                    $d = date('j', $time);
                    $m = (int)date('n', $time);
                    $y = date('Y', $time);
                    $dateString = "$d " . $monthNames[$m] . " $y";

                    $template->setValue('no#' . $rowNum, $item->no_urut);
                    $template->setValue('tanggal#' . $rowNum, $dateString);
                    $template->setValue('kegiatan#' . $rowNum, $item->kegiatan ?? '');
                }
            } else {
                $template->setValue('no', '');
                $template->setValue('tanggal', '');
                $template->setValue('kegiatan', '');
            }

            // Save to temp file and download
            $outputName = "Laporan_Bulanan_TA_Pak_Kun_" . $namaBulan . "_" . $laporan->tahun . ".docx";
            $tempFile = tempnam(sys_get_temp_dir(), 'docx');
            $template->saveAs($tempFile);

            // Sisipkan SK T.A FRAKSI 2026.pdf di akhir jika ada
            $pdfPath = storage_path('app/SK T.A FRAKSI 2026.pdf');
            if (file_exists($pdfPath)) {
                $tempDir = storage_path('app/temp_sk_images_' . uniqid());
                if (@mkdir($tempDir)) {
                    // Ekstrak halaman PDF menjadi PNG menggunakan pdftoppm
                    $cmd = "pdftoppm -png -r 150 " . escapeshellarg($pdfPath) . " " . escapeshellarg($tempDir . '/page');
                    shell_exec($cmd);

                    $images = glob($tempDir . '/page-*.png');
                    if (!empty($images)) {
                        sort($images, SORT_NATURAL);

                        // Muat draf docx yang sudah diproses untuk ditambahkan halaman gambarnya
                        $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempFile);

                        foreach ($images as $img) {
                            $section = $phpWord->addSection([
                                'marginTop' => 0,
                                'marginRight' => 0,
                                'marginBottom' => 0,
                                'marginLeft' => 0,
                            ]);
                            $section->addImage($img, [
                                'width' => 595,
                                'height' => 842,
                                'alignment' => \PhpOffice\SimpleType\Jc::CENTER
                            ]);
                        }

                        // Simpan kembali dokumen Word yang sudah di-merge
                        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                        $writer->save($tempFile);
                    }

                    // Hapus file gambar temp dan foldernya
                    foreach (glob($tempDir . '/*') as $f) {
                        @unlink($f);
                    }
                    @rmdir($tempDir);
                }
            }

            // Clean up the temp template file
            @unlink($tempTemplate);

            return response()->download($tempFile, $outputName)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            @unlink($tempTemplate);
            return redirect()->back()->with('error', 'Gagal memproses template Word: ' . $e->getMessage());
        }
    }

    /**
     * Delete report.
     */
    public function destroy($id)
    {
        $laporan = LaporanBulanan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan bulanan berhasil dihapus.');
    }

    /**
     * Helper to get only Monday, Tuesday, Thursday, Friday for a given month, skipping holidays
     */
    private function getWorkdays($year, $month)
    {
        $days = [];
        $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $dayNames = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu'
        ];

        $holidays = $this->getHolidays();

        for ($d = 1; $d <= $numDays; $d++) {
            $time = mktime(0, 0, 0, $month, $d, $year);
            $dayOfWeek = date('N', $time); // 1 = Senin, 7 = Minggu
            $formattedDate = date('Y-m-d', $time);

            // In array of: Monday, Tuesday, Thursday, Friday AND not a holiday/cuti bersama
            if (in_array($dayOfWeek, [1, 2, 4, 5]) && !in_array($formattedDate, $holidays)) {
                $days[] = [
                    'day_name' => $dayNames[$dayOfWeek],
                    'formatted' => date('Y-m-d', $time)
                ];
            }
        }
        return $days;
    }

    /**
     * Helper to get the first workday of the following month, skipping weekends & holidays
     */
    private function getFirstWorkdayOfNextMonth($year, $month)
    {
        $nextMonth = $month + 1;
        $nextYear = $year;
        if ($nextMonth > 12) {
            $nextMonth = 1;
            $nextYear++;
        }

        $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $holidays = $this->getHolidays();

        // Loop untuk mencari hari kerja pertama yang bukan akhir pekan dan bukan hari libur
        for ($d = 1; $d <= 31; $d++) {
            $time = mktime(0, 0, 0, $nextMonth, $d, $nextYear);
            $dayOfWeek = date('N', $time);
            $formattedDate = date('Y-m-d', $time);

            if (!in_array($dayOfWeek, [6, 7]) && !in_array($formattedDate, $holidays)) {
                return "Gorontalo, $d " . $monthNames[$nextMonth] . " $nextYear";
            }
        }

        return "Gorontalo, 1 " . $monthNames[$nextMonth] . " $nextYear";
    }

    /**
     * List of Indonesian national holidays and cuti bersama for 2025, 2026, and 2027
     */
    private function getHolidays()
    {
        return [
            // === TAHUN 2025 ===
            // Libur Nasional 2025
            '2025-01-01', // Tahun Baru Masehi
            '2025-01-27', // Isra Mikraj
            '2025-01-29', // Tahun Baru Imlek
            '2025-03-29', // Hari Suci Nyepi
            '2025-03-31', // Idul Fitri
            '2025-04-01', // Idul Fitri
            '2025-04-18', // Wafat Yesus Kristus
            '2025-04-20', // Kebangkitan Yesus Kristus (Paskah)
            '2025-05-01', // Hari Buruh Internasional
            '2025-05-12', // Hari Raya Waisak
            '2025-05-29', // Kenaikan Yesus Kristus
            '2025-06-01', // Hari Lahir Pancasila
            '2025-06-06', // Hari Raya Idul Adha
            '2025-06-27', // Tahun Baru Islam
            '2025-08-17', // Hari Proklamasi Kemerdekaan RI
            '2025-09-05', // Maulid Nabi Muhammad SAW
            '2025-12-25', // Hari Raya Natal
            // Cuti Bersama 2025
            '2025-01-28', // Cuti Bersama Imlek
            '2025-03-28', // Cuti Bersama Nyepi
            '2025-04-02', // Cuti Bersama Idul Fitri
            '2025-04-03', // Cuti Bersama Idul Fitri
            '2025-04-04', // Cuti Bersama Idul Fitri
            '2025-04-07', // Cuti Bersama Idul Fitri
            '2025-05-13', // Cuti Bersama Waisak
            '2025-05-30', // Cuti Bersama Kenaikan Yesus Kristus
            '2025-06-09', // Cuti Bersama Idul Adha
            '2025-08-18', // Cuti Bersama Kemerdekaan RI
            '2025-12-26', // Cuti Bersama Natal

            // === TAHUN 2026 ===
            // Libur Nasional 2026
            '2026-01-01', // Tahun Baru Masehi
            '2026-01-16', // Isra Mikraj
            '2026-02-17', // Tahun Baru Imlek
            '2026-03-19', // Hari Suci Nyepi
            '2026-03-21', // Idul Fitri
            '2026-03-22', // Idul Fitri
            '2026-04-03', // Wafat Yesus Kristus
            '2026-04-05', // Kebangkitan Yesus Kristus (Paskah)
            '2026-05-01', // Hari Buruh Internasional
            '2026-05-14', // Kenaikan Yesus Kristus
            '2026-05-27', // Hari Raya Idul Adha
            '2026-05-31', // Hari Raya Waisak
            '2026-06-01', // Hari Lahir Pancasila
            '2026-06-16', // Tahun Baru Islam
            '2026-08-17', // Hari Proklamasi Kemerdekaan RI
            '2026-08-25', // Maulid Nabi Muhammad SAW
            '2026-12-25', // Hari Raya Natal
            // Cuti Bersama 2026
            '2026-02-16', // Cuti Bersama Imlek
            '2026-03-18', // Cuti Bersama Nyepi
            '2026-03-20', // Cuti Bersama Idul Fitri
            '2026-03-23', // Cuti Bersama Idul Fitri
            '2026-03-24', // Cuti Bersama Idul Fitri
            '2026-05-15', // Cuti Bersama Kenaikan Yesus Kristus
            '2026-05-28', // Cuti Bersama Idul Adha
            '2026-12-24', // Cuti Bersama Natal

            // === TAHUN 2027 (Estimasi) ===
            // Libur Nasional 2027
            '2027-01-01', // Tahun Baru Masehi
            '2027-01-05', // Isra Mikraj
            '2027-02-06', // Tahun Baru Imlek
            '2027-03-09', // Hari Suci Nyepi
            '2027-03-10', // Idul Fitri
            '2027-03-11', // Idul Fitri
            '2027-03-26', // Wafat Yesus Kristus
            '2027-03-28', // Kebangkitan Yesus Kristus (Paskah)
            '2027-05-01', // Hari Buruh Internasional
            '2027-05-06', // Kenaikan Yesus Kristus
            '2027-05-17', // Hari Raya Idul Adha
            '2027-05-20', // Hari Raya Waisak
            '2027-06-01', // Hari Lahir Pancasila
            '2027-06-06', // Tahun Baru Islam
            '2027-08-15', // Maulid Nabi Muhammad SAW
            '2027-08-17', // Hari Proklamasi Kemerdekaan RI
            '2027-12-25', // Hari Raya Natal
        ];
    }

    /**
     * Dynamic Template Compiler (On-the-fly parser for original DOCX template)
     */
    private function compileTemplate($originalDocx, $templateDocx)
    {
        // Copy original template to temp template location
        if (!copy($originalDocx, $templateDocx)) {
            throw new \Exception("Gagal menyalin berkas Word asli ke berkas temporary draf.");
        }

        $zip = new \ZipArchive();
        if ($zip->open($templateDocx) !== TRUE) {
            throw new \Exception("Gagal membuka berkas Word draf sebagai ZIP archive.");
        }

        $xmlContent = $zip->getFromName('word/document.xml');
        if ($xmlContent === false) {
            $zip->close();
            throw new \Exception("Gagal membaca word/document.xml dari berkas ZIP.");
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadXML($xmlContent);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);
        $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

        // 1. Process Paragraphs for placeholders
        $paragraphs = $xpath->query('//w:p');
        foreach ($paragraphs as $p) {
            $pText = '';
            $texts = $xpath->query('.//w:t', $p);
            foreach ($texts as $t) {
                $pText .= $t->nodeValue;
            }
            
            // Check for date: Gorontalo, 1 Agustus 2026
            if (preg_match('/Gorontalo,\s*\d+\s*Agustus\s*2026/i', $pText)) {
                $this->replaceParagraphText($xpath, $p, '${tanggal_laporan}');
            }
            // Check for Hal: Laporan Kinerja Periode Juli
            elseif (preg_match('/Hal\s*:\s*Laporan\s*Kinerja\s*Periode\s*Juli/i', $pText)) {
                $this->replaceParagraphText($xpath, $p, 'Hal : Laporan Kinerja Periode ${periode_laporan}');
            }
            // Check for "periode Juli 2026 sebagaimana terlampir"
            elseif (preg_match('/periode\s*Juli\s*2026\s*sebagaimana\s*terlampir/i', $pText)) {
                $newTxt = str_replace('periode Juli 2026 sebagaimana terlampir', 'periode ${periode_laporan} ${tahun_laporan} sebagaimana terlampir', $pText);
                $this->replaceParagraphText($xpath, $p, $newTxt);
            }
            // Check for title "LAPORAN KINERJA PELAKSANAAN TUGAS DAN TANGGUNG JAWAB ... PERIODE BULAN JULI 2026"
            elseif (preg_match('/PERIODE\s*BULAN\s*JULI\s*2026/i', $pText)) {
                $newTxt = str_replace('PERIODE BULAN JULI 2026', 'PERIODE BULAN ${periode_laporan_upper} ${tahun_laporan}', $pText);
                $this->replaceParagraphText($xpath, $p, $newTxt);
            }
            // Check for "sebagai Tenaga Ahli ...,untuk periode Juli 2026."
            elseif (preg_match('/untuk\s*periode\s*Juli\s*2026/i', $pText)) {
                $newTxt = str_replace('untuk periode Juli 2026', 'untuk periode ${periode_laporan} ${tahun_laporan}', $pText);
                $this->replaceParagraphText($xpath, $p, $newTxt);
            }
            // Check for "selama periode Juli 2026"
            elseif (preg_match('/selama\s*periode\s*Juli\s*2026/i', $pText)) {
                $newTxt = str_replace('selama periode Juli 2026', 'selama periode ${periode_laporan} ${tahun_laporan}', $pText);
                $this->replaceParagraphText($xpath, $p, $newTxt);
            }
            // Check for "selama bulan Juli 2026"
            elseif (preg_match('/selama\s*bulan\s*Juli\s*2026/i', $pText)) {
                $newTxt = str_replace('selama bulan Juli 2026', 'selama bulan ${periode_laporan} ${tahun_laporan}', $pText);
                $this->replaceParagraphText($xpath, $p, $newTxt);
            }
            // Check for "pada bulan Juli 2026 ini"
            elseif (preg_match('/pada\s*bulan\s*Juli\s*2026\s*ini/i', $pText)) {
                $newTxt = str_replace('pada bulan Juli 2026 ini', 'pada bulan ${periode_laporan} ${tahun_laporan} ini', $pText);
                $this->replaceParagraphText($xpath, $p, $newTxt);
            }
            // Check for footer "periode Juli 2026, atas perhatian"
            elseif (preg_match('/periode\s*Juli\s*2026,\s*atas\s*perhatian/i', $pText)) {
                $newTxt = str_replace('periode Juli 2026, atas perhatian', 'periode ${periode_laporan} ${tahun_laporan}, atas perhatian', $pText);
                $this->replaceParagraphText($xpath, $p, $newTxt);
            }
        }

        // 2. Process Tables
        $tables = $xpath->query('//w:tbl');
        foreach ($tables as $table) {
            $rows = $xpath->query('.//w:tr', $table);
            if ($rows->length < 2) continue;
            
            $row2 = $rows->item(1); 
            $cells = $xpath->query('.//w:tc', $row2);
            
            if ($cells->length >= 3) {
                $this->replaceCellText($xpath, $cells->item(0), '${no}');
                $this->replaceCellText($xpath, $cells->item(1), '${tanggal}');
                $this->replaceCellText($xpath, $cells->item(2), '${kegiatan}');
            }
            
            for ($i = 2; $i < $rows->length; $i++) {
                $table->removeChild($rows->item($i));
            }
        }

        // 3. Process Saran/Masukan
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
            $pTemplateItemClone = $pTemplateItem->cloneNode(true);
            $this->replaceParagraphText($xpath, $pTemplateItemClone, '${saran_text}');
            
            $dom = $pSaran->ownerDocument;
            $pBlockStart = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:p');
            $rStart = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:r');
            $tStart = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:t');
            $tStart->nodeValue = '${saran_block}';
            $rStart->appendChild($tStart);
            $pBlockStart->appendChild($rStart);
            
            $pBlockEnd = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:p');
            $rEnd = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:r');
            $tEnd = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:t');
            $tEnd->nodeValue = '${/saran_block}';
            $rEnd->appendChild($tEnd);
            $pBlockEnd->appendChild($rEnd);
            
            $nodesToDelete = [];
            $curr = $pSaran->nextSibling;
            while ($curr && $curr !== $pPenutup) {
                $nodesToDelete[] = $curr;
                $curr = $curr->nextSibling;
            }
            
            $parent = $pSaran->parentNode;
            foreach ($nodesToDelete as $node) {
                $parent->removeChild($node);
            }
            
            $pSpacing1 = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:p');
            $parent->insertBefore($pSpacing1, $pPenutup);
            $parent->insertBefore($pBlockStart, $pPenutup);
            $parent->insertBefore($pTemplateItemClone, $pPenutup);
            $parent->insertBefore($pBlockEnd, $pPenutup);
        }

        $newXml = $dom->saveXML();
        $zip->deleteName('word/document.xml');
        $zip->addFromString('word/document.xml', $newXml);
        $zip->close();
    }

    /**
     * Helper to replace all text nodes in a paragraph with a single text node
     */
    private function replaceParagraphText($xpath, $p, $newText)
    {
        $runs = $xpath->query('.//w:r', $p);
        if ($runs->length == 0) return;
        
        $firstRun = $runs->item(0);
        $texts = $xpath->query('.//w:t', $firstRun);
        foreach ($texts as $t) {
            $firstRun->removeChild($t);
        }
        
        $dom = $p->ownerDocument;
        $newT = $dom->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'w:t');
        if (strpos($newText, ' ') !== false) {
            $newT->setAttribute('xml:space', 'preserve');
        }
        $newT->nodeValue = $newText;
        $firstRun->appendChild($newT);
        
        for ($i = 1; $i < $runs->length; $i++) {
            $p->removeChild($runs->item($i));
        }
    }

    /**
     * Helper to replace all text in a cell (w:tc) with a single text node
     */
    private function replaceCellText($xpath, $cell, $newText)
    {
        $paragraphs = $xpath->query('.//w:p', $cell);
        if ($paragraphs->length == 0) return;
        
        $firstP = $paragraphs->item(0);
        $this->replaceParagraphText($xpath, $firstP, $newText);
        
        for ($i = 1; $i < $paragraphs->length; $i++) {
            $cell->removeChild($paragraphs->item($i));
        }
    }
}
