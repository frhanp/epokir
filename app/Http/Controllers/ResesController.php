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
            // Genapkan array kecuali layout 3 (karena layout 3 logicnya manual)
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

        return $pdf->stream('Laporan_SPJ_Reses.pdf');
    }
}
