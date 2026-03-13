<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokir;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. STATS UTAMA
        $totalUsulan = Pokir::count();
        $totalOpd = Pokir::distinct('opd_tujuan')->count();
        $totalAleg = Pokir::distinct('anggota_dprd')->count();

        // 2. DATA UNTUK CHART KATEGORI (Donut Chart)
        $statsKategori = Pokir::select('kategori_usulan', DB::raw('count(*) as total'))
            ->groupBy('kategori_usulan')
            ->orderByDesc('total')
            ->get();

        $labelKategori = $statsKategori->pluck('kategori_usulan');
        $dataKategori = $statsKategori->pluck('total');

        // 3. DATA PER OPD (Top Leaderboard)
        $statsOpd = Pokir::select('opd_tujuan', DB::raw('count(*) as total'))
            ->groupBy('opd_tujuan')
            ->orderByDesc('total')
            ->get(); // Kita ambil semua, nanti di view kita limit tampilannya

        // 4. DATA PER ALEG (Progress Bar)
        $statsAleg = Pokir::select('anggota_dprd', DB::raw('count(*) as total'))
            ->groupBy('anggota_dprd')
            ->orderByDesc('total')
            ->get();

        // Cari nilai tertinggi untuk kalkulasi persentase progress bar
        $maxAleg = $statsAleg->max('total') ?? 1;

        return view('dashboard', compact(
            'totalUsulan',
            'totalOpd',
            'totalAleg',
            'labelKategori',
            'dataKategori',
            'statsOpd',
            'statsAleg',
            'maxAleg'
        ));
    }

    // TAMBAHAN BARU: API UNTUK CEK SEBARAN PAGU
    public function cekPagu(Request $request)
    {
        $keyword = $request->keyword;

        if (empty($keyword)) {
            return response()->json(['data' => [], 'total_global' => 0]);
        }

        // Cari di Master Plan (Pagu), kelompokkan per Aleg
        $results = \App\Models\PokirPlan::where('nama_kegiatan', 'LIKE', "%{$keyword}%")
            ->select(
                'anggota_dprd',
                DB::raw('SUM(volume_target) as total_volume'),
                DB::raw('COUNT(*) as total_paket'),
                DB::raw('MAX(satuan) as satuan') // Ambil salah satu satuan
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
