<?php $__env->startSection('title', 'Kelola Kamar'); ?>
<?php $__env->startSection('subtitle', 'Manajemen data kamar hotel dari database'); ?>

<?php $__env->startSection('content'); ?>




<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-gray-500">Total <?php echo e($rooms->total()); ?> kamar terdaftar</p>
    </div>
    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', \App\Models\Rooms::class)): ?>
    <a href="<?php echo e(route('admin.rooms.create')); ?>"
       class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-4 py-2.5 rounded-xl transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Kamar
    </a>
    <?php endif; ?>
</div>


<?php if(session('success')): ?>
<div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl mb-6 flex items-center gap-2">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>


<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">#</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Kamar</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Tipe</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Harga / Malam</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Kapasitas</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Total Reservasi</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Status</th>
                <th class="text-left px-6 py-4 text-gray-500 font-medium">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            <?php $__empty_1 = true; $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4 text-gray-400"><?php echo e($loop->iteration); ?></td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <?php if($room->gambar): ?>
                        <img src="<?php echo e(str_starts_with($room->gambar, 'images/') ? '/'.$room->gambar : asset('storage/'.$room->gambar)); ?>"
                             class="w-12 h-10 rounded-lg object-cover border border-gray-100">
                        <?php else: ?>
                        <div class="w-12 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                            </svg>
                        </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-medium text-gray-800"><?php echo e($room->nama); ?></p>
                            <p class="text-xs text-gray-400"><?php echo e($room->ukuran); ?> · <?php echo e($room->tipe_bed); ?></p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="bg-blue-50 text-blue-700 text-xs font-semibold px-2.5 py-1 rounded-lg">
                        <?php echo e($room->tipe); ?>

                    </span>
                </td>
                <td class="px-6 py-4 font-semibold text-gray-800">
                    <?php echo e($room->harga_format); ?>

                </td>
                <td class="px-6 py-4 text-gray-600">
                    <?php echo e($room->kapasitas); ?> orang
                </td>
                
                <td class="px-6 py-4">
                    <span class="text-gray-700 font-medium"><?php echo e($room->reservations_count); ?></span>
                    <span class="text-gray-400 text-xs ml-1">reservasi</span>
                </td>
                <td class="px-6 py-4">
                    <?php if($room->is_active): ?>
                    <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                    </span>
                    <?php else: ?>
                    <span class="inline-flex items-center gap-1 bg-red-50 text-red-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Nonaktif
                    </span>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $room)): ?>
                        <a href="<?php echo e(route('admin.rooms.edit', $room)); ?>"
                           class="inline-flex items-center gap-1 text-xs bg-yellow-50 text-yellow-700 hover:bg-yellow-100 px-3 py-1.5 rounded-lg transition font-medium">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <?php endif; ?>

                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $room)): ?>
                        <form action="<?php echo e(route('admin.rooms.destroy', $room)); ?>" method="POST"
                              onsubmit="return confirm('Yakin hapus kamar <?php echo e($room->nama); ?>? Semua reservasi terkait akan kehilangan referensi kamar.')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit"
                                    class="inline-flex items-center gap-1 text-xs bg-red-50 text-red-700 hover:bg-red-100 px-3 py-1.5 rounded-lg transition font-medium">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"/>
                    </svg>
                    <p class="font-medium">Belum ada data kamar</p>
                    <p class="text-xs mt-1">Jalankan <code class="bg-gray-100 px-1 rounded">php artisan db:seed</code> untuk mengisi data awal</p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if($rooms->hasPages()): ?>
    <div class="px-6 py-4 border-t border-gray-100">
        <?php echo e($rooms->links()); ?>

    </div>
    <?php endif; ?>
</div>


<?php if(config('app.debug')): ?>
<div class="mt-6 bg-blue-50 border border-blue-100 rounded-xl p-4 text-xs text-blue-700">
    <p class="font-semibold mb-1">📚 Pertemuan 11 — Relasi Eloquent yang aktif:</p>
    <ul class="space-y-0.5 list-disc list-inside text-blue-600">
        <li><code>Rooms::hasMany(Reservation::class)</code> → satu kamar punya banyak reservasi</li>
        <li><code>Reservation::belongsTo(Rooms::class)</code> → setiap reservasi milik satu kamar</li>
        <li><code>withCount('reservations')</code> → menghitung relasi tanpa N+1 query</li>
        <li><code>Rooms::aktif()->get()</code> → scope hanya kamar is_active = true</li>
    </ul>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/admin/rooms/index.blade.php ENDPATH**/ ?>