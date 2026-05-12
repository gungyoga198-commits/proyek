{{-- RESERVATION FORM - DATA PRIBADI & PEMBAYARAN --}}
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
                    <form action="{{ route('booking.store') }}" method="POST">
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
                                        <option value="ktp"      {{ old('jenis_identitas','ktp') == 'ktp'      ? 'selected' : '' }}>KTP</option>
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

                        {{-- ── STEP 2: METODE PEMBAYARAN ── --}}
                        <div class="bg-white rounded-lg shadow-sm p-6 mb-6 border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-8 h-8 bg-yellow-600 text-white rounded-full flex items-center justify-center text-sm font-bold">2</div>
                                <h2 class="font-semibold text-lg">Metode Pembayaran</h2>
                            </div>

                            @if($errors->has('metode_pembayaran'))
                            <p class="text-red-500 text-xs mb-3">{{ $errors->first('metode_pembayaran') }}</p>
                            @endif

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
                                @php
                                $methods = [
                                    ['value' => 'transfer_bank',   'label' => 'Transfer Bank',   'icon' => '🏦'],
                                    ['value' => 'virtual_account', 'label' => 'Virtual Account', 'icon' => '💻'],
                                    ['value' => 'kartu_kredit',    'label' => 'Kartu Kredit',    'icon' => '💳'],
                                    ['value' => 'kartu_debit',     'label' => 'Kartu Debit',     'icon' => '🏧'],
                                    ['value' => 'gopay',           'label' => 'GoPay',           'icon' => '📱'],
                                    ['value' => 'ovo',             'label' => 'OVO',             'icon' => '💜'],
                                    ['value' => 'dana',            'label' => 'DANA',            'icon' => '💙'],
                                ];
                                @endphp

                                @foreach($methods as $m)
                                <label class="border-2 rounded-lg p-3 cursor-pointer text-center transition
                                    {{ old('metode_pembayaran') == $m['value'] ? 'border-yellow-500 bg-yellow-50' : 'border-gray-200 hover:border-yellow-300' }}">
                                    <input type="radio" name="metode_pembayaran" value="{{ $m['value'] }}"
                                        class="hidden"
                                        {{ old('metode_pembayaran') == $m['value'] ? 'checked' : '' }}>
                                    <div class="text-2xl mb-1">{{ $m['icon'] }}</div>
                                    <div class="text-xs font-medium text-gray-700">{{ $m['label'] }}</div>
                                </label>
                                @endforeach
                            </div>

                            {{-- Info tambahan berdasarkan pilihan --}}
                            @if(old('metode_pembayaran') == 'transfer_bank')
                            <div class="bg-blue-50 border border-blue-100 rounded p-4 mb-4 text-sm text-blue-800">
                                <p class="font-semibold mb-2">Informasi Rekening Transfer</p>
                                <p>BCA: <strong>1234567890</strong> a/n OGAG HOTEL</p>
                                <p>Mandiri: <strong>0987654321</strong> a/n OGAG HOTEL</p>
                            </div>
                            <div class="grid md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Nama Bank</label>
                                    <input type="text" name="nama_bank" value="{{ old('nama_bank') }}"
                                        placeholder="BCA / Mandiri / BRI"
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">No. Rekening Pengirim</label>
                                    <input type="text" name="no_rekening" value="{{ old('no_rekening') }}"
                                        placeholder="Nomor rekening Anda"
                                        class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                                </div>
                            </div>
                            @elseif(old('metode_pembayaran') == 'kartu_kredit' || old('metode_pembayaran') == 'kartu_debit')
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Nama Pemegang Kartu</label>
                                <input type="text" name="nama_pemegang_kartu" value="{{ old('nama_pemegang_kartu') }}"
                                    placeholder="Nama sesuai kartu"
                                    class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500 mb-2">
                                <p class="text-xs text-gray-400">Pembayaran diproses saat check-in di hotel.</p>
                            </div>
                            @elseif(in_array(old('metode_pembayaran'), ['virtual_account','gopay','ovo','dana']))
                            <div class="bg-green-50 border border-green-100 rounded p-4 text-sm text-green-800">
                                <p class="font-semibold mb-1">Instruksi Pembayaran</p>
                                <p>Link / nomor pembayaran akan dikirim ke email Anda setelah reservasi dikonfirmasi.</p>
                            </div>
                            @else
                            <p class="text-xs text-gray-400 text-center py-2">Pilih metode pembayaran di atas untuk melihat instruksi.</p>
                            @endif

                        </div>

                        {{-- ── STEP 3: KONFIRMASI ── --}}
                        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 bg-yellow-600 text-white rounded-full flex items-center justify-center text-sm font-bold">3</div>
                                <h2 class="font-semibold text-lg">Konfirmasi & Kirim</h2>
                            </div>
                            <div class="flex items-start gap-2 mb-5">
                                <input type="checkbox" name="setuju" id="setuju" required value="1" class="mt-1">
                                <label for="setuju" class="text-sm text-gray-600">
                                    Saya setuju dengan <span class="text-yellow-600 underline">syarat & ketentuan</span> yang berlaku dan data yang diisi adalah benar.
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
                            </div>

                            <div class="mt-5 pt-4 border-t border-gray-100">
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