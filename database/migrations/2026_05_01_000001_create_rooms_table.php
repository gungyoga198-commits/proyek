<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
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
