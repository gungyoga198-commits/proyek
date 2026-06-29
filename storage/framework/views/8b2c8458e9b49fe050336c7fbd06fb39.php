<?php $__env->startSection('title', 'Booking'); ?>

<?php $__env->startSection('content'); ?>

    <?php if (isset($component)) { $__componentOriginal5379d7c313a3003ffeb1e9f8c8b1be8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5379d7c313a3003ffeb1e9f8c8b1be8a = $attributes; } ?>
<?php $component = App\View\Components\Booking::resolve(['rooms' => $rooms,'selected' => $selected,'checkin' => $checkin,'checkout' => $checkout,'guests' => $guests] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('booking'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Booking::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5379d7c313a3003ffeb1e9f8c8b1be8a)): ?>
<?php $attributes = $__attributesOriginal5379d7c313a3003ffeb1e9f8c8b1be8a; ?>
<?php unset($__attributesOriginal5379d7c313a3003ffeb1e9f8c8b1be8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5379d7c313a3003ffeb1e9f8c8b1be8a)): ?>
<?php $component = $__componentOriginal5379d7c313a3003ffeb1e9f8c8b1be8a; ?>
<?php unset($__componentOriginal5379d7c313a3003ffeb1e9f8c8b1be8a); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/booking.blade.php ENDPATH**/ ?>