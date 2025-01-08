<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    // Jika nama tabel di database tidak mengikuti konvensi plural, Anda bisa mendefinisikannya di sini
    protected $table = 'periode'; // Ganti dengan 'periode' jika Anda menggunakan nama tabel tunggal

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama_periode', // Pastikan kolom ini ada di tabel
    ];

    // Jika Anda ingin menambahkan relasi atau metode lain, Anda bisa melakukannya di sini
    public function penilaianPKs()
    {
        return $this->hasMany(PenilaianPK::class, 'periode_id');
    }

    // Relasi dengan PenilaianCF
    public function penilaianCF()
    {
        return $this->hasMany(PenilaianCF::class, 'periode_id');
    }
}