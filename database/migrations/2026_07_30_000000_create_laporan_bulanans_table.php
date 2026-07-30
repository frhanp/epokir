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
        Schema::create('laporan_bulanans', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan');
            $table->integer('tahun');
            $table->string('nama_ta')->default('Ir. KUN IDRUS');
            $table->string('jabatan_ta')->default('Tenaga Ahli Fraksi Partai Golkar DPRD Provinsi Gorontalo');
            $table->string('tanggal_laporan');
            $table->text('yth');
            $table->text('tembusan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bulanans');
    }
};
