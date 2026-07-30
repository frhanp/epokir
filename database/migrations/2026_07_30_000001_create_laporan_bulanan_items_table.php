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
        Schema::create('laporan_bulanan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_bulanan_id')->constrained('laporan_bulanans')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('hari');
            $table->text('kegiatan')->nullable();
            $table->integer('no_urut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bulanan_items');
    }
};
