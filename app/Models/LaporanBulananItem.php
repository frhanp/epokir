<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulananItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_bulanan_id',
        'tanggal',
        'hari',
        'kegiatan',
        'no_urut',
    ];

    public function laporanBulanan()
    {
        return $this->belongsTo(LaporanBulanan::class, 'laporan_bulanan_id');
    }
}
