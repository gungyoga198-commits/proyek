<!-- GALLERY PAGE -->

<!-- HERO BANNER -->
<section class="relative h-72 flex items-center justify-center overflow-hidden mt-20">
    <img src="/images/gallery2.webp" class="absolute inset-0 w-full h-full object-cover" alt="Gallery Banner">
    <div class="absolute inset-0 bg-black/60 pointer-events-none"></div>
    <div class="relative text-center text-white z-10">
        <p class="tracking-widest text-xs text-yellow-400 mb-3 uppercase">Our Collection</p>
        <h1 class="text-5xl font-semibold tracking-widest">GALLERY</h1>
        <div class="mt-4 w-16 h-0.5 bg-yellow-500 mx-auto"></div>
        <p class="mt-4 text-gray-300 text-sm">Keindahan dan kenyamanan yang kami tawarkan</p>
    </div>
</section>

<!-- BREADCRUMB -->
<div class="bg-white px-16 py-4 border-b text-sm text-gray-500 flex items-center gap-2">
    <a href="{{ route('home') }}" class="hover:text-yellow-600 transition">Home</a>
    <span class="text-gray-300">/</span>
    <span class="text-yellow-600 font-medium">Gallery</span>
</div>

<!-- FILTER TABS -->
<section class="bg-white py-10 px-6">
    <div class="flex justify-center gap-3 flex-wrap">
        <button onclick="filterGallery('all')" id="btn-all"
            class="filter-btn px-6 py-2 text-sm tracking-widest border border-yellow-600 bg-yellow-600 text-white transition">
            ALL
        </button>
        <button onclick="filterGallery('exterior')" id="btn-exterior"
            class="filter-btn px-6 py-2 text-sm tracking-widest border border-gray-300 text-gray-500 hover:border-yellow-600 hover:text-yellow-600 transition">
            EXTERIOR
        </button>
        <button onclick="filterGallery('pool')" id="btn-pool"
            class="filter-btn px-6 py-2 text-sm tracking-widest border border-gray-300 text-gray-500 hover:border-yellow-600 hover:text-yellow-600 transition">
            POOL
        </button>
        <button onclick="filterGallery('room')" id="btn-room"
            class="filter-btn px-6 py-2 text-sm tracking-widest border border-gray-300 text-gray-500 hover:border-yellow-600 hover:text-yellow-600 transition">
            ROOMS
        </button>
    </div>
</section>

<!-- GALLERY GRID -->
<section class="bg-gray-50 pb-24 px-6 md:px-16">
    <div class="max-w-6xl mx-auto columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4" id="gallery-grid">

        <!-- IMAGE 1 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="exterior"
             onclick="openLightbox('/images/gallery1.jpg', 'Villa Exterior with Pool')">
            <img src="/images/gallery1.jpg" class="w-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Villa Exterior">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Villa Exterior</p>
                <p class="text-yellow-400 text-xs tracking-wide">Exterior</p>
            </div>
        </div>

        <!-- IMAGE 2 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="pool"
             onclick="openLightbox('/images/gallery2.webp', 'Private Pool Villa')">
            <img src="/images/gallery2.webp" class="w-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Private Pool">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Private Pool Villa</p>
                <p class="text-yellow-400 text-xs tracking-wide">Pool</p>
            </div>
        </div>

        <!-- IMAGE 3 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="room"
             onclick="openLightbox('/images/Deluxe.jpg', 'Deluxe Room')">
            <img src="/images/Deluxe.jpg" class="w-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Deluxe Room">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Deluxe Room</p>
                <p class="text-yellow-400 text-xs tracking-wide">Rooms</p>
            </div>
        </div>

        <!-- IMAGE 4 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="room"
             onclick="openLightbox('/images/Family.jpg', 'Family Room')">
            <img src="/images/Family.jpg" class="w-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Family Room">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Family Room</p>
                <p class="text-yellow-400 text-xs tracking-wide">Rooms</p>
            </div>
        </div>

        <!-- IMAGE 5 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="room"
             onclick="openLightbox('/images/Presidential.jpg', 'Presidential Suite')">
            <img src="/images/Presidential.jpg" class="w-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Presidential Suite">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Presidential Suite</p>
                <p class="text-yellow-400 text-xs tracking-wide">Rooms</p>
            </div>
        </div>

        <!-- IMAGE 6 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="exterior"
             onclick="openLightbox('/images/OGAG.jpg', 'Hotel Exterior')">
            <img src="/images/OGAG.jpg" class="w-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Hotel Exterior">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Hotel Exterior</p>
                <p class="text-yellow-400 text-xs tracking-wide">Exterior</p>
            </div>
        </div>

        <!-- IMAGE 7 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="pool"
             onclick="openLightbox('/images/gallery2.webp', 'Private Pool')">
            <img src="/images/gallery2.webp" class="w-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Private Pool">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Private Pool</p>
                <p class="text-yellow-400 text-xs tracking-wide">Pool</p>
            </div>
        </div>

        <!-- IMAGE 8 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="pool"
             onclick="openLightbox('/images/gallery1.jpg', 'Pool Area')">
            <img src="/images/gallery1.jpg" class="w-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Pool Area">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Pool Area</p>
                <p class="text-yellow-400 text-xs tracking-wide">Pool</p>
            </div>
        </div>

        <!-- IMAGE 9 -->
        <div class="gallery-item break-inside-avoid group relative overflow-hidden rounded-lg shadow-md cursor-pointer"
             data-category="exterior"
             onclick="openLightbox('/images/gallery1.jpg', 'Villa with Pool')">
            <img src="/images/gallery1.jpg" class="w-full object-cover group-hover:scale-110 transition-transform duration-700 brightness-90" alt="Villa with Pool">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 text-center text-white">
                    <p class="text-2xl mb-1">🔍</p>
                    <p class="text-sm tracking-widest">VIEW</p>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                <p class="text-white text-sm font-semibold">Villa with Pool</p>
                <p class="text-yellow-400 text-xs tracking-wide">Exterior</p>
            </div>
        </div>

    </div>
</section>

<!-- LIGHTBOX -->
<div id="lightbox" class="fixed inset-0 bg-black/90 z-[999] hidden items-center justify-center p-4" onclick="closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white text-4xl hover:text-yellow-400 transition z-50">&times;</button>
    <div class="relative max-w-5xl max-h-[90vh] w-full flex flex-col items-center" onclick="event.stopPropagation()">
        <img id="lightbox-img" src="" class="max-h-[80vh] max-w-full object-contain rounded-lg shadow-2xl" alt="">
        <p id="lightbox-caption" class="text-white text-sm mt-4 tracking-widest text-center"></p>
    </div>
</div>

<script>
    function filterGallery(category) {
        const items = document.querySelectorAll('.gallery-item');
        const buttons = document.querySelectorAll('.filter-btn');

        buttons.forEach(btn => {
            btn.classList.remove('bg-yellow-600', 'text-white', 'border-yellow-600');
            btn.classList.add('border-gray-300', 'text-gray-500');
        });

        const activeBtn = document.getElementById('btn-' + category);
        activeBtn.classList.add('bg-yellow-600', 'text-white', 'border-yellow-600');
        activeBtn.classList.remove('border-gray-300', 'text-gray-500');

        items.forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
                item.style.animation = 'fadeIn 0.4s ease';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function openLightbox(src, caption) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').textContent = caption;
        const lb = document.getElementById('lightbox');
        lb.classList.remove('hidden');
        lb.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lb = document.getElementById('lightbox');
        lb.classList.add('hidden');
        lb.classList.remove('flex');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>