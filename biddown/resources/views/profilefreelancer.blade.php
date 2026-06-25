@extends('layouts.app')

@section('title', 'Profil Freelancer - Andi Setiawan | Bid Down')

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

.profile-avatar-xl{
    width:110px;
    height:110px;
    border-radius:24px;
    object-fit:cover;
    flex-shrink:0;

    box-shadow:
        0 10px 25px rgba(139,94,60,.15);
}

.profile-sidebar{
    position:sticky;
    top:100px;
}

.skill-chip{
    display:inline-flex;
    align-items:center;

    padding:.65rem 1rem;

    background:#faf8f6;

    border:1px solid #ebe3dc;

    border-radius:14px;

    color:var(--text-main);

    font-weight:600;

    box-shadow:
        0 4px 12px rgba(0,0,0,.03);

    transition:.25s;
}

.skill-chip:hover{
    border-color:rgba(139,94,60,.25);

    box-shadow:
        0 8px 20px rgba(139,94,60,.08);
}

.portfolio-card{
    overflow:hidden;

    border-radius:20px;

    transition:.3s;
}

.portfolio-card:hover{
    transform:translateY(-5px);
}

.portfolio-card img{
    height:220px;
    object-fit:cover;
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

.review-avatar{
    width:48px;
    height:48px;

    border-radius:14px;

    background:linear-gradient(
        135deg,
        #8b5e3c,
        #c8a27a
    );

    color:white;

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:700;
}

.star-rating{
    color:#f5b301;
}

.profile-meta{
    color:var(--text-secondary);
}

.profile-meta i{
    color:var(--primary);
}

</style>
@endsection

@section('content')

<div class="mb-4">
    <button onclick="history.back()" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>
        Kembali
    </button>
</div>

{{-- HEADER PROFIL --}}
<div class="card p-4 p-md-5 mb-4">

    <div class="row align-items-center">

        <div class="col-lg-6">

            <div class="d-flex align-items-center gap-4">

                <img
                    src="https://placehold.co/300x300/c8a27a/ffffff?text=AS"
                    class="profile-avatar-xl"
                    alt="Andi Setiawan">

                <div>

                    <h2 class="fw-bold mb-1">
                        Andi Setiawan
                    </h2>

                    <div class="text-primary fw-semibold mb-3">
                        Full Stack Web & Mobile Developer
                    </div>

                    <div class="profile-meta">

                        <div class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i>
                            Yogyakarta, Indonesia
                        </div>

                        <div>
                            <i class="bi bi-calendar3 me-2"></i>
                            Bergabung sejak 2022
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-3 mt-4 mt-lg-0">

            <div class="d-flex justify-content-center gap-5">

                <div class="text-center">

                    <div class="text-secondary-custom small">
                        Rating
                    </div>

                    <h3 class="fw-bold text-primary mb-0">
                        4.9
                    </h3>

                </div>

                <div class="text-center">

                    <div class="text-secondary-custom small">
                        Proyek Selesai
                    </div>

                    <h3 class="fw-bold text-primary mb-0">
                        34
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3 mt-4 mt-lg-0">

            <div class="d-grid gap-2">

                <a href="{{ url('/editprofilefreelancer') }}"
                   class="btn btn-primary">

                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Profil

                </a>

                 @if(!empty($freelancer->website))
                    <a href="{{ $freelancer->website }}"
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

<div class="row g-4">

    {{-- SIDEBAR KIRI --}}
    <div class="col-lg-4">

        <div class="profile-sidebar">

            {{-- TENTANG SAYA --}}
            <div class="card p-4 mb-4">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-person text-primary fs-5"></i>
                    <h5 class="fw-bold text-main mb-0">
                        Tentang Saya
                    </h5>
                </div>

                <p class="text-secondary-custom mb-0" style="line-height:1.9;">
                    Halo! Saya Andi, seorang Full-Stack Developer dengan pengalaman lebih dari 4 tahun dalam membangun aplikasi web dan mobile yang cepat, scalable, dan mudah digunakan.

                    Saya berpengalaman menggunakan React.js, Next.js, Laravel, Vue.js, Node.js, PostgreSQL, dan berbagai teknologi modern lainnya untuk membantu bisnis berkembang secara digital.
                </p>

            </div>

            {{-- KEAHLIAN --}}
            <div class="card p-4">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-lightning-charge text-primary fs-5"></i>
                    <h5 class="fw-bold text-main mb-0">
                        Keahlian
                    </h5>
                </div>

                <div class="d-flex flex-wrap gap-2">

                    <div class="d-flex flex-wrap gap-2">

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        React.js
                    </span>

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        Next.js
                    </span>

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        Laravel
                    </span>

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        Vue.js
                    </span>

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        Node.js
                    </span>

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        REST API
                    </span>

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        PostgreSQL
                    </span>

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        MySQL
                    </span>

                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        Docker
                    </span>
                    
                    <span class="skill-chip">
                        <i class="bi bi-check2-circle me-2"></i>
                        Docker
                    </span>
                </div>
                </div>

            </div>

        </div>

    </div>

    {{-- KONTEN KANAN --}}
    <div class="col-lg-8">

        {{-- PORTOFOLIO --}}
        <div class="card p-4 p-md-5 mb-4">

            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-grid text-primary fs-4"></i>
                <h4 class="fw-bold text-main mb-0">
                    Portofolio
                </h4>
            </div>

            <div class="row g-4">

                <div class="col-md-6">

                    <a href="#" class="text-decoration-none hover-link">
                        <div class="portfolio-card card">

                            <img
                                src="https://placehold.co/600x400/fbf9f6/8b5e3c?text=POS"
                                class="w-100">

                            <div class="p-4">

                                <h6 class="fw-bold mb-1 text-main">
                                    Sistem POS Restoran
                                </h6>

                                <small class="text-secondary-custom">
                                    Vue.js & Laravel
                                </small>

                            </div>

                        </div>
                    </a>

                </div>

                <div class="col-md-6">

                    <a href="#" class="text-decoration-none hover-link">
                        <div class="portfolio-card card">

                            <img
                                src="https://placehold.co/600x400/fbf9f6/8b5e3c?text=Kasir+Mobile"
                                class="w-100">

                            <div class="p-4">

                                <h6 class="fw-bold mb-1 text-main">
                                    Aplikasi Kasir Mobile
                                </h6>

                                <small class="text-secondary-custom">
                                    React Native
                                </small>

                            </div>

                        </div>
                    </a>

                </div>

            </div>

        </div>

        {{-- ULASAN --}}
        <div class="card p-4 p-md-5">

            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-chat-square-text text-primary fs-4"></i>
                <h4 class="fw-bold text-main mb-0">
                    Ulasan Klien
                    <span class="text-secondary-custom fw-medium fs-5">
                        (4.9/5.0)
                    </span>
                </h4>
            </div>

            <div class="review-item border-bottom border-light mb-4 pb-4">

                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="review-avatar">
                            PT
                        </div>

                        <div>

                            <h6 class="fw-bold text-main mb-0">
                                <a href="{{ url('/profileclient') }}" class="text-decoration-none hover-link text-main">PT Jaya Abadi</a>
                            </h6>

                            <small class="text-secondary-custom">
                                Proyek: <a href="{{ url('/projectdetailfreelancer') }}" class="text-primary text-decoration-none hover-link">Desain Ulang Website Perusahaan</a>
                            </small>

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

                <p class="mb-2 text-main" style="line-height: 1.6;">
                    "Andi bekerja sangat cepat dan hasilnya melebihi ekspektasi.
                    Dokumentasi lengkap dan komunikasi sangat baik."
                </p>

                <small class="text-secondary-custom fw-medium">Ditulis pada 12 Mar 2024</small>

            </div>

            <div class="review-item mb-2">

                <div class="d-flex justify-content-between align-items-start mb-3">

                    <div class="d-flex align-items-center gap-3">

                        <div class="review-avatar">
                            SM
                        </div>

                        <div>

                            <h6 class="fw-bold text-main mb-0">
                                <a href="{{ url('/profileclient') }}" class="text-decoration-none hover-link text-main">Sinar Makmur CV</a>
                            </h6>

                            <small class="text-secondary-custom">
                                Proyek: <a href="{{ url('/projectdetailfreelancer') }}" class="text-primary text-decoration-none hover-link">Integrasi API Payment Gateway</a>
                            </small>

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

                <p class="mb-2 text-main" style="line-height: 1.6;">
                    "Pekerjaan sesuai brief, API berjalan baik,
                    dan komunikasi selama proyek sangat jelas."
                </p>

                <small class="text-secondary-custom fw-medium">Ditulis pada 05 Feb 2024</small>

            </div>

        </div>

    </div>

</div>

@endsection

