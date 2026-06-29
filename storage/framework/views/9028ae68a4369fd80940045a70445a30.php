<?php $__env->startSection('content'); ?>

<?php if (isset($component)) { $__componentOriginal0f175370cc19626e362f7b4cb5002ea7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0f175370cc19626e362f7b4cb5002ea7 = $attributes; } ?>
<?php $component = App\View\Components\Contact::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('contact'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Contact::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0f175370cc19626e362f7b4cb5002ea7)): ?>
<?php $attributes = $__attributesOriginal0f175370cc19626e362f7b4cb5002ea7; ?>
<?php unset($__attributesOriginal0f175370cc19626e362f7b4cb5002ea7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0f175370cc19626e362f7b4cb5002ea7)): ?>
<?php $component = $__componentOriginal0f175370cc19626e362f7b4cb5002ea7; ?>
<?php unset($__componentOriginal0f175370cc19626e362f7b4cb5002ea7); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/contact.blade.php ENDPATH**/ ?>