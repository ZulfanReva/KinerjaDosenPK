<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianProfileMatching extends Model
{
    use HasFactory;

    protected $table = 'penilaian_profilematching';

    protected $fillable = [
        'id_penilaian_perilakukerja',
        'grade',
    ];

    /**
     * Relasi dengan tabel penilaian_perilakukerja
     */
    public function penilaianPerilakuKerja()
    {
        return $this->belongsTo(PenilaianPerilakuKerja::class, 'id_penilaian_perilakukerja');
    }

    
}
