<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GalleryController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/rooms', function () {
    $rooms = \App\Models\Rooms::aktif()->orderBy('harga_per_malam')->get();
    return view('rooms', compact('rooms'));
})->name('rooms');

Route::get('/room/{id}', function ($id) {
    $room = \App\Models\Rooms::aktif()->findOrFail($id);
    return view('room-detail', compact('room'));
})->name('room.detail');

Route::get('/gallery', [GalleryController::class, 'publicIndex'])
    ->name('gallery');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


/*
|--------------------------------------------------------------------------
| BOOKING & RESERVASI
|--------------------------------------------------------------------------
*/

Route::get('/booking', [BookingController::class, 'index'])
    ->name('booking');

Route::get('/reservation', [BookingController::class, 'form'])
    ->name('booking.form');

Route::post('/reservation', [BookingController::class, 'store'])
    ->name('booking.store');

Route::get('/booking/success/{kode}', [BookingController::class, 'success'])
    ->name('booking.success');

Route::get('/cek-reservasi', [BookingController::class, 'cekReservasi'])
    ->name('reservasi.cek.form');

Route::post('/cek-reservasi', [BookingController::class, 'cariReservasi'])
    ->name('reservasi.cek');


/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [LoginController::class, 'index'])
    ->name('admin.login');

Route::post('/admin/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Reservasi
    Route::get('/reservasi', [AdminController::class, 'reservasi'])
        ->name('admin.reservasi');

    Route::get('/reservasi/{id}', [AdminController::class, 'detailReservasi'])
        ->name('admin.reservasi.detail');

    Route::post('/reservasi/{id}/status', [AdminController::class, 'updateStatus'])
        ->name('admin.reservasi.status');

    // Kalender
    Route::get('/kalender', [AdminController::class, 'kalender'])
        ->name('admin.kalender');

    // Laporan
    Route::get('/laporan', [AdminController::class, 'laporan'])
        ->name('admin.laporan');

    Route::get('/laporan/pdf', [AdminController::class, 'downloadPdf'])
        ->name('admin.laporan.pdf');

    // Kamar
    Route::get('/kamar', [AdminController::class, 'kamar'])
        ->name('admin.kamar');

    // Room CRUD
    Route::get('/rooms', [RoomController::class, 'index'])
        ->name('admin.rooms.index');

    Route::get('/rooms/create', [RoomController::class, 'create'])
        ->name('admin.rooms.create');

    Route::post('/rooms', [RoomController::class, 'store'])
        ->name('admin.rooms.store');

    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])
        ->name('admin.rooms.edit');

    Route::put('/rooms/{room}', [RoomController::class, 'update'])
        ->name('admin.rooms.update');

    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])
        ->name('admin.rooms.destroy');

    // Gallery CRUD
    Route::get('/gallery', [GalleryController::class, 'index'])
        ->name('admin.gallery.index');

    Route::get('/gallery/create', [GalleryController::class, 'create'])
        ->name('admin.gallery.create');

    Route::post('/gallery', [GalleryController::class, 'store'])
        ->name('admin.gallery.store');

    Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'edit'])
        ->name('admin.gallery.edit');

    Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])
        ->name('admin.gallery.update');

    Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])
        ->name('admin.gallery.destroy');

});