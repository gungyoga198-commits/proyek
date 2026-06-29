<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ============================================================
// PERTEMUAN 11 — Migration Tabel Rooms
// Schema::dropIfExists dulu → aman jika tabel lama sudah ada
// dengan struktur yang berbeda
// ============================================================

return new class extends Migration
{
    public function up(): void
    {
        // Hapus tabel lama terlebih dahulu jika sudah ada
        // (aman: tabel lama mungkin punya struktur berbeda)
        Schema::dropIfExists('rooms');

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            // Identitas kamar
            $table->string('nama', 100);                    // Classic Terrace
            $table->string('tipe', 50)->unique();           // CLASSIC, DELUXE, SUPERIOR
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();           // path gambar

            // Spesifikasi
            $table->decimal('harga_per_malam', 12, 2);
            $table->unsignedInteger('kapasitas')->default(2);
            $table->string('ukuran', 20)->nullable();       // 25 m²
            $table->string('tipe_bed', 50)->nullable();     // Double Extra
            $table->string('pemandangan', 100)->nullable(); // Pool or Garden

            // Fasilitas disimpan sebagai JSON
            $table->json('fasilitas')->nullable();

            // Status ketersediaan
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
