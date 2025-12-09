<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pokir extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_usulan',
        'spesifikasi',
        'opd_tujuan',
        'alamat',
        'nama_pemohon',
        'identitas_pemohon',
        'anggota_dprd',
        'status_berkas',
        'operator_penerima',
    ];


    public function getJudulLengkapAttribute()
    {
        if (empty($this->spesifikasi)) {
            return $this->kategori_usulan;
        }
        return $this->kategori_usulan . ' - ' . $this->spesifikasi;
    }

    // Relasi ke Rencana Kerja (Wadah)
    public function plan()
    {
        return $this->belongsTo(PokirPlan::class, 'pokir_plan_id');
    }
}
