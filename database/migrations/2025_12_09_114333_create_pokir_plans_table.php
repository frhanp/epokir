<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Buat Tabel WADAH (Rencana Kerja / Pagu Indikatif)
        Schema::create('pokir_plans', function (Blueprint $table) {
            $table->id();
            // Header Data
            $table->string('anggota_dprd')->index(); // Nama Aleg
            $table->string('opd_tujuan')->index();   // OPD Pengampu
            $table->year('tahun_anggaran')->default(2026);
            
            // Detail Program
            $table->string('nama_kegiatan'); // Nama Program (misal: Bantuan Beasiswa)
            $table->string('satuan')->default('Paket');
            $table->decimal('harga_satuan', 15, 2)->default(0);
            
            // Target & Pagu
            $table->integer('volume_target')->default(0); // Kuota
            $table->decimal('pagu_total', 15, 2)->default(0);
            
            $table->timestamps();
        });

        // 2. Update Tabel POKIRS (Isi) agar terhubung ke Wadah
        Schema::table('pokirs', function (Blueprint $table) {
            // Kolom FK (Nullable karena bisa jadi usulan baru/manual)
            $table->foreignId('pokir_plan_id')->nullable()->constrained('pokir_plans')->onDelete('set null');
            
            // Status Sistem (Otomatis: Terakomodir/Cadangan/Usulan Baru)
            $table->string('status_sistem')->default('Usulan Baru')->after('status_berkas');
        });
    }

    public function down(): void
    {
        Schema::table('pokirs', function (Blueprint $table) {
            $table->dropForeign(['pokir_plan_id']);
            $table->dropColumn(['pokir_plan_id', 'status_sistem']);
        });
        Schema::dropIfExists('pokir_plans');
    }
};