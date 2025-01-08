<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPK extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'penilaian_pk'; // Ganti dengan nama tabel yang sesuai

    // Tentukan field yang dapat diisi massal
    protected $fillable = [
        'dosen_id', // Ganti dengan nama field yang sesuai
        'pengawas_id', // Ganti dengan nama field yang sesuai
        'periode_id', // Ganti dengan nama field yang sesuai
        'orientasi_pelayanan', // Ganti dengan nama field yang sesuai
        'integritas', // Ganti dengan nama field yang sesuai
        'komitmen', // Ganti dengan nama field yang sesuai
        'disiplin', // Ganti dengan nama field yang sesuai
        'kerjasama', // Ganti dengan nama field yang sesuai
        'kepemimpinan', // Ganti dengan nama field yang sesuai
        'nilai_nsf', // Ganti dengan nama field yang sesuai
        // Tambahkan field lainnya sesuai dengan tabel Anda
    ];
    // Relasi ke tabel periode
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id'); // pastikan kolom foreign key benar
    }
}