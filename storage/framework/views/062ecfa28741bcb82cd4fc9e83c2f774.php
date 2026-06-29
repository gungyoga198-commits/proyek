
<main>


    <?php if (isset($component)) { $__componentOriginale0f6bf82b872605c3c11e5a0889fb708 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0f6bf82b872605c3c11e5a0889fb708 = $attributes; } ?>
<?php $component = App\View\Components\PageBanner::resolve(['image' => '/images/OGAG.jpg','eyebrow' => 'STATUS PEMESANAN','title' => 'CEK RESERVASI','subtitle' => 'Masukkan kode booking atau email untuk melihat status reservasi Anda'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
        ['label' => 'Cek Reservasi'],
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

    <section class="bg-gray-50 py-16 px-6">
        <div class="max-w-xl mx-auto">

            
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8 mb-8">
                <h2 class="font-semibold text-lg mb-1">Lacak Pemesanan Anda</h2>
                <p class="text-gray-400 text-xs mb-6">Masukkan kode booking atau email untuk menemukan reservasi Anda.</p>

                
                <form action="<?php echo e(route('reservasi.cek')); ?>" method="POST" class="mb-4">
                    <?php echo csrf_field(); ?>
                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Cari dengan Kode Booking</label>
                    <div class="flex gap-2">
                        <input type="text" name="kode_booking"
                            value="<?php echo e(old('kode_booking')); ?>"
                            placeholder="Contoh: OGAG-A1B2C3D4"
                            class="flex-1 border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500 uppercase tracking-widest">
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 text-sm hover:bg-yellow-700 transition rounded whitespace-nowrap">
                            CARI
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Kode booking ada di halaman konfirmasi atau email Anda.</p>
                </form>

                <div class="flex items-center gap-3 my-5">
                    <div class="flex-1 h-px bg-gray-200"></div>
                    <span class="text-xs text-gray-400">atau</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                
                <form action="<?php echo e(route('reservasi.cek')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <label class="block text-xs font-medium text-gray-600 mb-1 uppercase tracking-wide">Cari dengan Email</label>
                    <div class="flex gap-2">
                        <input type="email" name="email"
                            value="<?php echo e(old('email')); ?>"
                            placeholder="Email yang digunakan saat reservasi"
                            class="flex-1 border border-gray-200 rounded px-3 py-2.5 text-sm focus:outline-none focus:border-yellow-500">
                        <button type="submit" class="bg-yellow-600 text-white px-4 py-2 text-sm hover:bg-yellow-700 transition rounded whitespace-nowrap">
                            CARI
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Akan menampilkan semua reservasi dengan email tersebut.</p>
                </form>

                
                <?php if(session('error')): ?>
                <div class="mt-4 bg-red-50 border border-red-200 text-red-600 rounded px-4 py-3 text-sm">
                    <?php echo e(session('error')); ?>

                </div>
                <?php endif; ?>
            </div>

            
            <?php if(isset($reservations)): ?>

                <?php if($reservations->count() > 0): ?>
                <p class="text-sm text-gray-500 mb-4">Ditemukan <strong><?php echo e($reservations->count()); ?></strong> reservasi:</p>

                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $statusConfig = match($r->status) {
                        'pending'     => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500', 'label' => 'Menunggu Konfirmasi'],
                        'confirmed'   => ['bg' => 'bg-blue-100',   'text' => 'text-blue-700',   'dot' => 'bg-blue-500',   'label' => 'Dikonfirmasi'],
                        'checked_in'  => ['bg' => 'bg-green-100',  'text' => 'text-green-700',  'dot' => 'bg-green-500',  'label' => 'Sedang Menginap'],
                        'checked_out' => ['bg' => 'bg-gray-100',   'text' => 'text-gray-600',   'dot' => 'bg-gray-400',   'label' => 'Selesai'],
                        'cancelled'   => ['bg' => 'bg-red-100',    'text' => 'text-red-700',    'dot' => 'bg-red-500',    'label' => 'Dibatalkan'],
                        default       => ['bg' => 'bg-gray-100',   'text' => 'text-gray-600',   'dot' => 'bg-gray-400',   'label' => $r->status],
                    };
                ?>

                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden mb-4">

                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-widest mb-0.5">Kode Booking</p>
                            <p class="font-bold text-yellow-600 tracking-widest"><?php echo e($r->kode_booking); ?></p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold <?php echo e($statusConfig['bg']); ?> <?php echo e($statusConfig['text']); ?>">
                            <span class="w-1.5 h-1.5 rounded-full <?php echo e($statusConfig['dot']); ?>"></span>
                            <?php echo e($statusConfig['label']); ?>

                        </span>
                    </div>

                    <div class="px-6 py-5">
                        <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Nama Tamu</p>
                                <p class="font-medium"><?php echo e($r->nama_lengkap); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Jenis Kamar</p>
                                <p class="font-medium"><?php echo e($r->jenis_kamar); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Check-in</p>
                                <p class="font-medium"><?php echo e($r->check_in->format('d M Y')); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Check-out</p>
                                <p class="font-medium"><?php echo e($r->check_out->format('d M Y')); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Durasi</p>
                                <p class="font-medium"><?php echo e($r->jumlah_malam); ?> malam</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Jumlah Tamu</p>
                                <p class="font-medium"><?php echo e($r->jumlah_tamu); ?> orang</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Metode Pembayaran</p>
                                <p class="font-medium capitalize"><?php echo e(str_replace('_', ' ', $r->metode_pembayaran)); ?></p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Tanggal Pesan</p>
                                <p class="font-medium"><?php echo e($r->created_at->format('d M Y, H:i')); ?></p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <span class="text-sm text-gray-500">Total Pembayaran</span>
                            <span class="font-bold text-yellow-600 text-lg">Rp <?php echo e(number_format($r->total_harga, 0, ',', '.')); ?></span>
                        </div>

                        <div class="mt-4 rounded px-4 py-3 text-xs <?php echo e($statusConfig['bg']); ?> <?php echo e($statusConfig['text']); ?>">
                            <?php if($r->status === 'pending'): ?>
                                ⏳ Reservasi Anda sedang menunggu konfirmasi. Kami akan menghubungi Anda dalam 1×24 jam.
                            <?php elseif($r->status === 'confirmed'): ?>
                                ✅ Reservasi Anda telah dikonfirmasi. Silakan datang pada tanggal check-in.
                            <?php elseif($r->status === 'checked_in'): ?>
                                🏨 Anda sedang menginap di hotel kami. Selamat menikmati!
                            <?php elseif($r->status === 'checked_out'): ?>
                                👋 Terima kasih telah menginap di OGAG Hotel. Sampai jumpa!
                            <?php elseif($r->status === 'cancelled'): ?>
                                ❌ Reservasi ini telah dibatalkan. Hubungi kami jika ada pertanyaan.
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                <div class="bg-white rounded-lg border border-gray-100 shadow-sm p-8 text-center">
                    <div class="text-4xl mb-3">🔍</div>
                    <p class="font-semibold text-gray-700 mb-1">Reservasi Tidak Ditemukan</p>
                    <p class="text-sm text-gray-400">Pastikan kode booking atau email yang Anda masukkan sudah benar.</p>
                </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </section>

</main><?php /**PATH C:\laragon\www\proyek\resources\views/components/cek-reservasi.blade.php ENDPATH**/ ?>