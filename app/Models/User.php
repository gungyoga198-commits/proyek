<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// ============================================================
// PERTEMUAN 12 — Update Model User
// Tambah kolom role untuk autentikasi berbasis peran
// PERTEMUAN 13 — Digunakan Gate & Policy untuk cek role
// ============================================================

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // Pertemuan 12: tambah role (admin / staff)
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── HELPER — cek role (dipakai Gate & Blade) ─────────────────
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }
}
