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
        Schema::create('pokirs', function (Blueprint $table) {
            $table->id();
            // PERUBAHAN DI SINI: Judul dipecah
            $table->string('kategori_usulan'); // Contoh: UMKM, Infrastruktur
            $table->string('spesifikasi')->nullable(); // Contoh: KIOS, Pengaspalan
            $table->string('opd_tujuan');
            $table->text('alamat');
            $table->string('nama_pemohon');
            $table->string('identitas_pemohon')->nullable();
            $table->string('anggota_dprd');
            $table->string('status_berkas')->nullable(); // 1 usulan, dll
            $table->string('operator_penerima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokirs');
    }
};
