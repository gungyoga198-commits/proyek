<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Gallery extends Component
{
    public $galleries;
    public $kategoris;
    public $kategori;

    public function __construct($galleries = null, $kategoris = null, $kategori = 'semua')
    {
        $this->galleries = $galleries ?? collect();
        $this->kategoris = $kategoris ?? collect();
        $this->kategori = $kategori;
    }

    public function render(): View|Closure|string
    {
        return view('components.gallery');
    }
}