@extends('admin.layout')
@section('title', 'Status Kamar')
@section('subtitle', 'Ketersediaan kamar secara realtime')

@section('content')

{{-- Filter Tanggal --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <form action="{{ route('admin.kamar') }}" method="GET" class="flex items-end gap-4">
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">Cek Ketersediaan Tanggal</label>
            <input type="date" name="tanggal" value="{{ $tanggal }}"
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100">
        </div>
        <button type="submit" class="bg-yellow-500 text-gray-900 font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-yellow-400 transition shadow-sm">
            Cek Sekarang
        </button>
        <a href="{{ route('admin.kamar') }}" class="text-sm text-gray-400 hover:text-gray-600 py-2.5">Hari Ini</a>
    </form>
    <p class="text-xs text-gray-400 mt-2">
        Menampilkan status kamar untuk tanggal: <strong class="text-gray-600">{{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}</strong>
    </p>
</div>

{{-- Kamar Cards --}}
@php
$roomsInfo = [
    'Classic Terrace' => [
        'type'       => 'CLASSIC',
        'image'      => '/images/Deluxe.jpg',
        'capacity'   => '2 Orang',
        'size'       => '25 m²',
        'bed'        => 'Double Extra',
        'price'      => 850000,
        'facilities' => ['WiFi','AC','TV','Kamar Mandi','Sarapan'],
        'desc'       => 'Ground Floor · Garden View',
    ],
    'Deluxe Daybed' => [
        'type'       => 'DELUXE',
        'image'      => '/images/Family.jpg',
        'capacity'   => '3 Orang',
        'size'       => '39 m²',
        'bed'        => 'Double Extra',
        'price'      => 1200000,
        'facilities' => ['WiFi','AC','TV','Kamar Mandi','Sarapan','Balkon'],
        'desc'       => 'Upper & Ground Floor · Balcony',
    ],
    'Superior Room' => [
        'type'       => 'SUPERIOR',
        'image'      => '/images/Presidential.jpg',
        'capacity'   => '2 Orang',
        'size'       => '30 m²',
        'bed'        => 'Double/Twin Bed',
        'price'      => 1500000,
        'facilities' => ['WiFi','AC','TV','Kamar Mandi','Sarapan','Mini Bar'],
        'desc'       => '1st & 2nd Floor · Garden View',
    ],
];
@endphp

<div class="grid md:grid-cols-3 gap-6">
    @foreach($kamarStatus as $nama => $status)
    @php $info = $roomsInfo[$nama]; @endphp

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden
        {{ $status['tersedia'] ? 'border-green-200' : 'border-red-200' }}">

        {{-- Gambar + Badge --}}
        <div class="relative">
            <img src="{{ $info['image'] }}" class="w-full h-48 object-cover" alt="{{ $nama }}">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

            {{-- Badge tipe --}}
            <div class="absolute top-3 left-3 bg-yellow-500 text-gray-900 text-xs px-3 py-1 font-semibold tracking-widest rounded-sm">
                {{ $info['type'] }}
            </div>

            {{-- Badge status --}}
            <div class="absolute top-3 right-3 flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                {{ $status['tersedia'] ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-white {{ $status['tersedia'] ? '' : 'animate-pulse' }}"></span>
                {{ $status['tersedia'] ? 'TERSEDIA' : 'TERISI' }}
            </div>

            {{-- Nama kamar di atas gambar --}}
            <div class="absolute bottom-3 left-4">
                <p class="text-white font-semibold text-lg leading-none">{{ $nama }}</p>
                <p class="text-gray-300 text-xs mt-0.5">{{ $info['desc'] }}</p>
            </div>
        </div>

        {{-- Info --}}
        <div class="p-5">
            <div class="grid grid-cols-2 text-xs text-gray-500 gap-y-1.5 mb-4">
                <span>👤 {{ $info['capacity'] }}</span>
                <span>📐 {{ $info['size'] }}</span>
                <span>🛏 {{ $info['bed'] }}</span>
                <span>💰 Rp {{ number_format($info['price'],0,',','.') }}</span>
            </div>

            <div class="flex flex-wrap gap-1 mb-4">
                @foreach($info['facilities'] as $f)
                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded-full">{{ $f }}</span>
                @endforeach
            </div>

            {{-- Info tamu jika terisi --}}
            @if(!$status['tersedia'] && $status['reservasi'])
            @php $r = $status['reservasi']; @endphp
            <div class="bg-red-50 border border-red-100 rounded-xl p-4 text-sm">
                <p class="text-xs font-semibold text-red-600 uppercase tracking-wide mb-2">Ditempati Oleh:</p>
                <div class="space-y-1 text-xs text-gray-600">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tamu</span>
                        <span class="font-medium">{{ $r->nama_lengkap }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Kode</span>
                        <span class="font-mono text-yellow-600 font-semibold">{{ $r->kode_booking }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Check-in</span>
                        <span class="font-medium">{{ $r->check_in->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Check-out</span>
                        <span class="font-medium">{{ $r->check_out->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status</span>
                        <span class="font-semibold {{ $r->status === 'checked_in' ? 'text-green-600' : 'text-blue-600' }}">
                            {{ $r->status === 'checked_in' ? 'Sedang Menginap' : 'Dikonfirmasi' }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('admin.reservasi.detail', $r->id) }}"
                   class="mt-3 block text-center text-xs bg-white border border-red-200 text-red-600 py-1.5 rounded-lg hover:bg-red-50 transition">
                    Lihat Detail →
                </a>
            </div>
            @else
            <div class="bg-green-50 border border-green-100 rounded-xl p-4 text-center">
                <p class="text-green-600 font-semibold text-sm">✓ Kamar Tersedia</p>
                <p class="text-green-500 text-xs mt-0.5">Siap untuk di-booking</p>
                <a href="{{ route('admin.reservasi', ['search' => $nama]) }}"
                   class="mt-2 block text-center text-xs bg-green-500 text-white py-1.5 rounded-lg hover:bg-green-600 transition">
                    Lihat Riwayat Kamar
                </a>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>

{{-- Ringkasan --}}
<div class="mt-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h3 class="font-semibold text-gray-700 mb-4">Ringkasan Hari Ini</h3>
    <div class="grid grid-cols-3 gap-4">
        @php
            $tersedia = collect($kamarStatus)->where('tersedia', true)->count();
            $terisi   = collect($kamarStatus)->where('tersedia', false)->count();
        @endphp
        <div class="bg-green-50 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-green-600">{{ $tersedia }}</p>
            <p class="text-xs text-green-500 mt-1">Kamar Tersedia</p>
        </div>
        <div class="bg-red-50 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-red-500">{{ $terisi }}</p>
            <p class="text-xs text-red-400 mt-1">Kamar Terisi</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-gray-600">{{ count($kamarStatus) }}</p>
            <p class="text-xs text-gray-400 mt-1">Total Kamar</p>
        </div>
    </div>
</div>

@endsection