{{-- BOOKING SUCCESS PAGE --}}
<main>

    <section class="relative h-64 flex items-center justify-center overflow-hidden">
        <img src="/images/OGAG.jpg" class="absolute inset-0 w-full h-full object-cover" alt="Success">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative text-center text-white z-10">
            <p class="tracking-widest text-sm text-yellow-400 mb-2">RESERVASI</p>
            <h1 class="text-4xl font-semibold">PEMESANAN BERHASIL</h1>
            <div class="mt-4 w-16 h-0.5 bg-yellow-500 mx-auto"></div>
        </div>
    </section>

    <div class="bg-white px-16 py-4 border-b text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-yellow-600 transition">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('booking') }}" class="hover:text-yellow-600 transition">Booking</a>
        <span class="mx-2">/</span>
        <span class="text-yellow-600 font-medium">Konfirmasi</span>
    </div>

    <section class="bg-gray-50 py-16 px-6">
        <div class="max-w-2xl mx-auto">

            {{-- Ikon sukses --}}
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800">Reservasi Diterima!</h2>
                <p class="text-gray-500 text-sm mt-2">Konfirmasi akan dikirim ke email <strong>{{ $reservation->email }}</strong></p>
            </div>

            {{-- Kode Booking --}}
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-5 text-center mb-6">
                <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Kode Booking Anda</p>
                <p class="text-3xl font-bold text-yellow-600 tracking-widest">{{ $reservation->kode_booking }}</p>
                <p class="text-xs text-gray-400 mt-1">Simpan kode ini untuk keperluan check-in</p>
            </div>

            {{-- Detail reservasi --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
                <h3 class="font-semibold text-gray-700 mb-4 text-sm uppercase tracking-wide">Detail Reservasi</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Nama Tamu</span>
                        <span class="font-medium">{{ $reservation->nama_lengkap }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Jenis Kamar</span>
                        <span class="font-medium">{{ $reservation->jenis_kamar }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Check-in</span>
                        <span class="font-medium">{{ $reservation->check_in->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Check-out</span>
                        <span class="font-medium">{{ $reservation->check_out->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Durasi</span>
                        <span class="font-medium">{{ $reservation->jumlah_malam }} malam</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Jumlah Tamu</span>
                        <span class="font-medium">{{ $reservation->jumlah_tamu }} orang</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-50 pb-2">
                        <span class="text-gray-500">Metode Pembayaran</span>
                        <span class="font-medium capitalize">{{ str_replace('_', ' ', $reservation->metode_pembayaran) }}</span>
                    </div>
                    <div class="flex justify-between pt-1">
                        <span class="text-gray-700 font-semibold">Total Pembayaran</span>
                        <span class="font-bold text-yellow-600 text-base">Rp {{ number_format($reservation->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="bg-blue-50 border border-blue-100 rounded p-4 text-sm text-blue-700 mb-6 text-center">
                <p>Status: <strong>Menunggu Konfirmasi</strong> — Tim kami akan menghubungi Anda dalam 1×24 jam.</p>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-4">
                <a href="{{ route('home') }}" class="flex-1 text-center border border-yellow-600 text-yellow-600 py-3 text-sm hover:bg-yellow-50 transition rounded">
                    KEMBALI KE HOME
                </a>
                <a href="{{ route('booking') }}" class="flex-1 text-center bg-yellow-600 text-white py-3 text-sm hover:bg-yellow-700 transition rounded">
                    BUAT RESERVASI LAIN
                </a>
            </div>

        </div>
    </section>

</main>