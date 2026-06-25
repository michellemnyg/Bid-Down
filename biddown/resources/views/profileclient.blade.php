@extends('layouts.app')

@section('title', 'Profil Klien - PT Jaya Abadi | Bid Down')

@section('user-name', 'PT Jaya Abadi')
@section('user-avatar', 'PT')
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
    .profile-avatar-xl{
        width:110px;
        height:110px;
        border-radius:24px;
        background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(139, 94, 60, 0.2);
        flex-shrink: 0;
    }
    /* Avatar Kecil untuk Ulasan */
    .review-avatar {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background-color: var(--primary-soft);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        border: 1px solid rgba(139, 94, 60, 0.1);
    }
    .review-item {
        transition: background-color 0.2s ease;
        padding: 1.5rem;
        border-radius: 12px;
        margin-left: -1.5rem;
        margin-right: -1.5rem;
    }
    .review-item:hover {
        background-color: var(--background);
    }
</style>
@endsection

@section('content')
        <div class="mb-4">
            <button onclick="history.back()" class="btn btn-outline-secondary shadow-sm bg-white text-dark border-0 fw-semibold px-4">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
        </div>

        <div class="card section-card p-4 p-md-5 mb-5">
            <div class="row align-items-center gap-4 gap-md-0">
                
                <div class="col-md-7 d-flex align-items-center gap-4">
                    <div class="profile-avatar">
                        PT
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-3 mb-1">
                            <h2 class="fw-bold text-main mb-0">PT Jaya Abadi</h2>
                        </div>
                        <p class="text-secondary-custom mb-0 mt-2 d-flex flex-wrap gap-3">
                            <span><i class="bi bi-geo-alt me-1"></i> Jakarta Selatan, Indonesia</span>
                            <span class="d-none d-sm-inline text-muted">|</span>
                            <span><i class="bi bi-calendar3 me-1"></i> Bergabung sejak 2023</span>
                        </p>
                    </div>
                </div>

<div class="col-md-5 mt-4 mt-md-0">

    <div class="card border-0 bg-light rounded-4 p-3">

        <div class="row align-items-center text-center">

            <div class="col-4 border-end">
                <small class="text-secondary-custom d-block mb-1">
                    Tingkat Hire
                </small>

                <h4 class="fw-bold text-primary mb-0">
                    85%
                </h4>
            </div>

            <div class="col-4 border-end">
                <small class="text-secondary-custom d-block mb-1">
                    Proyek Selesai
                </small>

                <h4 class="fw-bold text-primary mb-0">
                    24
                </h4>
            </div>

            <div class="col-4">

                <div class="d-grid gap-2">

                    <a href="{{ url('/editprofileclient') }}"
                       class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Profil
                    </a>

                    {{-- Tampilkan jika website tersedia --}}
                    @if(!empty($client->website))
                    <a href="{{ $client->website }}"
                       target="_blank"
                       class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-globe me-1"></i>
                        Website
                    </a>
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
            </div>
        </div>

        <section class="mb-5">
            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-briefcase text-primary fs-4"></i>
                <h4 class="fw-bold text-main mb-0">Proyek Aktif Klien Ini</h4>
            </div>
            
            <div class="row g-4">
                
                <div class="col-md-6 col-lg-4">
                    <div class="card project-card h-100 p-4">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">Web Development</span>
                                <h5 class="fw-bold text-main mb-1 line-clamp-2">Pembuatan Landing Page Perusahaan</h5>
                            </div>
                            <div class="p-3 bg-light rounded-3 border mb-4 mt-auto">
                                <span class="small text-secondary-custom d-block mb-1">Budget Maksimal</span>
                                <span class="fw-bold text-success fs-5">Rp 3.000.000</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="text-secondary-custom small fw-medium">
                                    <i class="bi bi-clock me-1"></i> Sisa 2 Hari
                                </span>
                                <a href="{{ url('/projectdetailclient') }}" class="btn btn-outline-primary btn-sm fw-semibold px-3">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card project-card h-100 p-4">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">UI/UX Design</span>
                                <h5 class="fw-bold text-main mb-1 line-clamp-2">Desain UI/UX Aplikasi Mobile</h5>
                            </div>
                            <div class="p-3 bg-light rounded-3 border mb-4 mt-auto">
                                <span class="small text-secondary-custom d-block mb-1">Budget Maksimal</span>
                                <span class="fw-bold text-success fs-5">Rp 8.000.000</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="text-secondary-custom small fw-medium">
                                    <i class="bi bi-clock me-1"></i> Sisa 5 Hari
                                </span>
                                <a href="{{ url('/projectdetailclient') }}" class="btn btn-outline-primary btn-sm fw-semibold px-3">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section>
            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-star-fill text-star fs-4"></i>
                <h4 class="fw-bold text-main mb-0">Ulasan Freelancer <span class="text-secondary-custom fw-medium fs-5">(4.8/5.0)</span></h4>
            </div>
            
            <div class="card section-card p-4 p-md-5">
                
                <div class="review-item border-bottom border-light mb-4 pb-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="review-avatar">AS</div>
                            <div>
                                <h6 class="fw-bold text-main mb-0">
                                    <a href="{{ url('/profilefreelancer') }}" class="text-decoration-none hover-link">Agus Setiawan</a>
                                </h6>
                                <small class="text-secondary-custom">Proyek: <a href="{{ url('/projectdetailclient') }}" class="text-primary text-decoration-none hover-link">Desain Logo Perusahaan Baru</a></small>
                            </div>
                        </div>
                        <div class="text-star fs-6 d-flex gap-1">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                    <p class="mb-2 text-main" style="line-height: 1.6;">"Klien yang sangat luar biasa. Briefing proyek sangat jelas, komunikasi lancar tanpa hambatan, dan yang paling penting pencairan dana escrow sangat cepat begitu pekerjaan disetujui. Sangat direkomendasikan!"</p>
                    <small class="text-secondary-custom fw-medium">Ditulis pada 05 Sep 2024</small>
                </div>

                <div class="review-item mb-2">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="review-avatar">MD</div>
                            <div>
                                <h6 class="fw-bold text-main mb-0">
                                    <a href="{{ url('/profilefreelancer') }}" class="text-decoration-none hover-link">Maya Dwi</a>
                                </h6>
                                <small class="text-secondary-custom">Proyek: <a href="{{ url('/projectdetailclient') }}" class="text-primary text-decoration-none hover-link">Video Company Profile 3 Menit</a></small>
                            </div>
                        </div>
                        <div class="text-star fs-6 d-flex gap-1">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                    </div>
                    <p class="mb-2 text-main" style="line-height: 1.6;">"Pekerjaan berjalan lancar. Klien meminta sedikit revisi tambahan di akhir, tapi masih dalam batas wajar sesuai kesepakatan awal. Overall pengalaman kerja yang menyenangkan."</p>
                    <small class="text-secondary-custom fw-medium">Ditulis pada 20 Agu 2024</small>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-outline-secondary bg-background border-0 text-primary fw-semibold px-4 py-2">
                        Muat Ulasan Lainnya <i class="bi bi-chevron-down ms-1"></i>
                    </button>
                </div>

            </div>
        </section>

@endsection


