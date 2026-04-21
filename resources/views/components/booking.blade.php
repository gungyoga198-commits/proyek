{{-- BOOKING PAGE - PILIH KAMAR & TANGGAL --}}
<main>

    {{-- HERO BANNER --}}
    <section class="relative h-72 flex items-center justify-center overflow-hidden">
        <img src="/images/OGAG.jpg" class="absolute inset-0 w-full h-full object-cover" alt="Booking Banner">
        <div class="absolute inset-0 bg-black/55"></div>
        <div class="relative text-center text-white z-10">
            <p class="tracking-widest text-sm text-yellow-400 mb-2">RESERVASI</p>
            <h1 class="text-4xl font-semibold">BOOK YOUR STAY</h1>
            <div class="mt-4 w-16 h-0.5 bg-yellow-500 mx-auto"></div>
            <p class="mt-4 text-gray-300 text-sm">Pilih kamar dan tanggal menginap Anda</p>
        </div>
    </section>

    {{-- BREADCRUMB --}}
    <div class="bg-white px-16 py-4 border-b text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-yellow-600 transition">Home</a>
        <span class="mx-2">/</span>
        <span class="text-yellow-600 font-medium">Booking</span>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-10 py-3 mt-4 mx-10 rounded text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- FORM PENCARIAN TANGGAL --}}
    <section class="bg-white shadow-md py-6 px-10">
        <form action="{{ route('booking') }}" method="GET">
            <div class="max-w-5xl mx-auto">
                <p class="text-xs tracking-widest text-gray-400 mb-3 uppercase">Cari Ketersediaan Kamar</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">Check-In</label>
                        <input type="date" name="checkin"
                            value="{{ $checkin ?? '' }}"
                            min="{{ date('Y-m-d') }}"
                            class="w-full border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-500">
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">Check-Out</label>
                        <input type="date" name="checkout"
                            value="{{ $checkout ?? '' }}"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                            class="w-full border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-500">
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">Jumlah Tamu</label>
                        <select name="guests" class="w-full border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-500">
                            @for($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ ($guests ?? 1) == $i ? 'selected' : '' }}>{{ $i }} Tamu</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-yellow-600 text-white py-2 px-4 text-sm hover:bg-yellow-700 transition rounded">
                            CARI KAMAR
                        </button>
                    </div>
                </div>

                {{-- Info malam jika tanggal sudah dipilih --}}
                @if($checkin && $checkout)
                @php $nights = \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)); @endphp
                @if($nights > 0)
                <div class="mt-3 text-xs text-green-600 font-medium">
                    🌙 Durasi menginap: {{ $nights }} malam
                </div>
                @endif
                @endif
            </div>
        </form>
    </section>

    {{-- ROOM CARDS --}}
    <section class="bg-gray-50 py-16 px-10">
        <div class="max-w-6xl mx-auto">

            <div class="text-center mb-12">
                <p class="text-xs tracking-widest text-gray-400 uppercase mb-1">Pilihan Kamar</p>
                <h2 class="text-2xl font-semibold">KAMAR TERSEDIA</h2>
                <div class="mt-3 w-12 h-0.5 bg-yellow-500 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($rooms as $room)
                @php
                    $isSelected = ($selected ?? '') === $room['name'];
                    $nights = ($checkin && $checkout) ? max(1, \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout))) : 1;
                @endphp

                <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-xl transition-all duration-300 group
                    {{ $isSelected ? 'ring-2 ring-yellow-500' : 'border border-transparent' }}">

                    <div class="relative overflow-hidden">
                        <img src="{{ $room['image'] }}"
                             class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                             alt="{{ $room['name'] }}">
                        <div class="absolute top-3 left-3 bg-yellow-600 text-white text-xs px-3 py-1 tracking-widest">
                            {{ $room['type'] }}
                        </div>
                        @if($isSelected)
                        <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-3 py-1 rounded-full">
                            ✓ Dipilih
                        </div>
                        @endif
                    </div>

                    <div class="p-5 text-sm">
                        <p class="font-semibold text-lg">{{ $room['name'] }}</p>
                        <p class="text-gray-400 mb-3 text-xs tracking-wide">{{ $room['location'] }}</p>
                        <p class="text-gray-600 mb-4 leading-relaxed text-xs">{{ $room['description'] }}</p>

                        <div class="grid grid-cols-2 text-gray-500 text-xs gap-y-2 mb-4">
                            <span>👤 {{ $room['capacity'] }}</span>
                            <span>🌿 {{ $room['view'] }}</span>
                            <span>📐 {{ $room['size'] }}</span>
                            <span>🛏 {{ $room['bed'] }}</span>
                        </div>

                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach($room['facilities'] as $f)
                            <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded">{{ $f }}</span>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400">Mulai dari</p>
                                <p class="text-yellow-600 font-semibold text-base">
                                    Rp {{ number_format($room['price'], 0, ',', '.') }}
                                    <span class="text-xs text-gray-400 font-normal">/ malam</span>
                                </p>
                                @if($checkin && $checkout && $nights > 0)
                                <p class="text-xs text-green-600 mt-0.5">
                                    Total: Rp {{ number_format($room['price'] * $nights, 0, ',', '.') }}
                                </p>
                                @endif
                            </div>

                            {{-- Tombol pilih kamar via form GET --}}
                            <form action="{{ route('booking') }}" method="GET">
                                <input type="hidden" name="room"     value="{{ $room['name'] }}">
                                <input type="hidden" name="checkin"  value="{{ $checkin ?? '' }}">
                                <input type="hidden" name="checkout" value="{{ $checkout ?? '' }}">
                                <input type="hidden" name="guests"   value="{{ $guests ?? 1 }}">
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

            {{-- Panel lanjutkan - muncul kalau kamar sudah dipilih --}}
            @if($selected && $checkin && $checkout)
            @php
                $selectedRoom = collect($rooms)->firstWhere('name', $selected);
                $nights = max(1, \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)));
            @endphp
            <div class="mt-10 text-center">
                <div class="bg-white border border-yellow-200 rounded-lg p-6 max-w-lg mx-auto shadow-md">
                    <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Kamar Dipilih</p>
                    <p class="font-semibold text-xl mb-1 text-gray-800">{{ $selected }}</p>
                    <p class="text-yellow-600 text-sm mb-5">
                        Rp {{ number_format($selectedRoom['price'], 0, ',', '.') }}
                        × {{ $nights }} malam =
                        <strong>Rp {{ number_format($selectedRoom['price'] * $nights, 0, ',', '.') }}</strong>
                    </p>
                    <a href="{{ route('booking.form') }}?room={{ urlencode($selected) }}&checkin={{ $checkin }}&checkout={{ $checkout }}&guests={{ $guests ?? 1 }}"
                        class="block w-full bg-yellow-600 text-white py-3 text-sm hover:bg-yellow-700 transition rounded tracking-wide text-center">
                        LANJUTKAN KE FORMULIR RESERVASI →
                    </a>
                </div>
            </div>
            @elseif($selected && (!$checkin || !$checkout))
            <div class="mt-10 text-center">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-5 max-w-lg mx-auto">
                    <p class="text-sm text-yellow-700">⚠️ Silakan isi tanggal <strong>Check-In</strong> dan <strong>Check-Out</strong> terlebih dahulu.</p>
                </div>
            </div>
            @endif

        </div>
    </section>

</main>