<?php $__env->startSection('title', 'Kelola Gallery'); ?>
<?php $__env->startSection('subtitle', 'Kelola foto-foto yang ditampilkan di website'); ?>

<?php $__env->startSection('content'); ?>


<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Total <?php echo e($galleries->total()); ?> foto terdaftar</p>
    </div>
    <a href="<?php echo e(route('admin.gallery.create')); ?>"
       class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Foto Baru
    </a>
</div>


<?php if(session('success')): ?>
<div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>


<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4 text-center">
        <p class="text-2xl font-bold text-gray-800"><?php echo e($galleries->total()); ?></p>
        <p class="text-xs text-gray-500 mt-1">Total Foto</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4 text-center">
        <p class="text-2xl font-bold text-green-600"><?php echo e($galleries->where('aktif', true)->count()); ?></p>
        <p class="text-xs text-gray-500 mt-1">Foto Aktif</p>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 px-5 py-4 text-center">
        <p class="text-2xl font-bold text-red-500"><?php echo e($galleries->where('aktif', false)->count()); ?></p>
        <p class="text-xs text-gray-500 mt-1">Foto Nonaktif</p>
    </div>
</div>


<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    <?php $__empty_1 = true; $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition
                <?php echo e(!$item->aktif ? 'opacity-70 border-red-100' : ''); ?>">

        
        <div class="relative aspect-[4/3] bg-gray-100 overflow-hidden">
            <img src="<?php echo e(asset('storage/' . $item->foto)); ?>" alt="<?php echo e($item->judul); ?>"
                 class="w-full h-full object-cover">
            <div class="absolute top-2 left-2 flex items-center gap-1.5">
                <span class="bg-black/60 text-white text-[11px] font-semibold px-2.5 py-1 rounded-full capitalize backdrop-blur-sm">
                    <?php echo e($item->kategori); ?>

                </span>
                <?php if(!$item->aktif): ?>
                <span class="bg-red-500/90 text-white text-[11px] font-semibold px-2.5 py-1 rounded-full">
                    Nonaktif
                </span>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="px-4 py-3">
            <p class="font-medium text-gray-800 text-sm truncate" title="<?php echo e($item->judul); ?>"><?php echo e($item->judul); ?></p>
            <p class="text-xs text-gray-400 mt-1 line-clamp-2 min-h-[2rem]">
                <?php echo e($item->deskripsi ? Str::limit($item->deskripsi, 80) : 'Tidak ada deskripsi'); ?>

            </p>
        </div>

        
        <div class="flex items-center gap-2 px-4 pb-4">
            <a href="<?php echo e(route('admin.gallery.edit', $item)); ?>"
               class="flex-1 inline-flex items-center justify-center gap-1 text-xs bg-yellow-50 text-yellow-700 hover:bg-yellow-100 px-3 py-1.5 rounded-lg transition font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
            </a>

            <form action="<?php echo e(route('admin.gallery.destroy', $item)); ?>" method="POST"
                  onsubmit="return confirm('Yakin hapus foto <?php echo e($item->judul); ?>?')" class="flex-1">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="col-span-full bg-white rounded-2xl shadow-sm border border-gray-100 px-6 py-16 text-center text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="font-medium">Belum ada foto</p>
        <p class="text-xs mt-1 mb-4">Tambahkan foto pertama untuk galeri website Anda</p>
        <a href="<?php echo e(route('admin.gallery.create')); ?>"
           class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Foto Pertama
        </a>
    </div>
    <?php endif; ?>
</div>


<?php if($galleries->hasPages()): ?>
<div class="mt-6">
    <?php echo e($galleries->links()); ?>

</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/admin/gallery/index.blade.php ENDPATH**/ ?>