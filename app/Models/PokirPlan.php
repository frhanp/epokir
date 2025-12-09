<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PokirPlan extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    // Relasi: Satu Plan punya banyak Usulan
    public function pokirs()
    {
        return $this->hasMany(Pokir::class, 'pokir_plan_id');
    }

    // Hitung Sisa Kuota (Hanya kurangi jika statusnya 'Terakomodir')
    public function getSisaKuotaAttribute()
    {
        $terpakai = $this->pokirs()->where('status_sistem', 'Terakomodir')->count();
        return max(0, $this->volume_target - $terpakai);
    }
}
