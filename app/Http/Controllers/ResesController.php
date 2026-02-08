<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResesController extends Controller
{
    public function index()
    {
        return view('reses.index');
    }

    public function printPdf(Request $request)
    {
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', '300');

        $data = $request->validate([
            'global_header_type' => 'required|string',
            'global_deskripsi'   => 'nullable|string',
            'global_masa_sidang' => 'nullable|string',
            'global_dapil'       => 'nullable|string',
            'sheets'             => 'array',
            'sheets.*.title'     => 'nullable|string',
            'sheets.*.tanggal'   => 'nullable|string',
            'sheets.*.layout'    => 'required|numeric',
            'sheets.*.photos'    => 'array',
        ]);

        foreach ($data['sheets'] as $key => &$sheet) {
            $photos = $sheet['photos'] ?? [];
            $layoutCount = (int) $sheet['layout'];

            for ($i = count($photos); $i < $layoutCount; $i++) {
                $photos[] = null;
            }
            if ($layoutCount != 3 && count($photos) % 2 != 0) {
                $photos[] = null;
            }
            $sheet['photos'] = $photos;
        }

        $pdf = Pdf::loadView('reses.pdf', $data)
            ->setPaper('a4', 'portrait')
            ->setOption([
                'dpi' => 120,
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true
            ]);

        // --- UPDATE: BUAT NAMA FILE DINAMIS ---
        // Contoh hasil: Reses_Standar_20260208_1030.pdf
        $jenis = ucfirst($data['global_header_type']); // Standar / Tatap_muka
        $waktu = date('Ymd_His'); // Jam detik unik
        $namaFile = "Laporan_Reses_{$jenis}_{$waktu}.pdf";

        return $pdf->stream($namaFile);
    }
}
