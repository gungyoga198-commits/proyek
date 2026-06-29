@extends('layouts.admin') {{-- Sesuaikan dengan layout admin kalian --}}

@section('title', 'Kelola Gallery')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        color: #fff;
        padding: 28px 32px;
        border-radius: 16px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .page-header h4 { margin: 0; font-weight: 700; font-size: 1.4rem; }
    .page-header p { margin: 4px 0 0; color: rgba(255,255,255,0.65); font-size: 0.9rem; }

    .gallery-admin-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }
    .gallery-admin-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        transition: transform 0.2s, box-shadow 0.2s;
        border: 2px solid transparent;
    }
    .gallery-admin-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.13);
    }
    .gallery-admin-card.nonaktif {
        border-color: #ffcdd2;
        opacity: 0.75;
    }
    .card-img-wrap {
        position: relative;
        aspect-ratio: 4/3;
        overflow: hidden;
        background: #f0f0f0;
    }
    .card-img-wrap img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }
    .gallery-admin-card:hover .card-img-wrap img { transform: scale(1.05); }

    .card-badges {
        position: absolute;
        top: 8px; left: 8px;
        display: flex; gap: 5px;
    }
    .badge-kategori {
        background: rgba(0,0,0,0.65);
        color: #fff;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        backdrop-filter: blur(4px);
        text-transform: capitalize;
    }
    .badge-nonaktif {
        background: rgba(229,57,53,0.85);
        color: #fff;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .card-body-admin { padding: 14px 16px; }
    .card-body-admin h6 {
        font-weight: 700;
        font-size: 0.92rem;
        margin-bottom: 4px;
        color: #222;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .card-body-admin .card-desc {
        font-size: 0.78rem;
        color: #888;
        margin-bottom: 12px;
        min-height: 32px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-actions {
        display: flex;
        gap: 6px;
        padding: 0 16px 14px;
    }
    .btn-action {
        flex: 1;
        padding: 7px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: opacity 0.2s;
        display: flex; align-items: center; justify-content: center; gap: 4px;
    }
    .btn-action:hover { opacity: 0.82; }
    .btn-edit  { background: #e3f2fd; color: #1565c0; }
    .btn-toggle-on  { background: #fff3e0; color: #e65100; }
    .btn-toggle-off { background: #e8f5e9; color: #2e7d32; }
    .btn-delete { background: #ffebee; color: #c62828; }

    /* STATS */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        text-align: center;
    }
    .stat-card .stat-num { font-size: 2rem; font-weight: 800; color: #1a1a2e; }
    .stat-card .stat-label { font-size: 0.8rem; color: #888; margin-top: 4px; }
    .stat-card.accent .stat-num { color: #e53935; }

    /* EMPTY */
    .empty-admin {
        text-align: center;
        padding: 60px;
        color: #bbb;
        grid-column: 1/-1;
        background: #fff;
        border-radius: 16px;
    }

    /* Pagination */
    .pagination { justify-content: center; margin-top: 32px; }
    .page-link { border-radius: 8px !important; margin: 0 3px; color: #1a1a2e; }
    .page-item.active .page-link { background: #e53935; border-color: #e53935; }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h4><i class="fas fa-images me-2"></i>Kelola Gallery</h4>
            <p>Tambah, edit, dan hapus foto galeri website</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-danger btn-lg fw-bold">
            <i class="fas fa-plus me-1"></i> Tambah Foto
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- STATS --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-num">{{ $galleries->total() }}</div>
            <div class="stat-label">Total Foto</div>
        </div>
        <div class="stat-card accent">
            <div class="stat-num">{{ $galleries->where('aktif', true)->count() }}</div>
            <div class="stat-label">Foto Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-num">{{ $galleries->where('aktif', false)->count() }}</div>
            <div class="stat-label">Foto Nonaktif</div>
        </div>
    </div>

    {{-- GRID --}}
    <div class="gallery-admin-grid">
        @forelse($galleries as $item)
        <div class="gallery-admin-card {{ !$item->aktif ? 'nonaktif' : '' }}">
            <div class="card-img-wrap">
                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                <div class="card-badges">
                    <span class="badge-kategori">{{ $item->kategori }}</span>
                    @if(!$item->aktif)
                    <span class="badge-nonaktif">Nonaktif</span>
                    @endif
                </div>
            </div>

            <div class="card-body-admin">
                <h6>{{ $item->judul }}</h6>
                <p class="card-desc">{{ $item->deskripsi ?: 'Tidak ada deskripsi' }}</p>
            </div>

            <div class="card-actions">
                <a href="{{ route('admin.gallery.edit', $item) }}" class="btn-action btn-edit">
                    <i class="fas fa-pencil-alt"></i>
                </a>

                <form action="{{ route('admin.gallery.toggle', $item) }}" method="POST" style="flex:1">
                    @csrf @method('PATCH')
                    <button type="submit"
                        class="btn-action {{ $item->aktif ? 'btn-toggle-on' : 'btn-toggle-off' }}"
                        style="width:100%"
                        title="{{ $item->aktif ? 'Nonaktifkan' : 'Aktifkan' }}">
                        <i class="fas {{ $item->aktif ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                    </button>
                </form>

                <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Yakin hapus foto ini?')" style="flex:1">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-action btn-delete" style="width:100%">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-admin">
            <i class="fas fa-images fa-3x mb-3" style="opacity:0.3"></i>
            <h5>Belum ada foto</h5>
            <p class="text-muted mb-3">Mulai tambahkan foto untuk galeri website Anda</p>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-danger">
                <i class="fas fa-plus me-1"></i> Tambah Foto Pertama
            </a>
        </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $galleries->links() }}
    </div>

</div>
@endsection