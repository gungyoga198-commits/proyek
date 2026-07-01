<!-- GALLERY PAGE -->

<!-- HERO BANNER -->
<section class="relative h-72 flex items-center justify-center overflow-hidden">
    <?php
        $heroImage = $galleries->first()
            ? asset('storage/' . $galleries->first()->foto)
            : asset('images/gallery2.webp');
    ?>
    <img src="<?php echo e($heroImage); ?>" class="absolute inset-0 w-full h-full object-cover" alt="Gallery Banner">
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
    <a href="<?php echo e(route('home')); ?>" class="hover:text-yellow-600 transition">Home</a>
    <span class="text-gray-300">/</span>
    <span class="text-yellow-600 font-medium">Gallery</span>
</div>

<!-- FILTER TABS (dibuat otomatis dari kategori yang ada di database) -->
<?php if($galleries->isNotEmpty()): ?>
<section class="bg-white py-10 px-6">
    <div class="flex justify-center gap-3 flex-wrap" id="filter-tabs">
        <button onclick="filterGallery('all', this)"
            class="filter-btn px-6 py-2 text-sm tracking-widest border border-yellow-600 bg-yellow-600 text-white transition rounded-full">
            ALL
        </button>
        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button onclick="filterGallery('<?php echo e($k); ?>', this)"
            class="filter-btn px-6 py-2 text-sm tracking-widest border border-gray-300 text-gray-500 hover:border-yellow-600 hover:text-yellow-600 transition rounded-full">
            <?php echo e(strtoupper($k)); ?>

        </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php endif; ?>

<!-- GALLERY GRID -->
<section class="bg-gray-50 pb-24 px-6 md:px-16 <?php echo e($galleries->isEmpty() ? 'pt-16' : ''); ?>">

    <?php if($galleries->isEmpty()): ?>
    
    <div class="max-w-md mx-auto text-center py-16">
        <div class="w-20 h-20 mx-auto mb-5 rounded-full bg-yellow-50 flex items-center justify-center">
            <svg class="w-9 h-9 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Galeri Belum Tersedia</h3>
        <p class="text-sm text-gray-400">Foto-foto terbaru akan segera kami tambahkan di sini.</p>
    </div>
    <?php else: ?>

    <div class="max-w-6xl mx-auto columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6" id="gallery-grid">
        <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="gallery-item break-inside-avoid group cursor-pointer opacity-0"
             style="animation: fadeInUp 0.6s ease forwards; animation-delay: <?php echo e(min($i * 0.08, 0.8)); ?>s;"
             data-category="<?php echo e($item->kategori); ?>"
             onclick="openLightbox('<?php echo e(asset('storage/' . $item->foto)); ?>', '<?php echo e(addslashes($item->judul)); ?>')">

            <div class="relative border-2 border-yellow-500/70 rounded-xl p-1.5
                        group-hover:border-yellow-500 group-hover:shadow-xl group-hover:-translate-y-1
                        transition-all duration-300 shadow-md bg-white">
                <div class="relative overflow-hidden rounded-lg">
                    <img src="<?php echo e(asset('storage/' . $item->foto)); ?>"
                         loading="lazy"
                         class="w-full object-cover group-hover:scale-110 transition-transform duration-700"
                         alt="<?php echo e($item->judul); ?>">

                    
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300
                                flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 scale-90 group-hover:scale-100
                                    transition-all duration-300 text-center text-white">
                            <svg class="w-7 h-7 mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/>
                            </svg>
                            <p class="text-xs tracking-widest">LIHAT</p>
                        </div>
                    </div>

                    
                    <span class="absolute top-3 left-3 bg-black/60 text-yellow-400 text-[10px] font-semibold
                                 tracking-wider uppercase px-2.5 py-1 rounded-full backdrop-blur-sm">
                        <?php echo e($item->kategori); ?>

                    </span>

                    
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4
                                translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <p class="text-white text-sm font-semibold leading-tight"><?php echo e($item->judul); ?></p>
                        <?php if($item->deskripsi): ?>
                        <p class="text-gray-300 text-xs mt-0.5 line-clamp-1"><?php echo e($item->deskripsi); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <p id="no-result" class="hidden text-center text-gray-400 text-sm mt-10">
        Tidak ada foto untuk kategori ini.
    </p>

    <?php endif; ?>
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
    function filterGallery(category, btn) {
        const items = document.querySelectorAll('.gallery-item');
        const buttons = document.querySelectorAll('.filter-btn');
        const noResult = document.getElementById('no-result');
        let visibleCount = 0;

        buttons.forEach(b => {
            b.classList.remove('bg-yellow-600', 'text-white', 'border-yellow-600');
            b.classList.add('border-gray-300', 'text-gray-500');
        });
        btn.classList.add('bg-yellow-600', 'text-white', 'border-yellow-600');
        btn.classList.remove('border-gray-300', 'text-gray-500');

        items.forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
                item.style.animation = 'fadeIn 0.4s ease';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (noResult) {
            noResult.classList.toggle('hidden', visibleCount > 0);
        }
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

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style><?php /**PATH C:\laragon\www\proyek\resources\views/components/gallery.blade.php ENDPATH**/ ?>