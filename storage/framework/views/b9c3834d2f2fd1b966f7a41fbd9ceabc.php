<?php $__env->startSection('title', 'Manajemen Reservasi'); ?>

<?php $__env->startSection('content'); ?>


<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
    <form action="<?php echo e(route('admin.reservasi')); ?>" method="GET" class="flex flex-wrap gap-4 items-end">
        <div>
            <label class="block text-xs text-gray-500 mb-1 uppercase tracking-wide">Cari</label>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                placeholder="Nama, kode, atau email..."
                class="border border-gray-200 rounded px-3 py-2 text-sm w-56 focus:outline-none focus:border-yellow-500">
        </div>
        <div>
            <label class="block text-xs text-gray-500 mb-1 uppercase tracking-wide">Status</label>
            <select name="status" class="border border-gray-200 rounded px-3 py-2 text-sm focus:outline-none focus:border-yellow-500">
                <option value="">Semua Status</option>
                <option value="pending"     <?php echo e(request('status')=='pending'     ? 'selected':''); ?>>Menunggu</option>
                <option value="confirmed"   <?php echo e(request('status')=='confirmed'   ? 'selected':''); ?>>Dikonfirmasi</option>
                <option value="checked_in"  <?php echo e(request('status')=='checked_in'  ? 'selected':''); ?>>Menginap</option>
                <option value="checked_out" <?php echo e(request('status')=='checked_out' ? 'selected':''); ?>>Selesai</option>
                <option value="cancelled"   <?php echo e(request('status')=='cancelled'   ? 'selected':''); ?>>Dibatalkan</option>
            </select>
        </div>
        <button type="submit" class="bg-yellow-600 text-white px-5 py-2 text-sm rounded hover:bg-yellow-700 transition">
            Filter
        </button>
        <a href="<?php echo e(route('admin.reservasi')); ?>" class="text-sm text-gray-400 hover:text-gray-600 py-2">Reset</a>
    </form>
</div>


<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h2 class="font-semibold text-gray-700">Daftar Reservasi</h2>
        <span class="text-xs text-gray-400"><?php echo e($reservations->total()); ?> total data</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wide">
                <tr>
                    <th class="px-5 py-3 text-left">Kode</th>
                    <th class="px-5 py-3 text-left">Nama Tamu</th>
                    <th class="px-5 py-3 text-left">Kamar</th>
                    <th class="px-5 py-3 text-left">Check-in</th>
                    <th class="px-5 py-3 text-left">Check-out</th>
                    <th class="px-5 py-3 text-left">Total</th>
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $badge = match($r->status) {
                        'pending'     => 'bg-yellow-100 text-yellow-700',
                        'confirmed'   => 'bg-blue-100 text-blue-700',
                        'checked_in'  => 'bg-green-100 text-green-700',
                        'checked_out' => 'bg-gray-100 text-gray-500',
                        'cancelled'   => 'bg-red-100 text-red-700',
                        default       => 'bg-gray-100 text-gray-600',
                    };
                    $label = match($r->status) {
                        'pending'     => 'Menunggu',
                        'confirmed'   => 'Dikonfirmasi',
                        'checked_in'  => 'Menginap',
                        'checked_out' => 'Selesai',
                        'cancelled'   => 'Dibatalkan',
                        default       => $r->status,
                    };
                ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-4 font-mono text-xs text-yellow-600 font-semibold"><?php echo e($r->kode_booking); ?></td>
                    <td class="px-5 py-4">
                        <p class="font-medium"><?php echo e($r->nama_lengkap); ?></p>
                        <p class="text-xs text-gray-400"><?php echo e($r->email); ?></p>
                    </td>
                    <td class="px-5 py-4 text-gray-600"><?php echo e($r->jenis_kamar); ?></td>
                    <td class="px-5 py-4 text-gray-600"><?php echo e($r->check_in->format('d M Y')); ?></td>
                    <td class="px-5 py-4 text-gray-600"><?php echo e($r->check_out->format('d M Y')); ?></td>
                    <td class="px-5 py-4 font-medium text-gray-700">Rp <?php echo e(number_format($r->total_harga,0,',','.')); ?></td>
                    <td class="px-5 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium <?php echo e($badge); ?>"><?php echo e($label); ?></span>
                    </td>
                    <td class="px-5 py-4">
                        <a href="<?php echo e(route('admin.reservasi.detail', $r->id)); ?>"
                           class="text-xs bg-gray-100 text-gray-700 px-3 py-1.5 rounded hover:bg-gray-200 transition">
                            Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="px-6 py-10 text-center text-gray-400">Tidak ada data reservasi.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <?php if($reservations->hasPages()): ?>
    <div class="px-6 py-4 border-t border-gray-100">
        <?php echo e($reservations->withQueryString()->links()); ?>

    </div>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/admin/reservasi.blade.php ENDPATH**/ ?>