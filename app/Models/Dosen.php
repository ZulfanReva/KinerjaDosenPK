<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen'; // Nama tabel di database
    use HasFactory;

    protected $fillable = [
        'nama_dosen',
        'nidn',
        'prodi_id',
        'status',
        'jabatan_id',
        'users_id', // Menyimpan ID user jika perlu
    ];

    protected $hidden = [
        'password',
    ];

    

    // Relasi dengan tabel prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }


    // Relasi dengan tabel jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id'); // Sesuaikan 'jabatan_id'
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); // Sesuaikan dengan nama kolom
    }

    // Relasi dengan PenilaianPK
    public function penilaianperilakukerja()
    {
        return $this->hasMany(PenilaianPerilakuKerja::class, 'dosen_id');
    }
}
