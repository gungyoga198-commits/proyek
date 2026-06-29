<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CekReservasi extends Component
{
    public mixed $reservations;

    public function __construct(mixed $reservations = null)
    {
        $this->reservations = $reservations;
    }

    public function render(): View|Closure|string
    {
        return view('components.cek-reservasi');
    }
}