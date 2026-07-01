
<main>

    <?php if (isset($component)) { $__componentOriginale0f6bf82b872605c3c11e5a0889fb708 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f6bf82b872605c3c11e5a0889fb708 = $attributes; } ?>
<?php $component = App\View\Components\PageBanner::resolve(['image' => '/images/OGAG.jpg','eyebrow' => 'RESERVASI','title' => 'BOOK YOUR STAY','subtitle' => 'Pilih kamar dan tanggal menginap Anda'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
        ['label' => 'Booking'],
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

    <?php if(session('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-10 py-3 mt-4 mx-10 rounded text-sm">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <section class="bg-white py-10 px-6 shadow-sm">
        <form action="<?php echo e(route('booking')); ?>" method="GET">
            <div class="max-w-5xl mx-auto">

                <p class="text-xs tracking-widest text-gray-400 uppercase mb-5">Cari Ketersediaan Kamar</p>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

                    
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">Check-In</label>
                        <input type="date" name="checkin"
                            value="<?php echo e($checkin ?? ''); ?>"
                            min="<?php echo e(date('Y-m-d')); ?>"
                            class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500 transition">
                    </div>

                    
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">Check-Out</label>
                        <input type="date" name="checkout"
                            value="<?php echo e($checkout ?? ''); ?>"
                            min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>"
                            class="w-full border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500 transition">
                    </div>

                    
                    <div>
                        <label class="text-xs text-gray-500 font-medium block mb-1 uppercase tracking-wide">
                            Jumlah Tamu <span class="normal-case text-gray-400">(maks. 6)</span>
                        </label>
                        <input type="hidden" name="guests" id="guestsInput" value="<?php echo e($guests ?? 1); ?>">
                        <div class="flex items-center border border-gray-200 rounded overflow-hidden">
                            <button type="button" onclick="changeGuests(-1)"
                                class="px-4 py-2.5 text-gray-500 hover:bg-gray-100 transition text-base font-medium select-none">−</button>
                            <span id="guestsDisplay"
                                class="flex-1 text-center text-sm text-gray-700 font-medium">
                                <?php echo e($guests ?? 1); ?> Tamu
                            </span>
                            <button type="button" onclick="changeGuests(1)"
                                class="px-4 py-2.5 text-gray-500 hover:bg-gray-100 transition text-base font-medium select-none">+</button>
                        </div>
                    </div>

                    
                    <div>
                        <button type="submit"
                            class="w-full bg-yellow-600 hover:bg-yellow-700 transition text-white py-2.5 px-4 text-sm rounded tracking-widest font-medium">
                            CARI KAMAR
                        </button>
                    </div>

                </div>

                
                <?php if($checkin && $checkout): ?>
                    <?php $nights = \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)); ?>
                    <?php if($nights > 0): ?>
                        <div class="mt-4 text-xs text-green-600 font-medium">
                            🌙 Durasi menginap: <?php echo e($nights); ?> malam
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </form>
    </section>

    
    <section class="bg-gray-50 py-16 px-6">
        <div class="max-w-6xl mx-auto">

            <?php if(!$checkin || !$checkout): ?>

                
                <div class="flex flex-col items-center justify-center py-24 text-center">
                    <div class="w-20 h-20 rounded-full bg-yellow-50 flex items-center justify-center mb-6">
                        <svg class="w-9 h-9 text-yellow-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>
                        </svg>
                    </div>
                    <p class="text-xs tracking-widest text-gray-400 uppercase mb-2">Langkah 1</p>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Isi tanggal menginap Anda</h3>
                    <p class="text-sm text-gray-400 max-w-sm leading-relaxed">
                        Pilih tanggal <strong>Check-In</strong> dan <strong>Check-Out</strong>, tentukan jumlah tamu,
                        lalu tekan <span class="text-yellow-600 font-medium">Cari Kamar</span> untuk melihat ketersediaan.
                    </p>
                    <div class="mt-8 w-10 h-0.5 bg-yellow-400 mx-auto"></div>
                </div>

            <?php else: ?>

                
                <div class="text-center mb-12">
                    <p class="text-xs tracking-widest text-gray-400 uppercase mb-1">Pilihan Kamar</p>
                    <h2 class="text-2xl font-semibold">KAMAR TERSEDIA</h2>
                    <div class="mt-3 w-12 h-0.5 bg-yellow-500 mx-auto"></div>
                    <?php $nights = max(1, \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout))); ?>
                    <p class="mt-3 text-sm text-gray-500">
                        <?php echo e(\Carbon\Carbon::parse($checkin)->format('d M Y')); ?>

                        &rarr;
                        <?php echo e(\Carbon\Carbon::parse($checkout)->format('d M Y')); ?>

                        &nbsp;·&nbsp; <?php echo e($nights); ?> malam &nbsp;·&nbsp; <?php echo e($guests); ?> tamu
                    </p>
                </div>

                
                <?php if(count($rooms) === 0): ?>
                    <div class="text-center py-16 text-gray-400 text-sm">
                        Tidak ada kamar tersedia untuk tanggal yang dipilih.
                    </div>
                <?php else: ?>
                <div class="grid md:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isSelected = ($selected ?? '') === $room->nama;
                        $nights     = max(1, \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)));
                        $fasilitas  = is_array($room->fasilitas) ? $room->fasilitas : json_decode($room->fasilitas ?? '[]', true);
                    ?>

                    <div class="bg-white rounded-lg overflow-hidden shadow hover:shadow-xl transition-all duration-300 group
                        <?php echo e($isSelected ? 'ring-2 ring-yellow-500' : 'border border-transparent'); ?>">

                        <div class="relative overflow-hidden">
                            <img src="<?php echo e($room->gambar ? asset('storage/' . $room->gambar) : '/images/OGAG.jpg'); ?>"
                                 class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                                 alt="<?php echo e($room->nama); ?>">
                            <div class="absolute top-3 left-3 bg-yellow-600 text-white text-xs px-3 py-1 tracking-widest">
                                <?php echo e($room->tipe); ?>

                            </div>
                            <?php if($isSelected): ?>
                            <div class="absolute top-3 right-3 bg-green-500 text-white text-xs px-3 py-1 rounded-full">
                                ✓ Dipilih
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-5 text-sm">
                            <p class="font-semibold text-lg"><?php echo e($room->nama); ?></p>
                            <p class="text-gray-400 mb-3 text-xs tracking-wide"><?php echo e($room->pemandangan); ?></p>
                            <p class="text-gray-600 mb-4 leading-relaxed text-xs"><?php echo e($room->deskripsi); ?></p>

                            <div class="grid grid-cols-2 text-gray-500 text-xs gap-y-2 mb-4">
                                <span>👤 <?php echo e($room->kapasitas); ?> Tamu</span>
                                <span>🌿 <?php echo e($room->pemandangan); ?></span>
                                <span>📐 <?php echo e($room->ukuran); ?></span>
                                <span>🛏 <?php echo e($room->tipe_bed); ?></span>
                            </div>

                            <div class="flex flex-wrap gap-1 mb-4">
                                <?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded"><?php echo e($f); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400">Mulai dari</p>
                                    <p class="text-yellow-600 font-semibold text-base">
                                        Rp <?php echo e(number_format($room->harga_per_malam, 0, ',', '.')); ?>

                                        <span class="text-xs text-gray-400 font-normal">/ malam</span>
                                    </p>
                                    <p class="text-xs text-green-600 mt-0.5">
                                        Total: Rp <?php echo e(number_format($room->harga_per_malam * $nights, 0, ',', '.')); ?>

                                    </p>
                                </div>

                                <form action="<?php echo e(route('booking')); ?>" method="GET">
                                    <input type="hidden" name="room"     value="<?php echo e($room->nama); ?>">
                                    <input type="hidden" name="checkin"  value="<?php echo e($checkin); ?>">
                                    <input type="hidden" name="checkout" value="<?php echo e($checkout); ?>">
                                    <input type="hidden" name="guests"   value="<?php echo e($guests); ?>">
                                    <button type="submit"
                                        class="px-4 py-2 text-xs transition
                                        <?php echo e($isSelected
                                            ? 'bg-green-500 text-white cursor-default'
                                            : 'bg-yellow-600 text-white hover:bg-yellow-700'); ?>">
                                        <?php echo e($isSelected ? '✓ DIPILIH' : 'PILIH KAMAR'); ?>

                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>

                
                <?php if($selected && $checkin && $checkout): ?>
                <?php
                    $selectedRoom = $rooms->firstWhere('nama', $selected);
                    $nights       = max(1, \Carbon\Carbon::parse($checkin)->diffInDays(\Carbon\Carbon::parse($checkout)));
                ?>
                <?php if($selectedRoom): ?>
                <div class="mt-10 text-center">
                    <div class="bg-white border border-yellow-200 rounded-lg p-6 max-w-lg mx-auto shadow-md">
                        <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Kamar Dipilih</p>
                        <p class="font-semibold text-xl mb-1 text-gray-800"><?php echo e($selected); ?></p>
                        <p class="text-yellow-600 text-sm mb-5">
                            Rp <?php echo e(number_format($selectedRoom->harga_per_malam, 0, ',', '.')); ?>

                            × <?php echo e($nights); ?> malam =
                            <strong>Rp <?php echo e(number_format($selectedRoom->harga_per_malam * $nights, 0, ',', '.')); ?></strong>
                        </p>
                        <a href="<?php echo e(route('booking.form')); ?>?room=<?php echo e(urlencode($selected)); ?>&checkin=<?php echo e($checkin); ?>&checkout=<?php echo e($checkout); ?>&guests=<?php echo e($guests); ?>"
                            class="block w-full bg-yellow-600 text-white py-3 text-sm hover:bg-yellow-700 transition rounded tracking-wide text-center">
                            LANJUTKAN KE FORMULIR RESERVASI →
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </section>

</main>

<script>
    function changeGuests(delta) {
        const input   = document.getElementById('guestsInput');
        const display = document.getElementById('guestsDisplay');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > 6) val = 6;
        input.value   = val;
        display.textContent = val + ' Tamu';
    }
</script><?php /**PATH C:\laragon\www\proyek\resources\views/components/booking.blade.php ENDPATH**/ ?>