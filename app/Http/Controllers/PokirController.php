<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokir;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\PokirPlan;
use Illuminate\Support\Facades\DB;

class PokirController extends Controller
{ // Fungsi bantuan agar filter bisa dipakai di Index, Print, dan Excel
    private function getFilteredPokir($request)
    {
        $query = Pokir::latest();

        if ($request->filled('kategori_usulan')) {
            $query->where('kategori_usulan', $request->kategori_usulan);
        }
        if ($request->filled('opd_tujuan')) {
            $query->where('opd_tujuan', $request->opd_tujuan);
        }
        if ($request->filled('anggota_dprd')) {
            $query->where('anggota_dprd', 'like', '%' . $request->anggota_dprd . '%');
        }
        if ($request->filled('tahun_anggaran')) {
            $query->where('tahun_anggaran', $request->tahun_anggaran);
        }
        if ($request->filled('tipe_apbd')) {
            $query->where('tipe_apbd', $request->tipe_apbd);
        }

        return $query;
    }

    // HALAMAN UTAMA (LIST & FILTER)
    public function index(Request $request)
    {
        // Gunakan pagination agar halaman tidak berat
        $pokirs = $this->getFilteredPokir($request)->paginate(10);
        
        // Ambil data unik untuk filter
        $alegs = PokirPlan::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        $opds = PokirPlan::distinct()->orderBy('opd_tujuan')->pluck('opd_tujuan')->toArray();
        $kategoris = Pokir::distinct()->orderBy('kategori_usulan')->pluck('kategori_usulan')->toArray();

        $currentYear = date('Y');
        $yearsRange = range($currentYear - 2, $currentYear + 4);

        return view('pokir.index', compact('pokirs', 'alegs', 'opds', 'kategoris', 'yearsRange'));
    }



    // CETAK (Ikut Filter)
    public function print(Request $request)
    {
        $pokirs = $this->getFilteredPokir($request)->get(); // Get all (sesuai filter)
        return view('pokir.print', compact('pokirs'));
    }

