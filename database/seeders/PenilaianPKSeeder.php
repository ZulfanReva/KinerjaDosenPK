<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenilaianPKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('penilaian_perilakukerja')->insert([
            [
                'dosen_id' => 6,
                'users_id' => 4,
                'periode_id' => 1,
                'tanggal_penilaian' => '2025-02-08',
                'integritas' => 1,
                'komitmen' => 1,
                'kerjasama' => 1,
                'orientasi_pelayanan' => 1,
                'disiplin' => 1,
                'kepemimpinan' => 1,
                'total_nilai' => 1.00,
            ],
            [
                'dosen_id' => 7,
                'users_id' => 4,
                'periode_id' => 1,
                'tanggal_penilaian' => '2025-02-08',
                'integritas' => 3,
                'komitmen' => 3,
                'kerjasama' => 3,
                'orientasi_pelayanan' => 1,
                'disiplin' => 1,
                'kepemimpinan' => 1,
                'total_nilai' => 2.20,
            ],
            [
                'dosen_id' => 9,
                'users_id' => 4,
                'periode_id' => 1,
                'tanggal_penilaian' => '2025-02-08',
                'integritas' => 3,
                'komitmen' => 3,
                'kerjasama' => 3,
                'orientasi_pelayanan' => 2,
                'disiplin' => 2,
                'kepemimpinan' => 2,
                'total_nilai' => 2.60,
            ],
            [
                'dosen_id' => 10,
                'users_id' => 4,
                'periode_id' => 1,
                'tanggal_penilaian' => '2025-02-08',
                'integritas' => 4,
                'komitmen' => 4,
                'kerjasama' => 4,
                'orientasi_pelayanan' => 3,
                'disiplin' => 3,
                'kepemimpinan' => 3,
                'total_nilai' => 3.60,
            ],
        ]);
    }
}
