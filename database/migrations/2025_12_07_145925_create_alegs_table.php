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
        Schema::create('alegs', function (Blueprint $table) {
        $table->id();
        $table->string('nama'); // Nama Anggota Dewan
        $table->string('fraksi')->nullable(); // Opsional: Partai/Fraksi
        $table->boolean('is_active')->default(true); // Status aktif/tidak
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alegs');
    }
};
