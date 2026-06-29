<?php $__env->startSection('title', 'Status Kamar'); ?>
<?php $__env->startSection('subtitle', 'Ketersediaan kamar secara realtime'); ?>

<?php $__env->startSection('content'); ?>


<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Status kamar berdasarkan reservasi aktif (confirmed / check-in)</p>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\Rooms::class)): ?>
    <a href="<?php echo e(route('admin.rooms.index')); ?>"
        class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7l7-7h9a2 2 0 012 2v17z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 2v6h6"/>
        </svg>
        Kelola Data Kamar
    </a>
    <?php endif; ?>
</div>


<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
    <form action="<?php echo e(route('admin.kamar')); ?>" method="GET" class="flex items-end gap-4">
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wide">Cek Ketersediaan Tanggal</label>
            <input type="date" name="tanggal" value="<?php echo e($tanggal); ?>"
                class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-100">
        </div>
        <button type="submit" class="bg-yellow-500 text-gray-900 font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-yellow-400 transition shadow-sm">
            Cek Sekarang
        </button>
        <a href="<?php echo e(route('admin.kamar')); ?>" class="text-sm text-gray-400 hover:text-gray-600 py-2.5">Hari Ini</a>
    </form>
    <p class="text-xs text-gray-400 mt-2">
        Menampilkan status kamar untuk tanggal: <strong class="text-gray-600"><?php echo e(\Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y')); ?></strong>
    </p>
</div>


<?php if(count($kamarStatus) === 0): ?>
<div class="bg-white rounded-2xl border border-gray-100 p-12 text-center text-gray-400 text-sm">
    Belum ada kamar terdaftar. <a href="<?php echo e(route('admin.rooms.create')); ?>" class="text-yellow-600 hover:underline">Tambah kamar sekarang →</a>
</div>
<?php else: ?>
<div class="grid md:grid-cols-3 gap-6">
    <?php $__currentLoopData = $kamarStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        /** @var \App\Models\Rooms $room */
        $room      = $status['room'];
        $fasilitas = is_array($room->fasilitas) ? $room->fasilitas : json_decode($room->fasilitas ?? '[]', true);
    ?>

    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden
        <?php echo e($status['tersedia'] ? 'border-green-200' : 'border-red-200'); ?>">

        
        <div class="relative">
            <?php if($room->gambar): ?>
                <img src="/<?php echo e(ltrim($room->gambar, '/')); ?>" class="w-full h-48 object-cover" alt="<?php echo e($nama); ?>">
            <?php else: ?>
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            <?php endif; ?>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

            
            <div class="absolute top-3 left-3 bg-yellow-500 text-gray-900 text-xs px-3 py-1 font-semibold tracking-widest rounded-sm">
                <?php echo e(strtoupper($room->tipe)); ?>

            </div>

            
            <div class="absolute top-3 right-3 flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                <?php echo e($status['tersedia'] ? 'bg-green-500 text-white' : 'bg-red-500 text-white'); ?>">
                <span class="w-1.5 h-1.5 rounded-full bg-white <?php echo e($status['tersedia'] ? '' : 'animate-pulse'); ?>"></span>
                <?php echo e($status['tersedia'] ? 'TERSEDIA' : 'TERISI'); ?>

            </div>

            
            <?php if(!$room->is_active): ?>
            <div class="absolute bottom-12 left-3 bg-gray-800/80 text-white text-xs px-2 py-0.5 rounded">
                Nonaktif
            </div>
            <?php endif; ?>

            <div class="absolute bottom-3 left-4">
                <p class="text-white font-semibold text-lg leading-none"><?php echo e($nama); ?></p>
                <p class="text-gray-300 text-xs mt-0.5"><?php echo e($room->pemandangan ?? ''); ?></p>
            </div>
        </div>

        
        <div class="p-5">
            <div class="grid grid-cols-2 text-xs text-gray-500 gap-y-1.5 mb-4">
                <span>👤 <?php echo e($room->kapasitas); ?> Orang</span>
                <span>📐 <?php echo e($room->ukuran ?? '-'); ?></span>
                <span>🛏 <?php echo e($room->tipe_bed ?? '-'); ?></span>
                <span>💰 Rp <?php echo e(number_format($room->harga_per_malam, 0, ',', '.')); ?></span>
            </div>

            <div class="flex flex-wrap gap-1 mb-4">
                <?php $__currentLoopData = array_slice($fasilitas, 0, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="bg-gray-100 text-gray-500 text-xs px-2 py-0.5 rounded-full"><?php echo e($f); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <?php if(!$status['tersedia'] && $status['reservasi']): ?>
            <?php $r = $status['reservasi']; ?>
            <div class="bg-red-50 border border-red-100 rounded-xl p-4 text-sm">
                <p class="text-xs font-semibold text-red-600 uppercase tracking-wide mb-2">Ditempati Oleh:</p>
                <div class="space-y-1 text-xs text-gray-600">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tamu</span>
                        <span class="font-medium"><?php echo e($r->nama_lengkap); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Kode</span>
                        <span class="font-mono text-yellow-600 font-semibold"><?php echo e($r->kode_booking); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Check-in</span>
                        <span class="font-medium"><?php echo e($r->check_in->format('d M Y')); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Check-out</span>
                        <span class="font-medium"><?php echo e($r->check_out->format('d M Y')); ?></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Tipe Bayar</span>
                        <span class="font-semibold <?php echo e(($r->tipe_pembayaran ?? 'lunas') === 'dp' ? 'text-blue-600' : 'text-green-600'); ?>">
                            <?php echo e(($r->tipe_pembayaran ?? 'lunas') === 'dp' ? 'DP 50%' : 'Lunas'); ?>

                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status</span>
                        <span class="font-semibold <?php echo e($r->status === 'checked_in' ? 'text-green-600' : 'text-blue-600'); ?>">
                            <?php echo e($r->status === 'checked_in' ? 'Sedang Menginap' : 'Dikonfirmasi'); ?>

                        </span>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.reservasi.detail', $r->id)); ?>"
                   class="mt-3 block text-center text-xs bg-white border border-red-200 text-red-600 py-1.5 rounded-lg hover:bg-red-50 transition">
                    Lihat Detail Reservasi →
                </a>
            </div>
            <?php else: ?>
            <div class="bg-green-50 border border-green-100 rounded-xl p-4 text-center">
                <p class="text-green-600 font-semibold text-sm">✓ Kamar Tersedia</p>
                <p class="text-green-500 text-xs mt-0.5">Siap untuk di-booking</p>
                <div class="mt-2 flex gap-2">
                    <a href="<?php echo e(route('admin.reservasi', ['search' => $nama])); ?>"
                       class="flex-1 text-center text-xs bg-green-500 text-white py-1.5 rounded-lg hover:bg-green-600 transition">
                        Riwayat
                    </a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $room)): ?>
                    <a href="<?php echo e(route('admin.rooms.edit', $room->id)); ?>"
                       class="flex-1 text-center text-xs bg-white border border-gray-200 text-gray-600 py-1.5 rounded-lg hover:bg-gray-50 transition">
                        Edit Kamar
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>


<div class="mt-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-gray-700">Ringkasan</h3>
        <a href="<?php echo e(route('admin.rooms.index')); ?>" class="text-xs text-yellow-600 hover:underline">
            Kelola semua kamar →
        </a>
    </div>
    <div class="grid grid-cols-3 gap-4">
        <?php
            $tersedia = collect($kamarStatus)->where('tersedia', true)->count();
            $terisi   = collect($kamarStatus)->where('tersedia', false)->count();
        ?>
        <div class="bg-green-50 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-green-600"><?php echo e($tersedia); ?></p>
            <p class="text-xs text-green-500 mt-1">Kamar Tersedia</p>
        </div>
        <div class="bg-red-50 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-red-500"><?php echo e($terisi); ?></p>
            <p class="text-xs text-red-400 mt-1">Kamar Terisi</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-gray-600"><?php echo e(count($kamarStatus)); ?></p>
            <p class="text-xs text-gray-400 mt-1">Total Kamar</p>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/admin/kamar.blade.php ENDPATH**/ ?>