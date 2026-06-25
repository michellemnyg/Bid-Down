@extends('layouts.app')

@section('title', 'Edit Profil Klien | Bid Down')

@section('user-name', $client->name ?? 'PT Jaya Abadi')
@section('user-avatar', substr($client->name ?? 'PT', 0, 2))
@section('profile-link', url('/profileclient'))

@section('nav-links')
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardclient') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardclient') }}#proyek-aktif"><i class="bi bi-briefcase me-1"></i> Proyek Saya</a>
</li>
@endsection

@section('styles')
<style>
    /* Profil Image Upload */
    .avatar-upload-container {
        position: relative;
        width: 160px;
        height: 160px;
        margin: 0 auto;
    }
    .avatar-preview {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 56px;
        font-weight: 700;
        border: 4px solid var(--surface);
        box-shadow: 0 8px 24px rgba(139, 94, 60, 0.15);
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: -5px;
        right: -5px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 3px solid var(--surface);
        transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(139, 94, 60, 0.3);
    }
    .avatar-edit-btn:hover {
        transform: scale(1.1) rotate(5deg);
        background: var(--primary-hover);
    }

    /* Links */
    .hover-link {
        color: var(--text-main) !important;
        transition: color 0.2s ease;
    }
    .hover-link:hover {
        color: var(--primary) !important;
    }
</style>
@endsection

@section('content')
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
            <div>
                <h2 class="fw-bold mb-1"><i class="bi bi-gear me-2 text-primary"></i>Pengaturan Profil Klien</h2>
                <p class="text-secondary-custom mb-0 fs-6">Perbarui informasi profil perusahaan Anda.</p>
            </div>
            <a href="{{ url('/profileclient') }}" class="btn btn-outline-secondary fw-semibold px-4 shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Profil
            </a>
        </div>

        <form action="{{ route('profileclient.update') }}" method="POST" onsubmit="return confirmAction(event, 'Simpan perubahan profil Anda?', 'Ya, Simpan')">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card section-card text-center p-4 h-100 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold mb-4">Logo Perusahaan / Profil</h5>
                        
                        <div class="avatar-upload-container mb-3">
                            <div class="avatar-preview" id="imagePreview">
                                {{ strtoupper(substr($client->name ?? 'PT', 0, 2)) }}
                            </div>
                            <label for="profileUpload" class="avatar-edit-btn" title="Ubah Logo">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                            <input type="file" id="profileUpload" class="d-none" accept="image/png, image/jpeg, image/jpg">
                        </div>
                        
                        <p class="small text-secondary-custom mb-0 mt-3">
                            Format yang didukung: JPEG, PNG.<br>Ukuran maksimal 2MB.
                        </p>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card section-card p-4 h-100">
                        <h5 class="fw-bold mb-4 border-bottom pb-3">Informasi Dasar</h5>
                        
                        <div class="row g-4">
                            <div class="col-md-12">
                                <label for="fullName" class="form-label fw-semibold">Nama Perusahaan / Klien <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullName" name="name" value="{{ old('name', $client->name ?? 'PT Jaya Abadi') }}" required>
                            </div>
                            <div class="col-12">
                                <label for="location" class="form-label fw-semibold">Lokasi Kantor <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="location" name="location" value="{{ old('location', $client->location ?? 'Jakarta Selatan, Indonesia') }}" placeholder="Kota, Negara" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="website" class="form-label fw-semibold">Website Perusahaan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-globe"></i></span>
                                    <input type="url" class="form-control border-start-0 ps-0" id="website" name="website" value="{{ old('website', $client->website ?? '') }}" placeholder="https://contoh.com">
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-5">
                            <button type="submit" class="btn btn-primary fw-bold px-5 py-2 shadow-sm">
                                <i class="bi bi-check2-circle me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>

@endsection

@section('scripts')
<script>
    // Preview gambar profil saat upload (Placeholder untuk fungsionalitas di masa depan)
    document.getElementById('profileUpload').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                // Untuk client, avatar adalah div dengan huruf, jadi kita bisa ubah menjadi image tag kalau diperlukan
                // atau cukup tampilkan pesan. Karena ini mock, kita tidak mengimplementasi full image preview.
                Swal.fire({
                    icon: 'info',
                    title: 'Gambar Dipilih',
                    text: 'Fitur upload gambar akan diproses di backend nanti.',
                    confirmButtonColor: '#8b5e3c'
                });
            }
            
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection
