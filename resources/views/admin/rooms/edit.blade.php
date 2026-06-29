@extends('admin.layout')

@section('title', 'Edit Kamar: ' . $room->nama)
@section('subtitle', 'Update data kamar di database')

@section('content')

{{-- ══ PERTEMUAN 11: Form edit kamar dari DB ══ --}}

<div class="max-w-3xl">

    <a href="{{ route('admin.rooms.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 mb-6 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Kamar
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-yellow-50">
            <h3 class="font-semibold text-gray-800">✏️ Edit Kamar: {{ $room->nama }}</h3>
            <p class="text-xs text-gray-500 mt-0.5">ID: {{ $room->id }} · Dibuat: {{ $room->created_at->format('d M Y') }}</p>
        </div>

        <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama & Tipe --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Kamar <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', $room->nama) }}"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('nama') border-red-400 @enderror">
                    @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tipe (Unik) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="tipe" value="{{ old('tipe', $room->tipe) }}"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 uppercase @error('tipe') border-red-400 @enderror">
                    @error('tipe')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Harga & Kapasitas --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Harga per Malam (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="harga_per_malam"
                           value="{{ old('harga_per_malam', $room->harga_per_malam) }}"
                           min="0" step="50000"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('harga_per_malam') border-red-400 @enderror">
                    @error('harga_per_malam')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kapasitas (orang) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="kapasitas"
                           value="{{ old('kapasitas', $room->kapasitas) }}"
                           min="1" max="20"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
            </div>

            {{-- Ukuran, Tipe Bed, Pemandangan --}}
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                    <input type="text" name="ukuran" value="{{ old('ukuran', $room->ukuran) }}"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Bed</label>
                    <input type="text" name="tipe_bed" value="{{ old('tipe_bed', $room->tipe_bed) }}"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pemandangan</label>
                    <input type="text" name="pemandangan" value="{{ old('pemandangan', $room->pemandangan) }}"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 resize-none">{{ old('deskripsi', $room->deskripsi) }}</textarea>
            </div>

            {{-- Fasilitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Fasilitas <span class="text-gray-400 text-xs">(disimpan sebagai JSON di database)</span>
                </label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(['WiFi', 'AC', 'TV', 'Kamar Mandi Pribadi', 'Sarapan', 'Balkon', 'Mini Bar', 'Bathtub', 'Netflix', 'Kolam Renang'] as $fasilitas)
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="fasilitas[]" value="{{ $fasilitas }}"
                               {{ in_array($fasilitas, old('fasilitas', $room->fasilitas ?? [])) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-400">
                        {{ $fasilitas }}
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Gambar --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar</label>
                @if($room->gambar)
                <div class="mb-2">
                    <img src="{{ str_starts_with($room->gambar, 'images/') ? '/'.$room->gambar : asset('storage/'.$room->gambar) }}"
                         class="h-24 rounded-xl object-cover border border-gray-200">
                    <p class="text-xs text-gray-400 mt-1">Gambar saat ini: {{ $room->gambar }}</p>
                </div>
                @endif
                <input type="file" name="gambar" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-yellow-50 file:text-yellow-700 file:font-medium hover:file:bg-yellow-100">
                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti gambar. Maks. 2MB.</p>
                @error('gambar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Aktif --}}
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active"
                       {{ old('is_active', $room->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-gray-300 text-yellow-500 focus:ring-yellow-400">
                <label for="is_active" class="text-sm text-gray-700 cursor-pointer">
                    Kamar aktif (tampil di halaman booking)
                </label>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-5 py-2.5 rounded-xl transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.rooms.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm px-5 py-2.5 rounded-xl transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Info Relasi (debug mode) --}}
    @if(config('app.debug'))
    <div class="mt-4 bg-blue-50 border border-blue-100 rounded-xl p-4 text-xs text-blue-700">
        <p class="font-semibold mb-1">📚 Pertemuan 11 — Relasi kamar ini:</p>
        <p>Total reservasi: <strong>{{ $room->reservations()->count() }}</strong></p>
        <p>Reservasi aktif: <strong>{{ $room->reservasiAktif()->count() }}</strong></p>
    </div>
    @endif

</div>

@endsection
