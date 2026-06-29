<?php

namespace App\View\Components;

use App\Models\Rooms;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Roomsdetail extends Component
{
    public Rooms $room;

    public function __construct(Rooms $room)
    {
        $this->room = $room;
    }

    public function render(): View|Closure|string
    {
        return view('components.roomsdetail');
    }
}
