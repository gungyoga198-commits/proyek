@extends('admin.layout')
@section('title', 'Kalender Tamu')

@section('content')

{{-- NAVIGASI BULAN --}}
@php
    $namaBulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $bulanPrev = $bulan == 1 ? 12 : $bulan - 1;
    $tahunPrev = $bulan == 1 ? $tahun - 1 : $tahun;
    $bulanNext = $bulan == 12 ? 1 : $bulan + 1;
    $tahunNext = $bulan == 12 ? $tahun + 1 : $tahun;
    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    $hariPertama = date('N', mktime(0,0,0,$bulan,1,$tahun)); // 1=Senin, 7=Minggu
@endphp

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.kalender', ['bulan' => $bulanPrev, 'tahun' => $tahunPrev]) }}"
           class="bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
            ← Sebelumnya
        </a>
        <h2 class="text-xl font-bold text-gray-800">{{ $namaBulan[$bulan] }} {{ $tahun }}</h2>
        <a href="{{ route('admin.kalender', ['bulan' => $bulanNext, 'tahun' => $tahunNext]) }}"
           class="bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
            Berikutnya →
        </a>
    </div>
    <a href="{{ route('admin.kalender', ['bulan' => date('m'), 'tahun' => date('Y')]) }}"
       class="bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-700 transition">
        Hari Ini
    </a>
</div>

{{-- LEGENDA --}}
<div class="flex gap-4 mb-5 text-xs">
    <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-blue-500"></span> Check-in</span>
    <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-red-400"></span> Check-out</span>
    <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-green-500"></span> Menginap</span>
</div>

{{-- KALENDER GRID --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

    {{-- Header hari --}}
    <div class="grid grid-cols-7 border-b border-gray-100">
        @foreach(['Sen','Sel','Rab','Kam','Jum','Sab','Min'] as $hari)
        <div class="py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide
            {{ $hari === 'Min' ? 'text-red-400' : '' }}">
            {{ $hari }}
        </div>
        @endforeach
    </div>

    {{-- Grid tanggal --}}
    <div class="grid grid-cols-7">
        {{-- Offset hari pertama --}}
        @for($i = 1; $i < $hariPertama; $i++)
        <div class="border-r border-b border-gray-50 min-h-28 p-2 bg-gray-50/50"></div>
        @endfor

        {{-- Hari dalam bulan --}}
        @for($hari = 1; $hari <= $jumlahHari; $hari++)
        @php
            $tanggal    = \Carbon\Carbon::create($tahun, $bulan, $hari);
            $isToday    = $tanggal->isToday();
            $hariKe     = $tanggal->dayOfWeekIso; // 7 = Minggu
            $checkinHari  = $reservations->filter(fn($r) => $r->check_in->format('Y-m-d') === $tanggal->format('Y-m-d'));
            $checkoutHari = $reservations->filter(fn($r) => $r->check_out->format('Y-m-d') === $tanggal->format('Y-m-d'));
            $menginapHari = $reservations->filter(fn($r) =>
                $r->check_in->format('Y-m-d') < $tanggal->format('Y-m-d') &&
                $r->check_out->format('Y-m-d') > $tanggal->format('Y-m-d')
            );
        @endphp

        <div class="border-r border-b border-gray-100 min-h-28 p-2
            {{ $isToday ? 'bg-yellow-50' : '' }}
            {{ $hariKe === 7 ? 'bg-red-50/30' : '' }}">

            {{-- Nomor tanggal --}}
            <div class="flex items-center justify-between mb-1">
                <span class="text-sm font-medium {{ $isToday ? 'bg-yellow-600 text-white w-7 h-7 rounded-full flex items-center justify-center text-xs' : ($hariKe === 7 ? 'text-red-400' : 'text-gray-700') }}">
                    {{ $hari }}
                </span>
                @if($checkinHari->count() + $checkoutHari->count() + $menginapHari->count() > 0)
                <span class="text-xs text-gray-400">{{ $checkinHari->count() + $checkoutHari->count() + $menginapHari->count() }} tamu</span>
                @endif
            </div>

            {{-- Event check-in --}}
            @foreach($checkinHari as $r)
            <a href="{{ route('admin.reservasi.detail', $r->id) }}"
               class="block bg-blue-100 text-blue-700 text-xs px-1.5 py-0.5 rounded mb-0.5 truncate hover:bg-blue-200 transition"
               title="Check-in: {{ $r->nama_lengkap }}">
                🔵 {{ $r->nama_lengkap }}
            </a>
            @endforeach

            {{-- Event menginap --}}
            @foreach($menginapHari as $r)
            <a href="{{ route('admin.reservasi.detail', $r->id) }}"
               class="block bg-green-100 text-green-700 text-xs px-1.5 py-0.5 rounded mb-0.5 truncate hover:bg-green-200 transition"
               title="Menginap: {{ $r->nama_lengkap }}">
                🟢 {{ $r->nama_lengkap }}
            </a>
            @endforeach

            {{-- Event check-out --}}
            @foreach($checkoutHari as $r)
            <a href="{{ route('admin.reservasi.detail', $r->id) }}"
               class="block bg-red-100 text-red-600 text-xs px-1.5 py-0.5 rounded mb-0.5 truncate hover:bg-red-200 transition"
               title="Check-out: {{ $r->nama_lengkap }}">
                🔴 {{ $r->nama_lengkap }}
            </a>
            @endforeach

        </div>
        @endfor

        {{-- Sisa kolom --}}
        @php $sisaKolom = (7 - (($hariPertama - 1 + $jumlahHari) % 7)) % 7; @endphp
        @for($i = 0; $i < $sisaKolom; $i++)
        <div class="border-r border-b border-gray-50 min-h-28 p-2 bg-gray-50/50"></div>
        @endfor
    </div>
</div>

{{-- DAFTAR TAMU BULAN INI --}}
@if($reservations->count() > 0)
<div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-700">Tamu Terkonfirmasi — {{ $namaBulan[$bulan] }} {{ $tahun }}</h3>
        <p class="text-xs text-gray-400 mt-0.5">{{ $reservations->count() }} reservasi</p>
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
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($reservations as $r)
                @php
                    $badge = $r->status === 'confirmed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700';
                    $label = $r->status === 'confirmed' ? 'Dikonfirmasi' : 'Menginap';
                @endphp
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3 font-mono text-xs text-yellow-600 font-semibold">{{ $r->kode_booking }}</td>
                    <td class="px-5 py-3 font-medium">{{ $r->nama_lengkap }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $r->jenis_kamar }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $r->check_in->format('d M Y') }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $r->check_out->format('d M Y') }}</td>
                    <td class="px-5 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium {{ $badge }}">{{ $label }}</span></td>
                    <td class="px-5 py-3">
                        <a href="{{ route('admin.reservasi.detail', $r->id) }}" class="text-xs text-yellow-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection