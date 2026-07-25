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
        Schema::table('pokirs', function (Blueprint $table) {
            $table->date('tanggal_penerimaan')->nullable()->after('operator_penerima');
            $table->year('tahun_anggaran')->default(2026)->after('tanggal_penerimaan');
            $table->string('tipe_apbd')->default('Induk')->after('tahun_anggaran');
            $table->text('keterangan_upload')->nullable()->after('tipe_apbd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pokirs', function (Blueprint $table) {
            $table->dropColumn(['tanggal_penerimaan', 'tahun_anggaran', 'tipe_apbd', 'keterangan_upload']);
        });
    }
};
