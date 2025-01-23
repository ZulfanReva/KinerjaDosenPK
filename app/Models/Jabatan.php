<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model Jabatan
class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan'; 
    protected $fillable = ['nama_jabatan'];

    public function dosen()
    {
    return $this->hasMany(Dosen::class, 'jabatan_id');
    }
}