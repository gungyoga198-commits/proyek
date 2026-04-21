<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Reservation extends Component
{
    public ?array  $room;
    public ?string $checkin;
    public ?string $checkout;
    public int     $guests;
    public int     $nights;
    public float   $totalHarga;

    public function __construct(
        ?array  $room       = null,
        ?string $checkin    = null,
        ?string $checkout   = null,
        int     $guests     = 1,
        int     $nights     = 1,
        float   $totalHarga = 0
    ) {
        $this->room       = $room;
        $this->checkin    = $checkin;
        $this->checkout   = $checkout;
        $this->guests     = $guests;
        $this->nights     = $nights;
        $this->totalHarga = $totalHarga;
    }

    public function render(): View|Closure|string
    {
        return view('components.reservation');
    }
}