@extends('layouts.app')

@section('title', 'Eksplorasi Proyek | Bid Down')

@section('profile-link', Auth::check() && Auth::user()->isClient() ? route('profileclient') : route('profilefreelancer'))

@section('nav-links')
@if(Auth::check() && Auth::user()->role === 'client')
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ route('dashboardclient') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ route('dashboardclient') }}#proyek-aktif"><i class="bi bi-briefcase me-1"></i> Proyek Saya</a>
</li>
@else
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardfreelancer') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom active" href="{{ url('/explore') }}"><i class="bi bi-compass me-1"></i> Eksplor Proyek</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardfreelancer') }}#bid-aktif"><i class="bi bi-graph-down-arrow me-1"></i> Bid Aktif Saya</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardfreelancer') }}#proyek-berjalan"><i class="bi bi-check2-all me-1"></i> Proyek Terkontrak</a>
</li>
@endif
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
            <form action="{{ route('explore') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-6 col-lg-4">
                    <label for="searchInput" class="form-label">Kata Kunci</label>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-secondary"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" value="{{ request('search') }}" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Cari: website, UI/UX, API..."/>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <label for="categoryFilter" class="form-label">Kategori</label>
                    <select name="category" id="categoryFilter" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Web Development" {{ request('category') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                        <option value="UI/UX Design" {{ request('category') == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                        <option value="Backend Development" {{ request('category') == 'Backend Development' ? 'selected' : '' }}>Backend Development</option>
                        <option value="Content Writing" {{ request('category') == 'Content Writing' ? 'selected' : '' }}>Content Writing</option>
                        <option value="Video Editing" {{ request('category') == 'Video Editing' ? 'selected' : '' }}>Video Editing</option>
                        <option value="Graphic Design" {{ request('category') == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                    </select>
                </div>
                <div class="col-md-12 col-lg-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary fw-semibold py-2 flex-grow-1">
                        Cari
                    </button>
                    <a href="{{ route('explore') }}" class="btn btn-outline-primary fw-semibold py-2">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </div>
            </form>
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
                    @forelse ($projects as $project)
                        <div class="col-md-6 col-xl-4">
                            <div class="card project-card">
                                <div class="card-body p-4 d-flex flex-column h-100">
                                    <div class="mb-3">
                                        <span class="badge badge-soft-primary px-3 py-2 rounded-pill mb-3">{{ $project->category }}</span>
                                        <h5 class="fw-bold text-main mb-2">{{ $project->title }}</h5>
                                        <p class="text-secondary-custom small mb-0">{{ Str::limit($project->description, 120) }}</p>
                                    </div>
                                    <div class="mt-auto pt-3">
                                        <div class="d-flex align-items-center gap-2 small text-secondary-custom mb-3">
                                            <i class="bi bi-clock"></i>
                                            <span class="fw-medium">Tenggat: {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="small text-secondary-custom">Budget Maks:</span>
                                            <span class="fw-bold text-main">Rp {{ number_format($project->budget_max, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="small text-secondary-custom">Bid Terendah:</span>
                                            <span class="fw-bold text-success">
                                                {{ $project->lowestBid ? 'Rp ' . number_format($project->lowestBid->amount, 0, ',', '.') : 'Belum ada' }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="badge badge-soft-success px-3 py-2 rounded-pill">Open Bid</span>
                                            <a href="{{ Auth::check() && Auth::user()->isClient() ? route('projectdetailclient', $project) : route('projectdetailfreelancer', $project) }}" class="btn btn-primary fw-medium px-4">
                                                Lihat <i class="bi bi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <h5 class="text-muted">Tidak ada proyek yang sesuai dengan pencarian Anda.</h5>
                        </div>
                    @endforelse
                


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
