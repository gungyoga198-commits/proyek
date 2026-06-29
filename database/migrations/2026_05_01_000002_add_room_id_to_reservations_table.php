<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ============================================================
// PERTEMUAN 11 — Tambah FK room_id ke tabel reservations
// Membangun relasi belongsTo: Reservation → Room (1:N)
// Nullable agar data reservasi lama tidak rusak
// ============================================================

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // FK ke tabel rooms — nullOnDelete: reservasi tetap ada jika kamar dihapus
            $table->foreignId('room_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('rooms')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
        });
    }
};
