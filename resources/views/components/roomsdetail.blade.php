{{-- ROOM DETAIL PAGE — Fully dinamis dari model Rooms --}}
<main>

    {{-- HERO BANNER dengan gambar kamar --}}
    <section class="relative h-80 flex items-center justify-center overflow-hidden">
        @if($room->gambar)
            <img src="/{{ ltrim($room->gambar, '/') }}"
                 class="absolute inset-0 w-full h-full object-cover"
                 alt="{{ $room->nama }}">
        @else
            <div class="absolute inset-0 bg-gray-800"></div>
        @endif
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white z-10 px-4">
            <p class="tracking-widest text-sm text-yellow-400 mb-2 uppercase">{{ $room->tipe }}</p>
            <h1 class="text-4xl font-semibold tracking-wide">{{ strtoupper($room->nama) }}</h1>
            <div class="mt-4 w-14 h-0.5 bg-yellow-500 mx-auto"></div>
        </div>
    </section>

    {{-- BREADCRUMB --}}
    <div class="bg-white px-16 py-4 border-b text-sm text-gray-500 flex items-center gap-1">
        <a href="{{ route('home') }}" class="hover:text-yellow-600 transition">Home</a>
        <span class="mx-1 text-gray-300">/</span>
        <a href="{{ route('rooms') }}" class="hover:text-yellow-600 transition">Rooms</a>
        <span class="mx-1 text-gray-300">/</span>
        <span class="text-yellow-600 font-medium">{{ $room->nama }}</span>
    </div>

    {{-- CONTENT --}}
    <section class="bg-gray-50 py-14 px-6 md:px-16">
        <div class="max-w-5xl mx-auto">
            <div class="grid md:grid-cols-3 gap-10">

                {{-- ════ KOLOM KIRI (2/3) ════ --}}
                <div class="md:col-span-2 flex flex-col gap-8">

                    {{-- DESKRIPSI --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-7">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">Deskripsi Kamar</h2>
                        <div class="w-8 h-0.5 bg-yellow-500 mb-4"></div>
                        <p class="text-gray-500 leading-relaxed text-sm">
                            {{ $room->deskripsi ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>

                    {{-- SPESIFIKASI --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-7">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">Spesifikasi</h2>
                        <div class="w-8 h-0.5 bg-yellow-500 mb-5"></div>
                        <div class="grid grid-cols-2 gap-4">

                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <div class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full shrink-0">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Kapasitas</p>
                                    <p class="text-sm font-medium text-gray-700 mt-0.5">{{ $room->kapasitas ?? 2 }} Tamu</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <div class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full shrink-0">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Pemandangan</p>
                                    <p class="text-sm font-medium text-gray-700 mt-0.5">{{ $room->pemandangan ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <div class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full shrink-0">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Ukuran</p>
                                    <p class="text-sm font-medium text-gray-700 mt-0.5">{{ $room->ukuran ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                <div class="w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full shrink-0">
                                    <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M3 14h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wide">Tipe Bed</p>
                                    <p class="text-sm font-medium text-gray-700 mt-0.5">{{ $room->tipe_bed ?? '-' }}</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- FASILITAS --}}
                    @php
                        $fasilitas = is_array($room->fasilitas)
                            ? $room->fasilitas
                            : json_decode($room->fasilitas ?? '[]', true);
                    @endphp
                    @if(!empty($fasilitas))
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-7">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">Fasilitas</h2>
                        <div class="w-8 h-0.5 bg-yellow-500 mb-5"></div>
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($fasilitas as $f)
                            <div class="flex items-center gap-2.5">
                                <div class="w-5 h-5 flex items-center justify-center bg-yellow-100 rounded-full shrink-0">
                                    <svg class="w-3 h-3 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-600">{{ $f }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                {{-- ════ KOLOM KANAN — BOOKING CARD (1/3) ════ --}}
                <div>
                    <div class="bg-white rounded-xl border border-gray-100 shadow-md p-6 sticky top-6">

                        {{-- HARGA --}}
                        <div class="text-center mb-5 pb-5 border-b border-gray-100">
                            <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Harga per malam</p>
                            <p class="text-3xl font-semibold text-yellow-600">
                                Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">Sudah termasuk pajak & sarapan</p>
                        </div>

                        {{-- RINGKASAN SPEK --}}
                        <div class="flex flex-col gap-2.5 mb-6 text-sm">
                            <div class="flex justify-between text-gray-500">
                                <span class="text-xs">Tipe kamar</span>
                                <span class="text-xs font-medium text-gray-700">{{ $room->tipe }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span class="text-xs">Kapasitas</span>
                                <span class="text-xs font-medium text-gray-700">{{ $room->kapasitas ?? 2 }} tamu</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span class="text-xs">Ukuran</span>
                                <span class="text-xs font-medium text-gray-700">{{ $room->ukuran ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span class="text-xs">Bed</span>
                                <span class="text-xs font-medium text-gray-700">{{ $room->tipe_bed ?? '-' }}</span>
                            </div>
                        </div>

                        {{-- TOMBOL --}}
                        <a href="{{ route('booking') }}?room={{ urlencode($room->nama) }}"
                           class="block w-full bg-yellow-600 text-white text-center py-3 rounded text-sm font-medium hover:bg-yellow-700 transition tracking-wider mb-3">
                            BOOK NOW
                        </a>
                        <a href="{{ route('rooms') }}"
                           class="block w-full border border-gray-300 text-gray-500 text-center py-2.5 rounded text-xs hover:border-yellow-500 hover:text-yellow-600 transition">
                            ← Kembali ke Rooms
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>
