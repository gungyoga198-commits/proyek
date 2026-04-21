<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Booking extends Component
{
    public array $rooms;
    public ?string $selected;
    public ?string $checkin;
    public ?string $checkout;
    public int $guests;

    public function __construct(
        array   $rooms    = [],
        ?string $selected = null,
        ?string $checkin  = null,
        ?string $checkout = null,
        int     $guests   = 1
    ) {
        $this->rooms    = $rooms;
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