@extends('layouts.app')

@section('title', 'Eksplorasi Proyek | Bid Down')

@section('user-name', 'Andi Setiawan')
@section('user-avatar', 'AS')
@section('profile-link', url('/profilefreelancer'))

@section('nav-links')
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardfreelancer') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom active" href="{{ url('/explore') }}"><i class="bi bi-search me-1"></i> Eksplor Proyek</a>
</li>
@endsection

@section('styles')
<style>
    .search-card {
        background: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.05);
        margin-top: -24px;
        position: relative;
        z-index: 2;
    }
    .project-card {
        background-color: var(--surface);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
    }
    .project-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 32px rgba(139, 94, 60, 0.08);
        border-color: rgba(139, 94, 60, 0.2);
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<div class="hero-dashboard">
    <div>
        <h2 class="fw-bold mb-2">Eksplorasi Proyek Aktif</h2>
        <p class="text-secondary-custom mb-0 fs-6" style="max-width: 600px;">Temukan berbagai peluang proyek yang sedang berjalan. Gunakan filter untuk mencari proyek yang sesuai dengan keahlian Anda, lalu ajukan penawaran terbaik.</p>
    </div>
</div>

<div class="mt-4">

        <section class="search-card p-4 p-md-5 mb-5">
            <h5 class="fw-bold mb-4 d-flex align-items-center gap-2 text-main">
                <i class="bi bi-funnel text-primary fs-4"></i> Filter Project
            </h5>
            <div class="row g-3 align-items-end">
                <div class="col-md-6 col-lg-4">
                    <label for="searchInput" class="form-label">Kata Kunci</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-secondary"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari: website, UI/UX, API..."/>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label for="categoryFilter" class="form-label">Kategori</label>
                    <select id="categoryFilter" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Web Development">Web Development</option>
                        <option value="UI/UX Design">UI/UX Design</option>
                        <option value="Backend Development">Backend Development</option>
                        <option value="Content Writing">Content Writing</option>
                        <option value="Video Editing">Video Editing</option>
                        <option value="Graphic Design">Graphic Design</option>
                    </select>
                </div>
                <div class="col-md-6 col-lg-3">
                    <label for="budgetFilter" class="form-label">Budget Maksimal</label>
                    <select id="budgetFilter" class="form-select">
                        <option value="">Semua Range</option>
                        <option value="1000000">Sampai Rp 1.000.000</option>
                        <option value="3000000">Sampai Rp 3.000.000</option>
                        <option value="5000000">Sampai Rp 5.000.000</option>
                        <option value="10000000">Sampai Rp 10.000.000</option>
                        <option value="20000000">Sampai Rp 20.000.000</option>
                    </select>
                </div>
                <div class="col-md-6 col-lg-2 d-grid">
                    <button type="button" class="btn btn-outline-primary fw-semibold py-2">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </button>
                </div>
            </div>
        </section>

        <section class="pt-2">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
                <h3 class="fw-bold mb-0 d-flex align-items-center gap-2 text-main">
                    <i class="bi bi-briefcase text-primary fs-4"></i> Project Tersedia
                </h3>
                <p class="text-secondary-custom mb-0 fw-semibold bg-white border border-light px-3 py-1 rounded-pill shadow-sm">
                    <span class="text-primary fw-bold">{{ isset($projects) ? $projects->count() : 8 }}</span> Proyek Ditemukan
                </p>
            </div>
            
            <div class="row g-4">
                @isset($projects)
                    @foreach ($projects as $project)
                        <div class="col-md-6 col-xl-4">
                            <div class="card project-card">
                                <div class="card-body p-4 d-flex flex-column h-100">
                                    <div class="mb-3">
                                        <span class="badge badge-soft-primary px-3 py-2 rounded-pill mb-3">{{ $project->category }}</span>
                                        <h5 class="fw-bold text-main mb-2">{{ $project->title }}</h5>
                                        <p class="text-secondary-custom small mb-0">{{ Str::limit($project->description, 120) }}</p>
                                    </div>
                                    <div class="mt-auto pt-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="small text-secondary-custom">Budget Maks:</span>
                                            <span class="fw-bold text-main">Rp {{ number_format($project->max_price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="small text-secondary-custom">Bid Terendah:</span>
                                            <span class="fw-bold text-success">
                                                {{ $project->lowestBid ? 'Rp ' . number_format($project->lowestBid->amount, 0, ',', '.') : 'Belum ada' }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge badge-soft-success px-3 py-2 rounded-pill">Open Bid</span>
                                            <a href="{{ route('projectdetailfreelancer', $project) }}" class="btn btn-primary fw-medium px-4">
                                                Lihat <i class="bi bi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
                
                <div class="col-md-6 col-xl-4">
                    <div class="card project-card">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">Web Development</span>
                                <h5 class="fw-bold text-main line-clamp-2 mb-1">Pembuatan Landing Page Produk SaaS</h5>
                            </div>
                            <p class="text-secondary-custom small line-clamp-2 mb-4" style="line-height: 1.5;">Membuat landing page responsif dengan conversion optimization + integrasi formulir lead capture.</p>
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 small text-secondary-custom mb-2">
                                    <i class="bi bi-building"></i>
                                    <span class="fw-medium">PT Solusi Digital</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 small mb-3">
                                    <i class="bi bi-calendar-event text-secondary-custom"></i>
                                    <span class="text-secondary-custom fw-medium">Selesai: 20 Apr 2026 (10 hr)</span>
                                </div>
                                <div class="p-3 bg-light rounded-3 border mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small text-secondary-custom">Budget Maks:</span>
                                        <span class="fw-bold text-main">Rp 3.000.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary-custom">Bid Terendah:</span>
                                        <span class="fw-bold text-success">Rp 2.100.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-soft-success px-3 py-2 rounded-pill">Open Bid</span>
                                    <a href="{{ url('/projectdetailfreelancer') }}" class="btn btn-primary fw-medium px-4">
                                        Lihat <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card project-card">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">UI/UX Design</span>
                                <h5 class="fw-bold text-main line-clamp-2 mb-1">Desain UI/UX Aplikasi E-Commerce Mobile</h5>
                            </div>
                            <p class="text-secondary-custom small line-clamp-2 mb-4" style="line-height: 1.5;">Desain lengkap 18 screen aplikasi mobile e-commerce dengan prototype interaktif di Figma.</p>
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 small text-secondary-custom mb-2">
                                    <i class="bi bi-building"></i>
                                    <span class="fw-medium">CV BelanjaMaju</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 small mb-3">
                                    <i class="bi bi-calendar-event text-secondary-custom"></i>
                                    <span class="text-secondary-custom fw-medium">Selesai: 30 Apr 2026 (20 hr)</span>
                                </div>
                                <div class="p-3 bg-light rounded-3 border mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small text-secondary-custom">Budget Maks:</span>
                                        <span class="fw-bold text-main">Rp 8.000.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary-custom">Bid Terendah:</span>
                                        <span class="fw-bold text-success">Rp 6.500.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-soft-success px-3 py-2 rounded-pill">Open Bid</span>
                                    <a href="{{ url('/projectdetailfreelancer') }}" class="btn btn-primary fw-medium px-4">
                                        Lihat <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card project-card">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">Backend Development</span>
                                <h5 class="fw-bold text-main line-clamp-2 mb-1">Setup API Node.js dan Database MySQL</h5>
                            </div>
                            <p class="text-secondary-custom small line-clamp-2 mb-4" style="line-height: 1.5;">Membuat REST API Node.js dengan autentikasi JWT, manajemen produk, dan sistem pembayaran.</p>
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 small text-secondary-custom mb-2">
                                    <i class="bi bi-building"></i>
                                    <span class="fw-medium">PT Jaya Abadi</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 small mb-3">
                                    <i class="bi bi-exclamation-circle-fill text-danger"></i>
                                    <span class="text-danger fw-medium">Selesai: 15 Apr 2026 (5 hr)</span>
                                </div>
                                <div class="p-3 bg-light rounded-3 border mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small text-secondary-custom">Budget Maks:</span>
                                        <span class="fw-bold text-main">Rp 5.000.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary-custom">Bid Terendah:</span>
                                        <span class="small fst-italic text-secondary-custom">Belum ada bid</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-soft-warning px-3 py-2 rounded-pill">Menunggu Bid</span>
                                    <a href="{{ url('/projectdetailfreelancer') }}" class="btn btn-primary fw-medium px-4">
                                        Lihat <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card project-card">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">Content Writing</span>
                                <h5 class="fw-bold text-main line-clamp-2 mb-1">Artikel SEO 20 Topik Bisnis Digital</h5>
                            </div>
                            <p class="text-secondary-custom small line-clamp-2 mb-4" style="line-height: 1.5;">Menulis artikel blog SEO-friendly, masing-masing 1200-1500 kata, dengan keyword research mendalam.</p>
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 small text-secondary-custom mb-2">
                                    <i class="bi bi-building"></i>
                                    <span class="fw-medium">Media Tumbuh</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 small mb-3">
                                    <i class="bi bi-calendar-event text-secondary-custom"></i>
                                    <span class="text-secondary-custom fw-medium">Selesai: 25 Apr 2026 (15 hr)</span>
                                </div>
                                <div class="p-3 bg-light rounded-3 border mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small text-secondary-custom">Budget Maks:</span>
                                        <span class="fw-bold text-main">Rp 2.000.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary-custom">Bid Terendah:</span>
                                        <span class="fw-bold text-success">Rp 1.500.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-soft-success px-3 py-2 rounded-pill">Open Bid</span>
                                    <a href="{{ url('/projectdetailfreelancer') }}" class="btn btn-primary fw-medium px-4">
                                        Lihat <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card project-card">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">Video Editing</span>
                                <h5 class="fw-bold text-main line-clamp-2 mb-1">Video Promosi 60 Detik untuk Social Media</h5>
                            </div>
                            <p class="text-secondary-custom small line-clamp-2 mb-4" style="line-height: 1.5;">Editing video vertikal (9:16) untuk Instagram Reels dan TikTok dengan color grading profesional.</p>
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 small text-secondary-custom mb-2">
                                    <i class="bi bi-building"></i>
                                    <span class="fw-medium">Brand Lokal Kita</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 small mb-3">
                                    <i class="bi bi-calendar-event text-secondary-custom"></i>
                                    <span class="text-secondary-custom fw-medium">Selesai: 18 Apr 2026 (8 hr)</span>
                                </div>
                                <div class="p-3 bg-light rounded-3 border mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small text-secondary-custom">Budget Maks:</span>
                                        <span class="fw-bold text-main">Rp 4.000.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary-custom">Bid Terendah:</span>
                                        <span class="fw-bold text-success">Rp 3.200.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-soft-success px-3 py-2 rounded-pill">Open Bid</span>
                                    <a href="{{ url('/projectdetailfreelancer') }}" class="btn btn-primary fw-medium px-4">
                                        Lihat <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-4">
                    <div class="card project-card">
                        <div class="card-body p-4 d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">Graphic Design</span>
                                <h5 class="fw-bold text-main line-clamp-2 mb-1">Desain Logo dan Brand Identity Lengkap</h5>
                            </div>
                            <p class="text-secondary-custom small line-clamp-2 mb-4" style="line-height: 1.5;">Desain logo, style guide, dan visual identity untuk startup teknologi yang sedang berkembang.</p>
                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 small text-secondary-custom mb-2">
                                    <i class="bi bi-building"></i>
                                    <span class="fw-medium">Startup Teknologi</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 small mb-3">
                                    <i class="bi bi-calendar-event text-secondary-custom"></i>
                                    <span class="text-secondary-custom fw-medium">Selesai: 01 Mei 2026 (21 hr)</span>
                                </div>
                                <div class="p-3 bg-light rounded-3 border mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small text-secondary-custom">Budget Maks:</span>
                                        <span class="fw-bold text-main">Rp 2.500.000</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small text-secondary-custom">Bid Terendah:</span>
                                        <span class="fw-bold text-success">Rp 1.800.000</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge badge-soft-success px-3 py-2 rounded-pill">Open Bid</span>
                                    <a href="{{ url('/projectdetailfreelancer') }}" class="btn btn-primary fw-medium px-4">
                                        Lihat <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <footer class="bg-white border-top border-light py-4 mt-auto">
        <div class="container-lg">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0 text-secondary-custom small fw-medium">
                        &copy; 2026 Bid-Down. Platform Reverse Bidding untuk Freelancer Indonesia.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-secondary-custom text-decoration-none small me-3 hover-link">Tentang Kami</a>
                    <a href="#" class="text-secondary-custom text-decoration-none small me-3 hover-link">Bantuan</a>
                    <a href="#" class="text-secondary-custom text-decoration-none small hover-link">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
</div>
@endsection
