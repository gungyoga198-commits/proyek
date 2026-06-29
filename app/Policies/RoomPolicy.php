<?php

namespace App\Policies;

use App\Models\Rooms;
use App\Models\User;

// ============================================================
// PERTEMUAN 13 — RoomPolicy
// Otorisasi berbasis model untuk CRUD Rooms
// Generate: php artisan make:policy RoomPolicy --model=Rooms
//
// Mapping otomatis via authorizeResource():
//   index()   → viewAny
//   show()    → view
//   create()  → create
//   store()   → create
//   edit()    → update
//   update()  → update
//   destroy() → delete
// ============================================================

class RoomPolicy
{
    /**
     * before(): Jika return true → skip semua cek di bawah
     * Admin bypass semua policy (akses penuh)
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role === 'admin') {
            return true; // admin boleh semua
        }

        return null; // lanjut ke method masing-masing
    }

    // GET /admin/rooms — staff boleh lihat daftar kamar
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staff']);
    }

    // GET /admin/rooms/{room} — staff boleh lihat detail
    public function view(User $user, Rooms $room): bool
    {
        return in_array($user->role, ['admin', 'staff']);
    }

    // GET /admin/rooms/create — hanya admin
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    // PUT /admin/rooms/{room} — hanya admin
    public function update(User $user, Rooms $room): bool
    {
        return $user->role === 'admin';
    }

    // DELETE /admin/rooms/{room} — hanya admin
    public function delete(User $user, Rooms $room): bool
    {
        return $user->role === 'admin';
    }
}
