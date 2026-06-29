<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// ============================================================
// PERTEMUAN 11 — Model Rooms dengan Relasi Eloquent
// Relasi: hasMany → Rooms punya banyak Reservation (1:N)
// Accessor: harga_format
// Scope: aktif()
// ============================================================

class Rooms extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'nama',
        'tipe',
        'deskripsi',
        'gambar',
        'harga_per_malam',
        'kapasitas',
        'ukuran',
        'tipe_bed',
        'pemandangan',
        'fasilitas',
        'is_active',
    ];

    protected $casts = [
        'harga_per_malam' => 'decimal:2',
        'kapasitas'       => 'integer',
        'is_active'       => 'boolean',
        'fasilitas'       => 'array', // JSON → PHP array otomatis
    ];

    // ── RELASI ─────────────────────────────────────────────────────
    // hasMany: Satu kamar bisa punya banyak reservasi
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'room_id');
    }

    // Hanya reservasi yang sedang aktif (confirmed atau checked_in)
    public function reservasiAktif()
    {
        return $this->hasMany(Reservation::class, 'room_id')
                    ->whereIn('status', ['confirmed', 'checked_in']);
    }

    // ── ACCESSOR ────────────────────────────────────────────────────
    // $room->harga_format → "Rp 850.000"
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_per_malam, 0, ',', '.');
    }

    // ── SCOPE ───────────────────────────────────────────────────────
    // Rooms::aktif()->get() → hanya kamar yang is_active = true
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }
}
