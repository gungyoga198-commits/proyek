@extends('layouts.admin')

@section('title', 'Tambah Foto Gallery')

@push('styles')
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
        position: relative;
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
        width: 100%;
        height: 100%;
    }
    .upload-area i { font-size: 2.5rem; color: #ccc; margin-bottom: 12px; display: block; }
    .upload-area p { margin: 0; color: #888; font-size: 0.9rem; }
    .upload-area p strong { color: #e53935; }

    #previewWrap {
        display: none;
        margin-top: 16px;
        position: relative;
        text-align: center;
    }
    #previewImg {
        max-height: 220px;
        max-width: 100%;
        border-radius: 12px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        object-fit: cover;
    }
    #removePreview {
        position: absolute;
        top: 8px; right: 8px;
        background: rgba(229,57,53,0.9);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 30px; height: 30px;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .form-label { font-weight: 600; color: #333; font-size: 0.9rem; }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1.5px solid #e0e0e0;
        padding: 10px 14px;
        transition: border-color 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #e53935;
        box-shadow: 0 0 0 3px rgba(229,57,53,0.12);
    }

    .btn-submit {
        background: linear-gradient(135deg, #e53935, #c62828);
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 12px 32px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(229,57,53,0.4);
    }
    .toggle-switch {
        display: flex; align-items: center; gap: 12px;
    }
    .form-check-input:checked { background-color: #e53935; border-color: #e53935; }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <div class="mb-3">
        <a href="{{ route('admin.gallery.index') }}" class="text-decoration-none text-muted">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Gallery
        </a>
    </div>

    <div class="form-card">
        <div class="form-title">
            <i class="fas fa-plus-circle"></i> Tambah Foto Gallery
        </div>

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- UPLOAD FOTO --}}
            <div class="mb-4">
                <label class="form-label mb-2">Foto <span class="text-danger">*</span></label>
                <div class="upload-area" id="uploadArea">
                    <input type="file" name="foto" id="fotoInput" accept="image/*">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p><strong>Klik untuk upload</strong> atau seret foto ke sini</p>
                    <p class="mt-1" style="font-size:0.8rem">JPG, PNG, WEBP – Maks. 2MB</p>
                </div>
                <div id="previewWrap">
                    <img src="" alt="Preview" id="previewImg">
                    <button type="button" id="removePreview" onclick="removePreview()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            {{-- JUDUL --}}
            <div class="mb-3">
                <label class="form-label">Judul Foto <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                       placeholder="Masukkan judul foto..." value="{{ old('judul') }}">
                @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"
                          placeholder="Keterangan singkat tentang foto...">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- KATEGORI & URUTAN --}}
            <div class="row">
                <div class="col-md-7 mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                        @foreach($kategoris as $k)
                        <option value="{{ $k }}" {{ old('kategori') == $k ? 'selected' : '' }}>
                            {{ ucfirst($k) }}
                        </option>
                        @endforeach
                    </select>
                    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-5 mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control"
                           placeholder="0" value="{{ old('urutan', 0) }}" min="0">
                </div>
            </div>

            {{-- STATUS --}}
            <div class="mb-4">
                <div class="toggle-switch">
                    <input type="checkbox" name="aktif" class="form-check-input" id="aktifCheck"
                           style="width:44px;height:22px;" checked>
                    <label for="aktifCheck" class="form-label mb-0">
                        Tampilkan di website
                    </label>
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save me-2"></i> Simpan Foto
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-light px-4 rounded-3 fw-600">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const fotoInput = document.getElementById('fotoInput');
    const uploadArea = document.getElementById('uploadArea');
    const previewWrap = document.getElementById('previewWrap');
    const previewImg = document.getElementById('previewImg');

    fotoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                previewWrap.style.display = 'block';
                uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    function removePreview() {
        fotoInput.value = '';
        previewWrap.style.display = 'none';
        uploadArea.style.display = 'block';
    }

    // Drag & Drop
    uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.classList.add('dragover'); });
    uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
    uploadArea.addEventListener('drop', e => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        fotoInput.files = e.dataTransfer.files;
        fotoInput.dispatchEvent(new Event('change'));
    });
</script>
@endpush