<?php

namespace Database\Seeders;

use App\Models\Rooms;
use Illuminate\Database\Seeder;

// ============================================================
// PERTEMUAN 11 — Seeder Data Kamar Hotel
// Memindahkan data kamar dari array hardcode di controller
// ke database menggunakan model Rooms
// ============================================================

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            [
                'nama'            => 'Classic Terrace',
                'tipe'            => 'CLASSIC',
                'deskripsi'       => 'Classic Terrace room menghadirkan suasana nyaman dengan desain elegan dan pemandangan taman yang asri. Cocok untuk pasangan maupun tamu yang ingin menikmati ketenangan selama menginap.',
                'gambar'          => 'images/Deluxe.jpg',
                'harga_per_malam' => 850000,
                'kapasitas'       => 2,
                'ukuran'          => '25 m²',
                'tipe_bed'        => 'Double Extra',
                'pemandangan'     => 'Pool or Garden',
                'fasilitas'       => ['WiFi', 'AC', 'TV', 'Kamar Mandi Pribadi', 'Sarapan'],
                'is_active'       => true,
            ],
            [
                'nama'            => 'Deluxe Daybed',
                'tipe'            => 'DELUXE',
                'deskripsi'       => 'Deluxe Daybed menawarkan ruangan luas dengan balkon pribadi dan pemandangan taman yang menenangkan. Sangat cocok untuk keluarga kecil.',
                'gambar'          => 'images/Family.jpg',
                'harga_per_malam' => 1200000,
                'kapasitas'       => 3,
                'ukuran'          => '39 m²',
                'tipe_bed'        => 'Double Extra',
                'pemandangan'     => 'Pool or Garden',
                'fasilitas'       => ['WiFi', 'AC', 'TV', 'Kamar Mandi Pribadi', 'Sarapan', 'Balkon'],
                'is_active'       => true,
            ],
            [
                'nama'            => 'Superior Room',
                'tipe'            => 'SUPERIOR',
                'deskripsi'       => 'Superior Room memberikan kenyamanan premium dengan desain modern dan balkon dengan pemandangan taman yang indah.',
                'gambar'          => 'images/Presidential.jpg',
                'harga_per_malam' => 1500000,
                'kapasitas'       => 2,
                'ukuran'          => '30 m²',
                'tipe_bed'        => 'Double / Twin Bed',
                'pemandangan'     => 'Garden',
                'fasilitas'       => ['WiFi', 'AC', 'TV', 'Kamar Mandi Pribadi', 'Sarapan', 'Mini Bar'],
                'is_active'       => true,
            ],
        ];

        foreach ($rooms as $data) {
            Rooms::create($data);
        }

        $this->command->info('✅ 3 data kamar berhasil di-seed.');
    }
}
