<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $terbaru   = Reservation::latest()->take(5)->get();

        // Ketersediaan kamar realtime hari ini
        $today = Carbon::today();
        $kamarStatus = $this->getKamarStatus($today, $today);

        return view('admin.dashboard', compact('total','pending','confirmed','checkedIn','cancelled','terbaru','kamarStatus'));
    }

    // ── Manajemen Reservasi ────────────────────────────────────────
    public function reservasi(Request $request)
    {
        $query = Reservation::query();
        if ($request->status) $query->where('status', $request->status);
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap',  'like', '%'.$request->search.'%')
                  ->orWhere('kode_booking','like', '%'.$request->search.'%')
                  ->orWhere('email',       'like', '%'.$request->search.'%');
            });
        }
        $reservations = $query->latest()->paginate(10);
        return view('admin.reservasi', compact('reservations'));
    }

    // ── Detail & Update Status ─────────────────────────────────────
    public function detailReservasi($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.detail-reservasi', compact('reservation'));
    }

    public function updateStatus(Request $request, $id)
    {
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

        $reservations = Reservation::whereIn('status', ['confirmed', 'checked_in'])
            ->where(function($q) use ($bulan, $tahun) {
                $q->where(function($q2) use ($bulan, $tahun) {
                    $q2->whereMonth('check_in', $bulan)->whereYear('check_in', $tahun);
                })->orWhere(function($q2) use ($bulan, $tahun) {
                    $q2->whereMonth('check_out', $bulan)->whereYear('check_out', $tahun);
                });
            })->get();

        return view('admin.kalender', compact('reservations', 'bulan', 'tahun'));
    }

    // ── Laporan ────────────────────────────────────────────────────
    public function laporan(Request $request)
    {
        $query = Reservation::query();
        if ($request->dari)   $query->whereDate('created_at', '>=', $request->dari);
        if ($request->sampai) $query->whereDate('created_at', '<=', $request->sampai);
        if ($request->status) $query->where('status', $request->status);

        $reservations    = $query->latest()->get();
        $totalPendapatan = $reservations->whereIn('status', ['confirmed','checked_in','checked_out'])->sum('total_harga');

        return view('admin.laporan', compact('reservations', 'totalPendapatan'));
    }

    // ── Download PDF Laporan ───────────────────────────────────────
    public function downloadPdf(Request $request)
    {
        $query = Reservation::query();
        if ($request->dari)   $query->whereDate('created_at', '>=', $request->dari);
        if ($request->sampai) $query->whereDate('created_at', '<=', $request->sampai);
        if ($request->status) $query->where('status', $request->status);

        $reservations    = $query->latest()->get();
        $totalPendapatan = $reservations->whereIn('status', ['confirmed','checked_in','checked_out'])->sum('total_harga');
        $dari            = $request->dari;
        $sampai          = $request->sampai;

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.pdf-laporan', compact('reservations', 'totalPendapatan', 'dari', 'sampai'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-reservasi-'.date('d-m-Y').'.pdf');
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
    private function getKamarStatus(Carbon $dari, Carbon $sampai): array
    {
        $rooms = ['Classic Terrace', 'Deluxe Daybed', 'Superior Room'];
        $result = [];

        foreach ($rooms as $nama) {
            $reservasiAktif = Reservation::whereIn('status', ['confirmed', 'checked_in'])
                ->where('jenis_kamar', $nama)
                ->where('check_in',  '<=', $sampai->format('Y-m-d'))
                ->where('check_out', '>',  $dari->format('Y-m-d'))
                ->first();

            $result[$nama] = [
                'tersedia'   => $reservasiAktif === null,
                'reservasi'  => $reservasiAktif,
            ];
        }

        return $result;
    }
}