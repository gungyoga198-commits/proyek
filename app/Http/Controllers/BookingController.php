<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // ── Halaman booking utama (pilih kamar & tanggal) ──────────────
    public function index(Request $request)
    {
        $rooms    = $this->getRoomsData();
        $selected = $request->get('room');
        $checkin  = $request->get('checkin');
        $checkout = $request->get('checkout');
        $guests   = $request->get('guests', 1);

        return view('booking', compact('rooms', 'selected', 'checkin', 'checkout', 'guests'));
    }

    // ── Halaman form reservasi ──────────────────────────────────────
    public function form(Request $request)
    {
        $rooms    = $this->getRoomsData();
        $roomName = $request->get('room');
        $checkin  = $request->get('checkin');
        $checkout = $request->get('checkout');
        $guests   = $request->get('guests', 1);

        if (!$roomName || !$checkin || !$checkout) {
            return redirect()->route('booking')->with('error', 'Silakan pilih kamar dan tanggal terlebih dahulu.');
        }

        $room         = collect($rooms)->firstWhere('name', $roomName);
        $checkinDate  = \Carbon\Carbon::parse($checkin);
        $checkoutDate = \Carbon\Carbon::parse($checkout);
        $nights       = max(1, $checkinDate->diffInDays($checkoutDate));
        $totalHarga   = $room ? $room['price'] * $nights : 0;

        return view('reservation', compact('room', 'checkin', 'checkout', 'guests', 'nights', 'totalHarga'));
    }

    // ── Simpan reservasi ke database ────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'      => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'no_telepon'        => 'required|string|max:20',
            'jenis_identitas'   => 'required|in:ktp,passport,sim',
            'no_identitas'      => 'required|string|max:50',
            'jenis_kamar'       => 'required|string',
            'check_in'          => 'required|date|after_or_equal:today',
            'check_out'         => 'required|date|after:check_in',
            'jumlah_tamu'       => 'required|integer|min:1|max:10',
            'metode_pembayaran' => 'required|in:transfer_bank,kartu_kredit,kartu_debit,virtual_account,ovo,gopay,dana',
        ], [
            'nama_lengkap.required'      => 'Nama lengkap wajib diisi.',
            'email.required'             => 'Email wajib diisi.',
            'email.email'                => 'Format email tidak valid.',
            'no_telepon.required'        => 'Nomor telepon wajib diisi.',
            'check_in.after_or_equal'    => 'Tanggal check-in minimal hari ini.',
            'check_out.after'            => 'Tanggal check-out harus setelah check-in.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
        ]);

        $rooms         = $this->getRoomsData();
        $room          = collect($rooms)->firstWhere('name', $request->jenis_kamar);
        $checkinDate   = \Carbon\Carbon::parse($request->check_in);
        $checkoutDate  = \Carbon\Carbon::parse($request->check_out);
        $nights        = max(1, $checkinDate->diffInDays($checkoutDate));
        $hargaPerMalam = $room ? $room['price'] : 0;
        $totalHarga    = $hargaPerMalam * $nights;

        $reservation = Reservation::create([
            'nama_lengkap'        => $request->nama_lengkap,
            'email'               => $request->email,
            'no_telepon'          => $request->no_telepon,
            'alamat'              => $request->alamat,
            'kota'                => $request->kota,
            'negara'              => $request->negara ?? 'Indonesia',
            'no_identitas'        => $request->no_identitas,
            'jenis_identitas'     => $request->jenis_identitas,
            'jenis_kamar'         => $request->jenis_kamar,
            'check_in'            => $request->check_in,
            'check_out'           => $request->check_out,
            'jumlah_tamu'         => $request->jumlah_tamu,
            'jumlah_malam'        => $nights,
            'harga_per_malam'     => $hargaPerMalam,
            'total_harga'         => $totalHarga,
            'permintaan_khusus'   => $request->permintaan_khusus,
            'metode_pembayaran'   => $request->metode_pembayaran,
            'nama_bank'           => $request->nama_bank,
            'no_rekening'         => $request->no_rekening,
            'nama_pemegang_kartu' => $request->nama_pemegang_kartu,
            'status'              => 'pending',
            'kode_booking'        => Reservation::generateKodeBooking(),
        ]);

        return redirect()->route('booking.success', $reservation->kode_booking);
    }

    // ── Halaman sukses ──────────────────────────────────────────────
    public function success($kode)
    {
        $reservation = Reservation::where('kode_booking', $kode)->firstOrFail();
        return view('booking-success', compact('reservation'));
    }

    // ── Halaman cek reservasi (client) ──────────────────────────────
    public function cekReservasi()
    {
        return view('cek-reservasi');
    }

    // ── Proses pencarian reservasi ──────────────────────────────────
    public function cariReservasi(Request $request)
    {
        $request->validate([
            'kode_booking' => 'nullable|string',
            'email'        => 'nullable|email',
        ]);

        $kode  = $request->kode_booking;
        $email = $request->email;

        if (!$kode && !$email) {
            return back()->with('error', 'Harap masukkan kode booking atau email.');
        }

        $query = Reservation::query();

        if ($kode) {
            $query->where('kode_booking', strtoupper(trim($kode)));
        } elseif ($email) {
            $query->where('email', strtolower(trim($email)));
        }

        $reservations = $query->latest()->get();

        return view('cek-reservasi', compact('reservations'));
    }

    // ── Data kamar (single source of truth) ────────────────────────
    private function getRoomsData(): array
    {
        return [
            [
                'name'        => 'Classic Terrace',
                'type'        => 'CLASSIC',
                'image'       => '/images/Deluxe.jpg',
                'location'    => 'Ground Floor · Garden View',
                'description' => 'Located on the ground floor and designed to accommodate up to 2 persons, with the option of a queen and twin beds.',
                'capacity'    => '2 Orang',
                'view'        => 'Pool or Garden',
                'size'        => '25 m²',
                'bed'         => 'Double Extra',
                'price'       => 850000,
                'facilities'  => ['WiFi', 'AC', 'TV', 'Kamar Mandi Pribadi', 'Sarapan'],
            ],
            [
                'name'        => 'Deluxe Daybed',
                'type'        => 'DELUXE',
                'image'       => '/images/Family.jpg',
                'location'    => 'Upper & Ground Floor · Balcony',
                'description' => 'Located on the upper & ground floor designed to accommodate up to 3 persons, with balcony overlooking garden.',
                'capacity'    => '3 Orang',
                'view'        => 'Pool or Garden',
                'size'        => '39 m²',
                'bed'         => 'Double Extra',
                'price'       => 1200000,
                'facilities'  => ['WiFi', 'AC', 'TV', 'Kamar Mandi Pribadi', 'Sarapan', 'Balkon'],
            ],
            [
                'name'        => 'Superior Room',
                'type'        => 'SUPERIOR',
                'image'       => '/images/Presidential.jpg',
                'location'    => '1st & 2nd Floor · Garden View',
                'description' => 'Located on the 1st & 2nd floor designed to accommodate up to 3 persons, with balcony overlooking garden.',
                'capacity'    => '2 Orang',
                'view'        => 'Garden',
                'size'        => '30 m²',
                'bed'         => 'Double / Twin Bed',
                'price'       => 1500000,
                'facilities'  => ['WiFi', 'AC', 'TV', 'Kamar Mandi Pribadi', 'Sarapan', 'Mini Bar'],
            ],
        ];
    }
}