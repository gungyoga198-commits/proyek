<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageBanner extends Component
{
    public function __construct(
        public string $image    = '/images/OGAG.jpg',
        public string $eyebrow  = '',
        public string $title    = '',
        public string $subtitle = '',
        public string $overlay  = 'bg-black/55',
        public bool   $showLine = true,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.page-banner');
    }
}