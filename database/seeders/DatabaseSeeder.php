<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// ============================================================
// DatabaseSeeder — jalankan semua seeder secara berurutan
// Perintah: php artisan db:seed
// ============================================================

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoomSeeder::class,   // Pertemuan 11: data kamar dari DB
            AdminSeeder::class,  // Pertemuan 12: akun admin & staff
        ]);
    }
}
