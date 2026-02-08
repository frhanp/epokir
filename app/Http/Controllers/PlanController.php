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


    public function update(Request $request, $id)
    {
        $plan = PokirPlan::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_kegiatan' => 'required|string',
            'volume_target' => 'required|numeric',
            'harga_satuan'  => 'required', // Bisa string "Rp...", nanti dibersihkan
        ]);

        // Bersihkan angka
        $hargaClean = $this->cleanNumber($request->harga_satuan);
        $volume = (int) $request->volume_target;

        // Hitung ulang total otomatis
        $totalBaru = $volume * $hargaClean;

        $plan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'opd_tujuan'    => $request->opd_tujuan, // Jaga-jaga mau ganti OPD
            'volume_target' => $volume,
            'satuan'        => $request->satuan,
            'harga_satuan'  => $hargaClean,
            'pagu_total'    => $totalBaru, // Update total otomatis
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    // 4. PROSES HAPUS
    public function destroy($id)
    {
        $plan = PokirPlan::findOrFail($id);

        // Opsional: Cek apakah sudah ada usulan masuk? Kalau ada, cegah hapus.
        if ($plan->pokirs()->count() > 0) {
            return redirect()->back()->with('error', 'Gagal hapus! Sudah ada usulan warga yang masuk ke program ini.');
        }

        $plan->delete();
        return redirect()->back()->with('success', 'Rencana kerja berhasil dihapus.');
    }

    public function destroyByAleg(Request $request)
    {
        // Hapus semua data berdasarkan Nama Aleg
        PokirPlan::where('anggota_dprd', $request->anggota_dprd)->delete();

        return redirect()->back()->with('success', 'Seluruh pagu milik ' . $request->anggota_dprd . ' berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_dprd'  => 'required|string',
            'opd_tujuan'    => 'required|string',
            'nama_kegiatan' => 'required|string',
            'volume_target' => 'required|numeric',
            'satuan'        => 'required|string',
            'harga_satuan'  => 'required', // String Rp...
        ]);

        PokirPlan::create([
            'anggota_dprd'   => $request->anggota_dprd,
            'opd_tujuan'     => $request->opd_tujuan,
            'nama_kegiatan'  => $request->nama_kegiatan,
            'volume_target'  => $request->volume_target,
            'satuan'         => $request->satuan,
            'harga_satuan'   => $this->cleanNumber($request->harga_satuan),
            'pagu_total'     => $request->volume_target * $this->cleanNumber($request->harga_satuan),
            'tahun_anggaran' => 2026,
        ]);

        return redirect()->back()->with('success', 'Data rencana kerja berhasil ditambahkan manual.');
    }
}
