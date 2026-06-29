<!-- CONTACT HERO -->
    <?php if (isset($component)) { $__componentOriginale0f6bf82b872605c3c11e5a0889fb708 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f6bf82b872605c3c11e5a0889fb708 = $attributes; } ?>
<?php $component = App\View\Components\PageBanner::resolve(['image' => '/images/contact.jpg','eyebrow' => 'Hubungi Kami','title' => 'CONTACT','subtitle' => 'Siap membantu kalau ada kendala','overlay' => 'bg-black/60'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\PageBanner::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0f6bf82b872605c3c11e5a0889fb708)): ?>
<?php $attributes = $__attributesOriginale0f6bf82b872605c3c11e5a0889fb708; ?>
<?php unset($__attributesOriginale0f6bf82b872605c3c11e5a0889fb708); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0f6bf82b872605c3c11e5a0889fb708)): ?>
<?php $component = $__componentOriginale0f6bf82b872605c3c11e5a0889fb708; ?>
<?php unset($__componentOriginale0f6bf82b872605c3c11e5a0889fb708); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginal269900abaed345884ce342681cdc99f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal269900abaed345884ce342681cdc99f6 = $attributes; } ?>
<?php $component = App\View\Components\Breadcrumb::resolve(['links' => [
        ['label' => 'Contact'],
    ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Breadcrumb::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $attributes = $__attributesOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__attributesOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal269900abaed345884ce342681cdc99f6)): ?>
<?php $component = $__componentOriginal269900abaed345884ce342681cdc99f6; ?>
<?php unset($__componentOriginal269900abaed345884ce342681cdc99f6); ?>
<?php endif; ?>

<!-- CONTACT CONTENT -->
<section class="w-full bg-white py-16 px-10">
    <div class="max-w-6xl w-full mx-auto">

        <h3 class="text-3xl md:text-4xl font-semibold text-yellow-600 text-center mb-16">
            Get in Touch
        </h3>

        <div class="grid md:grid-cols-2 gap-10">

            <!-- LEFT SIDE -->
            <div class="space-y-6 text-sm">
                <div class="flex items-center gap-4">
                    <div class="bg-gray-100 p-3 rounded-full">📞</div>
                    <div>
                        <p class="font-semibold">Phone</p>
                        <p class="text-yellow-600">08980563855</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-gray-100 p-3 rounded-full">💬</div>
                    <div>
                        <p class="font-semibold">Whatsapp</p>
                        <p class="text-yellow-600">08980563855</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-gray-100 p-3 rounded-full">📍</div>
                    <div>
                        <p class="font-semibold">Address</p>
                        <p class="text-gray-600">Jl. Astasura No.1</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="bg-gray-100 p-3 rounded-full">✉️</div>
                    <div>
                        <p class="font-semibold">Email</p>
                        <p class="text-yellow-600">reservation@ogagresort.com</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE (MAP) -->
            <div class="w-full h-[500px] md:h-full">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d246.5518975295231!2d115.21320046968638!3d-8.61228011398708!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sastasura%20no.1!5e0!3m2!1sid!2sid!4v1775530660292!5m2!1sid!2sid"
                    class="w-full h-full border-0 rounded-lg shadow"
                    loading="lazy">
                </iframe>
            </div>

        </div>
    </div>
</section><?php /**PATH C:\laragon\www\proyek\resources\views/components/contact.blade.php ENDPATH**/ ?>