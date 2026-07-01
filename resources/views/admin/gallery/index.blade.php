@extends('admin.layout')

@section('title', 'Kelola Gallery')
@section('subtitle', 'Kelola foto-foto yang ditampilkan di website')

@section('content')

{{-- Header: total foto + tombol tambah --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Total {{ $galleries->total() }} foto terdaftar</p>
    </div>
    <a href="{{ route('admin.gallery.create') }}"
       class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Foto Baru
    </a>
</div>

{{-- Notifikasi sukses --}}
@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    {{ session('success') }}
</div>
@endif

{{-- Stat cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4 text-center">
        <p class="text-2xl font-bold text-gray-800">{{ $galleries->total() }}</p>
        <p class="text-xs text-gray-500 mt-1">Total Foto</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4 text-center">
        <p class="text-2xl font-bold text-green-600">{{ $galleries->where('aktif', true)->count() }}</p>
        <p class="text-xs text-gray-500 mt-1">Foto Aktif</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4 text-center">
        <p class="text-2xl font-bold text-red-500">{{ $galleries->where('aktif', false)->count() }}</p>
        <p class="text-xs text-gray-500 mt-1">Foto Nonaktif</p>
    </div>
</div>

{{-- Grid foto gallery --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    @forelse($galleries as $item)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition
                {{ !$item->aktif ? 'opacity-70 border-red-100' : '' }}">

        {{-- Gambar + badge --}}
        <div class="relative aspect-[4/3] bg-gray-100 overflow-hidden">
            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                 class="w-full h-full object-cover">
            <div class="absolute top-2 left-2 flex items-center gap-1.5">
                <span class="bg-black/60 text-white text-[11px] font-semibold px-2.5 py-1 rounded-full capitalize backdrop-blur-sm">
                    {{ $item->kategori }}
                </span>
                @if(!$item->aktif)
                <span class="bg-red-500/90 text-white text-[11px] font-semibold px-2.5 py-1 rounded-full">
                    Nonaktif
                </span>
                @endif
            </div>
        </div>

        {{-- Body --}}
        <div class="px-4 py-3">
            <p class="font-medium text-gray-800 text-sm truncate" title="{{ $item->judul }}">{{ $item->judul }}</p>
            <p class="text-xs text-gray-400 mt-1 line-clamp-2 min-h-[2rem]">
                {{ $item->deskripsi ? Str::limit($item->deskripsi, 80) : 'Tidak ada deskripsi' }}
            </p>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-2 px-4 pb-4">
            <a href="{{ route('admin.gallery.edit', $item) }}"
               class="flex-1 inline-flex items-center justify-center gap-1 text-xs bg-yellow-50 text-yellow-700 hover:bg-yellow-100 px-3 py-1.5 rounded-lg transition font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>

            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST"
                  onsubmit="return confirm('Yakin hapus foto {{ $item->judul }}?')" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-1 text-xs bg-red-50 text-red-700 hover:bg-red-100 px-3 py-1.5 rounded-lg transition font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-16 text-center text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="font-medium">Belum ada foto</p>
        <p class="text-xs mt-1 mb-4">Tambahkan foto pertama untuk galeri website Anda</p>
        <a href="{{ route('admin.gallery.create') }}"
           class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Foto Pertama
        </a>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($galleries->hasPages())
<div class="mt-6">
    {{ $galleries->links() }}
</div>
@endif

@endsection