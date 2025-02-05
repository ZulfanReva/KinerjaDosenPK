<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode'; 
    protected $fillable = ['nama_periode'];

    public function dosen()
    {
    return $this->hasMany(Dosen::class, 'periode_id');
    }
}