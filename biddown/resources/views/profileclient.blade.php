@extends('layouts.app')

@section('title', 'Profil Klien - PT Jaya Abadi | Bid Down')

@section('nav-links')
@if(Auth::check() && Auth::user()->role === 'freelancer')
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
@else
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ route('dashboardclient') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ route('dashboardclient') }}#proyek-aktif"><i class="bi bi-briefcase me-1"></i> Proyek Saya</a>
</li>
@endif
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
                    <div class="profile-avatar-xl overflow-hidden">
                        @if($client->avatar_url)
                            <img src="{{ $client->avatar_url }}" alt="Avatar" class="w-100 h-100 object-fit-cover">
                        @else
                            {{ strtoupper(substr($client->name, 0, 2)) }}
                        @endif
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-3 mb-1">
                            <h2 class="fw-bold text-main mb-0">{{ $client->name }}</h2>
                        </div>
                        @if($client->bio)
                        <p class="text-main mb-2 mt-2" style="max-width: 600px;">{{ $client->bio }}</p>
                        @endif
                        <p class="text-secondary-custom mb-0 mt-2 d-flex flex-wrap gap-3">
                            @if($client->location)
                            <span><i class="bi bi-geo-alt me-1"></i> {{ $client->location }}</span>
                            <span class="d-none d-sm-inline text-muted">|</span>
                            @endif
                            <span><i class="bi bi-calendar3 me-1"></i> Bergabung sejak {{ $client->created_at->format('Y') }}</span>
                        </p>
                    </div>
                </div>

<div class="col-md-5 mt-4 mt-md-0">

    <div class="card border-0 bg-light rounded-4 p-3">

        @php
            $totalProjectsClient = App\Models\Project::where('client_id', $client->id)->count();
            $hiredProjects = App\Models\Project::where('client_id', $client->id)->whereNotNull('winner_bid_id')->count();
            $completedProjectsClient = App\Models\Project::where('client_id', $client->id)->where('status', 'completed')->count();
            $hireRate = $totalProjectsClient > 0 ? round(($hiredProjects / $totalProjectsClient) * 100) : 0;
        @endphp
        <div class="row align-items-center text-center">

            <div class="col-4 border-end">
                <small class="text-secondary-custom d-block mb-1">
                    Tingkat Hire
                </small>

                <h4 class="fw-bold text-primary mb-0">
                    {{ $hireRate }}%
                </h4>
            </div>

            <div class="col-4 border-end">
                <small class="text-secondary-custom d-block mb-1">
                    Proyek Selesai
                </small>

                <h4 class="fw-bold text-primary mb-0">
                    {{ $completedProjectsClient }}
                </h4>
            </div>

            <div class="col-4">

                <div class="d-grid gap-2">

                    @if(Auth::id() === $client->id)
                    <a href="{{ route('editprofileclient') }}"
                       class="btn btn-primary btn-sm">
                        <i class="bi bi-pencil-square me-1"></i>
                        Edit Profil
                    </a>
                    @endif

                    @if(!empty($client->portfolio_url))
                    <a href="{{ $client->portfolio_url }}"
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
                @php
                    $activeProjects = App\Models\Project::where('client_id', $client->id)->where('status', 'open')->latest()->get();
                @endphp
                @forelse($activeProjects as $proj)
                <div class="col-md-6 col-lg-4">
                    <div class="card project-card h-100 p-4">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-3">
                                <span class="badge badge-soft-secondary px-2 py-1 mb-2 rounded">{{ $proj->category }}</span>
                                <h5 class="fw-bold text-main mb-1 line-clamp-2">{{ $proj->title }}</h5>
                            </div>
                            <div class="p-3 bg-light rounded-3 border mb-4 mt-auto">
                                <span class="small text-secondary-custom d-block mb-1">Budget Maksimal</span>
                                <span class="fw-bold text-success fs-5">Rp {{ number_format($proj->budget_max, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="text-secondary-custom small fw-medium">
                                    <i class="bi bi-clock me-1"></i> {{ \Carbon\Carbon::parse($proj->deadline)->diffForHumans() }}
                                </span>
                                <a href="{{ route('projectdetailclient', ['project' => $proj->id]) }}" class="btn btn-outline-primary btn-sm fw-semibold px-3">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-secondary-custom">Belum ada proyek aktif.</p>
                </div>
                @endforelse

            </div>
        </section>

        <section class="mb-5">
            @php
                $reviews = App\Models\Review::where('reviewee_id', $client->id)->latest()->get();
                $clientAvgRating = $reviews->avg('rating');
                $clientAvgRating = $clientAvgRating ? number_format($clientAvgRating, 1) : '0.0';
            @endphp

            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-star-fill text-star fs-4"></i>
                <h4 class="fw-bold text-main mb-0">
                    Ulasan & Reputasi
                    @if($clientAvgRating > 0)
                    <span class="text-secondary-custom fw-medium fs-5">
                        ({{ $clientAvgRating }}/5.0)
                    </span>
                    @endif
                </h4>
            </div>
            @if(count($reviews) > 0)
            <div class="card section-card p-4 p-md-5">
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
            </div>
            @else
            <div class="card section-card p-4 p-md-5 text-center">
                <p class="text-secondary-custom mb-0">Belum ada ulasan.</p>
            </div>
            @endif
        </section>

@endsection

