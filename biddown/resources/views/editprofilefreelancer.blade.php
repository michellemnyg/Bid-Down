@extends('layouts.app')

@section('title', 'Edit Profil Freelancer | Bid Down')

@section('user-name', 'Andi Setiawan')
@section('user-avatar', 'AS')
@section('profile-link', url('/profilefreelancer'))

@section('nav-links')
<li class="nav-item">
    <a class="nav-link nav-link-custom active" href="{{ url('/dashboardfreelancer') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/explore') }}"><i class="bi bi-compass me-1"></i> Eksplor Proyek</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="#bid-aktif"><i class="bi bi-graph-down-arrow me-1"></i> Bid Aktif Saya</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="#proyek-berjalan"><i class="bi bi-check2-all me-1"></i> Proyek Terkontrak</a>
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
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--surface);
        box-shadow: 0 8px 24px rgba(139, 94, 60, 0.15);
    }
    .avatar-edit-btn {
        position: absolute;
        bottom: 0px;
        right: 0px;
        background: var(--primary);
        color: white;
        border-radius: 50%;
        width: 40px;
        height: 40px;
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

    /* Portfolio Item Container */
    .portfolio-item {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 1.25rem;
        margin-bottom: 1.25rem;
        background-color: var(--surface);
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .portfolio-item:hover {
        border-color: rgba(139, 94, 60, 0.3);
        box-shadow: 0 4px 12px rgba(0,0,0,0.02);
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
                <h2 class="fw-bold mb-1"><i class="bi bi-gear me-2 text-primary"></i>Pengaturan Profil</h2>
                <p class="text-secondary-custom mb-0 fs-6">Perbarui informasi profil dan portofolio Anda untuk menarik lebih banyak klien.</p>
            </div>
            <a href="{{ url('/profilefreelancer') }}" class="btn btn-outline-secondary fw-semibold px-4 shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Profil
            </a>
        </div>

        <form action="{{ route('profilefreelancer.update') }}" method="POST" onsubmit="return confirmAction(event, 'Simpan perubahan profil Anda?', 'Ya, Simpan')">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card section-card text-center p-4 h-100 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold mb-4">Foto Profil</h5>
                        
                        <div class="avatar-upload-container mb-3">
                            <img src="https://placehold.co/300x300/c8a27a/ffffff?text=AS" alt="Preview Profil" class="avatar-preview" id="imagePreview">
                            <label for="profileUpload" class="avatar-edit-btn" title="Ubah Foto">
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
                            <div class="col-md-6">
                                <label for="fullName" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullName" name="name" value="{{ old('name', $freelancer->name ?? 'Andi Setiawan') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jobTitle" class="form-label fw-semibold">Gelar Profesi / Peran <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="jobTitle" name="job_title" value="{{ old('job_title', $freelancer->job_title ?? 'Web & App Developer') }}" placeholder="Contoh: UI/UX Designer" required>
                            </div>
                            <div class="col-12">
                                <label for="location" class="form-label fw-semibold">Lokasi <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" id="location" name="location" value="{{ old('location', $freelancer->location ?? 'Yogyakarta, Indonesia') }}" placeholder="Kota, Negara" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="website" class="form-label fw-semibold">Website Portofolio</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-globe"></i></span>
                                    <input type="url" class="form-control border-start-0 ps-0" id="website" name="website" value="{{ old('website', $freelancer->website ?? 'https://andisetiawan.com') }}" placeholder="https://contoh.com">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card section-card p-4 mt-2">
                <h5 class="fw-bold mb-4 border-bottom pb-3">Tentang Saya & Keahlian</h5>
                
                <div class="mb-4">
                    <label for="aboutMe" class="form-label fw-semibold">Deskripsi Diri <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="aboutMe" name="bio" rows="5" required>{{ old('bio', $freelancer->bio ?? 'Halo! Saya Andi, seorang Full-Stack Developer dengan pengalaman lebih dari 4 tahun dalam membangun aplikasi web dan mobile yang responsif, cepat, dan mudah digunakan. Saya berfokus pada ekosistem JavaScript (React.js, Vue.js, Node.js) dan mahir dalam merancang arsitektur database (MySQL, PostgreSQL, MongoDB).') }}</textarea>
                    <div class="form-text mt-2 text-secondary-custom">Ceritakan pengalaman, fokus kerja, dan nilai tambah yang bisa Anda berikan ke klien.</div>
                </div>

                <div class="mb-2">
                    <label for="skills" class="form-label fw-semibold">Keahlian Utama (Pisahkan dengan koma) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-secondary"><i class="bi bi-stars"></i></span>
                        <input type="text" class="form-control border-start-0 ps-0" id="skills" name="skills" value="{{ old('skills', $freelancer->skills ?? 'React / Next.js, Laravel / Vue.js, Node.js / Express, UI/UX Implementation, REST API') }}" required>
                    </div>
                    <div class="form-text mt-2 text-secondary-custom">Contoh: Web Development, Video Editing, Logo Design</div>
                </div>
            </div>

            <div class="card section-card p-4 mt-2">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h5 class="fw-bold mb-0">Manajemen Portofolio</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary fw-semibold px-3">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Item
                    </button>
                </div>

                <div class="portfolio-item">
                    <div class="row align-items-center g-4">
                        <div class="col-md-3">
                            <div class="position-relative">
                                <img src="https://placehold.co/600x400/f1f3f4/8b5e3c?text=Sistem+POS+Restoran" alt="Thumb" class="img-fluid rounded border w-100 object-fit-cover" style="height: 120px;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Judul Portofolio</label>
                                <input type="text" class="form-control form-control-sm" value="Sistem POS Restoran Berbasis Web">
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold">Teknologi / Deskripsi</label>
                                    <input type="text" class="form-control form-control-sm" value="Vue.js & Laravel">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold">Link Proyek / Github</label>
                                    <input type="url" class="form-control form-control-sm" name="portfolio_url" value="{{ old('portfolio_url', $freelancer->portfolio_url ?? 'https://github.com/andisetiawan/pos-restoran') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex flex-md-column flex-row gap-2 justify-content-center">
                            <button type="button" class="btn btn-outline-secondary btn-sm flex-fill"><i class="bi bi-image me-1 d-none d-md-inline"></i>Ganti Gambar</button>
                            <button type="button" class="btn btn-outline-danger btn-sm flex-fill"><i class="bi bi-trash"></i> Hapus</button>
                        </div>
                    </div>
                </div>

                <div class="portfolio-item">
                    <div class="row align-items-center g-4">
                        <div class="col-md-3">
                            <div class="position-relative">
                                <img src="https://placehold.co/600x400/f1f3f4/8b5e3c?text=Aplikasi+Kasir+Mobile" alt="Thumb" class="img-fluid rounded border w-100 object-fit-cover" style="height: 120px;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Judul Portofolio</label>
                                <input type="text" class="form-control form-control-sm" value="Aplikasi Kasir Toko Baju">
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold">Teknologi / Deskripsi</label>
                                    <input type="text" class="form-control form-control-sm" value="React Native">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label small fw-semibold">Link Proyek / Github</label>
                                    <input type="url" class="form-control form-control-sm" placeholder="https://...">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex flex-md-column flex-row gap-2 justify-content-center">
                            <button type="button" class="btn btn-outline-secondary btn-sm flex-fill"><i class="bi bi-image me-1 d-none d-md-inline"></i>Ganti Gambar</button>
                            <button type="button" class="btn btn-outline-danger btn-sm flex-fill"><i class="bi bi-trash"></i> Hapus</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-end gap-3 mb-5 mt-4">
                <a href="{{ url('/profilefreelancer') }}" class="btn btn-outline-secondary fw-semibold px-4 py-2 bg-white">Batal</a>
                <button type="submit" class="btn btn-primary fw-bold px-5 py-2 shadow-sm">
                    <i class="bi bi-floppy me-2"></i> Simpan Perubahan
                </button>
            </div>

        </form>

@endsection

@section('scripts')
<script>
    // Script sederhana untuk preview gambar profil saat diunggah
    document.getElementById('profileUpload').addEventListener('change', function(event) {
        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endsection


