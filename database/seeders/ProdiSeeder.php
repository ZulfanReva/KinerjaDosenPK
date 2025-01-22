<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        DB::table('prodi')->insert([
            ['nama_prodi' => 'ARSITEKTUR (S1)'],
            ['nama_prodi' => 'FARMASI (D3)'],
            ['nama_prodi' => 'FARMASI (S1)'],
            ['nama_prodi' => 'INFORMATIKA (S1)'],
            ['nama_prodi' => 'KEBIDANAN (D3)'],
            ['nama_prodi' => 'KEBIDANAN (S1)'],
            ['nama_prodi' => 'KEPERAWATAN (D3)'],
            ['nama_prodi' => 'KEPERAWATAN (S1)'],
            ['nama_prodi' => 'KEPERAWATAN (S2)'],
            ['nama_prodi' => 'KEPERAWATAN ANESTESIOLOGI (D4)'],
            ['nama_prodi' => 'PENDIDIKAN BAHASA INDONESIA (S1)'],
            ['nama_prodi' => 'PENDIDIKAN BAHASA INGGRIS (S1)'],
            ['nama_prodi' => 'PENDIDIKAN ISLAM ANAK USIA DINI (S1)'],
            ['nama_prodi' => 'PENDIDIKAN MATEMATIKA (S1)'],
            ['nama_prodi' => 'PENDIDIKAN PROFESI BIDAN (PROFESI)'],
            ['nama_prodi' => 'PERBANKAN SYARIAH (S1)'],
            ['nama_prodi' => 'PERENCANAAN WILAYAH DAN KOTA (S1)'],
            ['nama_prodi' => 'PROFESI NERS (PROFESI)'],
            ['nama_prodi' => 'PSIKOLOGI (S1)'],
            ['nama_prodi' => 'TEKNIK SIPIL (S1)'],
        ]);
    }
}