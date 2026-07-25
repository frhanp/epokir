<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PokirPlan;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    // Halaman List Rencana Kerja
    public function index(Request $request)
    {
        $selectedTahun = $request->query('tahun', 2026);
        $selectedTipe = $request->query('tipe', 'Induk');

        // Ambil semua data, urutkan per Aleg lalu per OPD, kemudian GROUP BY Aleg
        $groupedPlans = PokirPlan::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->orderBy('anggota_dprd')
            ->orderBy('opd_tujuan')
            ->get()
            ->groupBy('anggota_dprd');

        // Buat daftar pilihan tahun (misal: 2 tahun ke belakang dan 4 tahun ke depan)
        $currentYear = date('Y');
        $yearsRange = range($currentYear - 2, $currentYear + 4);

        return view('plan.index', compact('groupedPlans', 'selectedTahun', 'selectedTipe', 'yearsRange'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls',
            'tahun_anggaran' => 'required|numeric',
            'tipe_apbd' => 'required|string|in:Induk,Perubahan'
        ]);

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

                    'tahun_anggaran' => $request->tahun_anggaran,
                    'tipe_apbd'      => $request->tipe_apbd
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
        $request->validate([
            'anggota_dprd' => 'required|string',
            'tahun_anggaran' => 'required|numeric',
            'tipe_apbd' => 'required|string|in:Induk,Perubahan'
        ]);

        // Hapus semua data berdasarkan Nama Aleg, Tahun, dan Tipe APBD
        PokirPlan::where('anggota_dprd', $request->anggota_dprd)
            ->where('tahun_anggaran', $request->tahun_anggaran)
            ->where('tipe_apbd', $request->tipe_apbd)
            ->delete();

        return redirect()->back()->with('success', 'Seluruh pagu milik ' . $request->anggota_dprd . ' tahun ' . $request->tahun_anggaran . ' (' . $request->tipe_apbd . ') berhasil dihapus.');
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
            'tahun_anggaran' => 'required|numeric',
            'tipe_apbd'     => 'required|string|in:Induk,Perubahan',
        ]);

        PokirPlan::create([
            'anggota_dprd'   => $request->anggota_dprd,
            'opd_tujuan'     => $request->opd_tujuan,
            'nama_kegiatan'  => $request->nama_kegiatan,
            'volume_target'  => $request->volume_target,
            'satuan'         => $request->satuan,
            'harga_satuan'   => $this->cleanNumber($request->harga_satuan),
            'pagu_total'     => $request->volume_target * $this->cleanNumber($request->harga_satuan),
            'tahun_anggaran' => $request->tahun_anggaran,
            'tipe_apbd'      => $request->tipe_apbd,
        ]);

        return redirect()->back()->with('success', 'Data rencana kerja berhasil ditambahkan manual.');
    }
}
