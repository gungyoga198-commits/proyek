<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

// ── PUBLIC ─────────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/rooms', function () {
    return view('rooms');
})->name('rooms');


// ── ROOM DETAIL ────────────────────────────────────────────────────
Route::get('/room/{type}', function ($type) {

    $rooms = [

        'classic' => [
            'name' => 'Classic Terrace',
            'type' => 'CLASSIC',
            'image' => '/images/Deluxe.jpg',
            'price' => '850.000',
            'description' => 'Classic Terrace room menghadirkan suasana nyaman dengan desain elegan dan pemandangan taman yang asri. Cocok untuk pasangan maupun tamu yang ingin menikmati ketenangan selama menginap.',
            'capacity' => '2 People',
            'view' => 'Pool or Garden',
            'size' => '25 m²',
            'bed' => 'Double Extra',
            'facilities' => [
                'WiFi',
                'AC',
                'TV',
                'Breakfast',
                'Hot Water',
            ],
        ],

        'deluxe' => [
            'name' => 'Deluxe Daybed',
            'type' => 'DELUXE',
            'image' => '/images/Family.jpg',
            'price' => '1.200.000',
            'description' => 'Deluxe Daybed menawarkan ruangan luas dengan balkon pribadi dan pemandangan taman yang menenangkan. Sangat cocok untuk keluarga kecil.',
            'capacity' => '3 People',
            'view' => 'Pool or Garden',
            'size' => '39 m²',
            'bed' => 'Double Extra',
            'facilities' => [
                'WiFi',
                'AC',
                'Mini Bar',
                'TV',
                'Breakfast',
            ],
        ],

        'superior' => [
            'name' => 'Superior Room',
            'type' => 'SUPERIOR',
            'image' => '/images/Presidential.jpg',
            'price' => '1.500.000',
            'description' => 'Superior Room memberikan kenyamanan premium dengan desain modern dan balkon dengan pemandangan taman yang indah.',
            'capacity' => '2 People',
            'view' => 'Garden',
            'size' => '30 m²',
            'bed' => 'Double / Twin Bed',
            'facilities' => [
                'WiFi',
                'AC',
                'Netflix TV',
                'Breakfast',
                'Bathtub',
            ],
        ],

    ];

    if (!isset($rooms[$type])) {
        abort(404);
    }

    $room = $rooms[$type];

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