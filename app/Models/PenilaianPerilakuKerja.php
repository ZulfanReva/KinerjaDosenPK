<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPerilakuKerja extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'penilaian_perilakukerja'; // Ganti dengan nama tabel yang sesuai

    // Tentukan field yang dapat diisi massal
    protected $fillable = [
        'dosen_id',
        'periode',
        'integritas',
        'komitmen',
        'kerjasama',
        'orientasi_pelayanan',
        'disiplin',
        'kepemimpinan',
        'nilai_corefactor',
        'nilai_secondaryfactor',
    ];
    
    // Relasi ke tabel periode
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id'); // pastikan kolom foreign key benar
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id'); // pastikan kolom foreign key benar
    }
}