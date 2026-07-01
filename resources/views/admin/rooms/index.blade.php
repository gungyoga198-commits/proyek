@extends('admin.layout')

@section('title', 'Kelola Kamar')
@section('subtitle', 'Manajemen data kamar hotel dari database')

@section('content')

{{-- ══ PERTEMUAN 11: Daftar kamar dari DB (bukan hardcode) ══ --}}
{{-- ══ PERTEMUAN 13: @can → tampilkan tombol hanya untuk admin ══ --}}

<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Total {{ $rooms->total() }} kamar terdaftar</p>
    </div>
    {{-- PERTEMUAN 13: @can 'create' Rooms → hanya admin yang lihat tombol --}}
    @can('create', \App\Models\Rooms::class)
    <a href="{{ route('admin.rooms.create') }}"
       class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Kamar
    </a>
    @endcan
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

{{-- Tabel daftar kamar --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">#</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Kamar</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Tipe</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Harga / Malam</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Kapasitas</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Total Reservasi</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Status</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($rooms as $room)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($room->gambar)
                        <img src="{{ str_starts_with($room->gambar, 'images/') ? '/'.$room->gambar : asset('storage/'.$room->gambar) }}"
                             class="w-12 h-10 rounded-lg object-cover border border-gray-100">
                        @else
                        <div class="w-12 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                            </svg>
                        </div>
                        @endif
                        <div>
                            <p class="font-medium text-gray-800">{{ $room->nama }}</p>
                            <p class="text-xs text-gray-400">{{ $room->ukuran }} · {{ $room->tipe_bed }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-lg">
                        {{ $room->tipe }}
                    </span>
                </td>
                <td class="px-6 py-4 font-semibold text-gray-800">
                    {{ $room->harga_format }}
                </td>
                <td class="px-6 py-4 text-gray-600">
                    {{ $room->kapasitas }} orang
                </td>
                {{-- PERTEMUAN 11: withCount('reservations') → tidak ada N+1 query --}}
                <td class="px-6 py-4">
                    <span class="text-gray-700 font-medium">{{ $room->reservations_count }}</span>
                    <span class="text-gray-400 text-xs ml-1">reservasi</span>
                </td>
                <td class="px-6 py-4">
                    @if($room->is_active)
                    <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1 bg-red-50 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Nonaktif
                    </span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        {{-- PERTEMUAN 13: @can 'update' → hanya admin yang lihat tombol Edit --}}
                        @can('update', $room)
                        <a href="{{ route('admin.rooms.edit', $room) }}"
                           class="inline-flex items-center gap-1 text-xs bg-yellow-50 text-yellow-700 hover:bg-yellow-100 px-3 py-1.5 rounded-lg transition font-medium">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        @endcan

                        {{-- PERTEMUAN 13: @can 'delete' → hanya admin yang lihat tombol Hapus --}}
                        @can('delete', $room)
                        <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus kamar {{ $room->nama }}? Semua reservasi terkait akan kehilangan referensi kamar.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-1 text-xs bg-red-50 text-red-700 hover:bg-red-100 px-3 py-1.5 rounded-lg transition font-medium">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                        @endcan
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                    </svg>
                    <p class="font-medium">Belum ada data kamar</p>
                    <p class="text-xs mt-1">Jalankan <code class="bg-gray-100 px-1 rounded">php artisan db:seed</code> untuk mengisi data awal</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($rooms->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $rooms->links() }}
    </div>
    @endif
</div>

@endsection
