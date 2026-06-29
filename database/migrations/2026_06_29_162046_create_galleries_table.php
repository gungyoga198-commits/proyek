<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();

            $table->string('judul');
            $table->text('deskripsi')->nullable();

            $table->string('kategori'); // hotel, room, event, dll
            $table->string('foto');     // path image storage

            $table->integer('urutan')->default(0); // sorting
            $table->boolean('aktif')->default(true); // tampil / tidak

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};