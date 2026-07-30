<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBulanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'tahun',
        'nama_ta',
        'jabatan_ta',
        'tanggal_laporan',
        'yth',
        'tembusan',
        'saran',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'saran' => 'array',
        ];
    }

    public function items()
    {
        return $this->hasMany(LaporanBulananItem::class, 'laporan_bulanan_id')->orderBy('tanggal', 'asc');
    }
}
