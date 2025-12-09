<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PokirPlan;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    // Halaman List Rencana Kerja
    public function index()
    {
        // Ambil semua data, urutkan per Aleg lalu per OPD, kemudian GROUP BY Aleg
        $groupedPlans = PokirPlan::orderBy('anggota_dprd')
            ->orderBy('opd_tujuan')
            ->get()
            ->groupBy('anggota_dprd');

        return view('plan.index', compact('groupedPlans'));
    }

    public function import(Request $request)
    {
        $request->validate(['file_excel' => 'required|mimes:xlsx,xls']);

        try {
            $file = $request->file('file_excel');
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            DB::beginTransaction();

            $countInput = 0;

            // --- VARIABEL PENGINGAT (Untuk Handle Merged Cell) ---
            $lastOpd = null; // Awalnya kosong
            $lastAleg = null; // Jaga-jaga kalau kolom Aleg juga di-merge

            foreach ($rows as $index => $row) {
                // 1. Skip Header (Mulai baca dari baris 4 / Index 3)
                if ($index < 3) continue;

                // 2. Filter Baris Sampah (Cek Kolom A harus Angka)
                if (empty($row[0]) || !is_numeric($row[0])) {
                    continue;
                }

                // --- LOGIKA UN-MERGE (MEMORY) ---

                // Cek Kolom OPD (Index 6 / Kolom G)
                if (!empty($row[6])) {
                    // Kalau ada isinya, kita update ingatan kita
                    $lastOpd = $row[6];
                }
                // Kalau kosong, $lastOpd akan tetap memegang nilai dari baris sebelumnya

                // Cek Kolom Aleg (Index 7 / Kolom H) - Jaga-jaga kalau ini juga merge
                if (!empty($row[7])) {
                    $lastAleg = $row[7];
                }

                // --------------------------------

                PokirPlan::create([
                    'nama_kegiatan' => $row[1],
                    'volume_target' => (int) $row[2],
                    'satuan'        => $row[3] ?? 'Paket',
                    'harga_satuan'  => $this->cleanNumber($row[4]),
                    'pagu_total'    => $this->cleanNumber($row[5]),

                    // PENTING: Gunakan variable pengingat, bukan $row[6] mentah
                    'opd_tujuan'    => $lastOpd ?? 'Dinas Terkait',
                    'anggota_dprd'  => $lastAleg ?? 'Umum',

                    'tahun_anggaran' => 2026
                ]);

                $countInput++;
            }

            DB::commit();
            return redirect()->back()->with('success', "Sukses! $countInput program berhasil diimport (Merged Cells handled).");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }

    // Helper Bersihkan Rupiah
    private function cleanNumber($string)
    {
        if (empty($string)) return 0;
        if (is_numeric($string)) return $string;
        return (float) preg_replace('/[^0-9]/', '', $string);
    }
}
