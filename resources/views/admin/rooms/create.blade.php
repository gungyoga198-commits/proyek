@extends('admin.layout')

@section('title', 'Tambah Kamar')
@section('subtitle', 'Tambah data kamar baru ke database')

@section('content')

{{-- ══ PERTEMUAN 11: Form tambah kamar ke DB ══ --}}

<div class="max-w-3xl">

    <a href="{{ route('admin.rooms.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 mb-6 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Kamar
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="font-semibold text-gray-800">➕ Tambah Kamar Baru</h3>
            <p class="text-xs text-gray-500 mt-0.5">Data akan disimpan ke tabel <code>rooms</code> di database</p>
        </div>

        <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data"
              class="p-6 space-y-5">
            @csrf

            {{-- Nama & Tipe --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Kamar <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                           placeholder="cth: Classic Terrace"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('nama') border-red-400 @enderror">
                    @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tipe (Unik) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="tipe" value="{{ old('tipe') }}"
                           placeholder="cth: CLASSIC"
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
                    <input type="number" name="harga_per_malam" value="{{ old('harga_per_malam') }}"
                           min="0" step="50000" placeholder="850000"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('harga_per_malam') border-red-400 @enderror">
                    @error('harga_per_malam')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kapasitas (orang) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="kapasitas" value="{{ old('kapasitas', 2) }}"
                           min="1" max="20"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('kapasitas') border-red-400 @enderror">
                    @error('kapasitas')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Ukuran, Tipe Bed, Pemandangan --}}
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ukuran</label>
                    <input type="text" name="ukuran" value="{{ old('ukuran') }}"
                           placeholder="cth: 25 m²"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Bed</label>
                    <input type="text" name="tipe_bed" value="{{ old('tipe_bed') }}"
                           placeholder="cth: Double Extra"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pemandangan</label>
                    <input type="text" name="pemandangan" value="{{ old('pemandangan') }}"
                           placeholder="cth: Pool or Garden"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          placeholder="Deskripsi singkat tentang kamar ini..."
                          class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 resize-none">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Fasilitas --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Fasilitas <span class="text-gray-400 text-xs">(simpan sebagai JSON)</span>
                </label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach(['WiFi', 'AC', 'TV', 'Kamar Mandi Pribadi', 'Sarapan', 'Balkon', 'Mini Bar', 'Bathtub', 'Netflix', 'Kolam Renang'] as $fasilitas)
                    <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                        <input type="checkbox" name="fasilitas[]" value="{{ $fasilitas }}"
                               {{ in_array($fasilitas, old('fasilitas', [])) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-400">
                        {{ $fasilitas }}
                    </label>
                    @endforeach
                </div>
                @error('fasilitas')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Upload Gambar --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Kamar</label>
                <input type="file" name="gambar" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-yellow-50 file:text-yellow-700 file:font-medium hover:file:bg-yellow-100">
                <p class="text-xs text-gray-400 mt-1">Maks. 2MB. Format: JPG, PNG, WebP</p>
                @error('gambar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status Aktif --}}
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_active" id="is_active" checked
                       class="w-4 h-4 rounded border-gray-300 text-yellow-500 focus:ring-yellow-400">
                <label for="is_active" class="text-sm text-gray-700 cursor-pointer">
                    Kamar aktif (tampil di halaman booking)
                </label>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-5 py-2.5 rounded-xl transition">
                    Simpan Kamar
                </button>
                <a href="{{ route('admin.rooms.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm px-5 py-2.5 rounded-xl transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
