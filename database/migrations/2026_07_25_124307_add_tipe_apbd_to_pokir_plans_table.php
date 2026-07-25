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
        Schema::table('pokir_plans', function (Blueprint $table) {
            $table->string('tipe_apbd')->default('Induk')->after('tahun_anggaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokir_plans', function (Blueprint $table) {
            $table->dropColumn('tipe_apbd');
        });
    }
};
