{{-- CEK RESERVASI - CLIENT --}}
<main>

    {{-- HERO BANNER --}}
    <section class="relative h-72 flex items-center justify-center overflow-hidden">
        <img src="/images/OGAG.jpg" class="absolute inset-0 w-full h-full object-cover" alt="Cek Reservasi">
        <div class="absolute inset-0 bg-black/55"></div>
        <div class="relative text-center text-white z-10">
            <p class="tracking-widest text-sm text-yellow-400 mb-2">STATUS PEMESANAN</p>
            <h1 class="text-4xl font-semibold">CEK RESERVASI</h1>
            <div class="mt-4 w-16 h-0.5 bg-yellow-500 mx-auto"></div>
            <p class="mt-4 text-gray-300 text-sm">Masukkan kode booking atau email untuk melihat status reservasi Anda</p>
        </div>
    </section>

    {{-- BREADCRUMB --}}
    <div class="bg-white px-16 py-4 border-b text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-yellow-600 transition">Home</a>
        <span class="mx-2">/</span>
        <span class="text-yellow-600 font-medium">Cek Reservasi</span>
    </div>

    <section class="bg-gray-50 py-16 px-6">
        <div class="max-w-xl mx-auto">

            {{-- FORM CEK --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8 mb-8">
                <h2 class="font-semibold text-lg mb-1">Lacak Pemesanan Anda</h2>
                <p class="text-gray-400 text-xs mb-6">Masukkan kode booking atau email untuk menemukan reservasi Anda.</p>

                {{-- Tab Kode Booking --}}
                <form action="{{ route('reservasi.cek') }}" method="POST" class="mb-4">
                    @csrf
                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Cari dengan Kode Booking</label>
                    <div class="flex gap-2">
                        <input type="text" name="kode_booking"
                            value="{{ old('kode_booking') }}"
                            placeholder="Contoh: OGAG-A1B2C3D4"
                            class="flex-1 border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500 uppercase tracking-widest">
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 text-sm hover:bg-yellow-700 transition rounded whitespace-nowrap">
                            CARI
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Kode booking ada di halaman konfirmasi atau email Anda.</p>
                </form>

                <div class="flex items-center gap-3 my-5">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400">atau</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                {{-- Tab Email --}}
                <form action="{{ route('reservasi.cek') }}" method="POST">
                    @csrf
                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Cari dengan Email</label>
                    <div class="flex gap-2">
                        <input type="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="Email yang digunakan saat reservasi"
                            class="flex-1 border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 text-sm hover:bg-yellow-700 transition rounded whitespace-nowrap">
                            CARI
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Akan menampilkan semua reservasi dengan email tersebut.</p>
                </form>

                {{-- Error --}}
                @if(session('error'))
                <div class="mt-4 bg-red-50 border border-red-200 text-red-600 rounded px-4 py-3 text-sm">
                    {{ session('error') }}
                </div>
                @endif
            </div>

            {{-- HASIL --}}
            @if(isset($reservations))

                @if($reservations->count() > 0)
                <p class="text-sm text-gray-500 mb-4">Ditemukan <strong>{{ $reservations->count() }}</strong> reservasi:</p>

                @foreach($reservations as $r)
                @php
                    $statusConfig = match($r->status) {
                        'pending'     => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500', 'label' => 'Menunggu Konfirmasi'],
                        'confirmed'   => ['bg' => 'bg-blue-100',   'text' => 'text-blue-700',   'dot' => 'bg-blue-500',   'label' => 'Dikonfirmasi'],
                        'checked_in'  => ['bg' => 'bg-green-100',  'text' => 'text-green-700',  'dot' => 'bg-green-500',  'label' => 'Sedang Menginap'],
                        'checked_out' => ['bg' => 'bg-gray-100',   'text' => 'text-gray-600',   'dot' => 'bg-gray-400',   'label' => 'Selesai'],
                        'cancelled'   => ['bg' => 'bg-red-100',    'text' => 'text-red-700',    'dot' => 'bg-red-500',    'label' => 'Dibatalkan'],
                        default       => ['bg' => 'bg-gray-100',   'text' => 'text-gray-600',   'dot' => 'bg-gray-400',   'label' => $r->status],
                    };
                @endphp

                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-4">

                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest mb-0.5">Kode Booking</p>
                            <p class="font-bold text-yellow-600 tracking-widest">{{ $r->kode_booking }}</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }}"></span>
                            {{ $statusConfig['label'] }}
                        </span>
                    </div>

                    <div class="px-6 py-5">
                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Nama Tamu</p>
                                <p class="font-medium">{{ $r->nama_lengkap }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Jenis Kamar</p>
                                <p class="font-medium">{{ $r->jenis_kamar }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Check-in</p>
                                <p class="font-medium">{{ $r->check_in->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Check-out</p>
                                <p class="font-medium">{{ $r->check_out->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Durasi</p>
                                <p class="font-medium">{{ $r->jumlah_malam }} malam</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Jumlah Tamu</p>
                                <p class="font-medium">{{ $r->jumlah_tamu }} orang</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Metode Pembayaran</p>
                                <p class="font-medium capitalize">{{ str_replace('_', ' ', $r->metode_pembayaran) }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Tanggal Pesan</p>
                                <p class="font-medium">{{ $r->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-500">Total Pembayaran</span>
                            <span class="font-bold text-yellow-600 text-lg">Rp {{ number_format($r->total_harga, 0, ',', '.') }}</span>
                        </div>

                        <div class="mt-4 rounded px-4 py-3 text-xs {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }}">
                            @if($r->status === 'pending')
                                ⏳ Reservasi Anda sedang menunggu konfirmasi. Kami akan menghubungi Anda dalam 1×24 jam.
                            @elseif($r->status === 'confirmed')
                                ✅ Reservasi Anda telah dikonfirmasi. Silakan datang pada tanggal check-in.
                            @elseif($r->status === 'checked_in')
                                🏨 Anda sedang menginap di hotel kami. Selamat menikmati!
                            @elseif($r->status === 'checked_out')
                                👋 Terima kasih telah menginap di OGAG Hotel. Sampai jumpa!
                            @elseif($r->status === 'cancelled')
                                ❌ Reservasi ini telah dibatalkan. Hubungi kami jika ada pertanyaan.
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

                @else
                <div class="bg-white rounded-lg border border-gray-100 shadow-sm p-8 text-center">
                    <div class="text-4xl mb-3">🔍</div>
                    <p class="font-semibold text-gray-700 mb-1">Reservasi Tidak Ditemukan</p>
                    <p class="text-sm text-gray-400">Pastikan kode booking atau email yang Anda masukkan sudah benar.</p>
                </div>
                @endif

            @endif

        </div>
    </section>

</main>