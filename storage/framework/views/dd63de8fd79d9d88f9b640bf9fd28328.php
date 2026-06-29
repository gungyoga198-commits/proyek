<?php $__env->startSection('title', 'Cek Reservasi'); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal7c800a8119867511e3a82542b2feae5b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c800a8119867511e3a82542b2feae5b = $attributes; } ?>
<?php $component = App\View\Components\CekReservasi::resolve(['reservations' => $reservations ?? null] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('cek-reservasi'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CekReservasi::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c800a8119867511e3a82542b2feae5b)): ?>
<?php $attributes = $__attributesOriginal7c800a8119867511e3a82542b2feae5b; ?>
<?php unset($__attributesOriginal7c800a8119867511e3a82542b2feae5b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c800a8119867511e3a82542b2feae5b)): ?>
<?php $component = $__componentOriginal7c800a8119867511e3a82542b2feae5b; ?>
<?php unset($__componentOriginal7c800a8119867511e3a82542b2feae5b); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/cek-reservasi.blade.php ENDPATH**/ ?>