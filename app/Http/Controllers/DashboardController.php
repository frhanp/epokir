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
            'totalUsulan', 'totalOpd', 'totalAleg',
            'labelKategori', 'dataKategori',
            'statsOpd',
            'statsAleg', 'maxAleg'
        ));
    }
}
