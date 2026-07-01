<?php $__env->startSection('title', 'Tambah Foto Gallery'); ?>
<?php $__env->startSection('subtitle', 'Tambah foto baru ke galeri website'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-3xl">

    <a href="<?php echo e(route('admin.gallery.index')); ?>"
       class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 mb-6 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Gallery
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="font-semibold text-gray-800">🖼️ Tambah Foto Baru</h3>
            <p class="text-xs text-gray-500 mt-0.5">Data akan disimpan ke tabel <code>galleries</code> di database</p>
        </div>

        <form action="<?php echo e(route('admin.gallery.store')); ?>" method="POST" enctype="multipart/form-data"
              id="galleryForm" class="p-6 space-y-5">
            <?php echo csrf_field(); ?>

            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Foto <span class="text-red-500">*</span>
                </label>

                <div id="uploadArea"
                     class="relative border-2 border-dashed border-gray-200 rounded-xl px-6 py-10 text-center cursor-pointer hover:border-yellow-400 hover:bg-yellow-50/30 transition">
                    <input type="file" name="foto" id="fotoInput" accept="image/*" required
                           class="absolute inset-0 opacity-0 cursor-pointer">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-700">Klik atau seret foto ke sini</p>
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP &middot; Maksimal 2MB</p>
                </div>

                <div id="previewWrap" class="mt-3 text-center hidden">
                    <img id="previewImg" class="max-h-56 mx-auto rounded-xl shadow-sm border border-gray-100" alt="Preview">
                    <button type="button" onclick="removePreview()"
                            class="mt-2 inline-flex items-center gap-1 text-xs bg-red-50 text-red-700 hover:bg-red-100 px-3 py-1.5 rounded-lg transition font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Ganti Foto
                    </button>
                </div>
                <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Judul Foto <span class="text-red-500">*</span>
                </label>
                <input type="text" name="judul" value="<?php echo e(old('judul')); ?>"
                       placeholder="cth: Sunset View Villa"
                       class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="3"
                          placeholder="Deskripsi singkat tentang foto ini..."
                          class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 resize-none"><?php echo e(old('deskripsi')); ?></textarea>
            </div>

            
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori"
                            class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400 <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>" <?php echo e(old('kategori') == $k ? 'selected' : ''); ?>>
                            <?php echo e(ucfirst($k)); ?>

                        </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" value="<?php echo e(old('urutan', 0)); ?>" min="0"
                           class="w-full text-sm border border-gray-200 rounded-xl px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>
            </div>

            
            <div class="flex items-center gap-3">
                <input type="checkbox" name="aktif" id="aktif" checked
                       class="w-4 h-4 rounded border-gray-300 text-yellow-500 focus:ring-yellow-400">
                <label for="aktif" class="text-sm text-gray-700 cursor-pointer">
                    Tampilkan di Gallery Publik
                </label>
            </div>

            
            <div class="flex gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-semibold text-sm px-5 py-2.5 rounded-xl transition">
                    Simpan Foto
                </button>
                <a href="<?php echo e(route('admin.gallery.index')); ?>"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm px-5 py-2.5 rounded-xl transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview foto yang diupload
    document.getElementById('fotoInput').addEventListener('change', function (e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (ev) {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('previewWrap').classList.remove('hidden');
                document.getElementById('uploadArea').classList.add('hidden');
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    function removePreview() {
        document.getElementById('fotoInput').value = '';
        document.getElementById('previewWrap').classList.add('hidden');
        document.getElementById('uploadArea').classList.remove('hidden');
    }

    // Drag & drop
    const uploadArea = document.getElementById('uploadArea');
    uploadArea.addEventListener('dragover', e => {
        e.preventDefault();
        uploadArea.classList.add('border-yellow-400', 'bg-yellow-50/30');
    });
    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('border-yellow-400', 'bg-yellow-50/30');
    });
    uploadArea.addEventListener('drop', e => {
        e.preventDefault();
        uploadArea.classList.remove('border-yellow-400', 'bg-yellow-50/30');
        document.getElementById('fotoInput').files = e.dataTransfer.files;
        document.getElementById('fotoInput').dispatchEvent(new Event('change'));
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/admin/gallery/create.blade.php ENDPATH**/ ?>