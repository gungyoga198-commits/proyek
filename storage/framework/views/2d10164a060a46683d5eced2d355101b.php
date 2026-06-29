<section class="relative h-72 flex items-center justify-center overflow-hidden">
    <img src="<?php echo e($image); ?>" class="absolute inset-0 w-full h-full object-cover" alt="<?php echo e($title); ?>">
    <div class="absolute inset-0 <?php echo e($overlay); ?> pointer-events-none"></div>

    <div class="relative text-center text-white z-10 px-4">

        <?php if($eyebrow): ?>
            <p class="tracking-widest text-sm text-yellow-400 mb-2 uppercase"><?php echo e($eyebrow); ?></p>
        <?php endif; ?>

        <h1 class="text-4xl font-semibold tracking-widest"><?php echo e($title); ?></h1>

        <?php if($showLine): ?>
            <div class="mt-4 w-16 h-0.5 bg-yellow-500 mx-auto"></div>
        <?php endif; ?>

        <?php if($subtitle): ?>
            <p class="mt-4 text-gray-300 text-sm"><?php echo e($subtitle); ?></p>
        <?php endif; ?>

    </div>
</section><?php /**PATH C:\laragon\www\proyek\resources\views/components/page-banner.blade.php ENDPATH**/ ?>