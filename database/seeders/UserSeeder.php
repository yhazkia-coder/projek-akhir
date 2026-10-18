<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Account Admin TU
        User::create([
            'name'     => 'Admin TU',
            'email'    => 'admin@smkn5solo.sch.id',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // Account Siswa
        User::create([
            'name'        => 'Yahya',
            'email'       => 'yahya@siswa.sch.id',
            'nisn'        => '0051234567',
            'password'    => Hash::make('password123'),
            'role'        => 'siswa',
            'kelas'       => 'XII RPL',
            'tahun_lulus' => 2026,
        ]);
    }
}