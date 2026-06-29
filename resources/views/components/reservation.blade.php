{{-- RESERVATION FORM - DATA PRIBADI & PEMBAYARAN --}}

@php
$banks = [
    ['value' => 'BCA',     'logo' => 'BCA',     'color' => 'bg-blue-600',   ],
    ['value' => 'BRI',     'logo' => 'BRI',     'color' => 'bg-blue-800',   ],
    ['value' => 'BNI',     'logo' => 'BNI',     'color' => 'bg-orange-600', ],
    ['value' => 'MANDIRI', 'logo' => 'MANDIRI', 'color' => 'bg-yellow-700', ],
    ['value' => 'PAYPAL',  'logo' => 'PayPal',  'color' => 'bg-indigo-700', ],
];
@endphp

<main>

    <x-page-banner
        image="/images/OGAG.jpg"
        eyebrow="RESERVASI"
        title="FORMULIR PEMESANAN"
        overlay="bg-black/60"
    />

    <x-breadcrumb :links="[
        ['label' => 'Booking', 'route' => 'booking'],
        ['label' => 'Reservasi'],
    ]" />

    <section class="bg-gray-50 py-14 px-6 md:px-10">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-3 gap-8">

                {{-- ════ FORM KIRI ════ --}}
                <div class="md:col-span-2">
                    <form action="{{ route('booking.store') }}" method="POST" id="reservasiForm">
                        @csrf

                        <input type="hidden" name="jenis_kamar" value="{{ $room['name'] ?? '' }}">
                        <input type="hidden" name="check_in"    value="{{ $checkin }}">
                        <input type="hidden" name="check_out"   value="{{ $checkout }}">
                        <input type="hidden" name="jumlah_tamu" value="{{ $guests }}">

                        {{-- Validasi Error --}}
                        @if($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded p-4 mb-6">
                            <p class="text-sm font-semibold text-red-700 mb-1">Harap perbaiki kesalahan berikut:</p>
                            <ul class="list-disc list-inside text-sm text-red-600 space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- ── STEP 1: DATA PRIBADI ── --}}
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 bg-yellow-600 text-white rounded-full flex items-center justify-center text-sm font-bold">1</div>
                                <h2 class="font-semibold text-lg">Data Tamu</h2>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">

                                <div class="md:col-span-2">
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                                        placeholder="Nama lengkap sesuai identitas"
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        placeholder="contoh@email.com"
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">No. Telepon <span class="text-red-500">*</span></label>
                                    <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" required
                                        placeholder="08xx-xxxx-xxxx"
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Jenis Identitas <span class="text-red-500">*</span></label>
                                    <select name="jenis_identitas" required
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                        <option value="ktp"      {{ old('jenis_identitas', 'ktp') == 'ktp'      ? 'selected' : '' }}>KTP</option>
                                        <option value="passport" {{ old('jenis_identitas') == 'passport' ? 'selected' : '' }}>Passport</option>
                                        <option value="sim"      {{ old('jenis_identitas') == 'sim'      ? 'selected' : '' }}>SIM</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Nomor Identitas <span class="text-red-500">*</span></label>
                                    <input type="text" name="no_identitas" value="{{ old('no_identitas') }}" required
                                        placeholder="Nomor KTP / Passport / SIM"
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Alamat</label>
                                    <input type="text" name="alamat" value="{{ old('alamat') }}"
                                        placeholder="Jalan, No. Rumah, RT/RW"
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Kota</label>
                                    <input type="text" name="kota" value="{{ old('kota') }}"
                                        placeholder="Jakarta, Bandung, dll."
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Negara</label>
                                    <input type="text" name="negara" value="{{ old('negara', 'Indonesia') }}"
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Permintaan Khusus</label>
                                    <textarea name="permintaan_khusus" rows="3"
                                        placeholder="Contoh: kamar bebas rokok, kasur ekstra, dll."
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500 resize-none">{{ old('permintaan_khusus') }}</textarea>
                                </div>

                            </div>
                        </div>

                        {{-- ── STEP 2: TIPE PEMBAYARAN ── --}}
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 bg-yellow-600 text-white rounded-full flex items-center justify-center text-sm font-bold">2</div>
                                <h2 class="font-semibold text-lg">Tipe Pembayaran</h2>
                            </div>

                            {{-- Info batas bayar --}}
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6 flex gap-3">
                                <div class="text-amber-500 text-xl mt-0.5">⚠️</div>
                                <div class="text-sm text-amber-800">
                                    <p class="font-semibold mb-1">Batas Waktu Pembayaran</p>
                                    <p>Setelah reservasi dibuat, Anda memiliki <strong>12 jam</strong> untuk menyelesaikan pembayaran.</p>
                                    <p class="mt-1">Jika pembayaran tidak diterima dalam batas waktu tersebut, <strong>konfirmasi pemesanan akan ditolak otomatis</strong>.</p>
                                </div>
                            </div>

                            <input type="hidden" name="tipe_pembayaran" id="tipePembayaranInput" value="{{ old('tipe_pembayaran', '') }}">

                            <div class="grid grid-cols-2 gap-4">

                                {{-- LUNAS --}}
                                <div id="label-lunas"
                                    class="border-2 rounded-xl p-5 cursor-pointer transition
                                        {{ old('tipe_pembayaran') == 'lunas' ? 'border-yellow-500 bg-yellow-50' : 'border-gray-200 hover:border-yellow-300' }}"
                                    onclick="pilihTipe('lunas')">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-9 h-9 rounded-full bg-green-100 flex items-center justify-center text-lg">✅</div>
                                        <span id="check-lunas"
                                            class="text-xs font-semibold px-2 py-0.5 rounded-full
                                            {{ old('tipe_pembayaran') == 'lunas' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-400' }}">
                                            {{ old('tipe_pembayaran') == 'lunas' ? '✓ Dipilih' : 'Pilih' }}
                                        </span>
                                    </div>
                                    <p class="font-semibold text-gray-800 mb-1">Lunas</p>
                                    <p class="text-xs text-gray-500 leading-relaxed">Bayar penuh sekarang. Reservasi langsung terkonfirmasi setelah pembayaran diterima.</p>
                                    <p class="text-base font-bold text-green-600 mt-3">
                                        Rp {{ number_format($totalHarga, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- DP 50% --}}
                                <div id="label-dp"
                                    class="border-2 rounded-xl p-5 cursor-pointer transition
                                        {{ old('tipe_pembayaran') == 'dp' ? 'border-yellow-500 bg-yellow-50' : 'border-gray-200 hover:border-yellow-300' }}"
                                    onclick="pilihTipe('dp')">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-lg">💰</div>
                                        <span id="check-dp"
                                            class="text-xs font-semibold px-2 py-0.5 rounded-full
                                            {{ old('tipe_pembayaran') == 'dp' ? 'bg-yellow-500 text-white' : 'bg-gray-100 text-gray-400' }}">
                                            {{ old('tipe_pembayaran') == 'dp' ? '✓ Dipilih' : 'Pilih' }}
                                        </span>
                                    </div>
                                    <p class="font-semibold text-gray-800 mb-1">DP 50%</p>
                                    <p class="text-xs text-gray-500 leading-relaxed">Bayar setengah sekarang, sisa dilunasi saat check-in. Berlaku syarat batas waktu 12 jam.</p>
                                    <p class="text-base font-bold text-blue-600 mt-3">
                                        Rp {{ number_format($totalHarga * 0.5, 0, ',', '.') }}
                                        <span class="text-xs text-gray-400 font-normal">sekarang</span>
                                    </p>
                                </div>

                            </div>

                            @error('tipe_pembayaran')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ── STEP 3: METODE PEMBAYARAN ── --}}
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 bg-yellow-600 text-white rounded-full flex items-center justify-center text-sm font-bold">3</div>
                                <h2 class="font-semibold text-lg">Metode Pembayaran</h2>
                            </div>

                            {{-- Hanya Transfer Bank --}}
                            <div class="flex items-center gap-3 border-2 border-yellow-500 bg-yellow-50 rounded-xl px-5 py-4 mb-6">
                                <span class="text-2xl">🏦</span>
                                <div>
                                    <p class="font-semibold text-sm text-gray-800">Transfer Bank</p>
                                    <p class="text-xs text-gray-500">Satu-satunya metode pembayaran yang tersedia</p>
                                </div>
                                <span class="ml-auto text-xs bg-yellow-500 text-white px-3 py-1 rounded-full font-medium">✓ Dipilih</span>
                            </div>
                            <input type="hidden" name="metode_pembayaran" value="transfer_bank">

                            {{-- Pilih Bank --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-3 uppercase tracking-wide">Pilih Bank Tujuan Transfer <span class="text-red-500">*</span></label>

                                @error('nama_bank')
                                <p class="text-red-500 text-xs mb-2">{{ $message }}</p>
                                @enderror

                                <input type="hidden" name="nama_bank" id="namaBankInput" value="{{ old('nama_bank', '') }}">

                                <div class="grid grid-cols-5 gap-3 mb-4" id="bankGrid">
                                    @foreach($banks as $bank)
                                    <button type="button"
                                        id="btn-bank-{{ $bank['value'] }}"
                                        data-bank="{{ $bank['value'] }}"
                                        class="bank-btn border-2 rounded-xl py-3 px-2 text-center transition font-bold text-xs text-white {{ $bank['color'] }}
                                            {{ old('nama_bank') == $bank['value'] ? 'ring-2 ring-offset-2 ring-yellow-500 scale-105 opacity-100' : 'opacity-70 hover:opacity-100' }}">
                                        {{ $bank['logo'] }}
                                    </button>
                                    @endforeach
                                </div>

                                {{-- Info rekening berdasarkan bank yang dipilih --}}
                                <div id="infoRekening" class="hidden bg-blue-50 border border-blue-100 rounded-lg p-4 text-sm text-blue-800">
                                    <p class="font-semibold mb-1">Rekening Tujuan Transfer:</p>
                                    <p id="infoRekeningNama" class="font-bold text-lg text-blue-700"></p>
                                    <p id="infoRekeningNorek" class="text-blue-600 font-mono text-base mt-0.5"></p>
                                    <p class="text-xs text-blue-500 mt-2">a.n. BUKYUK RESORT — Pastikan nominal sesuai sebelum transfer.</p>
                                </div>
                            </div>

                            {{-- No. Rekening Pengirim --}}
                            <div class="mt-4">
                                <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">
                                    No. Rekening Pengirim
                                    <span class="text-gray-400 normal-case">(opsional, untuk konfirmasi)</span>
                                </label>
                                <input type="text" name="no_rekening" value="{{ old('no_rekening') }}"
                                    placeholder="Nomor rekening Anda"
                                    class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                            </div>
                        </div>

                        {{-- ── STEP 4: KONFIRMASI ── --}}
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 bg-yellow-600 text-white rounded-full flex items-center justify-center text-sm font-bold">4</div>
                                <h2 class="font-semibold text-lg">Konfirmasi & Kirim</h2>
                            </div>
                            <div class="flex items-start gap-2 mb-5">
                                <input type="checkbox" name="setuju" id="setuju" required value="1" class="mt-1">
                                <label for="setuju" class="text-sm text-gray-600">
                                    Saya setuju dengan <span class="text-yellow-600 underline">syarat & ketentuan</span> yang berlaku,
                                    memahami batas waktu pembayaran <strong>12 jam</strong>, dan data yang diisi adalah benar.
                                </label>
                            </div>
                            <button type="submit"
                                class="w-full bg-yellow-600 text-white py-3.5 text-sm font-semibold hover:bg-yellow-700 transition rounded tracking-widest">
                                KONFIRMASI RESERVASI
                            </button>
                        </div>

                    </form>
                </div>

                {{-- ════ RINGKASAN KANAN ════ --}}
                <div class="md:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 sticky top-6">

                        @if($room)
                        <img src="{{ $room['image'] }}" alt="{{ $room['name'] }}" class="w-full h-48 object-cover rounded-t-lg">
                        @endif

                        <div class="p-5">
                            <p class="text-xs text-gray-400 tracking-widest uppercase mb-1">Ringkasan Pemesanan</p>

                            @if($room)
                            <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded tracking-wider">{{ $room['type'] }}</span>
                            <p class="font-semibold text-lg mt-2 mb-4">{{ $room['name'] }}</p>
                            @endif

                            <div class="space-y-3 text-sm border-t border-gray-100 pt-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Check-in</span>
                                    <span class="font-medium">{{ $checkin ? \Carbon\Carbon::parse($checkin)->format('d M Y') : '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Check-out</span>
                                    <span class="font-medium">{{ $checkout ? \Carbon\Carbon::parse($checkout)->format('d M Y') : '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Durasi</span>
                                    <span class="font-medium">{{ $nights }} malam</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Jumlah Tamu</span>
                                    <span class="font-medium">{{ $guests }} orang</span>
                                </div>
                            </div>

                            @if($room)
                            <div class="border-t border-gray-100 pt-4 mt-4 space-y-2 text-sm">
                                <div class="flex justify-between text-gray-500 text-xs">
                                    <span>Rp {{ number_format($room['price'], 0, ',', '.') }} × {{ $nights }} malam</span>
                                </div>
                                <div class="flex justify-between font-bold text-base pt-1 border-t border-gray-100">
                                    <span>Total</span>
                                    <span class="text-yellow-600">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                                </div>
                                <div class="justify-between text-xs text-blue-600 hidden" id="ringkasanDp">
                                    <span>DP 50% sekarang</span>
                                    <span>Rp {{ number_format($totalHarga * 0.5, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="mt-4 p-3 bg-amber-50 border border-amber-100 rounded-lg text-xs text-amber-700">
                                <p class="font-semibold mb-1">⏰ Batas Pembayaran</p>
                                <p>12 jam sejak reservasi dibuat. Lewat batas waktu → ditolak otomatis.</p>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <p class="text-xs text-gray-400 mb-2">Fasilitas Kamar</p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($room['facilities'] as $f)
                                    <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded">{{ $f }}</span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <a href="{{ route('booking') }}" class="block text-center mt-5 text-xs text-gray-400 hover:text-yellow-600 transition">
                                ← Ganti Kamar
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<script>
    // Data bank — hardcode di JS agar tidak ada garis merah dari editor
    const bankInfo = {
        BCA:     { nama: 'BCA \u2014 Bank Central Asia',     norek: '1234 5678 90' },
        BRI:     { nama: 'BRI \u2014 Bank Rakyat Indonesia', norek: '0987 6543 21' },
        BNI:     { nama: 'BNI \u2014 Bank Negara Indonesia', norek: '1122 3344 55' },
        MANDIRI: { nama: 'Bank Mandiri',                     norek: '5566 7788 99' },
        PAYPAL:  { nama: 'PayPal',                           norek: 'reservasi@bukyuk.com' },
    };

    function pilihTipe(tipe) {
        document.getElementById('tipePembayaranInput').value = tipe;

        ['lunas', 'dp'].forEach(function (t) {
            const lbl   = document.getElementById('label-' + t);
            const check = document.getElementById('check-' + t);
            if (t === tipe) {
                lbl.classList.add('border-yellow-500', 'bg-yellow-50');
                lbl.classList.remove('border-gray-200');
                check.textContent = '✓ Dipilih';
                check.classList.add('bg-yellow-500', 'text-white');
                check.classList.remove('bg-gray-100', 'text-gray-400');
            } else {
                lbl.classList.remove('border-yellow-500', 'bg-yellow-50');
                lbl.classList.add('border-gray-200');
                check.textContent = 'Pilih';
                check.classList.remove('bg-yellow-500', 'text-white');
                check.classList.add('bg-gray-100', 'text-gray-400');
            }
        });

        // Tampil/sembunyikan baris DP di ringkasan
        const dpRow = document.getElementById('ringkasanDp');
        if (dpRow) {
            if (tipe === 'dp') {
                dpRow.classList.remove('hidden');
                dpRow.classList.add('flex');
            } else {
                dpRow.classList.add('hidden');
                dpRow.classList.remove('flex');
            }
        }
    }

    function pilihBank(bank) {
        document.getElementById('namaBankInput').value = bank;

        // Update tampilan tombol bank
        document.querySelectorAll('.bank-btn').forEach(function (btn) {
            btn.classList.remove('ring-2', 'ring-offset-2', 'ring-yellow-500', 'scale-105', 'opacity-100');
            btn.classList.add('opacity-70');
        });

        const chosen = document.getElementById('btn-bank-' + bank);
        if (chosen) {
            chosen.classList.add('ring-2', 'ring-offset-2', 'ring-yellow-500', 'scale-105', 'opacity-100');
            chosen.classList.remove('opacity-70');
        }

        // Tampilkan info rekening
        const info = bankInfo[bank];
        if (info) {
            document.getElementById('infoRekening').classList.remove('hidden');
            document.getElementById('infoRekeningNama').textContent  = info.nama;
            document.getElementById('infoRekeningNorek').textContent = info.norek;
        }
    }

    // Event listener untuk tombol bank (menggantikan inline onclick)
    document.addEventListener('DOMContentLoaded', function () {
        // Pasang event listener ke semua tombol bank
        document.querySelectorAll('.bank-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                pilihBank(this.dataset.bank);
            });
        });

        // Restore state dari old() value jika ada (setelah validasi gagal)
        const oldTipe = document.getElementById('tipePembayaranInput').value;
        if (oldTipe) pilihTipe(oldTipe);

        const oldBank = document.getElementById('namaBankInput').value;
        if (oldBank) pilihBank(oldBank);
    });
</script>