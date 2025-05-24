<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Pendaftaran',
                'email' => 'pendaftaran@example.com',
                'password' => Hash::make('password'),
                'role' => 'pendaftaran',
            ],
            [
                'name' => 'Dr. Andi',
                'email' => 'dokter@example.com',
                'password' => Hash::make('password'),
                'role' => 'dokter',
            ],
            [
                'name' => 'Perawat Siti',
                'email' => 'perawat@example.com',
                'password' => Hash::make('password'),
                'role' => 'perawat',
            ],
            [
                'name' => 'Apoteker Budi',
                'email' => 'apoteker@example.com',
                'password' => Hash::make('password'),
                'role' => 'apoteker',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(['email' => $user['email']], $user);
        }
    }
}