    // EXPORT EXCEL (Ikut Filter)
    public function exportExcel(Request $request)
    {
        $dataPokir = $this->getFilteredPokir($request)->get();
        $totalData = $dataPokir->count();

        if ($totalData == 0) return redirect()->back()->with('error', 'Data kosong.');

        $templatePath = storage_path('app/template_pokir.xlsx');
        if (!file_exists($templatePath)) return redirect()->back()->with('error', 'Template tidak ada.');

        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();

        $startRow = 9;

        if ($totalData > 1) {
            $sheet->insertNewRowBefore($startRow + 1, $totalData - 1);
        }

        foreach ($dataPokir as $index => $row) {
            $currentRow = $startRow + $index;
            $sheet->setCellValue('A' . $currentRow, $index + 1);
            $sheet->setCellValue('B' . $currentRow, $row->judul_lengkap);
            $sheet->setCellValue('C' . $currentRow, $row->alamat);
            $sheet->setCellValue('D' . $currentRow, $row->nama_pemohon);
            $sheet->setCellValue('E' . $currentRow, $row->identitas_pemohon);
            $sheet->setCellValue('F' . $currentRow, $row->anggota_dprd);
            $sheet->setCellValue('G' . $currentRow, $row->status_berkas);
            $sheet->setCellValue('H' . $currentRow, $row->operator_penerima);
            $sheet->setCellValue('I' . $currentRow, $row->opd_tujuan);
        }

        // Nama file lebih spesifik (misal: Laporan_UMKM.xlsx)
        $suffix = $request->kategori_usulan ? '_' . $request->kategori_usulan : '';
        $fileName = 'Laporan_Pokir' . $suffix . '_' . date('Ymd_Hi') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    // IMPORT EXCEL USULAN
    public function importExcel(Request $request)
    {
        $request->validate([
            'file_excel'          => 'required|mimes:xlsx,xls',
            'tanggal_penerimaan'  => 'required|date',
            'tahun_anggaran'      => 'required|numeric',
            'tipe_apbd'           => 'required|string|in:Induk,Perubahan',
            'keterangan_upload'   => 'nullable|string',
        ]);

        try {
            $file = $request->file('file_excel');
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            DB::beginTransaction();

            $countInput = 0;

            foreach ($rows as $index => $row) {
                // Filter baris (kolom A harus numerik)
                if (empty($row[0]) || !is_numeric($row[0])) {
                    continue;
                }

                // Kolom B (index 1): JUDUL PERMOHONAN -> kategori_usulan
                // Kolom C (index 2): ALAMAT -> alamat
                // Kolom D (index 3): YANG BERMOHON -> nama_pemohon
                // Kolom E (index 4): IDENTITAS -> identitas_pemohon
                // Kolom F (index 5): ANGGOTA DPRD PENGUSUL -> anggota_dprd
                // Kolom G (index 6): KET BERKAS -> status_berkas
                // Kolom H (index 7): KET PENERIMA -> operator_penerima
                // Kolom I (index 8): DINAS TERKAIT -> opd_tujuan

                $alegInput = trim(preg_replace('/\s+/', ' ', $row[5] ?? 'Umum'));
                $opdInput = trim(preg_replace('/\s+/', ' ', $row[8] ?? 'Dinas Terkait'));

                // Cari rencana kerja (Master Pagu) yang sesuai
                $plan = PokirPlan::where('tahun_anggaran', $request->tahun_anggaran)
                    ->where('tipe_apbd', $request->tipe_apbd)
                    ->where('anggota_dprd', $alegInput)
                    ->where('opd_tujuan', $opdInput)
                    ->first();

                $planId = null;
                $statusSistem = 'Usulan Baru';

                if ($plan) {
                    $planId = $plan->id;
                    // Hitung jumlah yang sudah 'Terakomodir' pada rencana kerja ini secara dinamis
                    $terpakai = Pokir::where('pokir_plan_id', $plan->id)
                        ->where('status_sistem', 'Terakomodir')
                        ->count();

                    if ($terpakai < $plan->volume_target) {
                        $statusSistem = 'Terakomodir';
                    } else {
                        $statusSistem = 'Cadangan';
                    }
                }

                Pokir::create([
                    'kategori_usulan'    => $row[1] ?? 'Umum',
                    'alamat'             => $row[2] ?? '-',
                    'nama_pemohon'       => $row[3] ?? 'Anonim',
                    'identitas_pemohon'  => $row[4] ?? null,
                    'anggota_dprd'       => $alegInput,
                    'status_berkas'      => $row[6] ?? '1 Proposal',
                    'operator_penerima'  => $row[7] ?? null,
                    'opd_tujuan'         => $opdInput,
                    
                    // Kolom relasi & metadata baru
                    'pokir_plan_id'      => $planId,
                    'status_sistem'      => $statusSistem,
                    'tanggal_penerimaan' => $request->tanggal_penerimaan,
                    'tahun_anggaran'     => $request->tahun_anggaran,
                    'tipe_apbd'          => $request->tipe_apbd,
                    'keterangan_upload'  => $request->keterangan_upload,
                ]);

                $countInput++;
            }

            DB::commit();
            return redirect()->route('pokir.index')->with('success', "Sukses! $countInput berkas usulan berhasil diimport dan diselaraskan dengan Master Pagu.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pokir.index')->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    // HALAMAN MATRIKS REALISASI (SUMMARY & GAP ANALYSIS)
    public function matrix(Request $request)
    {
        // 1. Ambil data unik untuk pilihan filter
        $alegs = PokirPlan::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        if (empty($alegs)) {
            // fallback jika master plan kosong, ambil dari pokirs
            $alegs = Pokir::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        }

        $opds = PokirPlan::distinct()->orderBy('opd_tujuan')->pluck('opd_tujuan')->toArray();
        if (empty($opds)) {
            $opds = Pokir::distinct()->orderBy('opd_tujuan')->pluck('opd_tujuan')->toArray();
        }

        // Default values
        $selectedAleg = $request->query('anggota_dprd', $alegs[0] ?? '');
        $selectedTahun = $request->query('tahun_anggaran', 2026);
        $selectedTipe = $request->query('tipe_apbd', 'Induk');

        // 2. Query Pagu Target (Master Pagu)
        $plansQuery = PokirPlan::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->where('anggota_dprd', $selectedAleg);

        if ($request->filled('opd_tujuan')) {
            $plansQuery->where('opd_tujuan', $request->opd_tujuan);
        }

        if ($request->filled('nama_kegiatan')) {
            $plansQuery->where('nama_kegiatan', 'like', '%' . $request->nama_kegiatan . '%');
        }

        $plans = $plansQuery->with(['pokirs'])->get();

        // 3. Query Usulan Tanpa Pagu (Orphan / Usulan Baru)
        $orphanQuery = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->where('anggota_dprd', $selectedAleg)
            ->whereNull('pokir_plan_id');

        if ($request->filled('opd_tujuan')) {
            $orphanQuery->where('opd_tujuan', $request->opd_tujuan);
        }

        $orphans = $orphanQuery->get();

        // Pilihan tahun
        $currentYear = date('Y');
        $yearsRange = range($currentYear - 2, $currentYear + 4);

        return view('pokir.matrix', compact(
            'alegs',
            'opds',
            'selectedAleg',
            'selectedTahun',
            'selectedTipe',
            'plans',
            'orphans',
            'yearsRange'
        ));
    }

    // EXPORT MATRIKS REALISASI KE EXCEL
    public function exportMatrixExcel(Request $request)
    {
        // 1. Ambil data unik untuk filter
        $alegs = PokirPlan::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        if (empty($alegs)) {
            $alegs = Pokir::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        }

        $selectedAleg = $request->query('anggota_dprd', $alegs[0] ?? '');
        $selectedTahun = $request->query('tahun_anggaran', 2026);
        $selectedTipe = $request->query('tipe_apbd', 'Induk');

        // Query Pagu Target (Master Pagu)
        $plansQuery = PokirPlan::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->where('anggota_dprd', $selectedAleg);

        if ($request->filled('opd_tujuan')) {
            $plansQuery->where('opd_tujuan', $request->opd_tujuan);
        }

        if ($request->filled('nama_kegiatan')) {
            $plansQuery->where('nama_kegiatan', 'like', '%' . $request->nama_kegiatan . '%');
        }

        $plans = $plansQuery->with(['pokirs'])->get();

        // Query Usulan Tanpa Pagu (Orphan / Usulan Baru)
        $orphanQuery = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->where('anggota_dprd', $selectedAleg)
            ->whereNull('pokir_plan_id');

        if ($request->filled('opd_tujuan')) {
            $orphanQuery->where('opd_tujuan', $request->opd_tujuan);
        }

        $orphans = $orphanQuery->get();

        // 2. Load file Excel Template
        $templatePath = storage_path('app/contoh_matriks_aleg.xlsx');
        if (file_exists($templatePath)) {
            $spreadsheet = IOFactory::load($templatePath);
        } else {
            $spreadsheet = new Spreadsheet();
        }
        
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Matriks Realisasi');

        // Hapus isi data bawaan template dari baris 7 kebawah
        $highestRow = $sheet->getHighestRow();
        if ($highestRow >= 7) {
            $sheet->removeRow(7, $highestRow - 6);
        }

        $currentRow = 7;

        // Loop Plans
        foreach ($plans as $index => $plan) {
            // Plan Title Block
            $sheet->setCellValue('B' . $currentRow, 'USULAN ' . strtoupper($plan->nama_kegiatan) . ' ALEG PENGUSUL An : ' . $selectedAleg);
            $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->mergeCells('B' . $currentRow . ':F' . $currentRow);

            $currentRow++;

            // Total Usulan Row
            $linkedPokirs = $plan->pokirs;
            $sheet->setCellValue('B' . $currentRow, 'TOTAL ' . $linkedPokirs->count() . ' USULAN');
            $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->mergeCells('B' . $currentRow . ':F' . $currentRow);

            $currentRow++;

            // Table Header Row
            $sheet->setCellValue('B' . $currentRow, 'No');
            $sheet->setCellValue('C' . $currentRow, 'Jenis Usulan');
            $sheet->setCellValue('D' . $currentRow, 'Nama Pengusul');
            $sheet->setCellValue('E' . $currentRow, 'Alamat');
            $sheet->setCellValue('F' . $currentRow, 'Ket');

            $headerRange = 'B' . $currentRow . ':F' . $currentRow;
            $sheet->getStyle($headerRange)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->getStyle($headerRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFC000'); // Orange/Gold
            $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $currentRow++;

            // Data Rows
            if ($linkedPokirs->count() > 0) {
                $dataStartRow = $currentRow;
                foreach ($linkedPokirs as $pIdx => $pokir) {
                    $namaPengusul = $pokir->nama_pemohon . ($pokir->identitas_pemohon ? ' (' . $pokir->identitas_pemohon . ')' : '');

                    $sheet->setCellValue('B' . $currentRow, $pIdx + 1);
                    $sheet->setCellValue('C' . $currentRow, $pokir->kategori_usulan);
                    $sheet->setCellValue('D' . $currentRow, $namaPengusul);
                    $sheet->setCellValue('E' . $currentRow, $pokir->alamat);
                    $sheet->setCellValue('F' . $currentRow, $pokir->status_berkas ?? 'Ada');

                    $currentRow++;
                }
                $dataEndRow = $currentRow - 1;
                $sheet->getStyle('B' . $dataStartRow . ':F' . $dataEndRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            } else {
                // Tulis satu baris info gap / kosong
                $sheet->setCellValue('B' . $currentRow, '1');
                $sheet->setCellValue('C' . $currentRow, 'Belum ada usulan warga terakomodir');
                $sheet->setCellValue('D' . $currentRow, '-');
                $sheet->setCellValue('E' . $currentRow, '-');
                $sheet->setCellValue('F' . $currentRow, 'Kekurangan ' . $plan->volume_target . ' berkas');

                $sheet->getStyle('B' . $currentRow . ':F' . $currentRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('F' . $currentRow)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED))->setBold(true);

                $currentRow++;
            }

            // Tambahkan spacing kosong di antara pagu
            $currentRow += 2;
        }

        // Tulis Usulan Tanpa Pagu (jika ada)
        if ($orphans->count() > 0) {
            $sheet->setCellValue('B' . $currentRow, 'USULAN TANPA PAGU (ORPHAN PROPOSALS) ALEG PENGUSUL An : ' . $selectedAleg);
            $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->mergeCells('B' . $currentRow . ':F' . $currentRow);

            $currentRow++;

            $sheet->setCellValue('B' . $currentRow, 'TOTAL ' . $orphans->count() . ' USULAN');
            $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->mergeCells('B' . $currentRow . ':F' . $currentRow);

            $currentRow++;

            $sheet->setCellValue('B' . $currentRow, 'No');
            $sheet->setCellValue('C' . $currentRow, 'OPD & Jenis Usulan');
            $sheet->setCellValue('D' . $currentRow, 'Nama Pengusul');
            $sheet->setCellValue('E' . $currentRow, 'Alamat');
            $sheet->setCellValue('F' . $currentRow, 'Ket');

            $headerRange = 'B' . $currentRow . ':F' . $currentRow;
            $sheet->getStyle($headerRange)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->getStyle($headerRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFEE2E2'); // Light Red
            $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $currentRow++;

            $dataStartRow = $currentRow;
            foreach ($orphans as $oIdx => $orphan) {
                $namaPengusul = $orphan->nama_pemohon . ($orphan->identitas_pemohon ? ' (' . $orphan->identitas_pemohon . ')' : '');
                $jenisUsulan = '[' . $orphan->opd_tujuan . '] ' . $orphan->kategori_usulan;

                $sheet->setCellValue('B' . $currentRow, $oIdx + 1);
                $sheet->setCellValue('C' . $currentRow, $jenisUsulan);
                $sheet->setCellValue('D' . $currentRow, $namaPengusul);
                $sheet->setCellValue('E' . $currentRow, $orphan->alamat);
                $sheet->setCellValue('F' . $currentRow, $orphan->status_berkas ?? 'Usulan Baru');

                $currentRow++;
            }
            $dataEndRow = $currentRow - 1;
            $sheet->getStyle('B' . $dataStartRow . ':F' . $dataEndRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }

        // Autofilter column widths untuk kolom B sampai F
        foreach (range('B', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'Matriks_Realisasi_' . str_replace(' ', '_', $selectedAleg) . '_' . $selectedTahun . '_' . $selectedTipe . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
