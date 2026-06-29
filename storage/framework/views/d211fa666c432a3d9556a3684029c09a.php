<?php $__env->startSection('title', 'Gallery - OGAG Hotel'); ?>

<?php $__env->startSection('content'); ?>

    <?php if (isset($component)) { $__componentOriginal9a832d76029d535741abf550da1dfcb2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a832d76029d535741abf550da1dfcb2 = $attributes; } ?>
<?php $component = App\View\Components\Gallery::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('gallery'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Gallery::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a832d76029d535741abf550da1dfcb2)): ?>
<?php $attributes = $__attributesOriginal9a832d76029d535741abf550da1dfcb2; ?>
<?php unset($__attributesOriginal9a832d76029d535741abf550da1dfcb2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a832d76029d535741abf550da1dfcb2)): ?>
<?php $component = $__componentOriginal9a832d76029d535741abf550da1dfcb2; ?>
<?php unset($__componentOriginal9a832d76029d535741abf550da1dfcb2); ?>
<?php endif; ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/gallery.blade.php ENDPATH**/ ?>