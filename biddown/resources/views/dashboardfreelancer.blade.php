@extends('layouts.app')

@section('title', 'Dashboard Freelancer | Bid Down')

@section('profile-link', route('profilefreelancer'))

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

@section('content')
<div class="hero-dashboard">
    <div>
        <h2 class="fw-bold mb-2">Selamat datang, <span class="text-primary">{{ explode(' ', $freelancer->name)[0] }}!</span></h2>
        <p class="text-secondary-custom mb-0 fs-6">Pantau posisi bid kamu dan selesaikan proyek yang sedang berjalan.</p>
    </div>
    <a href="{{ url('/explore') }}" class="btn btn-primary fw-semibold shadow-sm px-4 py-2 d-inline-flex align-items-center">
        <i class="bi bi-search me-2"></i> Cari Proyek Baru
    </a>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card stat-card p-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #c8a27a, #a68159); color: white;">
                    <i class="bi bi-send-check"></i>
                </div>
                <div>
                    <p class="text-secondary-custom small text-uppercase tracking-wide fw-semibold mb-1">Total Bid Diikuti</p>
                    <h3 class="fw-bold mb-0">{{ $freelancer->bids()->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #8b5e3c, #5c3c24); color: white;">
                    <i class="bi bi-trophy"></i>
                </div>
                <div>
                    <p class="text-secondary-custom small text-uppercase tracking-wide fw-semibold mb-1">Proyek Dimenangkan</p>
                    <h3 class="fw-bold mb-0">{{ $completedProjectsCount }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #4b8b60, #2d5a3c); color: white;">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div>
                    <p class="text-secondary-custom small text-uppercase tracking-wide fw-semibold mb-1">Total Penghasilan</p>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="bid-aktif" class="mb-5">
    <div class="section-title">
        <i class="bi bi-graph-down-arrow text-primary fs-4"></i>
        <h4 class="fw-bold mb-0">Status Bidding Saat Ini</h4>
    </div>
    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>Detail Proyek</th>
                        <th>Sisa Waktu ⏱️</th>
                        <th>Penawaran Saya</th>
                        <th class="text-center">
                            <span class="bg-white text-primary px-2 py-1 rounded shadow-sm border"><i class="bi bi-fire text-danger me-1"></i> Bid Terendah Saat Ini</span>
                        </th>
                        <th>Posisi Bidding</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeBids as $bid)
                    @php
                        $isLowest = $bid->project->lowestBid && $bid->project->lowestBid->id === $bid->id;
                    @endphp
                    <tr class="{{ !$isLowest ? 'row-terkalahkan' : '' }}">
                        <td>
                            <div class="mb-1">
                                <span class="badge badge-soft-secondary px-2 py-1 rounded">{{ $bid->project->category }}</span>
                            </div>
                            <a href="{{ route('projectdetailfreelancer', $bid->project->id) }}" class="fw-semibold text-decoration-none hover-link {{ !$isLowest ? 'text-danger' : '' }} d-block">{{ $bid->project->title }}</a>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <a href="#" class="text-secondary-custom small text-decoration-none hover-link"><i class="bi bi-building me-1"></i> {{ $bid->project->client->name }}</a>
                                <span class="text-secondary-custom small">&bull;</span>
                                <span class="text-secondary-custom small">Tgl Posting: {{ $bid->project->created_at->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td>
                            @php
                                $deadline = \Carbon\Carbon::parse($bid->project->deadline);
                                $isNear = $deadline->diffInDays(now()) <= 1;
                            @endphp
                            <span class="badge badge-soft-{{ $isNear ? 'danger' : 'warning' }} rounded-pill px-3 py-2 fw-semibold">
                                <i class="bi bi-clock me-1"></i> {{ $deadline->diffForHumans() }}
                            </span>
                        </td>
                        <td class="fw-bold {{ !$isLowest ? 'text-danger' : 'text-success' }}">Rp {{ number_format($bid->amount, 0, ',', '.') }}</td>
                        <td class="text-center fw-bold text-success fs-6">
                            @if($bid->project->lowestBid)
                                Rp {{ number_format($bid->project->lowestBid->amount, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($isLowest)
                                <span class="badge badge-soft-success rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-trophy me-1"></i> Memimpin</span>
                            @else
                                <span class="badge badge-soft-danger rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-exclamation-triangle me-1"></i> Terkalahkan</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                @if($isLowest)
                                    <a href="{{ route('projectdetailfreelancer', $bid->project->id) }}" class="btn btn-sm btn-outline-primary fw-medium px-3" title="Lihat Proyek"><i class="bi bi-eye"></i></a>
                                @else
                                    <a href="{{ route('projectdetailfreelancer', $bid->project->id) }}#biddingarea" class="btn btn-sm btn-outline-primary fw-medium px-3" title="Turunkan Harga"><i class="bi bi-arrow-down-circle"></i></a>
                                @endif
                                <form action="{{ route('bids.destroy', $bid->id) }}" method="POST" class="m-0" onsubmit="return confirmAction(event, 'Yakin ingin menarik (membatalkan) bid Anda pada proyek ini?', 'Ya, Tarik Bid')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2" title="Tarik Bid"><i class="bi bi-x-lg"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Kamu belum mengajukan bid apapun.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<section id="proyek-berjalan">
    <div class="section-title">
        <i class="bi bi-check2-all text-primary fs-4"></i>
        <h4 class="fw-bold mb-0">Proyek Terkontrak (Dimenangkan)</h4>
    </div>
    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>Proyek & Klien</th>
                        <th>Harga Disepakati</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contractedProjects as $project)
                    <tr>
                        <td>
                            <div class="mb-1">
                                <span class="badge badge-soft-secondary px-2 py-1 rounded">{{ $project->category }}</span>
                            </div>
                            <a href="{{ route('projectdetailfreelancer', $project->id) }}" class="fw-semibold text-decoration-none hover-link d-block">{{ $project->title }}</a>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <a href="#" class="text-primary small text-decoration-none hover-link fw-medium"><i class="bi bi-building me-1"></i> {{ $project->client->name }}</a>
                                <span class="text-secondary-custom small">&bull;</span>
                                <span class="text-secondary-custom small">Tgl Deal: {{ $project->updated_at->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="fw-bold text-dark">Rp {{ number_format($project->winnerBid->amount, 0, ',', '.') }}</td>
                        <td>
                            @if($project->status === 'closed')
                                <span class="badge badge-soft-warning rounded-pill px-3 py-2 fw-semibold">Pengerjaan</span>
                            @elseif($project->status === 'completed')
                                <span class="badge badge-soft-success rounded-pill px-3 py-2 fw-semibold">Selesai</span>
                            @else
                                <span class="badge badge-soft-success rounded-pill px-3 py-2 fw-semibold">Diulas</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($project->status === 'closed')
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $project->client->phone) }}" target="_blank" class="btn btn-sm btn-success fw-medium px-3"><i class="bi bi-whatsapp me-1"></i> Hubungi Klien</a>
                            @elseif($project->status === 'completed')
                                <a href="{{ route('projectdetailfreelancer', $project->id) }}" class="btn btn-sm btn-outline-primary fw-medium px-3"><i class="bi bi-star me-1"></i> Ulas Balik</a>
                            @else
                                <a href="{{ route('projectdetailfreelancer', $project->id) }}" class="btn btn-sm btn-outline-secondary fw-medium px-3"><i class="bi bi-eye me-1"></i> Detail</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada proyek terkontrak.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
