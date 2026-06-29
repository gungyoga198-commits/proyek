@extends('layouts.admin')

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
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }
    .gallery-admin-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.13);
    }
    .gallery-admin-card.nonaktif {
        opacity: 0.75;
        border-color: #ffcdd2;
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
        transition: transform 0.4s ease;
    }
    .gallery-admin-card:hover .card-img-wrap img {
        transform: scale(1.05);
    }

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
        background: rgba(229,57,53,0.9);
        color: #fff;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
    }

    .card-body-admin { padding: 14px 16px; }
    .card-body-admin h6 {
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 6px;
        color: #222;
        line-height: 1.3;
    }
    .card-desc {
        font-size: 0.8rem;
        color: #888;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 40px;
    }

    .card-actions {
        padding: 0 16px 14px;
        display: flex;
        gap: 6px;
    }
    .btn-action {
        flex: 1;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-align: center;
        transition: all 0.2s;
    }
    .btn-edit  { background: #e3f2fd; color: #1565c0; }
    .btn-toggle { background: #e8f5e9; color: #2e7d32; }
    .btn-delete { background: #ffebee; color: #c62828; }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 18px;
        text-align: center;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    }
    .stat-num { font-size: 1.8rem; font-weight: 800; color: #1a1a2e; }
    .stat-label { font-size: 0.8rem; color: #666; margin-top: 4px; }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="page-header">
        <div>
            <h4><i class="fas fa-images me-2"></i> Kelola Gallery</h4>
            <p>Kelola foto-foto yang ditampilkan di website</p>
        </div>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-danger px-4 py-2 fw-bold">
            <i class="fas fa-plus me-2"></i> Tambah Foto Baru
        </a>
    </div>

    <!-- SUCCESS ALERT -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- STATS -->
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-num">{{ $galleries->total() }}</div>
            <div class="stat-label">Total Foto</div>
        </div>
        <div class="stat-card">
            <div class="stat-num text-success">{{ $galleries->where('aktif', true)->count() }}</div>
            <div class="stat-label">Foto Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-num text-danger">{{ $galleries->where('aktif', false)->count() }}</div>
            <div class="stat-label">Foto Nonaktif</div>
        </div>
    </div>

    <!-- GALLERY GRID -->
    <div class="gallery-admin-grid">
        @forelse($galleries as $item)
        <div class="gallery-admin-card {{ !$item->aktif ? 'nonaktif' : '' }}">
            <div class="card-img-wrap">
                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                <div class="card-badges">
                    <span class="badge-kategori">{{ $item->kategori }}</span>
                    @if(!$item->aktif)
                        <span class="badge-nonaktif">NONAKTIF</span>
                    @endif
                </div>
            </div>

            <div class="card-body-admin">
                <h6 title="{{ $item->judul }}">{{ $item->judul }}</h6>
                <p class="card-desc">{{ Str::limit($item->deskripsi, 80) ?: 'Tidak ada deskripsi' }}</p>
            </div>

            <div class="card-actions">
                <a href="{{ route('admin.gallery.edit', $item) }}" class="btn-action btn-edit">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" 
                      onsubmit="return confirm('Yakin hapus foto ini?')" style="flex:1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="empty-admin text-center py-5">
            <i class="fas fa-images fa-4x mb-3 opacity-25"></i>
            <h5>Belum ada foto</h5>
            <p class="text-muted">Tambahkan foto pertama untuk galeri website Anda</p>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-danger mt-3">
                <i class="fas fa-plus"></i> Tambah Foto Pertama
            </a>
        </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center mt-5">
        {{ $galleries->links() }}
    </div>

</div>
@endsection