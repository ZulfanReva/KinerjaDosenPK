<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianBKD extends Model
{
    use HasFactory;

    // Menentukan nama tabel (optional, jika tabel menggunakan nama lain)
    protected $table = 'penilaian_bkd';

    // Menentukan kolom yang boleh diisi (fillable)
    protected $fillable = [
        'dosen_id',
        'periode_id',
        'bidang_pendidikan',
        'bidang_penelitian',
        'bidang_pengabdian',
        'bidang_penunjang',
        'nilai_ncf',
          // Pastikan periode_id dimasukkan di sini
    ];

    // Relasi dengan model Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    // Relasi dengan model Periode
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
}
