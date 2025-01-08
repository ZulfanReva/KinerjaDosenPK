<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $prodiData = [
            ['nama_prodi' => 'Teknik Informatika'],
            ['nama_prodi' => 'Teknik Sipil'],
            ['nama_prodi' => 'Teknik Arsitektur'],
            ['nama_prodi' => 'Teknik PWK'],
            
        ];

        foreach ($prodiData as $prodi) {
            Prodi::create($prodi);
        }
    }
}
