<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// ============================================================
// PERTEMUAN 12 — Seeder Akun Admin
// Membuat akun admin default dengan role 'admin'
// Jalankan: php artisan db:seed --class=AdminSeeder
// Login: admin@hotel.com / password
// ============================================================

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@hotel.com'],
            [
                'name'     => 'Administrator',
                'email'    => 'admin@hotel.com',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@hotel.com'],
            [
                'name'     => 'Staff Hotel',
                'email'    => 'staff@hotel.com',
                'password' => Hash::make('password'),
                'role'     => 'staff',
            ]
        );

        $this->command->info('✅ Akun admin & staff berhasil di-seed.');
        $this->command->info('   Admin  → admin@hotel.com / password');
        $this->command->info('   Staff  → staff@hotel.com / password');
    }
}
