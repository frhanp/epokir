<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Pokir;
use App\Models\PokirPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;

class PokirImportTest extends TestCase
{
    use RefreshDatabase;

    private function createTestExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Header row
        $sheet->setCellValue('A8', 'NO');
        $sheet->setCellValue('B8', 'JUDUL PERMOHONAN');
        $sheet->setCellValue('C8', 'ALAMAT');
        $sheet->setCellValue('D8', 'YANG BERMOHON');
        $sheet->setCellValue('E8', 'IDENTITAS');
        $sheet->setCellValue('F8', 'ANGGOTA DPRD PENGUSUL');
        $sheet->setCellValue('G8', 'KET BERKAS');
        $sheet->setCellValue('H8', 'KET PENERIMA');
        $sheet->setCellValue('I8', 'DINAS TERKAIT');

        // Data row 1 (Aleg matches, OPD matches, volume target = 1) -> Terakomodir
        $sheet->setCellValue('A9', '1');
        $sheet->setCellValue('B9', 'Beasiswa Pendidikan S1');
        $sheet->setCellValue('C9', 'Kota Gorontalo');
        $sheet->setCellValue('D9', 'Budi Santoso');
        $sheet->setCellValue('E9', '123456');
        $sheet->setCellValue('F9', 'ALEG GOLKAR 1');
        $sheet->setCellValue('G9', '1 Proposal');
        $sheet->setCellValue('H9', 'Farhan');
        $sheet->setCellValue('I9', 'Dinas Pendidikan');

        // Data row 2 (Aleg matches, OPD matches, but quota full) -> Cadangan
        $sheet->setCellValue('A10', '2');
        $sheet->setCellValue('B10', 'Beasiswa Pendidikan S1');
        $sheet->setCellValue('C10', 'Kota Gorontalo');
        $sheet->setCellValue('D10', 'Ani');
        $sheet->setCellValue('E10', '123457');
        $sheet->setCellValue('F10', 'ALEG GOLKAR 1');
        $sheet->setCellValue('G10', '1 Proposal');
        $sheet->setCellValue('H10', 'Farhan');
        $sheet->setCellValue('I10', 'Dinas Pendidikan');

        // Data row 3 (No matching plan) -> Usulan Baru
        $sheet->setCellValue('A11', '3');
        $sheet->setCellValue('B11', 'Bantuan Pertanian');
        $sheet->setCellValue('C11', 'Kabupaten Gorontalo');
        $sheet->setCellValue('D11', 'Chandra');
        $sheet->setCellValue('E11', '123458');
        $sheet->setCellValue('F11', 'ALEG GOLKAR 2');
        $sheet->setCellValue('G11', '1 Proposal');
        $sheet->setCellValue('H11', 'Farhan');
        $sheet->setCellValue('I11', 'Dinas Pertanian');

        $tempPath = tempnam(sys_get_temp_dir(), 'excel');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        return $tempPath;
    }

    public function test_user_can_import_and_align_pokir_with_master_pagu()
    {
        $user = User::factory()->create();

        // Buat mock pagu untuk ALEG GOLKAR 1 di Dinas Pendidikan dengan Kuota/Volume = 1
        $plan = PokirPlan::create([
            'anggota_dprd' => 'ALEG GOLKAR 1',
            'opd_tujuan' => 'Dinas Pendidikan',
            'nama_kegiatan' => 'Pemberian Beasiswa S1',
            'satuan' => 'Orang',
            'harga_satuan' => 1000000,
            'volume_target' => 1,
            'pagu_total' => 1000000,
            'tahun_anggaran' => 2026,
            'tipe_apbd' => 'Induk'
        ]);

        $filePath = $this->createTestExcel();

        $uploadedFile = new UploadedFile(
            $filePath,
            'test_import.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        $response = $this->actingAs($user)->post(route('pokir.import'), [
            'file_excel' => $uploadedFile,
            'tanggal_penerimaan' => '2026-07-25',
            'tahun_anggaran' => 2026,
            'tipe_apbd' => 'Induk',
            'keterangan_upload' => 'Uji Coba Sinkronisasi Pagu'
        ]);

        $response->assertRedirect(route('pokir.index'));

        // Cek Row 1 (Terakomodir)
        $this->assertDatabaseHas('pokirs', [
            'nama_pemohon' => 'Budi Santoso',
            'status_sistem' => 'Terakomodir',
            'pokir_plan_id' => $plan->id,
            'tahun_anggaran' => 2026,
            'tipe_apbd' => 'Induk'
        ]);

        // Cek Row 2 (Cadangan, karena kuota target ALEG GOLKAR 1 di Dinas Pendidikan cuman 1 orang)
        $this->assertDatabaseHas('pokirs', [
            'nama_pemohon' => 'Ani',
            'status_sistem' => 'Cadangan',
            'pokir_plan_id' => $plan->id,
            'tahun_anggaran' => 2026,
            'tipe_apbd' => 'Induk'
        ]);

        // Cek Row 3 (Usulan Baru, karena ALEG GOLKAR 2 di Dinas Pertanian tidak memiliki pagu)
        $this->assertDatabaseHas('pokirs', [
            'nama_pemohon' => 'Chandra',
            'status_sistem' => 'Usulan Baru',
            'pokir_plan_id' => null,
            'tahun_anggaran' => 2026,
            'tipe_apbd' => 'Induk'
        ]);

        @unlink($filePath);
    }

    public function test_user_can_access_matrix_page_with_filters()
    {
        $user = User::factory()->create();

        $plan = PokirPlan::create([
            'anggota_dprd' => 'ALEG TEST MATRIX',
            'opd_tujuan' => 'Dinas Pekerjaan Umum',
            'nama_kegiatan' => 'Pembangunan Jalan Desa',
            'satuan' => 'Meter',
            'harga_satuan' => 500000,
            'volume_target' => 10,
            'pagu_total' => 5000000,
            'tahun_anggaran' => 2027,
            'tipe_apbd' => 'Induk'
        ]);

        $response = $this->actingAs($user)->get(route('pokir.matrix', [
            'anggota_dprd' => 'ALEG TEST MATRIX',
            'tahun_anggaran' => 2027,
            'tipe_apbd' => 'Induk'
        ]));

        $response->assertStatus(200);
        $response->assertSee('Matriks Realisasi');
        $response->assertSee('Analisis Gap Pokir');
        $response->assertSee('ALEG TEST MATRIX');
        $response->assertSee('Pembangunan Jalan Desa');
    }

    public function test_user_can_export_matrix_to_excel()
    {
        $user = User::factory()->create();

        PokirPlan::create([
            'anggota_dprd' => 'ALEG EXPORT EXCEL',
            'opd_tujuan' => 'Dinas Kesehatan',
            'nama_kegiatan' => 'Pengadaan Ambulans Desa',
            'satuan' => 'Unit',
            'harga_satuan' => 300000000,
            'volume_target' => 1,
            'pagu_total' => 300000000,
            'tahun_anggaran' => 2026,
            'tipe_apbd' => 'Induk'
        ]);

        $response = $this->actingAs($user)->get(route('pokir.matrix.export', [
            'anggota_dprd' => 'ALEG EXPORT EXCEL',
            'tahun_anggaran' => 2026,
            'tipe_apbd' => 'Induk'
        ]));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->assertHeader('Content-Disposition', 'attachment;filename="Matriks_Realisasi_ALEG_EXPORT_EXCEL_2026_Induk.xlsx"');
    }
}
