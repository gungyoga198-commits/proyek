<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

// ============================================================
// PERTEMUAN 11 — Update: getKamarStatus() pakai model Rooms
// PERTEMUAN 13 — Gate::authorize() pada aksi tertentu
// ============================================================

class AdminController extends Controller
{
    // ── Dashboard ──────────────────────────────────────────────────
    public function dashboard()
    {
        $total     = Reservation::count();
        $pending   = Reservation::where('status', 'pending')->count();
        $confirmed = Reservation::where('status', 'confirmed')->count();
        $checkedIn = Reservation::where('status', 'checked_in')->count();
        $cancelled = Reservation::where('status', 'cancelled')->count();

        // PERTEMUAN 11: Eager loading dengan relasi room
        $terbaru = Reservation::with('room')->latest()->take(5)->get();

        // Ketersediaan kamar realtime hari ini
        $today       = Carbon::today();
        $kamarStatus = $this->getKamarStatus($today, $today);

        return view('admin.dashboard', compact(
            'total', 'pending', 'confirmed', 'checkedIn', 'cancelled',
            'terbaru', 'kamarStatus'
        ));
    }

    // ── Manajemen Reservasi ────────────────────────────────────────
    public function reservasi(Request $request)
    {
        $query = Reservation::with('room'); // Eager loading
        if ($request->status) $query->where('status', $request->status);
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap',  'like', '%'.$request->search.'%')
                  ->orWhere('kode_booking', 'like', '%'.$request->search.'%')
                  ->orWhere('email',        'like', '%'.$request->search.'%');
            });
        }
        $reservations = $query->latest()->paginate(10);
        return view('admin.reservasi', compact('reservations'));
    }

    // ── Detail & Update Status ─────────────────────────────────────
    public function detailReservasi($id)
    {
        // PERTEMUAN 11: Eager loading relasi room
        $reservation = Reservation::with('room')->findOrFail($id);
        return view('admin.detail-reservasi', compact('reservation'));
    }

    public function updateStatus(Request $request, $id)
    {
        // PERTEMUAN 13: Cek gate — hanya admin & staff
        Gate::authorize('update-status-reservasi');

        $request->validate(['status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled']);
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $request->status]);

        return back()->with('success', 'Status reservasi "'.$reservation->kode_booking.'" berhasil diperbarui.');
    }

    // ── Kalender ───────────────────────────────────────────────────
    public function kalender(Request $request)
    {
        $bulan = (int) $request->get('bulan', date('m'));
        $tahun = (int) $request->get('tahun', date('Y'));

        $reservations = Reservation::with('room')
            ->whereIn('status', ['confirmed', 'checked_in'])
            ->where(function ($q) use ($bulan, $tahun) {
                $q->where(function ($q2) use ($bulan, $tahun) {
                    $q2->whereMonth('check_in', $bulan)->whereYear('check_in', $tahun);
                })->orWhere(function ($q2) use ($bulan, $tahun) {
                    $q2->whereMonth('check_out', $bulan)->whereYear('check_out', $tahun);
                });
            })->get();

        return view('admin.kalender', compact('reservations', 'bulan', 'tahun'));
    }

    // ── Laporan ────────────────────────────────────────────────────
    public function laporan(Request $request)
    {
        // PERTEMUAN 13: Cek gate — hanya admin & staff
        Gate::authorize('lihat-laporan');

        $query = Reservation::query();
        if ($request->dari)   $query->whereDate('created_at', '>=', $request->dari);
        if ($request->sampai) $query->whereDate('created_at', '<=', $request->sampai);
        if ($request->status) $query->where('status', $request->status);

        $reservations    = $query->latest()->get();
        $totalPendapatan = $reservations->whereIn('status', ['confirmed', 'checked_in', 'checked_out'])
                                         ->sum('total_harga');

        return view('admin.laporan', compact('reservations', 'totalPendapatan'));
    }

    // ── Cetak / Export Laporan (Print-friendly HTML) ───────────────
    // Catatan: dompdf dihapus — gunakan Print Browser → Save as PDF
    public function downloadPdf(Request $request)
    {
        // PERTEMUAN 13: Cek gate — hanya admin (via middleware 'role:admin' di route)
        Gate::authorize('download-laporan');

        $query = Reservation::query();
        if ($request->dari)   $query->whereDate('created_at', '>=', $request->dari);
        if ($request->sampai) $query->whereDate('created_at', '<=', $request->sampai);
        if ($request->status) $query->where('status', $request->status);

        $reservations    = $query->latest()->get();
        $totalPendapatan = $reservations->whereIn('status', ['confirmed', 'checked_in', 'checked_out'])
                                         ->sum('total_harga');
        $dari   = $request->dari;
        $sampai = $request->sampai;

        // Render view HTML — browser akan otomatis membuka dialog Print
        // User tinggal pilih "Save as PDF" di dialog print browser
        return view('admin.pdf-laporan', compact('reservations', 'totalPendapatan', 'dari', 'sampai'));
    }

    // ── Kamar Realtime ─────────────────────────────────────────────
    public function kamar(Request $request)
    {
        $tanggal     = $request->get('tanggal', date('Y-m-d'));
        $kamarStatus = $this->getKamarStatus(
            Carbon::parse($tanggal),
            Carbon::parse($tanggal)
        );
        return view('admin.kamar', compact('kamarStatus', 'tanggal'));
    }

    // ── Helper: status kamar berdasarkan tanggal ───────────────────
    // PERTEMUAN 11: Sekarang mengambil daftar kamar dari DB via model Rooms
    private function getKamarStatus(Carbon $dari, Carbon $sampai): array
    {
        // Ambil semua kamar aktif dari database (bukan hardcode)
        $rooms  = Rooms::aktif()->orderBy('harga_per_malam')->get();
        $result = [];

        foreach ($rooms as $room) {
            // Cek apakah ada reservasi aktif untuk kamar ini di tanggal tersebut
            $reservasiAktif = Reservation::whereIn('status', ['confirmed', 'checked_in'])
                ->where('jenis_kamar', $room->nama)
                ->where('check_in',   '<=', $sampai->format('Y-m-d'))
                ->where('check_out',  '>',  $dari->format('Y-m-d'))
                ->first();

            $result[$room->nama] = [
                'tersedia'  => $reservasiAktif === null,
                'reservasi' => $reservasiAktif,
                'room'      => $room, // data kamar dari DB
            ];
        }

        return $result;
    }
}
