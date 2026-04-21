@extends('admin.layout')
@section('title', 'Detail Reservasi')

@section('content')

<div class="mb-5">
    <a href="{{ route('admin.reservasi') }}" class="text-sm text-gray-400 hover:text-yellow-600 transition">← Kembali ke Daftar Reservasi</a>
</div>

<div class="grid md:grid-cols-3 gap-6">

    {{-- ── KOLOM KIRI: Detail Data ── --}}
    <div class="md:col-span-2 space-y-5">

        {{-- Header kode booking --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Kode Booking</p>
                    <p class="text-2xl font-bold text-yellow-600 tracking-widest">{{ $reservation->kode_booking }}</p>
                    <p class="text-xs text-gray-400 mt-1">Dipesan pada {{ $reservation->created_at->format('d M Y, H:i') }}</p>
                </div>
                @php
                    $badge = match($reservation->status) {
                        'pending'     => 'bg-yellow-100 text-yellow-700',
                        'confirmed'   => 'bg-blue-100 text-blue-700',
                        'checked_in'  => 'bg-green-100 text-green-700',
                        'checked_out' => 'bg-gray-100 text-gray-500',
                        'cancelled'   => 'bg-red-100 text-red-700',
                        default       => 'bg-gray-100 text-gray-600',
                    };
                    $label = match($reservation->status) {
                        'pending'     => 'Menunggu Konfirmasi',
                        'confirmed'   => 'Dikonfirmasi',
                        'checked_in'  => 'Sedang Menginap',
                        'checked_out' => 'Selesai',
                        'cancelled'   => 'Dibatalkan',
                        default       => $reservation->status,
                    };
                @endphp
                <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $badge }}">{{ $label }}</span>
            </div>
        </div>

        {{-- Data Tamu --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Data Tamu</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Nama Lengkap</p>
                    <p class="font-medium">{{ $reservation->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Email</p>
                    <p class="font-medium">{{ $reservation->email }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">No. Telepon</p>
                    <p class="font-medium">{{ $reservation->no_telepon }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">{{ strtoupper($reservation->jenis_identitas) }}</p>
                    <p class="font-medium">{{ $reservation->no_identitas }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Kota</p>
                    <p class="font-medium">{{ $reservation->kota ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Negara</p>
                    <p class="font-medium">{{ $reservation->negara }}</p>
                </div>
                @if($reservation->alamat)
                <div class="col-span-2">
                    <p class="text-xs text-gray-400 mb-0.5">Alamat</p>
                    <p class="font-medium">{{ $reservation->alamat }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Data Kamar --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Detail Menginap</h3>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Jenis Kamar</p>
                    <p class="font-medium">{{ $reservation->jenis_kamar }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Jumlah Tamu</p>
                    <p class="font-medium">{{ $reservation->jumlah_tamu }} orang</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Check-in</p>
                    <p class="font-medium">{{ $reservation->check_in->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Check-out</p>
                    <p class="font-medium">{{ $reservation->check_out->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Durasi</p>
                    <p class="font-medium">{{ $reservation->jumlah_malam }} malam</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 mb-0.5">Metode Pembayaran</p>
                    <p class="font-medium capitalize">{{ str_replace('_',' ',$reservation->metode_pembayaran) }}</p>
                </div>
                @if($reservation->permintaan_khusus)
                <div class="col-span-2">
                    <p class="text-xs text-gray-400 mb-0.5">Permintaan Khusus</p>
                    <p class="font-medium">{{ $reservation->permintaan_khusus }}</p>
                </div>
                @endif
            </div>

            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between">
                <span class="text-sm text-gray-500">Total Pembayaran</span>
                <span class="font-bold text-yellow-600 text-lg">Rp {{ number_format($reservation->total_harga,0,',','.') }}</span>
            </div>
        </div>

    </div>

    {{-- ── KOLOM KANAN: Update Status ── --}}
    <div class="space-y-5">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Update Status Reservasi</h3>

            <div class="space-y-3">

                @php
                $statuses = [
                    [
                        'value' => 'pending',
                        'label' => 'Menunggu Konfirmasi',
                        'dot'   => 'bg-yellow-500',
                        'aktif' => 'bg-yellow-50 border-yellow-400 text-yellow-700',
                        'btn'   => 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200',
                    ],
                    [
                        'value' => 'confirmed',
                        'label' => 'Konfirmasi Diterima',
                        'dot'   => 'bg-blue-500',
                        'aktif' => 'bg-blue-50 border-blue-400 text-blue-700',
                        'btn'   => 'bg-blue-100 text-blue-700 hover:bg-blue-200',
                    ],
                    [
                        'value' => 'checked_in',
                        'label' => 'Check In',
                        'dot'   => 'bg-green-500',
                        'aktif' => 'bg-green-50 border-green-400 text-green-700',
                        'btn'   => 'bg-green-100 text-green-700 hover:bg-green-200',
                    ],
                    [
                        'value' => 'checked_out',
                        'label' => 'Check Out',
                        'dot'   => 'bg-gray-400',
                        'aktif' => 'bg-gray-100 border-gray-400 text-gray-600',
                        'btn'   => 'bg-gray-100 text-gray-600 hover:bg-gray-200',
                    ],
                    [
                        'value' => 'cancelled',
                        'label' => 'Batalkan Reservasi',
                        'dot'   => 'bg-red-500',
                        'aktif' => 'bg-red-50 border-red-400 text-red-700',
                        'btn'   => 'bg-red-100 text-red-700 hover:bg-red-200',
                    ],
                ];
                @endphp

                @foreach($statuses as $s)
                @if($reservation->status === $s['value'])
                {{-- Status aktif saat ini --}}
                <div class="flex items-center gap-3 px-4 py-3 rounded-lg border-2 {{ $s['aktif'] }}">
                    <span class="w-2.5 h-2.5 rounded-full {{ $s['dot'] }}"></span>
                    <span class="text-sm font-semibold flex-1">{{ $s['label'] }}</span>
                    <span class="text-xs font-medium">✓ Saat ini</span>
                </div>
                @else
                {{-- Tombol ganti status --}}
                <form action="{{ route('admin.reservasi.status', $reservation->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="{{ $s['value'] }}">
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg border border-gray-200 text-left transition {{ $s['btn'] }}">
                        <span class="w-2.5 h-2.5 rounded-full {{ $s['dot'] }}"></span>
                        <span class="text-sm font-medium flex-1">{{ $s['label'] }}</span>
                        <span class="text-xs">Pilih →</span>
                    </button>
                </form>
                @endif
                @endforeach

            </div>
        </div>

        {{-- Info cepat --}}
        <div class="bg-gray-50 rounded-xl border border-gray-200 p-5 text-xs text-gray-500 space-y-2">
            <p class="font-semibold text-gray-600 mb-2">Panduan Status:</p>
            <p>🟡 <strong>Menunggu</strong> — Baru masuk, belum diproses</p>
            <p>🔵 <strong>Dikonfirmasi</strong> — Kamar dipesan, siap check-in</p>
            <p>🟢 <strong>Check In</strong> — Tamu sedang menginap</p>
            <p>⚫ <strong>Check Out</strong> — Tamu telah selesai menginap</p>
            <p>🔴 <strong>Dibatalkan</strong> — Reservasi dibatalkan</p>
        </div>

    </div>
</div>

@endsection