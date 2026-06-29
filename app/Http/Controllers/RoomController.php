<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\Request;

// ============================================================
// PERTEMUAN 11 — RoomController (Resource CRUD)
// Mengelola data kamar hotel dari admin panel
//
// PERTEMUAN 13 — Otorisasi:
// - Route sudah dilindungi middleware 'role:admin'
// - authorizeResource() memetakan setiap method ke RoomPolicy
// ============================================================

class RoomController extends Controller
{
    // Catatan Laravel 12: authorizeResource() & middleware() di constructor
    // sudah dihapus dari framework. Otorisasi ditangani oleh:
    // 1. Route middleware 'auth'     → wajib login
    // 2. Route middleware 'role:admin' → wajib role admin (web.php)
    // 3. @can / Gate::authorize()   → di dalam method & view

    // GET /admin/rooms — daftar semua kamar
    public function index()
    {
        // withCount('reservations') → cegah N+1, hitung relasi hasMany
        $rooms = Rooms::withCount('reservations')
                       ->latest()
                       ->paginate(10);

        return view('admin.rooms.index', compact('rooms'));
    }

    // GET /admin/rooms/create — form tambah kamar
    public function create()
    {
        return view('admin.rooms.create');
    }

    // POST /admin/rooms — simpan kamar baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:100',
            'tipe'            => 'required|string|max:50|unique:rooms,tipe',
            'deskripsi'       => 'nullable|string',
            'gambar'          => 'nullable|image|max:2048',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas'       => 'required|integer|min:1|max:20',
            'ukuran'          => 'nullable|string|max:20',
            'tipe_bed'        => 'nullable|string|max:50',
            'pemandangan'     => 'nullable|string|max:100',
            'fasilitas'       => 'nullable|array',
            'fasilitas.*'     => 'string|max:50',
        ], [
            'nama.required'            => 'Nama kamar wajib diisi.',
            'tipe.required'            => 'Tipe kamar wajib diisi.',
            'tipe.unique'              => 'Tipe kamar sudah ada.',
            'harga_per_malam.required' => 'Harga per malam wajib diisi.',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                                           ->store('rooms', 'public');
        }

        $validated['fasilitas'] = $request->fasilitas ?? [];
        $validated['is_active'] = $request->has('is_active');

        Rooms::create($validated);

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Kamar "' . $validated['nama'] . '" berhasil ditambahkan.');
    }

    // GET /admin/rooms/{room}/edit — form edit kamar
    public function edit(Rooms $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    // PUT /admin/rooms/{room} — simpan perubahan
    public function update(Request $request, Rooms $room)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:100',
            'tipe'            => 'required|string|max:50|unique:rooms,tipe,' . $room->id,
            'deskripsi'       => 'nullable|string',
            'gambar'          => 'nullable|image|max:2048',
            'harga_per_malam' => 'required|numeric|min:0',
            'kapasitas'       => 'required|integer|min:1|max:20',
            'ukuran'          => 'nullable|string|max:20',
            'tipe_bed'        => 'nullable|string|max:50',
            'pemandangan'     => 'nullable|string|max:100',
            'fasilitas'       => 'nullable|array',
            'fasilitas.*'     => 'string|max:50',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')
                                           ->store('rooms', 'public');
        }

        $validated['fasilitas'] = $request->fasilitas ?? [];
        $validated['is_active'] = $request->has('is_active');

        $room->update($validated);

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Data kamar "' . $room->nama . '" berhasil diperbarui.');
    }

    // DELETE /admin/rooms/{room} — hapus kamar
    public function destroy(Rooms $room)
    {
        $nama = $room->nama;
        $room->delete();

        return redirect()->route('admin.rooms.index')
                         ->with('success', 'Kamar "' . $nama . '" berhasil dihapus.');
    }
}
