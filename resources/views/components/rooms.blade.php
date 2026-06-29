{{-- ROOMS PAGE — Layout horizontal, gambar kiri detail kanan --}}
<main>

    {{-- HERO BANNER --}}
    <section class="relative h-80 flex items-center justify-center overflow-hidden">
        <img src="/images/OGAG.jpg" class="absolute inset-0 w-full h-full object-cover" alt="Rooms Banner">
        <div class="absolute inset-0 bg-black/55"></div>
        <div class="relative text-center text-white z-10 px-4">
            <p class="tracking-widest text-sm text-yellow-400 mb-3 uppercase">Explore</p>
            <h1 class="text-4xl font-semibold tracking-wide">OUR ROOMS</h1>
            <div class="mt-4 w-14 h-0.5 bg-yellow-500 mx-auto"></div>
            <p class="mt-4 text-gray-300 text-sm">Temukan kenyamanan dan kemewahan di setiap kamar kami</p>
        </div>
    </section>

    {{-- BREADCRUMB --}}
    <div class="bg-white px-16 py-4 border-b text-sm text-gray-500 flex items-center gap-1">
        <a href="{{ route('home') }}" class="hover:text-yellow-600 transition">Home</a>
        <span class="mx-1 text-gray-300">/</span>
        <span class="text-yellow-600 font-medium">Rooms</span>
    </div>

    {{-- ROOMS SECTION --}}
    <section class="bg-gray-50 py-16 px-6 md:px-16">

        {{-- TITLE --}}
        <div class="text-center mb-12">
            <p class="text-xs tracking-widest text-gray-400 uppercase mb-1">Choose Your</p>
            <h2 class="text-3xl font-semibold">PERFECT ROOM</h2>
            <div class="mt-3 w-12 h-0.5 bg-yellow-500 mx-auto"></div>
            <p class="mt-4 text-gray-500 max-w-xl mx-auto text-sm">
                Nikmati pengalaman menginap terbaik dengan pilihan kamar yang kami sediakan khusus untuk Anda.
            </p>
        </div>

        {{-- ROOM LIST --}}
        <div class="max-w-5xl mx-auto flex flex-col gap-8">

            @forelse($rooms as $room)

            @php
                $fasilitas = is_array($room->fasilitas) ? $room->fasilitas : json_decode($room->fasilitas ?? '[]', true);
            @endphp

            <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-lg transition-shadow duration-300 group">
                <div class="grid md:grid-cols-[280px_1fr]">

                    {{-- GAMBAR KIRI --}}
                    <div class="relative overflow-hidden bg-gray-200" style="min-height: 220px;">
                        @if($room->gambar)
                            <img src="{{ asset('storage/' . $room->gambar) }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 absolute inset-0"
                                 alt="{{ $room->nama }}">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center bg-gray-200">
                                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- BADGE TIPE --}}
                        <div class="absolute top-0 left-0">
                            <span class="block bg-yellow-600 text-white text-xs font-medium px-4 py-2 tracking-widest">
                                {{ strtoupper($room->tipe) }}
                            </span>
                        </div>
                    </div>

                    {{-- DETAIL KANAN --}}
                    <div class="p-6 flex flex-col justify-between">

                        <div>
                            {{-- NAMA & SPEK --}}
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-800">{{ $room->nama }}</h3>
                                    <p class="text-xs text-gray-400 mt-0.5 tracking-wide">
                                        {{ $room->ukuran ?? '' }}{{ ($room->ukuran && $room->pemandangan) ? ' · ' : '' }}{{ $room->pemandangan ?? '' }}
                                    </p>
                                </div>
                                <div class="text-right shrink-0 ml-4">
                                    <p class="text-xs text-gray-400">per malam</p>
                                    <p class="text-xl font-semibold text-yellow-600">
                                        Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            {{-- DESKRIPSI --}}
                            <p class="text-gray-500 text-sm leading-relaxed mb-4">
                                {{ $room->deskripsi ?? '-' }}
                            </p>

                            {{-- INFO GRID --}}
                            <div class="grid grid-cols-2 gap-2 mb-4">
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <svg class="w-4 h-4 text-yellow-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                                    </svg>
                                    <span>{{ $room->kapasitas ?? 2 }} Tamu</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <svg class="w-4 h-4 text-yellow-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <span>{{ $room->pemandangan ?? '-' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <svg class="w-4 h-4 text-yellow-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                    </svg>
                                    <span>{{ $room->ukuran ?? '-' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs text-gray-500">
                                    <svg class="w-4 h-4 text-yellow-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M3 14h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                                    </svg>
                                    <span>{{ $room->tipe_bed ?? '-' }}</span>
                                </div>
                            </div>

                            {{-- FASILITAS PILLS --}}
                            <div class="flex flex-wrap gap-1.5 mb-5">
                                @foreach(array_slice($fasilitas, 0, 5) as $f)
                                <span class="bg-gray-50 border border-gray-200 text-gray-500 text-xs px-2.5 py-1 rounded-full">
                                    {{ $f }}
                                </span>
                                @endforeach
                                @if(count($fasilitas) > 5)
                                <span class="bg-gray-50 border border-gray-200 text-gray-400 text-xs px-2.5 py-1 rounded-full">
                                    +{{ count($fasilitas) - 5 }} lainnya
                                </span>
                                @endif
                            </div>
                        </div>

                        {{-- TOMBOL AKSI --}}
                        <div class="flex gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('room.detail', $room->id) }}"
                               class="flex-1 text-center border border-gray-300 text-gray-600 text-xs font-medium py-2.5 px-4 rounded hover:border-yellow-500 hover:text-yellow-600 transition">
                                Lihat Detail
                            </a>
                            <a href="{{ route('booking') }}?room={{ urlencode($room->nama) }}"
                               class="flex-1 text-center bg-yellow-600 text-white text-xs font-medium py-2.5 px-4 rounded hover:bg-yellow-700 transition tracking-wider">
                                BOOK NOW
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            @empty
            <div class="text-center py-16 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <p>Belum ada kamar tersedia.</p>
            </div>
            @endforelse

        </div>
    </section>

</main>