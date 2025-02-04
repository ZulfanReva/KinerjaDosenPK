<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        DB::table('jabatan')->insert([
            ['nama_jabatan' => 'DOSEN PENGAJAR'],
            ['nama_jabatan' => 'KAPRODI'],
            // ['nama_jabatan' => 'KAPRODI ARSITEKTUR (S1)'],
            // ['nama_jabatan' => 'KAPRODI FARMASI (D3)'],
            // ['nama_jabatan' => 'KAPRODI FARMASI (S1)'],
            // ['nama_jabatan' => 'KAPRODI INFORMATIKA (S1)'],
            // ['nama_jabatan' => 'KAPRODI KEBIDANAN (D3)'],
            // ['nama_jabatan' => 'KAPRODI KEBIDANAN (S1)'],
            // ['nama_jabatan' => 'KAPRODI KEPERAWATAN (D3)'],
            // ['nama_jabatan' => 'KAPRODI KEPERAWATAN (S1)'],
            // ['nama_jabatan' => 'KAPRODI KEPERAWATAN (S2)'],
            // ['nama_jabatan' => 'KAPRODI KEPERAWATAN ANESTESIOLOGI (D4)'],
            // ['nama_jabatan' => 'KAPRODI PENDIDIKAN BAHASA INDONESIA (S1)'],
            // ['nama_jabatan' => 'KAPRODI PENDIDIKAN BAHASA INGGRIS (S1)'],
            // ['nama_jabatan' => 'KAPRODI PENDIDIKAN ISLAM ANAK USIA DINI (S1)'],
            // ['nama_jabatan' => 'KAPRODI PENDIDIKAN MATEMATIKA (S1)'],
            // ['nama_jabatan' => 'KAPRODI PENDIDIKAN PROFESI BIDAN (PROFESI)'],
            // ['nama_jabatan' => 'KAPRODI PERBANKAN SYARIAH (S1)'],
            // ['nama_jabatan' => 'KAPRODI PERENCANAAN WILAYAH DAN KOTA (S1)'],
            // ['nama_jabatan' => 'KAPRODI PROFESI NERS (PROFESI)'],
            // ['nama_jabatan' => 'KAPRODI PSIKOLOGI (S1)'],
            // ['nama_jabatan' => 'KAPRODI TEKNIK SIPIL (S1)'],
        ]);
    }
}
