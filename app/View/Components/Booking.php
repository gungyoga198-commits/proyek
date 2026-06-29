<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// ============================================================
// PERTEMUAN 11 — Update Booking Component
// Sekarang menerima Eloquent Collection dari DB (bukan array).
// Dikonversi ke format array lama agar blade view tidak perlu
// diubah sama sekali.
// ============================================================

class Booking extends Component
{
    public array   $rooms;
    public ?string $selected;
    public ?string $checkin;
    public ?string $checkout;
    public int     $guests;

    public function __construct(
        $rooms    = [],    // menerima array ATAU Eloquent Collection
        ?string $selected = null,
        ?string $checkin  = null,
        ?string $checkout = null,
        int     $guests   = 1
    ) {
        // Jika $rooms adalah Eloquent Collection, konversi ke format
        // array yang dipakai blade view (key: name, type, image, ...)
        if ($rooms instanceof \Illuminate\Support\Collection) {
            $this->rooms = $rooms->map(function ($r) {
                return [
                    'name'        => $r->nama,
                    'type'        => $r->tipe,
                    'image'       => '/' . ltrim($r->gambar, '/'),
                    'location'    => ($r->ukuran ?? '') . ' · ' . ($r->pemandangan ?? ''),
                    'description' => $r->deskripsi ?? '',
                    'capacity'    => ($r->kapasitas ?? 2) . ' Orang',
                    'view'        => $r->pemandangan ?? '',
                    'size'        => $r->ukuran ?? '',
                    'bed'         => $r->tipe_bed ?? '',
                    'price'       => (float) $r->harga_per_malam,
                    'facilities'  => $r->fasilitas ?? [],
                ];
            })->toArray();
        } else {
            $this->rooms = (array) $rooms;
        }

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
