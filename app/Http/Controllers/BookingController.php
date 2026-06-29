<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    // ── Halaman booking utama (pilih kamar & tanggal) ──────────────
    public function index(Request $request)
    {
        $rooms    = Rooms::aktif()->orderBy('harga_per_malam')->get();
        $selected = $request->get('room');
        $checkin  = $request->get('checkin');
        $checkout = $request->get('checkout');
        $guests   = $request->get('guests', 1);

        return view('booking', compact('rooms', 'selected', 'checkin', 'checkout', 'guests'));
    }

    // ── Halaman form reservasi ──────────────────────────────────────
    public function form(Request $request)
    {
        $roomName = $request->get('room');
        $checkin  = $request->get('checkin');
        $checkout = $request->get('checkout');
        $guests   = $request->get('guests', 1);

        if (!$roomName || !$checkin || !$checkout) {
            return redirect()->route('booking')->with('error', 'Silakan pilih kamar dan tanggal terlebih dahulu.');
        }

        $room = Rooms::aktif()->where('nama', $roomName)->first();

        if (!$room) {
            return redirect()->route('booking')->with('error', 'Kamar tidak ditemukan.');
        }

        $checkinDate  = Carbon::parse($checkin);
        $checkoutDate = Carbon::parse($checkout);
        $nights       = max(1, $checkinDate->diffInDays($checkoutDate));
        $totalHarga   = $room->harga_per_malam * $nights;

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
            'jumlah_tamu'       => 'required|integer|min:1|max:6',
            'tipe_pembayaran'   => 'required|in:lunas,dp',
            'metode_pembayaran' => 'required|in:transfer_bank',
            'nama_bank'         => 'required|in:BCA,BRI,BNI,MANDIRI,PAYPAL',
        ], [
            'nama_lengkap.required'      => 'Nama lengkap wajib diisi.',
            'email.required'             => 'Email wajib diisi.',
            'email.email'                => 'Format email tidak valid.',
            'no_telepon.required'        => 'Nomor telepon wajib diisi.',
            'check_in.after_or_equal'    => 'Tanggal check-in minimal hari ini.',
            'check_out.after'            => 'Tanggal check-out harus setelah check-in.',
            'tipe_pembayaran.required'   => 'Pilih tipe pembayaran: Lunas atau DP 50%.',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih.',
            'nama_bank.required'         => 'Pilih bank tujuan transfer.',
            'nama_bank.in'               => 'Bank tidak valid. Pilih BCA, BRI, BNI, MANDIRI, atau PAYPAL.',
        ]);

        $room = Rooms::where('nama', $request->jenis_kamar)->first();

        $checkinDate   = Carbon::parse($request->check_in);
        $checkoutDate  = Carbon::parse($request->check_out);
        $nights        = max(1, $checkinDate->diffInDays($checkoutDate));
        $hargaPerMalam = $room ? $room->harga_per_malam : 0;
        $totalHarga    = $hargaPerMalam * $nights;

        $tipePembayaran = $request->tipe_pembayaran;
        $jumlahDp       = $tipePembayaran === 'dp' ? round($totalHarga * 0.5) : null;

        $batasBayar = Carbon::now()->addHours(12);

        $reservation = Reservation::create([
            'room_id'           => $room?->id,
            'nama_lengkap'      => $request->nama_lengkap,
            'email'             => $request->email,
            'no_telepon'        => $request->no_telepon,
            'alamat'            => $request->alamat,
            'kota'              => $request->kota,
            'negara'            => $request->negara ?? 'Indonesia',
            'no_identitas'      => $request->no_identitas,
            'jenis_identitas'   => $request->jenis_identitas,
            'jenis_kamar'       => $request->jenis_kamar,
            'check_in'          => $request->check_in,
            'check_out'         => $request->check_out,
            'jumlah_tamu'       => $request->jumlah_tamu,
            'jumlah_malam'      => $nights,
            'harga_per_malam'   => $hargaPerMalam,
            'total_harga'       => $totalHarga,
            'permintaan_khusus' => $request->permintaan_khusus,
            'tipe_pembayaran'   => $tipePembayaran,
            'jumlah_dp'         => $jumlahDp,
            'batas_bayar'       => $batasBayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'nama_bank'         => $request->nama_bank,
            'no_rekening'       => $request->no_rekening,
            'status'            => 'pending',
            'kode_booking'      => Reservation::generateKodeBooking(),
        ]);

        return redirect()->route('booking.success', $reservation->kode_booking);
    }

    // ── Halaman sukses ──────────────────────────────────────────────
    public function success($kode)
    {
        $reservation = Reservation::with('room')
                                   ->where('kode_booking', $kode)
                                   ->firstOrFail();

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
}