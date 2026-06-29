

<?php $__env->startSection('title', 'Edit Foto Gallery'); ?>

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

    .current-image {
        border-radius: 12px;
        overflow: hidden;
        border: 3px solid #f0f0f0;
        margin-bottom: 20px;
    }
    .current-image img {
        width: 100%;
        max-height: 260px;
        object-fit: cover;
    }

    .upload-area {
        border: 2px dashed #d0d0d0;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #fafafa;
    }
    .upload-area:hover {
        border-color: #e53935;
        background: rgba(229,57,53,0.05);
    }

    .form-label { 
        font-weight: 600; 
        color: #333; 
        font-size: 0.95rem; 
        margin-bottom: 8px; 
    }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1.5px solid #e0e0e0;
        padding: 12px 16px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #e53935;
        box-shadow: 0 0 0 3px rgba(229,57,53,0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, #e53935, #c62828);
        color: white;
        border: none;
        padding: 12px 40px;
        border-radius: 10px;
        font-weight: 700;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4">
    <div class="mb-4">
        <a href="<?php echo e(route('admin.gallery.index')); ?>" class="text-muted text-decoration-none">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Gallery
        </a>
    </div>

    <div class="form-card">
        <div class="form-title">
            <i class="fas fa-edit"></i> Edit Foto Gallery
        </div>

        <form action="<?php echo e(route('admin.gallery.update', $gallery)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Current Image -->
            <div class="current-image mb-4">
                <img src="<?php echo e(asset('storage/' . $gallery->foto)); ?>" alt="<?php echo e($gallery->judul); ?>">
            </div>

            <!-- Upload New Image -->
            <div class="mb-4">
                <label class="form-label">Ganti Foto (Opsional)</label>
                <div class="upload-area" id="uploadArea">
                    <input type="file" name="foto" id="fotoInput" accept="image/*">
                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-3"></i>
                    <p class="mb-1"><strong>Klik untuk upload foto baru</strong></p>
                    <p class="text-muted small">JPG, PNG, WebP • Maks. 2MB</p>
                </div>
                <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Foto <span class="text-danger">*</span></label>
                <input type="text" name="judul" value="<?php echo e(old('judul', $gallery->judul)); ?>" 
                       class="form-control <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
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
                <textarea name="deskripsi" rows="4" class="form-control"><?php echo e(old('deskripsi', $gallery->deskripsi)); ?></textarea>
            </div>

            <!-- Kategori & Urutan -->
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select" required>
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k); ?>" <?php echo e(old('kategori', $gallery->kategori) == $k ? 'selected' : ''); ?>>
                                <?php echo e(ucfirst($k)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Urutan Tampilan</label>
                    <input type="number" name="urutan" value="<?php echo e(old('urutan', $gallery->urutan)); ?>" 
                           class="form-control" min="0">
                </div>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="aktif" id="aktifCheck" 
                           <?php echo e(old('aktif', $gallery->aktif) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="aktifCheck">Tampilkan di website publik</label>
                </div>
            </div>

            <div class="d-flex gap-3 mt-5">
                <a href="<?php echo e(route('admin.gallery.index')); ?>" class="btn btn-light px-5 py-2">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save me-2"></i> Update Foto
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Preview foto baru (opsional)
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.style.maxHeight = '200px';
                img.style.borderRadius = '8px';
                // Bisa ditampilkan di bawah jika diperlukan
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\proyek\resources\views/admin/gallery/edit.blade.php ENDPATH**/ ?>