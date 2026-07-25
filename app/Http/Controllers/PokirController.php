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

                $alegInput = trim($row[5] ?? 'Umum');
                $opdInput = trim($row[8] ?? 'Dinas Terkait');

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
}
