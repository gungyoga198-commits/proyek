

<?php $__env->startSection('title', 'Tambah Foto Gallery'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .form-card {
        background: #fff;
        border-radius: 16px;
        padding: 36px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        max-width: 680px;
        margin: 0 auto;
    }
    .form-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #1a1a2e;
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-title i { color: #e53935; }

    .upload-area {
        border: 2px dashed #d0d0d0;
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafafa;
    }
    .upload-area:hover, .upload-area.dragover {
        border-color: #e53935;
        background: rgba(229,57,53,0.04);
    }
    .upload-area input[type=file] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }
    .preview-img {
        max-height: 220px;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <div class="mb-4">
        <a href="<?php echo e(route('admin.gallery.index')); ?>" class="text-muted text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Gallery
        </a>
    </div>

    <div class="form-card">
        <div class="form-title">
            <i class="fas fa-image"></i> Tambah Foto Baru
        </div>

        <form action="<?php echo e(route('admin.gallery.store')); ?>" method="POST" enctype="multipart/form-data" id="galleryForm">
            <?php echo csrf_field(); ?>

            <!-- Upload Foto -->
            <div class="mb-4">
                <label class="form-label">Foto <span class="text-danger">*</span></label>
                <div class="upload-area" id="uploadArea">
                    <input type="file" name="foto" id="fotoInput" accept="image/*" required>
                    <i class="fas fa-cloud-upload-alt fa-3x mb-3 text-muted"></i>
                    <p class="mb-1"><strong>Klik atau seret foto ke sini</strong></p>
                    <p class="text-muted small">JPG, PNG, WebP • Maksimal 2MB</p>
                </div>

                <div id="previewWrap" class="mt-3 text-center" style="display:none;">
                    <img id="previewImg" class="preview-img" alt="Preview">
                    <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removePreview()">
                        <i class="fas fa-times"></i> Ganti Foto
                    </button>
                </div>
                <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger d-block mt-1"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Foto <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('judul')); ?>" placeholder="Contoh: Sunset View Villa" required>
                <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="form-control" 
                          placeholder="Deskripsi singkat tentang foto..."><?php echo e(old('deskripsi')); ?></textarea>
            </div>

            <!-- Kategori & Urutan -->
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select <?php $__errorArgs = ['kategori'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
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
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Urutan Tampilan</label>
                    <input type="number" name="urutan" value="<?php echo e(old('urutan', 0)); ?>" min="0" 
                           class="form-control">
                </div>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="aktif" id="aktif" checked>
                    <label class="form-check-label" for="aktif">Tampilkan di Gallery Publik</label>
                </div>
            </div>

            <div class="d-flex gap-3 mt-4">
                <a href="<?php echo e(route('admin.gallery.index')); ?>" class="btn btn-light px-5">Batal</a>
                <button type="submit" class="btn btn-danger px-5">
                    <i class="fas fa-save"></i> Simpan Foto
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Preview Foto
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('previewWrap').style.display = 'block';
                document.getElementById('uploadArea').style.display = 'none';
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    function removePreview() {
        document.getElementById('fotoInput').value = '';
        document.getElementById('previewWrap').style.display = 'none';
        document.getElementById('uploadArea').style.display = 'block';
    }

    // Drag & Drop
    const uploadArea = document.getElementById('uploadArea');
    uploadArea.addEventListener('dragover', e => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });
    uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
    uploadArea.addEventListener('drop', e => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        document.getElementById('fotoInput').files = e.dataTransfer.files;
        document.getElementById('fotoInput').dispatchEvent(new Event('change'));
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/admin/gallery/create.blade.php ENDPATH**/ ?>