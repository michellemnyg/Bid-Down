@extends('layouts.app')

@section('title', 'Profil Freelancer - Andi Setiawan | Bid Down')

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
    <a class="nav-link nav-link-custom" href="{{ url('/explore') }}"><i class="bi bi-compass me-1"></i> Eksplor Proyek</a>
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

<div class="card p-4 p-md-5 mb-4">

    <div class="row align-items-center">

        <div class="col-lg-6">

            <div class="d-flex align-items-center gap-4">

                <div class="profile-avatar-xl overflow-hidden d-flex align-items-center justify-content-center text-white" style="background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%); font-size: 36px; font-weight: 700;">
                    @if($freelancer->avatar_url)
                        <img src="{{ $freelancer->avatar_url }}" alt="Avatar" class="w-100 h-100 object-fit-cover">
                    @else
                        {{ strtoupper(substr($freelancer->name, 0, 2)) }}
                    @endif
                </div>

                <div>

                    <h2 class="fw-bold mb-1">
                        {{ $freelancer->name }}
                    </h2>

                    <div class="text-primary fw-semibold mb-3">
                        {{ $freelancer->job_title ?? 'Freelancer' }}
                    </div>

                    <div class="profile-meta">

                        @if($freelancer->location)
                        <div class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i>
                            {{ $freelancer->location }}
                        </div>
                        @endif

                        <div>
                            <i class="bi bi-calendar3 me-2"></i>
                            Bergabung sejak {{ $freelancer->created_at->format('Y') }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

        @php
            $freelancerCompletedProjects = App\Models\Project::whereIn('status', ['completed', 'reviewed'])->whereHas('winnerBid', function($q) use ($freelancer) {
                $q->where('freelancer_id', $freelancer->id);
            })->count();
            $freelancerAvgRating = App\Models\Review::where('reviewee_id', $freelancer->id)->avg('rating');
            $freelancerAvgRating = $freelancerAvgRating ? number_format($freelancerAvgRating, 1) : '0.0';
        @endphp
        <div class="col-lg-3 mt-4 mt-lg-0">

            <div class="d-flex justify-content-center gap-5">

                <div class="text-center">

                    <div class="text-secondary-custom small">
                        Rating
                    </div>

                    <h3 class="fw-bold text-primary mb-0">
                        {{ $freelancerAvgRating }}
                    </h3>

                </div>

                <div class="text-center">

                    <div class="text-secondary-custom small">
                        Proyek Selesai
                    </div>

                    <h3 class="fw-bold text-primary mb-0">
                        {{ $freelancerCompletedProjects }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-lg-3 mt-4 mt-lg-0">

            <div class="d-grid gap-2">

                @if(Auth::id() === $freelancer->id)
                <a href="{{ route('editprofilefreelancer') }}"
                   class="btn btn-primary">

                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Profil

                </a>
                @endif

                 @if(!empty($freelancer->portfolio_url))
                    <a href="{{ $freelancer->portfolio_url }}"
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

    <div class="col-lg-4">

        <div class="profile-sidebar">

            <div class="card p-4 mb-4">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-person text-primary fs-5"></i>
                    <h5 class="fw-bold text-main mb-0">
                        Tentang Saya
                    </h5>
                </div>

                <p class="text-secondary-custom mb-0" style="line-height:1.9; white-space: pre-line;">
                    {{ $freelancer->bio ?? 'Belum ada deskripsi.' }}
                </p>

            </div>

            <div class="card p-4">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-lightning-charge text-primary fs-5"></i>
                    <h5 class="fw-bold text-main mb-0">
                        Keahlian
                    </h5>
                </div>

                <div class="d-flex flex-wrap gap-2">

                    <div class="d-flex flex-wrap gap-2">
                        @if($freelancer->skills)
                            @foreach(explode(',', $freelancer->skills) as $skill)
                            <span class="skill-chip">
                                <i class="bi bi-check2-circle me-2"></i>
                                {{ trim($skill) }}
                            </span>
                            @endforeach
                        @else
                            <span class="text-secondary-custom">Belum ada keahlian yang ditambahkan.</span>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-8">

        <div class="card p-4 p-md-5 mb-4">

            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-grid text-primary fs-4"></i>
                <h4 class="fw-bold text-main mb-0">
                    Portofolio
                </h4>
            </div>

            <div class="row g-4">
                @if($freelancer->portfolio_url)
                <div class="col-md-6">
                    <a href="{{ $freelancer->portfolio_url }}" class="text-decoration-none hover-link" target="_blank">
                        <div class="portfolio-card card border shadow-sm">
                            <div class="p-4">
                                <h6 class="fw-bold mb-1 text-main">
                                    <i class="bi bi-link-45deg me-1"></i> Website / Link Portofolio Utama
                                </h6>
                                <small class="text-primary d-block mt-2 text-break">
                                    {{ $freelancer->portfolio_url }}
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
                @endif

                @foreach($freelancer->portfolios as $portfolio)
                <div class="col-md-6">
                    <a href="{{ $portfolio->url }}" class="text-decoration-none hover-link" target="_blank">
                        <div class="portfolio-card card border shadow-sm">
                            <div class="p-4">
                                <h6 class="fw-bold mb-1 text-main">
                                    {{ $portfolio->title }}
                                </h6>
                                <small class="text-secondary-custom">
                                    {{ $portfolio->technology }}
                                </small>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

                @if(!$freelancer->portfolio_url && count($freelancer->portfolios) == 0)
                <div class="col-12 text-center text-muted py-4">
                    Belum ada portofolio yang dicantumkan.
                </div>
                @endif
            </div>

        </div>

        <div class="card p-4 p-md-5">

            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-chat-square-text text-primary fs-4"></i>
                <h4 class="fw-bold text-main mb-0">
                    Ulasan Klien
                    @if($freelancerAvgRating > 0)
                    <span class="text-secondary-custom fw-medium fs-5">
                        ({{ $freelancerAvgRating }}/5.0)
                    </span>
                    @endif
                </h4>
            </div>

            @php
                $reviews = App\Models\Review::where('reviewee_id', $freelancer->id)->latest()->get();
            @endphp
            @if(count($reviews) > 0)
                @foreach($reviews as $review)
                <div class="review-item border-bottom border-light mb-4 pb-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="review-avatar flex-shrink-0">
                            {{ strtoupper(substr($review->reviewer->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                                <h6 class="fw-bold text-main mb-0">{{ $review->reviewer->name }}</h6>
                                <span class="text-secondary-custom small">&bull; {{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-star small mb-2">
                                @for($i = 0; $i < $review->rating; $i++)
                                    <i class="bi bi-star-fill"></i>
                                @endfor
                                @for($i = $review->rating; $i < 5; $i++)
                                    <i class="bi bi-star"></i>
                                @endfor
                            </div>
                            <p class="text-main mb-0">{{ $review->message }}</p>
                            <div class="mt-2 text-secondary-custom small">
                                <i class="bi bi-diagram-3 me-1"></i> Proyek: <span class="fw-medium">{{ $review->project->title }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="text-center text-muted py-4">
                    Belum ada ulasan.
                </div>
            @endif

        </div>

    </div>

</div>

@endsection

