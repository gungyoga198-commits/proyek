<?php $__env->startSection('title', 'Detail Rooms'); ?>

<?php $__env->startSection('content'); ?>

    <?php if (isset($component)) { $__componentOriginalcfd6aff5e8087f7c0bf4df1d8637a17e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcfd6aff5e8087f7c0bf4df1d8637a17e = $attributes; } ?>
<?php $component = App\View\Components\Roomsdetail::resolve(['room' => $room] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('roomsdetail'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Roomsdetail::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcfd6aff5e8087f7c0bf4df1d8637a17e)): ?>
<?php $attributes = $__attributesOriginalcfd6aff5e8087f7c0bf4df1d8637a17e; ?>
<?php unset($__attributesOriginalcfd6aff5e8087f7c0bf4df1d8637a17e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcfd6aff5e8087f7c0bf4df1d8637a17e)): ?>
<?php $component = $__componentOriginalcfd6aff5e8087f7c0bf4df1d8637a17e; ?>
<?php unset($__componentOriginalcfd6aff5e8087f7c0bf4df1d8637a17e); ?>
<?php endif; ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/room-detail.blade.php ENDPATH**/ ?>