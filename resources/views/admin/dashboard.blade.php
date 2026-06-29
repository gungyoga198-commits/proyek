@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')

{{-- STAT CARDS --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <p class="text-xs text-gray-400 uppercase tracking-wide mb-1">Total Reservasi</p>
        <p class="text-3xl font-bold text-gray-800">{{ $total }}</p>
        <p class="text-xs text-gray-400 mt-1">Semua waktu</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-yellow-100 p-5">
        <p class="text-xs text-yellow-500 uppercase tracking-wide mb-1">Menunggu</p>
        <p class="text-3xl font-bold text-yellow-600">{{ $pending }}</p>
        <p class="text-xs text-gray-400 mt-1">Perlu dikonfirmasi</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-blue-100 p-5">
        <p class="text-xs text-blue-500 uppercase tracking-wide mb-1">Dikonfirmasi</p>
        <p class="text-3xl font-bold text-blue-600">{{ $confirmed }}</p>
        <p class="text-xs text-gray-400 mt-1">Siap check-in</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-green-100 p-5">
        <p class="text-xs text-green-500 uppercase tracking-wide mb-1">Menginap</p>
        <p class="text-3xl font-bold text-green-600">{{ $checkedIn }}</p>
        <p class="text-xs text-gray-400 mt-1">Sedang di hotel</p>
    </div>

</div>

{{-- PENDING ALERT --}}
@if($pending > 0)
<div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-8 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></div>
        <p class="text-sm text-yellow-700 font-medium">Ada <strong>{{ $pending }}</strong> reservasi menunggu konfirmasi Anda.</p>
    </div>
    <a href="{{ route('admin.reservasi', ['status' => 'pending']) }}"
       class="text-xs bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">
        Lihat Sekarang
    </a>
</div>
@endif

{{-- RESERVASI TERBARU --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <h2 class="font-semibold text-gray-700">Reservasi Terbaru</h2>
        <a href="{{ route('admin.reservasi') }}" class="text-xs text-yellow-600 hover:underline">Lihat Semua →</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 text-left">Kode Booking</th>
                    <th class="px-6 py-3 text-left">Nama Tamu</th>
                    <th class="px-6 py-3 text-left">Kamar</th>
                    <th class="px-6 py-3 text-left">Check-in</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($terbaru as $r)
                @php
                    $badge = match($r->status) {
                        'pending'     => 'bg-yellow-100 text-yellow-700',
                        'confirmed'   => 'bg-blue-100 text-blue-700',
                        'checked_in'  => 'bg-green-100 text-green-700',
                        'checked_out' => 'bg-gray-100 text-gray-600',
                        'cancelled'   => 'bg-red-100 text-red-700',
                        default       => 'bg-gray-100 text-gray-600',
                    };
                    $label = match($r->status) {
                        'pending'     => 'Menunggu',
                        'confirmed'   => 'Dikonfirmasi',
                        'checked_in'  => 'Menginap',
                        'checked_out' => 'Selesai',
                        'cancelled'   => 'Dibatalkan',
                        default       => $r->status,
                    };
                @endphp
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-mono text-xs text-yellow-600 font-semibold">{{ $r->kode_booking }}</td>
                    <td class="px-6 py-4 font-medium">{{ $r->nama_lengkap }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $r->jenis_kamar }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $r->check_in->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $badge }}">{{ $label }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.reservasi.detail', $r->id) }}"
                           class="text-xs text-yellow-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400 text-sm">Belum ada reservasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection