<?php

namespace App\View\Components;

use App\Models\Reservation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookingSuccess extends Component
{
    public Reservation $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function render(): View|Closure|string
    {
        return view('components.booking-success');
    }
}