<div class="bg-white px-16 py-4 border-b text-sm text-gray-500 flex items-center gap-1">

    <a href="<?php echo e(route('home')); ?>" class="hover:text-yellow-600 transition">Home</a>

    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <span class="mx-1 text-gray-300">/</span>

        <?php if(isset($link['route'])): ?>
            <a href="<?php echo e(route($link['route'])); ?>" class="hover:text-yellow-600 transition">
                <?php echo e($link['label']); ?>

            </a>
        <?php else: ?>
            <span class="text-yellow-600 font-medium"><?php echo e($link['label']); ?></span>
        <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div><?php /**PATH C:\laragon\www\proyek\resources\views/components/breadcrumb.blade.php ENDPATH**/ ?>