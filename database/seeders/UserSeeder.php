<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'username' => 'adminsdi',
            'password' => bcrypt('adminsdi'),
            'role' => 'admin',
        ]);
        User::create([
            'username' => 'dosenberjabatan',
            'password' => bcrypt('dosenberjabatan'),
            'role' => 'dosenberjabatan',
        ]);
    }
}
