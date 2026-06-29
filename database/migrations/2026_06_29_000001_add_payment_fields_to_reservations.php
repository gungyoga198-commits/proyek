<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {

            // Tipe pembayaran: lunas atau dp
            $table->enum('tipe_pembayaran', ['lunas', 'dp'])->default('lunas')->after('metode_pembayaran');

            // Jumlah yang harus dibayar sekarang (full atau 50%)
            $table->decimal('jumlah_dp', 12, 2)->nullable()->after('tipe_pembayaran');

            // Batas waktu pembayaran (12 jam setelah booking dibuat)
            $table->timestamp('batas_bayar')->nullable()->after('jumlah_dp');

            // Nama bank pilihan (BCA, BRI, BNI, MANDIRI, PAYPAL)
            // Override kolom lama yang sudah ada agar tidak konflik
            // — kolom nama_bank sudah ada, cukup gunakan ulang
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['tipe_pembayaran', 'jumlah_dp', 'batas_bayar']);
        });
    }
};