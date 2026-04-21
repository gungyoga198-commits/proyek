@extends('admin.layout')
@section('title', 'Laporan Reservasi')
@section('subtitle', 'Riwayat dan statistik reservasi hotel')

@section('content')

{{-- Filter --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <form action="{{ route('admin.laporan') }}" method="GET" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">Dari Tanggal</label>
            <input type="date" name="dari" value="{{ request('dari') }}"
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">Sampai Tanggal</label>
            <input type="date" name="sampai" value="{{ request('sampai') }}"
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">Status</label>
            <select name="status" class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100">
                <option value="">Semua Status</option>
                <option value="pending"     {{ request('status')=='pending'     ? 'selected':'' }}>Menunggu</option>
                <option value="confirmed"   {{ request('status')=='confirmed'   ? 'selected':'' }}>Dikonfirmasi</option>
                <option value="checked_in"  {{ request('status')=='checked_in'  ? 'selected':'' }}>Menginap</option>
                <option value="checked_out" {{ request('status')=='checked_out' ? 'selected':'' }}>Selesai</option>
                <option value="cancelled"   {{ request('status')=='cancelled'   ? 'selected':'' }}>Dibatalkan</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="bg-yellow-500 text-gray-900 font-semibold px-5 py-2.5 rounded-xl text-sm hover:bg-yellow-400 transition shadow-sm">
                Terapkan
            </button>
            <a href="{{ route('admin.laporan') }}" class="bg-gray-100 text-gray-600 px-5 py-2.5 rounded-xl text-sm hover:bg-gray-200 transition">
                Reset
            </a>
        </div>

        {{-- Tombol Download PDF --}}
        <div class="ml-auto">
            <a href="{{ route('admin.laporan.pdf', request()->query()) }}"
               class="flex items-center gap-2 bg-gray-900 text-white px-5 py-2.5 rounded-xl text-sm hover:bg-gray-700 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Download PDF
            </a>
        </div>
    </form>
</div>

{{-- Statistik --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Total</p>
            <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-gray-800">{{ $reservations->count() }}</p>
        <p class="text-xs text-gray-400 mt-1">Reservasi</p>
    </div>
    <div class="bg-white rounded-2xl border border-green-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-green-400 uppercase tracking-wide">Pendapatan</p>
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalPendapatan/1000000,1) }}jt</p>
        <p class="text-xs text-gray-400 mt-1">Terkonfirmasi & selesai</p>
    </div>
    <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-blue-400 uppercase tracking-wide">Rata-rata</p>
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-blue-600">
            Rp {{ $reservations->count() > 0 ? number_format($totalPendapatan/$reservations->count()/1000,0).'rb' : '0' }}
        </p>
        <p class="text-xs text-gray-400 mt-1">Per reservasi</p>
    </div>
    <div class="bg-white rounded-2xl border border-red-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-2">
            <p class="text-xs font-semibold text-red-400 uppercase tracking-wide">Dibatalkan</p>
            <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-red-500">{{ $reservations->where('status','cancelled')->count() }}</p>
        <p class="text-xs text-gray-400 mt-1">Reservasi batal</p>
    </div>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-gray-700">Riwayat Reservasi</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ $reservations->count() }} data ditemukan</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                <tr>
                    <th class="px-5 py-3 text-left">Kode</th>
                    <th class="px-5 py-3 text-left">Nama Tamu</th>
                    <th class="px-5 py-3 text-left">Kamar</th>
                    <th class="px-5 py-3 text-left">Check-in</th>
                    <th class="px-5 py-3 text-left">Check-out</th>
                    <th class="px-5 py-3 text-left">Malam</th>
                    <th class="px-5 py-3 text-left">Total</th>
                    <th class="px-5 py-3 text-left">Pembayaran</th>
                    <th class="px-5 py-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($reservations as $r)
                @php
                    $badge = match($r->status) {
                        'pending'     => 'bg-yellow-100 text-yellow-700',
                        'confirmed'   => 'bg-blue-100 text-blue-700',
                        'checked_in'  => 'bg-green-100 text-green-700',
                        'checked_out' => 'bg-gray-100 text-gray-500',
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
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-5 py-4 font-mono text-xs text-yellow-600 font-semibold">{{ $r->kode_booking }}</td>
                    <td class="px-5 py-4">
                        <p class="font-medium text-gray-800">{{ $r->nama_lengkap }}</p>
                        <p class="text-xs text-gray-400">{{ $r->email }}</p>
                    </td>
                    <td class="px-5 py-4 text-gray-600 text-xs">{{ $r->jenis_kamar }}</td>
                    <td class="px-5 py-4 text-gray-600 text-xs whitespace-nowrap">{{ $r->check_in->format('d M Y') }}</td>
                    <td class="px-5 py-4 text-gray-600 text-xs whitespace-nowrap">{{ $r->check_out->format('d M Y') }}</td>
                    <td class="px-5 py-4 text-center text-gray-600">{{ $r->jumlah_malam }}</td>
                    <td class="px-5 py-4 font-semibold text-gray-700 whitespace-nowrap">Rp {{ number_format($r->total_harga,0,',','.') }}</td>
                    <td class="px-5 py-4 text-gray-500 text-xs capitalize">{{ str_replace('_',' ',$r->metode_pembayaran) }}</td>
                    <td class="px-5 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $badge }}">{{ $label }}</span></td>
                </tr>
                @empty
                <tr><td colspan="9" class="px-6 py-12 text-center text-gray-400">Tidak ada data untuk filter ini.</td></tr>
                @endforelse
            </tbody>
            @if($reservations->count() > 0)
            <tfoot class="border-t-2 border-gray-200 bg-gray-50">
                <tr>
                    <td colspan="6" class="px-5 py-4 text-sm font-bold text-gray-700 text-right">Total Pendapatan:</td>
                    <td colspan="3" class="px-5 py-4 text-sm font-bold text-green-600">Rp {{ number_format($totalPendapatan,0,',','.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

@endsection