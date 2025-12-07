<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokir;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        return $query;
    }

    // HALAMAN UTAMA (LIST & FILTER)
    public function index(Request $request)
    {
        // Gunakan pagination agar halaman tidak berat
        $pokirs = $this->getFilteredPokir($request)->paginate(10);
        return view('pokir.index', compact('pokirs'));
    }

    // HALAMAN INPUT (FORM)
    public function create()
    {
        return view('pokir.create');
    }

    // PROSES SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'kategori_usulan' => 'required',
            'opd_tujuan' => 'required',
            'alamat' => 'required',
            'nama_pemohon' => 'required',
            'anggota_dprd' => 'required',
        ]);

        Pokir::create([
            'kategori_usulan' => $request->kategori_usulan,
            'spesifikasi' => $request->spesifikasi,
            'opd_tujuan' => $request->opd_tujuan,
            'alamat' => $request->alamat,
            'nama_pemohon' => $request->nama_pemohon,
            'identitas_pemohon' => $request->identitas_pemohon,
            'anggota_dprd' => $request->anggota_dprd,
            'status_berkas' => $request->status_berkas,
            'operator_penerima' => $request->operator_penerima ?? 'IVHON',
        ]);

        // Redirect ke Index agar bisa lihat hasil input
        return redirect()->route('pokir.index')->with('success', 'Data berhasil disimpan.');
    }



    public function createBulk()
    {
        return view('pokir.create-bulk');
    }

    // 2. SIMPAN DATA MASSAL
    public function storeBulk(Request $request)
    {
        // Validasi Header
        $request->validate([
            'kategori_usulan' => 'required',
            'opd_tujuan' => 'required',
            'anggota_dprd' => 'required',
            
            // Validasi Array Detail
            'details' => 'required|array|min:1',
            'details.*.nama_pemohon' => 'required', 
            'details.*.alamat' => 'required',
        ]);

        $dataHeader = [
            'kategori_usulan' => $request->kategori_usulan,
            'opd_tujuan' => $request->opd_tujuan,
            'anggota_dprd' => $request->anggota_dprd,
            'operator_penerima' => 'IVHON', // Default
        ];

        // Looping simpan per baris
        foreach ($request->details as $row) {
            // Cek jika baris kosong (nama pemohon tidak diisi), skip saja
            if (empty($row['nama_pemohon'])) continue;

            Pokir::create(array_merge($dataHeader, [
                'spesifikasi' => $row['spesifikasi'] ?? null,
                'nama_pemohon' => $row['nama_pemohon'],
                'identitas_pemohon' => $row['identitas_pemohon'] ?? null,
                'alamat' => $row['alamat'],
                'status_berkas' => $row['status_berkas'] ?? null,
            ]));
        }

        return redirect()->route('pokir.index')->with('success', 'Input massal berhasil disimpan!');
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


    
}
