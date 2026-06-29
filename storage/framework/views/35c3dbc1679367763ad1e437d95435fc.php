<?php $__env->startSection('title', 'Kalender Tamu'); ?>

<?php $__env->startSection('content'); ?>


<?php
    $namaBulan = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $bulanPrev = $bulan == 1 ? 12 : $bulan - 1;
    $tahunPrev = $bulan == 1 ? $tahun - 1 : $tahun;
    $bulanNext = $bulan == 12 ? 1 : $bulan + 1;
    $tahunNext = $bulan == 12 ? $tahun + 1 : $tahun;
    $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
    $hariPertama = date('N', mktime(0,0,0,$bulan,1,$tahun)); // 1=Senin, 7=Minggu
?>

<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-4">
        <a href="<?php echo e(route('admin.kalender', ['bulan' => $bulanPrev, 'tahun' => $tahunPrev])); ?>"
           class="bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
            ← Sebelumnya
        </a>
        <h2 class="text-xl font-bold text-gray-800"><?php echo e($namaBulan[$bulan]); ?> <?php echo e($tahun); ?></h2>
        <a href="<?php echo e(route('admin.kalender', ['bulan' => $bulanNext, 'tahun' => $tahunNext])); ?>"
           class="bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
            Berikutnya →
        </a>
    </div>
    <a href="<?php echo e(route('admin.kalender', ['bulan' => date('m'), 'tahun' => date('Y')])); ?>"
       class="bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-yellow-700 transition">
        Hari Ini
    </a>
</div>


<div class="flex gap-4 mb-5 text-xs">
    <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-blue-500"></span> Check-in</span>
    <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-red-400"></span> Check-out</span>
    <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded-full bg-green-500"></span> Menginap</span>
</div>


<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

    
    <div class="grid grid-cols-7 border-b border-gray-100">
        <?php $__currentLoopData = ['Sen','Sel','Rab','Kam','Jum','Sab','Min']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hari): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide
            <?php echo e($hari === 'Min' ? 'text-red-400' : ''); ?>">
            <?php echo e($hari); ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="grid grid-cols-7">
        
        <?php for($i = 1; $i < $hariPertama; $i++): ?>
        <div class="border-r border-b border-gray-50 min-h-28 p-2 bg-gray-50/50"></div>
        <?php endfor; ?>

        
        <?php for($hari = 1; $hari <= $jumlahHari; $hari++): ?>
        <?php
            $tanggal    = \Carbon\Carbon::create($tahun, $bulan, $hari);
            $isToday    = $tanggal->isToday();
            $hariKe     = $tanggal->dayOfWeekIso; // 7 = Minggu
            $checkinHari  = $reservations->filter(fn($r) => $r->check_in->format('Y-m-d') === $tanggal->format('Y-m-d'));
            $checkoutHari = $reservations->filter(fn($r) => $r->check_out->format('Y-m-d') === $tanggal->format('Y-m-d'));
            $menginapHari = $reservations->filter(fn($r) =>
                $r->check_in->format('Y-m-d') < $tanggal->format('Y-m-d') &&
                $r->check_out->format('Y-m-d') > $tanggal->format('Y-m-d')
            );
        ?>

        <div class="border-r border-b border-gray-100 min-h-28 p-2
            <?php echo e($isToday ? 'bg-yellow-50' : ''); ?>

            <?php echo e($hariKe === 7 ? 'bg-red-50/30' : ''); ?>">

            
            <div class="flex items-center justify-between mb-1">
                <span class="text-sm font-medium <?php echo e($isToday ? 'bg-yellow-600 text-white w-7 h-7 rounded-full flex items-center justify-center text-xs' : ($hariKe === 7 ? 'text-red-400' : 'text-gray-700')); ?>">
                    <?php echo e($hari); ?>

                </span>
                <?php if($checkinHari->count() + $checkoutHari->count() + $menginapHari->count() > 0): ?>
                <span class="text-xs text-gray-400"><?php echo e($checkinHari->count() + $checkoutHari->count() + $menginapHari->count()); ?> tamu</span>
                <?php endif; ?>
            </div>

            
            <?php $__currentLoopData = $checkinHari; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.reservasi.detail', $r->id)); ?>"
               class="block bg-blue-100 text-blue-700 text-xs px-1.5 py-0.5 rounded mb-0.5 truncate hover:bg-blue-200 transition"
               title="Check-in: <?php echo e($r->nama_lengkap); ?>">
                🔵 <?php echo e($r->nama_lengkap); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php $__currentLoopData = $menginapHari; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.reservasi.detail', $r->id)); ?>"
               class="block bg-green-100 text-green-700 text-xs px-1.5 py-0.5 rounded mb-0.5 truncate hover:bg-green-200 transition"
               title="Menginap: <?php echo e($r->nama_lengkap); ?>">
                🟢 <?php echo e($r->nama_lengkap); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php $__currentLoopData = $checkoutHari; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('admin.reservasi.detail', $r->id)); ?>"
               class="block bg-red-100 text-red-600 text-xs px-1.5 py-0.5 rounded mb-0.5 truncate hover:bg-red-200 transition"
               title="Check-out: <?php echo e($r->nama_lengkap); ?>">
                🔴 <?php echo e($r->nama_lengkap); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <?php endfor; ?>

        
        <?php $sisaKolom = (7 - (($hariPertama - 1 + $jumlahHari) % 7)) % 7; ?>
        <?php for($i = 0; $i < $sisaKolom; $i++): ?>
        <div class="border-r border-b border-gray-50 min-h-28 p-2 bg-gray-50/50"></div>
        <?php endfor; ?>
    </div>
</div>


<?php if($reservations->count() > 0): ?>
<div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100">
        <h3 class="font-semibold text-gray-700">Tamu Terkonfirmasi — <?php echo e($namaBulan[$bulan]); ?> <?php echo e($tahun); ?></h3>
        <p class="text-xs text-gray-400 mt-0.5"><?php echo e($reservations->count()); ?> reservasi</p>
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
                    <th class="px-5 py-3 text-left">Status</th>
                    <th class="px-5 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $badge = $r->status === 'confirmed' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700';
                    $label = $r->status === 'confirmed' ? 'Dikonfirmasi' : 'Menginap';
                ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-3 font-mono text-xs text-yellow-600 font-semibold"><?php echo e($r->kode_booking); ?></td>
                    <td class="px-5 py-3 font-medium"><?php echo e($r->nama_lengkap); ?></td>
                    <td class="px-5 py-3 text-gray-600"><?php echo e($r->jenis_kamar); ?></td>
                    <td class="px-5 py-3 text-gray-600"><?php echo e($r->check_in->format('d M Y')); ?></td>
                    <td class="px-5 py-3 text-gray-600"><?php echo e($r->check_out->format('d M Y')); ?></td>
                    <td class="px-5 py-3"><span class="px-2 py-1 rounded-full text-xs font-medium <?php echo e($badge); ?>"><?php echo e($label); ?></span></td>
                    <td class="px-5 py-3">
                        <a href="<?php echo e(route('admin.reservasi.detail', $r->id)); ?>" class="text-xs text-yellow-600 hover:underline">Detail</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/admin/kalender.blade.php ENDPATH**/ ?>