<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model Prodi
class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';
    protected $fillable = ['nama_prodi'];

    public function dosen()
    {
        return $this->hasMany(Dosen::class, 'prodi_id');
    }
}
