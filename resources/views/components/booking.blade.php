{{-- BOOKING PAGE - DESAIN A: Search bar full-width + empty state --}}
<main>

    <x-page-banner
        image="/images/OGAG.jpg"
        eyebrow="RESERVASI"
        title="BOOK YOUR STAY"
        subtitle="Pilih kamar dan tanggal menginap Anda"
    />

    <x-breadcrumb :links="[
        ['label' => 'Booking'],
    ]" />

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-10 py-3 mt-4 mx-10 rounded text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- ── FORM PENCARIAN ── --}}
    <section class="bg-white py-10 px-6 shadow-sm">
        <form action="{{ route('booking') }}" method="GET">
            <div class="max-w-5xl mx-auto">

                <p class="text-xs tracking-widest text-gray-400 uppercase mb-5">Cari Ketersediaan Kamar</p>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

                    {{-- Check-In --}}
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">Check-In</label>
                        <input type="date" name="checkin"
                            value="{{ $checkin ?? '' }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500 transition">
                    </div>

                    {{-- Check-Out --}}
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">Check-Out</label>
                        <input type="date" name="checkout"
                            value="{{ $checkout ?? '' }}"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500 transition">
                    </div>

                    {{-- Jumlah Tamu --}}
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">
                            Jumlah Tamu <span class="normal-case text-gray-400">(maks. 6)</span>
                        </label>
                        <input type="hidden" name="guests" id="guestsInput" value="{{ $guests ?? 1 }}">
                        <div class="flex items-center border border-gray-200 rounded overflow-hidden">
                            <button type="button" onclick="changeGuests(-1)"
                                class="px-4 py-2.5 text-gray-500 hover:bg-gray-100 transition text-base font-medium select-none">−</button>
                            <span id="guestsDisplay"
                                class="flex-1 text-center text-sm text-gray-700 font-medium">
                                {{ $guests ?? 1 }} Tamu
                            </span>
                            <button type="button" onclick="changeGuests(1)"
                                class="px-4 py-2.5 text-gray-500 hover:bg-gray-100 transition text-base font-medium select-none">+</button>
                        </div>
                    </div>

                    {{-- Tombol Cari --}}
                    <div>
                        <button type="submit"
                            class="w-full bg-yellow-600 hover:bg-yellow-700 transition text-white py-2.5 px-4 text-sm rounded tracking-widest font-medium">
                            CARI KAMAR
                        </button>
                    </div>

                </div>

                {{-- Info durasi malam --}}
                @if($checkin && $checkout)
                    @php $nights = \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)); @endphp
                    @if($nights > 0)
                        <div class="mt-4 text-xs text-green-600 font-medium">
                            🌙 Durasi menginap: {{ $nights }} malam
                        </div>
                    @endif
                @endif

            </div>
        </form>
    </section>

    {{-- ── AREA KAMAR ── --}}
    <section class="bg-gray-50 py-16 px-6">
        <div class="max-w-6xl mx-auto">

            @if(!$checkin || !$checkout)

                {{-- EMPTY STATE --}}
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="w-20 h-20 rounded-full bg-yellow-50 flex items-center justify-center mb-6">
                        <svg class="w-9 h-9 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                    </div>
                    <p class="text-xs tracking-widest text-gray-400 uppercase mb-2">Langkah 1</p>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Isi tanggal menginap Anda</h3>
                    <p class="text-sm text-gray-400 max-w-sm leading-relaxed">
                        Pilih tanggal <strong>Check-In</strong> dan <strong>Check-Out</strong>, tentukan jumlah tamu,
                        lalu tekan <span class="text-yellow-600 font-medium">Cari Kamar</span> untuk melihat ketersediaan.
                    </p>
                    <div class="mt-8 w-10 h-0.5 bg-yellow-400 mx-auto"></div>
                </div>

            @else

                {{-- HEADER --}}
                <div class="text-center mb-12">
                    <p class="text-xs tracking-widest text-gray-400 uppercase mb-1">Pilihan Kamar</p>
                    <h2 class="text-2xl font-semibold">KAMAR TERSEDIA</h2>
                    <div class="mt-3 w-12 h-0.5 bg-yellow-500 mx-auto"></div>
                    @php $nights = max(1, \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout))); @endphp
                    <p class="mt-3 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($checkin)->format('d M Y') }}
                        &rarr;
                        {{ \Carbon\Carbon::parse($checkout)->format('d M Y') }}
                        &nbsp;·&nbsp; {{ $nights }} malam &nbsp;·&nbsp; {{ $guests }} tamu
                    </p>
                </div>

                {{-- GRID KAMAR --}}
                @if(count($rooms) === 0)
                    <div class="text-center py-16 text-gray-400 text-sm">
                        Tidak ada kamar tersedia untuk tanggal yang dipilih.
                    </div>
                @else
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($rooms as $room)
                    @php
                        $isSelected = ($selected ?? '') === $room->nama;
                        $nights     = max(1, \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)));
                        $fasilitas  = is_array($room->fasilitas) ? $room->fasilitas : json_decode($room->fasilitas ?? '[]', true);
                    @endphp

                    <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-xl transition-all duration-300 group
                        {{ $isSelected ? 'ring-2 ring-yellow-500' : 'border border-transparent' }}">

                        <div class="relative overflow-hidden">
                            <img src="{{ $room->gambar ? asset('storage/' . $room->gambar) : '/images/OGAG.jpg' }}"
                                 class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                                 alt="{{ $room->nama }}">
                            <div class="absolute top-3 left-3 bg-yellow-600 text-white text-xs px-3 py-1 tracking-widest">
                                {{ $room->tipe }}
                            </div>
                            @if($isSelected)
                            <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-3 py-1 rounded-full">
                                ✓ Dipilih
                            </div>
                            @endif
                        </div>

                        <div class="p-5 text-sm">
                            <p class="font-semibold text-lg">{{ $room->nama }}</p>
                            <p class="text-gray-400 mb-3 text-xs tracking-wide">{{ $room->pemandangan }}</p>
                            <p class="text-gray-600 mb-4 leading-relaxed text-xs">{{ $room->deskripsi }}</p>

                            <div class="grid grid-cols-2 text-gray-500 text-xs gap-y-2 mb-4">
                                <span>👤 {{ $room->kapasitas }} Tamu</span>
                                <span>🌿 {{ $room->pemandangan }}</span>
                                <span>📐 {{ $room->ukuran }}</span>
                                <span>🛏 {{ $room->tipe_bed }}</span>
                            </div>

                            <div class="flex flex-wrap gap-1 mb-4">
                                @foreach($fasilitas as $f)
                                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded">{{ $f }}</span>
                                @endforeach
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400">Mulai dari</p>
                                    <p class="text-yellow-600 font-semibold text-base">
                                        Rp {{ number_format($room->harga_per_malam, 0, ',', '.') }}
                                        <span class="text-xs text-gray-400 font-normal">/ malam</span>
                                    </p>
                                    <p class="text-xs text-green-600 mt-0.5">
                                        Total: Rp {{ number_format($room->harga_per_malam * $nights, 0, ',', '.') }}
                                    </p>
                                </div>

                                <form action="{{ route('booking') }}" method="GET">
                                    <input type="hidden" name="room"     value="{{ $room->nama }}">
                                    <input type="hidden" name="checkin"  value="{{ $checkin }}">
                                    <input type="hidden" name="checkout" value="{{ $checkout }}">
                                    <input type="hidden" name="guests"   value="{{ $guests }}">
                                    <button type="submit"
                                        class="px-4 py-2 text-xs transition
                                        {{ $isSelected
                                            ? 'bg-green-500 text-white cursor-default'
                                            : 'bg-yellow-600 text-white hover:bg-yellow-700' }}">
                                        {{ $isSelected ? '✓ DIPILIH' : 'PILIH KAMAR' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Panel lanjutkan --}}
                @if($selected && $checkin && $checkout)
                @php
                    $selectedRoom = $rooms->firstWhere('nama', $selected);
                    $nights       = max(1, \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)));
                @endphp
                @if($selectedRoom)
                <div class="mt-10 text-center">
                    <div class="bg-white border border-yellow-200 rounded-lg p-6 max-w-lg mx-auto shadow-md">
                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Kamar Dipilih</p>
                        <p class="font-semibold text-xl mb-1 text-gray-800">{{ $selected }}</p>
                        <p class="text-yellow-600 text-sm mb-5">
                            Rp {{ number_format($selectedRoom->harga_per_malam, 0, ',', '.') }}
                            × {{ $nights }} malam =
                            <strong>Rp {{ number_format($selectedRoom->harga_per_malam * $nights, 0, ',', '.') }}</strong>
                        </p>
                        <a href="{{ route('booking.form') }}?room={{ urlencode($selected) }}&checkin={{ $checkin }}&checkout={{ $checkout }}&guests={{ $guests }}"
                            class="block w-full bg-yellow-600 text-white py-3 text-sm hover:bg-yellow-700 transition rounded tracking-wide text-center">
                            LANJUTKAN KE FORMULIR RESERVASI →
                        </a>
                    </div>
                </div>
                @endif
                @endif

            @endif

        </div>
    </section>

</main>

<script>
    function changeGuests(delta) {
        const input   = document.getElementById('guestsInput');
        const display = document.getElementById('guestsDisplay');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > 6) val = 6;
        input.value   = val;
        display.textContent = val + ' Tamu';
    }
</script>