<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// ============================================================
// PERTEMUAN 11 — Rooms View Component
// $rooms diterima dari route, diteruskan ke blade view.
// ============================================================

class Rooms extends Component
{
    public $rooms;

    public function __construct($rooms = [])
    {
        $this->rooms = $rooms;
    }

    public function render(): View|Closure|string
    {
        return view('components.rooms');
    }
}
