@extends('layouts.app')

@section('title', 'Dashboard Klien | Bid Down')

@section('profile-link', route('profileclient'))

@section('nav-links')
<li class="nav-item">
    <a class="nav-link nav-link-custom active" href="{{ url('/dashboardclient') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardclient') }}#proyek-aktif"><i class="bi bi-briefcase me-1"></i> Proyek Saya</a>
</li>
@endsection

@section('content')
<div class="hero-dashboard">
    <div>
        <h2 class="fw-bold mb-2">Selamat datang, <span class="text-primary">{{ $client->name }}!</span></h2>
        <p class="text-secondary-custom mb-0 fs-6">Pantau proyek aktifmu dan temukan freelancer terbaik hari ini.</p>
    </div>
    <a href="{{ url('/make-project') }}" class="btn btn-primary fw-semibold shadow-sm px-4 py-2 d-inline-flex align-items-center">
        <i class="bi bi-plus-lg me-2"></i> Posting Proyek Baru
    </a>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card stat-card p-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #c8a27a, #a68159); color: white;">
                    <i class="bi bi-folder2-open"></i>
                </div>
                <div>
                    <p class="text-secondary-custom small text-uppercase tracking-wide fw-semibold mb-1">Total Proyek</p>
                    <h3 class="fw-bold mb-0">{{ $totalProjects }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-4 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background: linear-gradient(135deg, #8b5e3c, #5c3c24); color: white;">
                    <i class="bi bi-broadcast"></i>
                </div>
                <div>
                    <p class="text-secondary-custom small text-uppercase tracking-wide fw-semibold mb-1">Proyek Aktif (Bidding)</p>
                    <h3 class="fw-bold mb-0">{{ $activeProjects->count() }}</h3>
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
                    <p class="text-secondary-custom small text-uppercase tracking-wide fw-semibold mb-1">Total Pengeluaran</p>
                    <h3 class="fw-bold mb-0">Rp {{ number_format($totalSpend, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="proyek-aktif" class="mb-5">
    <div class="section-title">
        <i class="bi bi-activity text-primary fs-4"></i>
        <h4 class="fw-bold mb-0">Proyek Aktif (Fase Bidding)</h4>
    </div>
    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>Detail Proyek</th>
                        <th>Sisa Waktu Bidding ⏱️</th>
                        <th>Modal Maksimal</th>
                        <th>Total Bid</th>
                        <th class="text-center">
                            <span class="bg-white text-primary px-2 py-1 rounded shadow-sm border"><i class="bi bi-fire text-danger me-1"></i> Bid Terendah</span>
                        </th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activeProjects as $project)
                    <tr>
                        <td>
                            <div class="mb-1">
                                <span class="badge badge-soft-secondary px-2 py-1 rounded">{{ $project->category }}</span>
                            </div>
                            <a href="{{ route('projectdetailclient', $project->id) }}" class="fw-semibold text-decoration-none hover-link d-block">{{ $project->title }}</a>
                            <span class="text-secondary-custom small">Tanggal Posting: {{ $project->created_at->format('d M Y') }}</span>
                        </td>
                        <td>
                            @php
                                $deadline = \Carbon\Carbon::parse($project->deadline);
                                $isNear = $deadline->diffInDays(now()) <= 1;
                            @endphp
                            <span class="badge badge-soft-{{ $isNear ? 'danger' : 'warning' }} rounded-pill px-3 py-2 fw-semibold">
                                <i class="bi bi-clock me-1"></i> {{ $deadline->diffForHumans() }}
                            </span>
                        </td>
                        <td class="fw-medium text-dark">Rp {{ number_format($project->budget_max, 0, ',', '.') }}</td>
                        <td><span class="badge bg-secondary rounded-pill px-3 py-2">{{ $project->bids_count }} Bid</span></td>
                        <td class="text-center fw-bold text-success fs-6">
                            @if($project->lowestBid)
                                Rp {{ number_format($project->lowestBid->amount, 0, ',', '.') }}
                            @else
                                <span class="text-muted fs-6 fw-normal">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('projectdetailclient', $project->id) }}" class="btn btn-sm btn-outline-primary fw-medium px-3" title="Lihat Bids"><i class="bi bi-eye me-1"></i> Detail</a>
                                <a href="{{ route('edit-project', $project->id) }}" class="btn btn-sm btn-outline-secondary fw-medium px-2" title="Edit Proyek"><i class="bi bi-pencil"></i></a>
                                <form action="#" method="POST" class="m-0" onsubmit="return confirmAction(event, 'Yakin ingin menghapus proyek ini?', 'Ya, Hapus')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada proyek aktif.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<section id="riwayat-proyek">
    <div class="section-title">
        <i class="bi bi-check2-all text-primary fs-4"></i>
        <h4 class="fw-bold mb-0">Riwayat Proyek (Terkontrak & Selesai)</h4>
    </div>
    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>Detail Proyek</th>
                        <th>Pemenang</th>
                        <th>Harga Deal</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($historyProjects as $project)
                    <tr>
                        <td>
                            <div class="mb-1">
                                <span class="badge badge-soft-secondary px-2 py-1 rounded">{{ $project->category }}</span>
                            </div>
                            <a href="{{ route('projectdetailclient', $project->id) }}" class="fw-semibold text-decoration-none hover-link d-block">{{ $project->title }}</a>
                            <span class="text-secondary-custom small">Selesai/Ditutup: {{ $project->updated_at->format('d M Y') }}</span>
                        </td>
                        <td>
                            @if($project->winnerBid)
                            <a href="{{ route('profilefreelancer', ['id' => $project->winnerBid->freelancer_id]) }}" class="d-flex align-items-center gap-2 text-decoration-none hover-link">
                                <div class="avatar-sm shadow-sm">{{ strtoupper(substr($project->winnerBid->freelancer->name, 0, 2)) }}</div>
                                <span class="fw-medium">{{ $project->winnerBid->freelancer->name }}</span>
                            </a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark">
                            @if($project->winnerBid)
                                Rp {{ number_format($project->winnerBid->amount, 0, ',', '.') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($project->status === 'closed')
                                <span class="badge badge-soft-warning rounded-pill px-3 py-2 fw-semibold">Terkontrak</span>
                            @elseif($project->status === 'completed')
                                <span class="badge badge-soft-info rounded-pill px-3 py-2 fw-semibold">Selesai (Menunggu Ulasan)</span>
                            @else
                                <span class="badge badge-soft-success rounded-pill px-3 py-2 fw-semibold">Diulas</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($project->status === 'closed')
                            <form action="{{ route('projects.complete', $project->id) }}" method="POST" class="m-0 d-inline" onsubmit="return confirmAction(event, 'Konfirmasi bahwa pengerjaan proyek ini telah selesai?', 'Ya, Selesai')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success fw-medium px-3"><i class="bi bi-check-circle me-1"></i> Selesai</button>
                            </form>
                            @elseif($project->status === 'completed')
                            <a href="{{ route('projectdetailclient', $project->id) }}" class="btn btn-sm btn-outline-primary fw-medium px-3"><i class="bi bi-star me-1"></i> Ulas</a>
                            @else
                            <a href="{{ route('projectdetailclient', $project->id) }}" class="btn btn-sm btn-outline-secondary fw-medium px-3"><i class="bi bi-eye me-1"></i> Detail</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada riwayat proyek.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
