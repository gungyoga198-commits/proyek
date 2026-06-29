<?php $__env->startSection('title', 'Rooms - OGAG Hotel'); ?>

<?php $__env->startSection('content'); ?>

    
    <?php if (isset($component)) { $__componentOriginal88f510bfb80a82fcf17be5022d973193 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal88f510bfb80a82fcf17be5022d973193 = $attributes; } ?>
<?php $component = App\View\Components\Rooms::resolve(['rooms' => $rooms] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('rooms'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Rooms::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal88f510bfb80a82fcf17be5022d973193)): ?>
<?php $attributes = $__attributesOriginal88f510bfb80a82fcf17be5022d973193; ?>
<?php unset($__attributesOriginal88f510bfb80a82fcf17be5022d973193); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal88f510bfb80a82fcf17be5022d973193)): ?>
<?php $component = $__componentOriginal88f510bfb80a82fcf17be5022d973193; ?>
<?php unset($__componentOriginal88f510bfb80a82fcf17be5022d973193); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/rooms.blade.php ENDPATH**/ ?>