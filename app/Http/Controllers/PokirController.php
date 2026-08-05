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
{
    private function cleanString($str)
    {
        if (empty($str)) return '';
        // Replace non-breaking spaces (both UTF-8 and Latin-1) with normal spaces
        $str = str_replace(["\xc2\xa0", "\xa0"], ' ', $str);
        // Replace multiple spaces/newlines/tabs with a single space
        $str = preg_replace('/\s+/', ' ', $str);
        return trim($str);
    }

    private function normalizeString($str)
    {
        if (empty($str)) return '';
        $str = mb_strtolower($str, 'UTF-8');
        $str = preg_replace('/[^\w\s]/u', ' ', $str);
        $str = $this->cleanString($str);
        return $str;
    }

    private function cleanName($name)
    {
        $norm = $this->normalizeString($name);
        $titles = ['dr', 'drs', 'h', 'hj', 'se', 'mm', 'm', 'si', 'sip', 'sh', 'mh', 'ec', 'dev', 'sos', 'i', 'ra', 'a', 't', 'z'];
        $words = array_filter(explode(' ', $norm));
        $filtered = array_filter($words, fn($w) => !in_array($w, $titles) && mb_strlen($w, 'UTF-8') >= 2);
        return implode(' ', $filtered);
    }

    private function isFlexibleMatch($str1, $str2)
    {
        $n1 = $this->normalizeString($str1);
        $n2 = $this->normalizeString($str2);
        
        if (empty($n1) || empty($n2)) {
            return true;
        }
        
        if ($n1 === $n2) return true;
        if (str_contains($n1, $n2) || str_contains($n2, $n1)) return true;

        $c1 = $this->cleanName($str1);
        $c2 = $this->cleanName($str2);

        if (!empty($c1) && !empty($c2)) {
            if ($c1 === $c2 || str_contains($c1, $c2) || str_contains($c2, $c1)) {
                return true;
            }
            $w1 = array_filter(explode(' ', $c1));
            $w2 = array_filter(explode(' ', $c2));
            $intersect = array_intersect($w1, $w2);
            if (count($intersect) >= 2 || (count($intersect) == 1 && mb_strlen(reset($intersect), 'UTF-8') >= 4)) {
                return true;
            }
        }
        
        return false;
    }

    private function findBestMatchingPlan($plans, $kategori, $spesifikasi = '')
    {
        if ($plans->isEmpty()) {
            return null;
        }

        $bestPlan = null;
        $highestScore = -1;

        $kategoriNorm = $this->normalizeString($kategori);
        if (empty($kategoriNorm)) {
            return null;
        }

        // 1. First, look for an exact normalized match
        foreach ($plans as $plan) {
            $planNorm = $this->normalizeString($plan->nama_kegiatan);
            if ($kategoriNorm === $planNorm) {
                return $plan; // Perfect exact match
            }
        }

        // Helper to tokenize and clean a string into unique words
        $getWords = function($str) {
            $norm = $this->normalizeString($str);
            if (empty($norm)) return [];

            $words = explode(' ', $norm);
            $commonWords = ['permohonan', 'bantuan', 'pengadaan', 'pembangunan', 'rehabilitasi', 'pemeliharaan', 'belanja', 'kegiatan', 'pekerjaan', 'usulan', 'dinas', 'paket', 'tahun', 'anggaran', 'kabupaten', 'kota', 'kecamatan', 'desa', 'kelurahan'];
            
            $cleaned = [];
            foreach ($words as $w) {
                $w = trim($w);
                if (mb_strlen($w, 'UTF-8') >= 2 && !in_array($w, $commonWords)) {
                    $cleaned[] = $w;
                }
            }
            // If all words were common words, fallback to keeping all words >= 2 chars
            if (empty($cleaned)) {
                foreach ($words as $w) {
                    $w = trim($w);
                    if (mb_strlen($w, 'UTF-8') >= 2) {
                        $cleaned[] = $w;
                    }
                }
            }
            return array_unique(array_values($cleaned));
        };

        $kategoriWords = $getWords($kategori);
        if (!empty($spesifikasi)) {
            $kategoriWords = array_unique(array_merge($kategoriWords, $getWords($spesifikasi)));
        }

        foreach ($plans as $plan) {
            $planNorm = $this->normalizeString($plan->nama_kegiatan);
            
            // Substring check
            if (!empty($planNorm) && (str_contains($kategoriNorm, $planNorm) || str_contains($planNorm, $kategoriNorm))) {
                $score = 100 + (strlen($planNorm) / 100);
            } else {
                $planWords = $getWords($plan->nama_kegiatan);
                
                if (empty($kategoriWords) || empty($planWords)) {
                    $score = 0;
                } else {
                    $intersect = array_intersect($kategoriWords, $planWords);
                    $score = count($intersect);
                }
            }

            if ($score > 0 && $score > $highestScore) {
                $highestScore = $score;
                $bestPlan = $plan;
            }
        }

        return $bestPlan;
    }

    // Fungsi bantuan agar filter bisa dipakai di Index, Print, dan Excel
    private function getFilteredPokir($request)
    {
        $query = Pokir::latest();

        if ($request->filled('ids')) {
            $ids = explode(',', $request->ids);
            $query->whereIn('id', $ids);
        } else {
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
            if ($request->filled('status_sistem')) {
                $query->where('status_sistem', $request->status_sistem);
            }
            if ($request->filled('keyword')) {
                $q = $request->keyword;
                $query->where(function($sub) use ($q) {
                    $sub->where('kategori_usulan', 'like', "%{$q}%")
                        ->orWhere('spesifikasi', 'like', "%{$q}%")
                        ->orWhere('nama_pemohon', 'like', "%{$q}%")
                        ->orWhere('alamat', 'like', "%{$q}%")
                        ->orWhere('identitas_pemohon', 'like', "%{$q}%");
                });
            }
        }

        return $query;
    }

    // HALAMAN UTAMA (LIST & FILTER)
    public function index(Request $request)
    {
        // Gunakan pagination agar halaman tidak berat
        $pokirs = $this->getFilteredPokir($request)->paginate(10);
        
        // Ambil data unik untuk filter (Gabungkan dari Master Pagu dan Usulan Pokir)
        $alegsPlan = PokirPlan::distinct()->pluck('anggota_dprd')->toArray();
        $alegsPokir = Pokir::distinct()->pluck('anggota_dprd')->toArray();
        $alegs = array_unique(array_filter(array_merge($alegsPlan, $alegsPokir)));
        sort($alegs);

        $opdsPlan = PokirPlan::distinct()->pluck('opd_tujuan')->toArray();
        $opdsPokir = Pokir::distinct()->pluck('opd_tujuan')->toArray();
        $opds = array_unique(array_filter(array_merge($opdsPlan, $opdsPokir)));
        sort($opds);

        $kategoris = Pokir::distinct()->orderBy('kategori_usulan')->pluck('kategori_usulan')->filter()->toArray();

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

            // Fetch ALL plans for this year and APBD type once to avoid N+1 query and case-sensitivity issues
            $allPlans = PokirPlan::where('tahun_anggaran', $request->tahun_anggaran)
                ->where('tipe_apbd', $request->tipe_apbd)
                ->get();

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

                $alegInput = $row[5] ?? 'Umum';
                $opdInput = $row[8] ?? 'Dinas Terkait';
                $kategoriInput = $row[1] ?? 'Umum';

                // 3-Tier plan matching strategy:
                // Tier 1: Match both Aleg & OPD with flexible matching
                $matchedPlans = $allPlans->filter(function($p) use ($alegInput, $opdInput) {
                    return $this->isFlexibleMatch($p->anggota_dprd, $alegInput) &&
                           $this->isFlexibleMatch($p->opd_tujuan, $opdInput);
                });

                // Tier 2: Match by Aleg only
                if ($matchedPlans->isEmpty()) {
                    $matchedPlans = $allPlans->filter(function($p) use ($alegInput) {
                        return $this->isFlexibleMatch($p->anggota_dprd, $alegInput);
                    });
                }

                // Tier 3: Fallback to all plans in that Year & APBD
                if ($matchedPlans->isEmpty()) {
                    $matchedPlans = $allPlans;
                }

                // Cari plan terbaik menggunakan fuzzy matching
                $plan = $this->findBestMatchingPlan($matchedPlans, $kategoriInput);

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

    public function realign(Request $request)
    {
        try {
            DB::beginTransaction();

            $pokirs = Pokir::all();
            $countUpdated = 0;

            // Ambil semua plans
            $plans = PokirPlan::all();

            // Setel ulang semua pokir agar status kembali ke 'Usulan Baru' dan pokir_plan_id null
            Pokir::query()->update([
                'pokir_plan_id' => null,
                'status_sistem' => 'Usulan Baru'
            ]);

            // Catat pemakaian per plan
            $planUsage = [];

            foreach ($pokirs as $pokir) {
                // Tier 1: Match both Aleg & OPD with flexible matching in same year & APBD
                $matchedPlans = $plans->filter(function($p) use ($pokir) {
                    return $p->tahun_anggaran == $pokir->tahun_anggaran &&
                           $p->tipe_apbd == $pokir->tipe_apbd &&
                           $this->isFlexibleMatch($p->anggota_dprd, $pokir->anggota_dprd) &&
                           $this->isFlexibleMatch($p->opd_tujuan, $pokir->opd_tujuan);
                });

                // Tier 2: Match by Aleg only within same year & APBD
                if ($matchedPlans->isEmpty()) {
                    $matchedPlans = $plans->filter(function($p) use ($pokir) {
                        return $p->tahun_anggaran == $pokir->tahun_anggaran &&
                               $p->tipe_apbd == $pokir->tipe_apbd &&
                               $this->isFlexibleMatch($p->anggota_dprd, $pokir->anggota_dprd);
                    });
                }

                // Tier 3: Fallback to all plans in same year & APBD
                if ($matchedPlans->isEmpty()) {
                    $matchedPlans = $plans->filter(function($p) use ($pokir) {
                        return $p->tahun_anggaran == $pokir->tahun_anggaran &&
                               $p->tipe_apbd == $pokir->tipe_apbd;
                    });
                }

                $plan = $this->findBestMatchingPlan($matchedPlans, $pokir->kategori_usulan);

                if ($plan) {
                    $planId = $plan->id;
                    if (!isset($planUsage[$planId])) {
                        $planUsage[$planId] = 0;
                    }

                    if ($planUsage[$planId] < $plan->volume_target) {
                        $statusSistem = 'Terakomodir';
                        $planUsage[$planId]++;
                    } else {
                        $statusSistem = 'Cadangan';
                    }

                    $pokir->update([
                        'pokir_plan_id' => $planId,
                        'status_sistem' => $statusSistem
                    ]);
                    $countUpdated++;
                }
            }

            DB::commit();
            return redirect()->route('pokir.index')->with('success', "Sukses! Sinkronisasi berhasil, $countUpdated usulan diselaraskan dengan Master Pagu.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pokir.index')->with('error', 'Sinkronisasi gagal: ' . $e->getMessage());
        }
    }

    public function destroy(Pokir $pokir)
    {
        try {
            $pokir->delete();
            return redirect()->route('pokir.index')->with('success', 'Usulan Pokir berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pokir.index')->with('error', 'Gagal menghapus usulan Pokir: ' . $e->getMessage());
        }
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        try {
            $ids = explode(',', $request->ids);
            $deletedCount = Pokir::whereIn('id', $ids)->delete();
            return redirect()->route('pokir.index')->with('success', $deletedCount . ' usulan Pokir berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pokir.index')->with('error', 'Gagal menghapus usulan: ' . $e->getMessage());
        }
    }

    // HALAMAN MATRIKS REALISASI (SUMMARY & GAP ANALYSIS)
    public function matrix(Request $request)
    {
        // 1. Ambil data unik untuk pilihan filter (Konsolidasi nama Aleg agar tidak ganda karena variasi spasi/gelar)
        $rawAlegs = PokirPlan::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        if (empty($rawAlegs)) {
            $rawAlegs = Pokir::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        }

        $alegs = [];
        foreach ($rawAlegs as $item) {
            $exists = false;
            foreach ($alegs as $existing) {
                if ($this->isFlexibleMatch($item, $existing)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists && !empty(trim($item))) {
                $alegs[] = trim($item);
            }
        }

        $opds = PokirPlan::distinct()->orderBy('opd_tujuan')->pluck('opd_tujuan')->toArray();
        if (empty($opds)) {
            $opds = Pokir::distinct()->orderBy('opd_tujuan')->pluck('opd_tujuan')->toArray();
        }

        // Default values
        $selectedAleg = $request->query('anggota_dprd', $alegs[0] ?? '');
        $selectedTahun = $request->query('tahun_anggaran', 2026);
        $selectedTipe = $request->query('tipe_apbd', 'Induk');

        // 2. Query Pagu Target (Master Pagu) secara fleksibel
        $allPlans = PokirPlan::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->with(['pokirs'])
            ->get();

        $plans = $allPlans->filter(function($p) use ($selectedAleg) {
            return $this->isFlexibleMatch($p->anggota_dprd, $selectedAleg);
        });

        if ($request->filled('opd_tujuan')) {
            $opdReq = $request->opd_tujuan;
            $plans = $plans->filter(function($p) use ($opdReq) {
                return $this->isFlexibleMatch($p->opd_tujuan, $opdReq);
            });
        }

        if ($request->filled('nama_kegiatan')) {
            $kegReq = $request->nama_kegiatan;
            $plans = $plans->filter(function($p) use ($kegReq) {
                return $this->isFlexibleMatch($p->nama_kegiatan, $kegReq);
            });
        }

        // 3. Query Usulan Tanpa Pagu (Orphan / Usulan Baru) secara fleksibel
        $allOrphans = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->whereNull('pokir_plan_id')
            ->get();

        $orphans = $allOrphans->filter(function($po) use ($selectedAleg) {
            return $this->isFlexibleMatch($po->anggota_dprd, $selectedAleg);
        });

        if ($request->filled('opd_tujuan')) {
            $opdReq = $request->opd_tujuan;
            $orphans = $orphans->filter(function($po) use ($opdReq) {
                return $this->isFlexibleMatch($po->opd_tujuan, $opdReq);
            });
        }

        // Pilihan tahun
        $currentYear = date('Y');
        $yearsRange = range($currentYear - 2, $currentYear + 4);

        return view('pokir.matrix', compact(
            'alegs',
            'opds',
            'selectedAleg',
            'selectedTahun',
            'selectedTipe',
            'plans',
            'orphans',
            'yearsRange'
        ));
    }

    // EXPORT MATRIKS REALISASI KE EXCEL
    public function exportMatrixExcel(Request $request)
    {
        // 1. Ambil data unik untuk filter
        $rawAlegs = PokirPlan::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        if (empty($rawAlegs)) {
            $rawAlegs = Pokir::distinct()->orderBy('anggota_dprd')->pluck('anggota_dprd')->toArray();
        }

        $alegs = [];
        foreach ($rawAlegs as $item) {
            $exists = false;
            foreach ($alegs as $existing) {
                if ($this->isFlexibleMatch($item, $existing)) {
                    $exists = true;
                    break;
                }
            }
            if (!$exists && !empty(trim($item))) {
                $alegs[] = trim($item);
            }
        }

        $selectedAleg = $request->query('anggota_dprd', $alegs[0] ?? '');
        $selectedTahun = $request->query('tahun_anggaran', 2026);
        $selectedTipe = $request->query('tipe_apbd', 'Induk');

        // Query Pagu Target (Master Pagu) secara fleksibel
        $allPlans = PokirPlan::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->with(['pokirs'])
            ->get();

        $plans = $allPlans->filter(function($p) use ($selectedAleg) {
            return $this->isFlexibleMatch($p->anggota_dprd, $selectedAleg);
        });

        if ($request->filled('opd_tujuan')) {
            $opdReq = $request->opd_tujuan;
            $plans = $plans->filter(function($p) use ($opdReq) {
                return $this->isFlexibleMatch($p->opd_tujuan, $opdReq);
            });
        }

        if ($request->filled('nama_kegiatan')) {
            $kegReq = $request->nama_kegiatan;
            $plans = $plans->filter(function($p) use ($kegReq) {
                return $this->isFlexibleMatch($p->nama_kegiatan, $kegReq);
            });
        }

        // Query Usulan Tanpa Pagu (Orphan / Usulan Baru) secara fleksibel
        $allOrphans = Pokir::where('tahun_anggaran', $selectedTahun)
            ->where('tipe_apbd', $selectedTipe)
            ->whereNull('pokir_plan_id')
            ->get();

        $orphans = $allOrphans->filter(function($po) use ($selectedAleg) {
            return $this->isFlexibleMatch($po->anggota_dprd, $selectedAleg);
        });

        if ($request->filled('opd_tujuan')) {
            $opdReq = $request->opd_tujuan;
            $orphans = $orphans->filter(function($po) use ($opdReq) {
                return $this->isFlexibleMatch($po->opd_tujuan, $opdReq);
            });
        }

        // 2. Load file Excel Template
        $templatePath = storage_path('app/contoh_matriks_aleg.xlsx');
        if (file_exists($templatePath)) {
            $spreadsheet = IOFactory::load($templatePath);
        } else {
            $spreadsheet = new Spreadsheet();
        }
        
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Matriks Realisasi');

        // Hapus isi data bawaan template dari baris 7 kebawah
        $highestRow = $sheet->getHighestRow();
        if ($highestRow >= 7) {
            $sheet->removeRow(7, $highestRow - 6);
        }

        $currentRow = 7;

        // Loop Plans
        foreach ($plans as $index => $plan) {
            // Plan Title Block
            $sheet->setCellValue('B' . $currentRow, 'USULAN ' . strtoupper($plan->nama_kegiatan) . ' ALEG PENGUSUL An : ' . $selectedAleg);
            $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->mergeCells('B' . $currentRow . ':F' . $currentRow);

            $currentRow++;

            // Total Usulan Row
            $linkedPokirs = $plan->pokirs;
            $sheet->setCellValue('B' . $currentRow, 'TOTAL ' . $linkedPokirs->count() . ' USULAN');
            $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->mergeCells('B' . $currentRow . ':F' . $currentRow);

            $currentRow++;

            // Table Header Row
            $sheet->setCellValue('B' . $currentRow, 'No');
            $sheet->setCellValue('C' . $currentRow, 'Jenis Usulan');
            $sheet->setCellValue('D' . $currentRow, 'Nama Pengusul');
            $sheet->setCellValue('E' . $currentRow, 'Alamat');
            $sheet->setCellValue('F' . $currentRow, 'Ket');

            $headerRange = 'B' . $currentRow . ':F' . $currentRow;
            $sheet->getStyle($headerRange)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->getStyle($headerRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFC000'); // Orange/Gold
            $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $currentRow++;

            // Data Rows
            if ($linkedPokirs->count() > 0) {
                $dataStartRow = $currentRow;
                foreach ($linkedPokirs as $pIdx => $pokir) {
                    $namaPengusul = $pokir->nama_pemohon . ($pokir->identitas_pemohon ? ' (' . $pokir->identitas_pemohon . ')' : '');

                    $sheet->setCellValue('B' . $currentRow, $pIdx + 1);
                    $sheet->setCellValue('C' . $currentRow, $pokir->kategori_usulan);
                    $sheet->setCellValue('D' . $currentRow, $namaPengusul);
                    $sheet->setCellValue('E' . $currentRow, $pokir->alamat);
                    $sheet->setCellValue('F' . $currentRow, $pokir->status_berkas ?? 'Ada');

                    $currentRow++;
                }
                $dataEndRow = $currentRow - 1;
                $sheet->getStyle('B' . $dataStartRow . ':F' . $dataEndRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            } else {
                // Tulis satu baris info gap / kosong
                $sheet->setCellValue('B' . $currentRow, '1');
                $sheet->setCellValue('C' . $currentRow, 'Belum ada usulan warga terakomodir');
                $sheet->setCellValue('D' . $currentRow, '-');
                $sheet->setCellValue('E' . $currentRow, '-');
                $sheet->setCellValue('F' . $currentRow, 'Kekurangan ' . $plan->volume_target . ' berkas');

                $sheet->getStyle('B' . $currentRow . ':F' . $currentRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $sheet->getStyle('F' . $currentRow)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED))->setBold(true);

                $currentRow++;
            }

            // Tambahkan spacing kosong di antara pagu
            $currentRow += 2;
        }

        // Tulis Usulan Tanpa Pagu (jika ada)
        if ($orphans->count() > 0) {
            $sheet->setCellValue('B' . $currentRow, 'USULAN TANPA PAGU (ORPHAN PROPOSALS) ALEG PENGUSUL An : ' . $selectedAleg);
            $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->mergeCells('B' . $currentRow . ':F' . $currentRow);

            $currentRow++;

            $sheet->setCellValue('B' . $currentRow, 'TOTAL ' . $orphans->count() . ' USULAN');
            $sheet->getStyle('B' . $currentRow)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->mergeCells('B' . $currentRow . ':F' . $currentRow);

            $currentRow++;

            $sheet->setCellValue('B' . $currentRow, 'No');
            $sheet->setCellValue('C' . $currentRow, 'OPD & Jenis Usulan');
            $sheet->setCellValue('D' . $currentRow, 'Nama Pengusul');
            $sheet->setCellValue('E' . $currentRow, 'Alamat');
            $sheet->setCellValue('F' . $currentRow, 'Ket');

            $headerRange = 'B' . $currentRow . ':F' . $currentRow;
            $sheet->getStyle($headerRange)->getFont()->setBold(true)->setName('Calibri')->setSize(11);
            $sheet->getStyle($headerRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFEE2E2'); // Light Red
            $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $currentRow++;

            $dataStartRow = $currentRow;
            foreach ($orphans as $oIdx => $orphan) {
                $namaPengusul = $orphan->nama_pemohon . ($orphan->identitas_pemohon ? ' (' . $orphan->identitas_pemohon . ')' : '');
                $jenisUsulan = '[' . $orphan->opd_tujuan . '] ' . $orphan->kategori_usulan;

                $sheet->setCellValue('B' . $currentRow, $oIdx + 1);
                $sheet->setCellValue('C' . $currentRow, $jenisUsulan);
                $sheet->setCellValue('D' . $currentRow, $namaPengusul);
                $sheet->setCellValue('E' . $currentRow, $orphan->alamat);
                $sheet->setCellValue('F' . $currentRow, $orphan->status_berkas ?? 'Usulan Baru');

                $currentRow++;
            }
            $dataEndRow = $currentRow - 1;
            $sheet->getStyle('B' . $dataStartRow . ':F' . $dataEndRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        }

        // Autofilter column widths untuk kolom B sampai F
        foreach (range('B', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $fileName = 'Matriks_Realisasi_' . str_replace(' ', '_', $selectedAleg) . '_' . $selectedTahun . '_' . $selectedTipe . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
