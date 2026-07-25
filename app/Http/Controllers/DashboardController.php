<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokir;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedTahun = $request->query('tahun', 2026);
        $selectedTipe = $request->query('tipe', 'Induk');

        // 1. STATS UTAMA (Sesuai Filter)
        $totalUsulan = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->count();
            
        $totalOpd = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->distinct('opd_tujuan')
            ->count();
            
        $totalAleg = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->distinct('anggota_dprd')
            ->count();

        // 2. DATA UNTUK CHART KATEGORI (Donut Chart - Sesuai Filter)
        $statsKategori = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->select('kategori_usulan', DB::raw('count(*) as total'))
            ->groupBy('kategori_usulan')
            ->orderByDesc('total')
            ->get();

        $labelKategori = $statsKategori->pluck('kategori_usulan');
        $dataKategori = $statsKategori->pluck('total');

        // 3. DATA PER OPD (Top Leaderboard - Sesuai Filter)
        $statsOpd = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->select('opd_tujuan', DB::raw('count(*) as total'))
            ->groupBy('opd_tujuan')
            ->orderByDesc('total')
            ->get();

        // 4. DATA SISA POKIR PER ANGGOTA (Aleg List - Sesuai Filter)
        $alegsPagu = \App\Models\PokirPlan::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->select('anggota_dprd', DB::raw('SUM(volume_target) as total_target'))
            ->groupBy('anggota_dprd')
            ->orderByDesc('total_target')
            ->get();

        $statsAleg = [];
        foreach ($alegsPagu as $ap) {
            $name = $ap->anggota_dprd;
            
            $terakomodir = Pokir::where('tahun_anggaran', $selectedTahun)
                ->where('tipe_apbd', $selectedTipe)
                ->where('anggota_dprd', $name)
                ->where('status_sistem', 'Terakomodir')
                ->count();

            $cadangan = Pokir::where('tahun_anggaran', $selectedTahun)
                ->where('tipe_apbd', $selectedTipe)
                ->where('anggota_dprd', $name)
                ->where('status_sistem', 'Cadangan')
                ->count();

            $usulanBaru = Pokir::where('tahun_anggaran', $selectedTahun)
                ->where('tipe_apbd', $selectedTipe)
                ->where('anggota_dprd', $name)
                ->where('status_sistem', 'Usulan Baru')
                ->count();

            $statsAleg[] = (object)[
                'anggota_dprd' => $name,
                'total_target' => (int) $ap->total_target,
                'terakomodir'  => $terakomodir,
                'cadangan'     => $cadangan,
                'usulan_baru'  => $usulanBaru,
                'sisa_kuota'   => max(0, (int)$ap->total_target - $terakomodir),
            ];
        }

        // Ambil Aleg yang tidak ada pagunya tapi punya usulan di tahun/tipe ini
        $alegsPokirOnly = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->whereNotIn('anggota_dprd', $alegsPagu->pluck('anggota_dprd'))
            ->distinct('anggota_dprd')
            ->pluck('anggota_dprd');

        foreach ($alegsPokirOnly as $name) {
            $usulanBaru = Pokir::where('tahun_anggaran', $selectedTahun)
                ->where('tipe_apbd', $selectedTipe)
                ->where('anggota_dprd', $name)
                ->count();

            $statsAleg[] = (object)[
                'anggota_dprd' => $name,
                'total_target' => 0,
                'terakomodir'  => 0,
                'cadangan'     => 0,
                'usulan_baru'  => $usulanBaru,
                'sisa_kuota'   => 0,
            ];
        }

        // Urutkan $statsAleg berdasarkan total_target / sisa_kuota descending
        usort($statsAleg, function($a, $b) {
            return $b->total_target <=> $a->total_target;
        });

        // Buat daftar pilihan tahun (misal: 2 tahun ke belakang dan 4 tahun ke depan)
        $currentYear = date('Y');
        $yearsRange = range($currentYear - 2, $currentYear + 4);

        return view('dashboard', compact(
            'totalUsulan',
            'totalOpd',
            'totalAleg',
            'labelKategori',
            'dataKategori',
            'statsOpd',
            'statsAleg',
            'selectedTahun',
            'selectedTipe',
            'yearsRange'
        ));
    }

    // CEK SEBARAN PAGU
    public function cekPagu(Request $request)
    {
        $keyword = $request->keyword;
        $tahun = $request->query('tahun', 2026);
        $tipe = $request->query('tipe', 'Induk');

        if (empty($keyword)) {
            return response()->json(['data' => [], 'total_global' => 0]);
        }

        // Cari di Master Plan (Pagu), kelompokkan per Aleg
        $results = \App\Models\PokirPlan::where('tahun_anggaran', $tahun)
            ->where('tipe_apbd', $tipe)
            ->where('nama_kegiatan', 'LIKE', "%{$keyword}%")
            ->select(
                'anggota_dprd',
                DB::raw('SUM(volume_target) as total_volume'),
                DB::raw('COUNT(*) as total_paket'),
                DB::raw('MAX(satuan) as satuan')
            )
            ->groupBy('anggota_dprd')
            ->orderByDesc('total_volume')
            ->get();

        $totalGlobal = $results->sum('total_volume');

        return response()->json([
            'data' => $results,
            'total_global' => $totalGlobal
        ]);
    }
}
