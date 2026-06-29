<?php

namespace App\Providers;

use App\Models\Rooms;
use App\Models\User;
use App\Policies\RoomPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

// ============================================================
// PERTEMUAN 13 — Gate & Policy
// Gate::before  → Admin bypass semua gate
// Gate::define  → Aturan otorisasi global
// $policies     → Daftarkan RoomPolicy ke model Rooms
// ============================================================

class AppServiceProvider extends ServiceProvider
{
    /**
     * Daftarkan Policy model secara eksplisit
     * (Laravel 11 mendukung auto-discovery, tapi eksplisit lebih jelas)
     */
    protected array $policies = [
        Rooms::class => RoomPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Daftarkan semua policy
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }

        // ── GATE::BEFORE — Admin bypass semua gate ───────────────
        // Jika return true → semua Gate::allows() langsung true
        // Jika return null → lanjut cek gate normal
        Gate::before(function (User $user, string $ability) {
            if ($user->role === 'admin') {
                return true;
            }
            return null;
        });

        // ── GATE 1: Kelola kamar (tambah / edit / hapus) ─────────
        // Hanya admin, tapi sudah di-handle oleh Gate::before di atas
        Gate::define('kelola-kamar', function (User $user) {
            return $user->role === 'admin';
        });

        // ── GATE 2: Lihat laporan pendapatan ─────────────────────
        // Admin dan staff boleh lihat laporan
        Gate::define('lihat-laporan', function (User $user) {
            return in_array($user->role, ['admin', 'staff']);
        });

        // ── GATE 3: Update status reservasi ──────────────────────
        // Admin dan staff boleh update status
        Gate::define('update-status-reservasi', function (User $user) {
            return in_array($user->role, ['admin', 'staff']);
        });

        // ── GATE 4: Download PDF laporan ─────────────────────────
        // Hanya admin
        Gate::define('download-laporan', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
