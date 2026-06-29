@extends('layouts.app')

@section('title', 'Gallery')

@push('styles')
<style>
    /* ===== GALLERY PAGE ===== */
    .gallery-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        padding: 80px 0 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .gallery-hero::before {
        content: '';
        position: absolute;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(229,57,53,0.15) 0%, transparent 70%);
        top: -100px; right: -100px;
        border-radius: 50%;
    }
    .gallery-hero::after {
        content: '';
        position: absolute;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(100,181,246,0.1) 0%, transparent 70%);
        bottom: -80px; left: -80px;
        border-radius: 50%;
    }
    .gallery-hero h1 {
        font-size: 3rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: -1px;
        margin-bottom: 12px;
        position: relative; z-index: 1;
    }
    .gallery-hero h1 span {
        background: linear-gradient(90deg, #e53935, #64b5f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .gallery-hero p {
        color: rgba(255,255,255,0.65);
        font-size: 1.1rem;
        position: relative; z-index: 1;
    }

    /* ===== FILTER TABS ===== */
    .filter-section {
        background: #fff;
        padding: 24px 0 0;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    }
    .filter-tabs {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 0;
        scrollbar-width: none;
        justify-content: center;
        flex-wrap: wrap;
    }
    .filter-tabs::-webkit-scrollbar { display: none; }
    .filter-btn {
        padding: 10px 22px;
        border: 2px solid #e0e0e0;
        border-radius: 50px;
        background: transparent;
        color: #555;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.25s ease;
        white-space: nowrap;
        text-transform: capitalize;
    }
    .filter-btn:hover {
        border-color: #e53935;
        color: #e53935;
        background: rgba(229,57,53,0.05);
    }
    .filter-btn.active {
        background: #e53935;
        border-color: #e53935;
        color: #fff;
        box-shadow: 0 4px 15px rgba(229,57,53,0.35);
    }
    .filter-underline {
        height: 3px;
        background: linear-gradient(90deg, #e53935, #64b5f6);
        margin-top: 20px;
        border-radius: 3px 3px 0 0;
    }

    /* ===== GALLERY GRID ===== */
    .gallery-section {
        padding: 48px 0 80px;
        background: #f8f9fa;
        min-height: 50vh;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
    .gallery-item {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        aspect-ratio: 4/3;
    }
    .gallery-item:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.18);
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
        display: block;
    }
    .gallery-item:hover img {
        transform: scale(1.07);
    }
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0) 50%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .gallery-overlay-content h5 {
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        margin: 0 0 4px;
    }
    .gallery-overlay-content span {
        color: rgba(255,255,255,0.7);
        font-size: 0.78rem;
        text-transform: capitalize;
        background: rgba(229,57,53,0.8);
        padding: 2px 10px;
        border-radius: 20px;
    }
    .gallery-zoom-icon {
        position: absolute;
        top: 14px; right: 14px;
        width: 36px; height: 36px;
        background: rgba(255,255,255,0.9);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        color: #333;
        font-size: 0.9rem;
    }
    .gallery-item:hover .gallery-zoom-icon { opacity: 1; }

    /* ===== CATEGORY BADGE ===== */
    .gallery-kategori-badge {
        position: absolute;
        top: 12px; left: 12px;
        background: rgba(0,0,0,0.6);
        color: #fff;
        font-size: 0.72rem;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
        text-transform: capitalize;
        backdrop-filter: blur(4px);
    }

    /* ===== EMPTY STATE ===== */
    .empty-gallery {
        text-align: center;
        padding: 80px 20px;
        color: #aaa;
        grid-column: 1 / -1;
    }
    .empty-gallery i { font-size: 4rem; margin-bottom: 16px; display: block; opacity: 0.4; }

    /* ===== LIGHTBOX ===== */
    .lightbox-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.94);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.25s ease;
    }
    .lightbox-overlay.show { display: flex; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    .lightbox-container {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .lightbox-img {
        max-width: 85vw;
        max-height: 75vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }
    .lightbox-info {
        text-align: center;
        margin-top: 20px;
        color: #fff;
    }
    .lightbox-info h4 { font-size: 1.2rem; font-weight: 700; margin-bottom: 6px; }
    .lightbox-info p { color: rgba(255,255,255,0.6); font-size: 0.9rem; max-width: 500px; }
    .lightbox-close {
        position: fixed;
        top: 20px; right: 24px;
        background: rgba(255,255,255,0.12);
        border: none;
        color: #fff;
        width: 44px; height: 44px;
        border-radius: 50%;
        font-size: 1.3rem;
        cursor: pointer;
        transition: background 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .lightbox-close:hover { background: rgba(229,57,53,0.8); }
    .lightbox-nav {
        position: fixed;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255,255,255,0.12);
        border: none;
        color: #fff;
        width: 48px; height: 48px;
        border-radius: 50%;
        font-size: 1.3rem;
        cursor: pointer;
        transition: background 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .lightbox-nav:hover { background: rgba(229,57,53,0.8); }
    .lightbox-prev { left: 16px; }
    .lightbox-next { right: 16px; }
    .lightbox-counter {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255,255,255,0.55);
        font-size: 0.85rem;
    }

    /* ===== STATS BAR ===== */
    .gallery-stats {
        background: #fff;
        padding: 14px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .gallery-stats .stat-text {
        color: #666;
        font-size: 0.9rem;
    }
    .gallery-stats .stat-text strong { color: #333; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .gallery-hero h1 { font-size: 2rem; }
        .gallery-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .lightbox-nav { display: none; }
    }
    @media (max-width: 480px) {
        .gallery-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="gallery-hero">
    <div class="container">
        <h1>Galeri <span>Foto</span></h1>
        <p>Momen-momen terbaik yang kami abadikan</p>
    </div>
</section>

{{-- FILTER --}}
<div class="filter-section">
    <div class="container">
        <div class="filter-tabs">
            <button class="filter-btn {{ $kategori == 'semua' ? 'active' : '' }}"
                    data-filter="semua">
                Semua
            </button>
            @foreach($kategoris as $k)
            <button class="filter-btn {{ $kategori == $k ? 'active' : '' }}"
                    data-filter="{{ $k }}">
                {{ ucfirst($k) }}
            </button>
            @endforeach
        </div>
        <div class="filter-underline"></div>
    </div>
</div>

{{-- STATS --}}
<div class="gallery-stats">
    <div class="container">
        <span class="stat-text">
            Menampilkan <strong id="visibleCount">{{ count($galleries) }}</strong> foto
            @if($kategori != 'semua')
                dalam kategori <strong>{{ ucfirst($kategori) }}</strong>
            @endif
        </span>
    </div>
</div>

{{-- GALLERY GRID --}}
<section class="gallery-section">
    <div class="container">
        <div class="gallery-grid" id="galleryGrid">
            @forelse($galleries as $index => $item)
            <div class="gallery-item"
                 data-kategori="{{ $item->kategori }}"
                 data-index="{{ $index }}"
                 onclick="openLightbox({{ $index }})">

                <img src="{{ asset('storage/' . $item->foto) }}"
                     alt="{{ $item->judul }}"
                     loading="lazy">

                <span class="gallery-kategori-badge">{{ $item->kategori }}</span>

                <div class="gallery-zoom-icon">
                    <i class="fas fa-search-plus"></i>
                </div>

                <div class="gallery-overlay">
                    <div class="gallery-overlay-content">
                        <h5>{{ $item->judul }}</h5>
                        <span>{{ $item->kategori }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-gallery">
                <i class="fas fa-images"></i>
                <h5>Belum ada foto</h5>
                <p>Foto akan ditampilkan di sini setelah ditambahkan oleh admin.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- LIGHTBOX --}}
<div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightboxOutside(event)">
    <button class="lightbox-close" onclick="closeLightbox()">
        <i class="fas fa-times"></i>
    </button>
    <button class="lightbox-nav lightbox-prev" onclick="changeLightbox(-1)">
        <i class="fas fa-chevron-left"></i>
    </button>
    <button class="lightbox-nav lightbox-next" onclick="changeLightbox(1)">
        <i class="fas fa-chevron-right"></i>
    </button>

    <div class="lightbox-container">
        <img src="" alt="" class="lightbox-img" id="lightboxImg">
        <div class="lightbox-info">
            <h4 id="lightboxTitle"></h4>
            <p id="lightboxDesc"></p>
        </div>
    </div>

    <div class="lightbox-counter" id="lightboxCounter"></div>
</div>

@endsection

@push('scripts')
<script>
    // Data gallery dari Blade
    const galleryData = @json($galleries->map(fn($g) => [
        'judul'     => $g->judul,
        'deskripsi' => $g->deskripsi ?? '',
        'foto'      => asset('storage/' . $g->foto),
        'kategori'  => $g->kategori,
    ]));

    let currentIndex = 0;

    // ===== LIGHTBOX =====
    function openLightbox(index) {
        currentIndex = index;
        updateLightbox();
        document.getElementById('lightboxOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function updateLightbox() {
        const item = galleryData[currentIndex];
        document.getElementById('lightboxImg').src = item.foto;
        document.getElementById('lightboxImg').alt = item.judul;
        document.getElementById('lightboxTitle').textContent = item.judul;
        document.getElementById('lightboxDesc').textContent = item.deskripsi;
        document.getElementById('lightboxCounter').textContent =
            (currentIndex + 1) + ' / ' + galleryData.length;
    }

    function changeLightbox(dir) {
        currentIndex = (currentIndex + dir + galleryData.length) % galleryData.length;
        updateLightbox();
    }

    function closeLightbox() {
        document.getElementById('lightboxOverlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    function closeLightboxOutside(e) {
        if (e.target === document.getElementById('lightboxOverlay')) closeLightbox();
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const overlay = document.getElementById('lightboxOverlay');
        if (!overlay.classList.contains('show')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') changeLightbox(-1);
        if (e.key === 'ArrowRight') changeLightbox(1);
    });

    // ===== FILTER =====
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;

            // Update URL tanpa reload
            const url = new URL(window.location);
            if (filter === 'semua') {
                url.searchParams.delete('kategori');
            } else {
                url.searchParams.set('kategori', filter);
            }
            window.history.pushState({}, '', url);

            // Filter items
            const items = document.querySelectorAll('.gallery-item');
            let visible = 0;
            items.forEach(item => {
                const match = filter === 'semua' || item.dataset.kategori === filter;
                item.style.display = match ? 'block' : 'none';
                if (match) visible++;
            });

            document.getElementById('visibleCount').textContent = visible;
        });
    });
</script>
@endpush