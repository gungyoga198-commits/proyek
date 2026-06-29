<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// ============================================================
// PERTEMUAN 13 — Middleware CheckRole
// Melindungi route berdasarkan kolom role di tabel users
// Penggunaan: ->middleware('role:admin')
//          atau ->middleware('role:admin,staff')
// ============================================================

class CheckRole
{
    /**
     * Handle an incoming request.
     * Variadic parameter $roles: bisa menerima banyak role sekaligus
     * Contoh: role:admin,staff → user dengan salah satu role diizinkan
     */
    public function handle(Request $request, Closure $next, string ...$roles): mixed
    {
        // 1. Pastikan user sudah login terlebih dahulu
        if (!auth()->check()) {
            return redirect('/admin/anjay13')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah role user ada di daftar role yang diizinkan
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Akses ditolak! Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
