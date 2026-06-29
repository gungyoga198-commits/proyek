<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;

// ── PUBLIC ─────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/rooms', function () {
    $rooms = \App\Models\Rooms::aktif()->orderBy('harga_per_malam')->get();
    return view('rooms', compact('rooms'));
})->name('rooms');

// ── ROOM DETAIL — dinamis dari database via ID ──────────────────────
Route::get('/room/{id}', function ($id) {
    $room = \App\Models\Rooms::aktif()->findOrFail($id);
    return view('room-detail', compact('room'));
})->name('room.detail');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// ── BOOKING & RESERVASI ────────────────────────────────────────────
Route::get('/booking',                [BookingController::class, 'index'])->name('booking');
Route::get('/reservation',            [BookingController::class, 'form'])->name('booking.form');
Route::post('/reservation',           [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{kode}', [BookingController::class, 'success'])->name('booking.success');
Route::get('/cek-reservasi',          [BookingController::class, 'cekReservasi'])->name('reservasi.cek.form');
Route::post('/cek-reservasi',         [BookingController::class, 'cariReservasi'])->name('reservasi.cek');


// ── ADMIN AUTH ─────────────────────────────────────────────────────
Route::get('/admin/login',  [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login',   [LoginController::class, 'login']);
Route::post('/logout',        [LoginController::class, 'logout'])->name('admin.logout');


// ── ADMIN PANEL ────────────────────────────────────────────────────
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard',              [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/reservasi',              [AdminController::class, 'reservasi'])->name('admin.reservasi');
    Route::get('/reservasi/{id}',         [AdminController::class, 'detailReservasi'])->name('admin.reservasi.detail');
    Route::get('/kalender',               [AdminController::class, 'kalender'])->name('admin.kalender');

    Route::post('/reservasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.reservasi.status');

    Route::get('/laporan',                [AdminController::class, 'laporan'])->name('admin.laporan');

    Route::get('/laporan/pdf',            [AdminController::class, 'downloadPdf'])
         ->middleware('role:admin')
         ->name('admin.laporan.pdf');

    Route::get('/kamar',                  [AdminController::class, 'kamar'])->name('admin.kamar');

    Route::middleware('role:admin')->group(function () {
        Route::get('/rooms',                [RoomController::class, 'index'])->name('admin.rooms.index');
        Route::get('/rooms/create',         [RoomController::class, 'create'])->name('admin.rooms.create');
        Route::post('/rooms',               [RoomController::class, 'store'])->name('admin.rooms.store');
        Route::get('/rooms/{room}/edit',    [RoomController::class, 'edit'])->name('admin.rooms.edit');
        Route::put('/rooms/{room}',         [RoomController::class, 'update'])->name('admin.rooms.update');
        Route::delete('/rooms/{room}',      [RoomController::class, 'destroy'])->name('admin.rooms.destroy');
    });

});