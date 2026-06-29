@extends('admin.layout')
@section('title', 'Status Kamar')
@section('subtitle', 'Ketersediaan kamar secara realtime')

@section('content')

{{-- Header + Tombol ke Kelola Kamar --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Status kamar berdasarkan reservasi aktif (confirmed / check-in)</p>
    </div>
    @can('create', \App\Models\Rooms::class)
    <a href="{{ route('admin.rooms.index') }}"
        class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7l7-7h9a2 2 0 012 2v17z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 2v6h6"/>
        </svg>
        Kelola Data Kamar
    </a>
    @endcan
</div>

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

{{-- Kamar Cards — data dari DB via $kamarStatus['room'] --}}
@if(count($kamarStatus) === 0)
<div class="bg-white rounded-2xl border border-gray-100 p-12 text-center text-gray-400 text-sm">
    Belum ada kamar terdaftar. <a href="{{ route('admin.rooms.create') }}" class="text-yellow-600 hover:underline">Tambah kamar sekarang →</a>
</div>
@else
<div class="grid md:grid-cols-3 gap-6">
    @foreach($kamarStatus as $nama => $status)
    @php
        /** @var \App\Models\Rooms $room */
        $room      = $status['room'];
        $fasilitas = is_array($room->fasilitas) ? $room->fasilitas : json_decode($room->fasilitas ?? '[]', true);
    @endphp

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden
        {{ $status['tersedia'] ? 'border-green-200' : 'border-red-200' }}">

        {{-- Gambar + Badge --}}
        <div class="relative">
            @if($room->gambar)
                <img src="/{{ ltrim($room->gambar, '/') }}" class="w-full h-48 object-cover" alt="{{ $nama }}">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

            {{-- Badge tipe --}}
            <div class="absolute top-3 left-3 bg-yellow-500 text-gray-900 text-xs px-3 py-1 font-semibold tracking-widest rounded-sm">
                {{ strtoupper($room->tipe) }}
            </div>

            {{-- Badge status tersedia/terisi --}}
            <div class="absolute top-3 right-3 flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                {{ $status['tersedia'] ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                <span class="w-1.5 h-1.5 rounded-full bg-white {{ $status['tersedia'] ? '' : 'animate-pulse' }}"></span>
                {{ $status['tersedia'] ? 'TERSEDIA' : 'TERISI' }}
            </div>

            {{-- Badge aktif/nonaktif --}}
            @if(!$room->is_active)
            <div class="absolute bottom-12 left-3 bg-gray-800/80 text-white text-xs px-2 py-0.5 rounded">
                Nonaktif
            </div>
            @endif

            <div class="absolute bottom-3 left-4">
                <p class="text-white font-semibold text-lg leading-none">{{ $nama }}</p>
                <p class="text-gray-300 text-xs mt-0.5">{{ $room->pemandangan ?? '' }}</p>
            </div>
        </div>

        {{-- Info dari DB --}}
        <div class="p-5">
            <div class="grid grid-cols-2 text-xs text-gray-500 gap-y-1.5 mb-4">
                <span>👤 {{ $room->kapasitas }} Orang</span>
                <span>📐 {{ $room->ukuran ?? '-' }}</span>
                <span>🛏 {{ $room->tipe_bed ?? '-' }}</span>
                <span>💰 Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}</span>
            </div>

            <div class="flex flex-wrap gap-1 mb-4">
                @foreach(array_slice($fasilitas, 0, 5) as $f)
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
                        <span class="text-gray-400">Tipe Bayar</span>
                        <span class="font-semibold {{ ($r->tipe_pembayaran ?? 'lunas') === 'dp' ? 'text-blue-600' : 'text-green-600' }}">
                            {{ ($r->tipe_pembayaran ?? 'lunas') === 'dp' ? 'DP 50%' : 'Lunas' }}
                        </span>
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
                    Lihat Detail Reservasi →
                </a>
            </div>
            @else
            <div class="bg-green-50 border border-green-100 rounded-xl p-4 text-center">
                <p class="text-green-600 font-semibold text-sm">✓ Kamar Tersedia</p>
                <p class="text-green-500 text-xs mt-0.5">Siap untuk di-booking</p>
                <div class="mt-2 flex gap-2">
                    <a href="{{ route('admin.reservasi', ['search' => $nama]) }}"
                       class="flex-1 text-center text-xs bg-green-500 text-white py-1.5 rounded-lg hover:bg-green-600 transition">
                        Riwayat
                    </a>
                    @can('update', $room)
                    <a href="{{ route('admin.rooms.edit', $room->id) }}"
                       class="flex-1 text-center text-xs bg-white border border-gray-200 text-gray-600 py-1.5 rounded-lg hover:bg-gray-50 transition">
                        Edit Kamar
                    </a>
                    @endcan
                </div>
            </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endif

{{-- Ringkasan + link ke CRUD rooms --}}
<div class="mt-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-gray-700">Ringkasan</h3>
        <a href="{{ route('admin.rooms.index') }}" class="text-xs text-yellow-600 hover:underline">
            Kelola semua kamar →
        </a>
    </div>
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