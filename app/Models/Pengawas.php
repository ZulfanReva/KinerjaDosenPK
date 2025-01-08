<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawas extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pengawas';

    // Kolom yang dapat diisi
    protected $fillable = ['nama_pengawas', 'jabatan_id', 'user_id']; // pastikan menggunakan user_id sesuai dengan kolom di DB

    /**
     * Relasi dengan model User
     * Menghubungkan pengawas dengan pengguna (users)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // 'user_id' adalah foreign key di tabel pengawas
    }

    // Relasi dengan model Jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
