<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    // Pertemuan 13: tambahkan trait ini agar authorizeResource()
    // dan $this->authorize() bisa dipakai di semua controller turunan
    use AuthorizesRequests;
}
