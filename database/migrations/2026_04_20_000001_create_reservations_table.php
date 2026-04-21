<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // Data Tamu
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('negara')->default('Indonesia');
            $table->string('no_identitas')->nullable();
            $table->enum('jenis_identitas', ['ktp', 'passport', 'sim'])->default('ktp');

            // Data Kamar
            $table->enum('jenis_kamar', ['Classic Terrace', 'Deluxe Daybed', 'Superior Room']);
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('jumlah_tamu')->default(1);
            $table->integer('jumlah_malam');
            $table->decimal('harga_per_malam', 12, 2);
            $table->decimal('total_harga', 12, 2);

            // Permintaan Khusus
            $table->text('permintaan_khusus')->nullable();

            // Metode Pembayaran
            $table->enum('metode_pembayaran', ['transfer_bank', 'kartu_kredit', 'kartu_debit', 'virtual_account', 'ovo', 'gopay', 'dana']);
            $table->string('nama_bank')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('nama_pemegang_kartu')->nullable();

            // Status
            $table->enum('status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');
            $table->string('kode_booking')->unique();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};