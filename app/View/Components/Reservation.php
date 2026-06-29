<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// ============================================================
// PERTEMUAN 11 — Update Reservation Component
// Menerima Eloquent model Rooms dari DB (bukan array).
// Dikonversi ke format array lama agar blade view tidak perlu
// diubah sama sekali.
// ============================================================

class Reservation extends Component
{
    public ?array  $room;
    public ?string $checkin;
    public ?string $checkout;
    public int     $guests;
    public int     $nights;
    public float   $totalHarga;

    public function __construct(
        $room         = null,  // menerima array ATAU Eloquent Rooms model
        ?string $checkin    = null,
        ?string $checkout   = null,
        int     $guests     = 1,
        int     $nights     = 1,
        float   $totalHarga = 0
    ) {
        // Jika $room adalah Eloquent model, konversi ke format array
        // yang dipakai blade view (key: name, type, image, price, ...)
        if ($room instanceof \App\Models\Rooms) {
            $this->room = [
                'name'       => $room->nama,
                'type'       => $room->tipe,
                'image'      => '/' . ltrim($room->gambar, '/'),
                'price'      => (float) $room->harga_per_malam,
                'facilities' => $room->fasilitas ?? [],
                'capacity'   => ($room->kapasitas ?? 2) . ' Orang',
                'size'       => $room->ukuran ?? '',
                'bed'        => $room->tipe_bed ?? '',
                'view'       => $room->pemandangan ?? '',
            ];
        } else {
            $this->room = $room;
        }

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
