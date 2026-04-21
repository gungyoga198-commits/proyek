<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

// ── PUBLIC ─────────────────────────────────────────────────────────
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/rooms',   function () { return view('rooms');   })->name('rooms');
Route::get('/gallery', function () { return view('gallery'); })->name('gallery');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// ── BOOKING & RESERVASI ────────────────────────────────────────────
Route::get('/booking',                [BookingController::class, 'index'])->name('booking');
Route::get('/reservation',            [BookingController::class, 'form'])->name('booking.form');
Route::post('/reservation',           [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{kode}', [BookingController::class, 'success'])->name('booking.success');
Route::get('/cek-reservasi',          [BookingController::class, 'cekReservasi'])->name('reservasi.cek.form');
Route::post('/cek-reservasi',         [BookingController::class, 'cariReservasi'])->name('reservasi.cek');

// ── ADMIN AUTH ─────────────────────────────────────────────────────
Route::get('/admin/anjay13',  [LoginController::class, 'index']);
Route::post('/admin/login',   [LoginController::class, 'login']);
Route::post('/logout',        [LoginController::class, 'logout'])->name('admin.logout');

// ── ADMIN PANEL ────────────────────────────────────────────────────
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard',              [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/reservasi',              [AdminController::class, 'reservasi'])->name('admin.reservasi');
    Route::get('/reservasi/{id}',         [AdminController::class, 'detailReservasi'])->name('admin.reservasi.detail');
    Route::post('/reservasi/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.reservasi.status');
    Route::get('/kalender',               [AdminController::class, 'kalender'])->name('admin.kalender');
    Route::get('/laporan',                [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/laporan/pdf',            [AdminController::class, 'downloadPdf'])->name('admin.laporan.pdf');
    Route::get('/kamar',                  [AdminController::class, 'kamar'])->name('admin.kamar');
});