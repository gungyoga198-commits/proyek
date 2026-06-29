<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class Booking extends Component
{
    public Collection $rooms;
    public ?string $selected;
    public ?string $checkin;
    public ?string $checkout;
    public int     $guests;

    public function __construct(
        $rooms    = null,
        ?string $selected = null,
        ?string $checkin  = null,
        ?string $checkout = null,
        int     $guests   = 1
    ) {
        $this->rooms    = $rooms instanceof Collection ? $rooms : collect($rooms);
        $this->selected = $selected;
        $this->checkin  = $checkin;
        $this->checkout = $checkout;
        $this->guests   = $guests;
    }

    public function render(): View|Closure|string
    {
        return view('components.booking');
    }
}