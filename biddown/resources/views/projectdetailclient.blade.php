@extends('layouts.app')

@section('title', 'Detail Proyek - Pembuatan Landing Page | Bid Down')

@section('profile-link', route('profileclient'))

@section('nav-links')
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardclient') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom active" href="{{ url('/dashboardclient') }}#proyek-aktif"><i class="bi bi-briefcase me-1"></i> Proyek Saya</a>
</li>
@endsection

@section('styles')
<style>
    .btn-success-custom {
        background-color: #1e8e3e;
        color: white;
        border-color: #1e8e3e;
    }
    .btn-success-custom:hover {
        background-color: #177132;
        border-color: #177132;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(30, 142, 62, 0.3);
    }
    .btn-outline-success-custom {
        color: #1e8e3e;
        border-color: #1e8e3e;
        background-color: transparent;
    }
    .btn-outline-success-custom:hover {
        background-color: #e6f4ea;
        color: #1e8e3e;
        transform: translateY(-2px);
    }
    .section-card {
        background-color: var(--surface);
        border: 1px solid var(--border-color) !important;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.02) !important;
    }
    .timer-box {
        background: linear-gradient(180deg, var(--surface) 0%, var(--background) 100%);
        border: 1px solid var(--border-color);
        border-radius: 16px;
    }
    .digital-clock {
        font-variant-numeric: tabular-nums;
        letter-spacing: 1px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .rank-1 td {
        background-color: #e6f4ea !important;
        border-bottom: 1px solid #ceead6;
    }
    .avatar-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }
    .avatar-dark {
        background-color: #f1f3f4;
        color: #5f6368;
        border: 1px solid #e8eaed;
    }
    .avatar-primary {
        background-color: var(--primary);
        color: white;
        box-shadow: 0 4px 8px rgba(139, 94, 60, 0.3);
    }
    .text-star { color: #f5b301 !important; }
</style>
@endsection

@section('content')
        @php
            $isBiddingOpen = $project->isOpen();
        @endphp

        <div class="d-flex justify-content-between align-items-center mb-4">
            <button onclick="history.back()" class="btn btn-outline-secondary shadow-sm fw-semibold px-4">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
            <a href="{{ route('edit-project', $project->id) }}" class="btn btn-primary fw-semibold px-4 shadow-sm">
                <i class="bi bi-pencil me-2"></i> Edit Proyek
            </a>
        </div>

        <div class="row g-4 mb-5">

            <div class="col-lg-8">
                <div class="card section-card p-4 p-md-5 h-100">
                    <div class="mb-3">
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <span class="badge badge-soft-secondary px-3 py-2">{{ $project->category }}</span>
                        </div>
                        <h2 class="fw-bold text-main mb-2">{{ $project->title }}</h2>
                        <div class="d-flex align-items-center gap-2">
                            @if($isBiddingOpen)
                                <span class="badge badge-soft-success rounded-pill px-3 py-2 fs-6 d-flex align-items-center gap-1">
                                    <span class="spinner-grow spinner-grow-sm text-success" style="width: 0.5rem; height: 0.5rem;" role="status"></span> OPEN BID
                                </span>
                            @elseif($project->status === 'completed')
                                <span class="badge badge-soft-info rounded-pill px-3 py-2 fs-6 d-flex align-items-center gap-1">
                                    <i class="bi bi-check-circle-fill"></i> SELESAI (MENUNGGU ULASAN)
                                </span>
                            @elseif($project->status === 'reviewed')
                                <span class="badge badge-soft-success rounded-pill px-3 py-2 fs-6 d-flex align-items-center gap-1">
                                    <i class="bi bi-star-fill"></i> PROYEK DITUTUP
                                </span>
                            @else
                                <span class="badge badge-soft-primary rounded-pill px-3 py-2 fs-6 d-flex align-items-center gap-1">
                                    <i class="bi bi-lock-fill"></i> BIDDING DITUTUP
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-3 text-secondary-custom mb-4 align-items-center border-bottom border-light pb-4">
                        <span>
                            Diterbitkan oleh: <a href="{{ route('profileclient') }}" class="text-primary fw-semibold text-decoration-none hover-link"><i class="bi bi-building me-1"></i> {{ $project->client->name }} (Anda)</a>
                        </span>
                        <span class="d-none d-sm-inline">|</span>
                        <span><i class="bi bi-calendar-date me-1"></i> {{ $project->created_at->format('d M Y') }}</span>
                    </div>

                    <h5 class="fw-bold text-main mb-3">Deskripsi Proyek</h5>
                    <p class="text-main" style="line-height: 1.7; white-space: pre-line;">
                        {{ $project->description }}
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="timer-box p-4 p-md-5 h-100 text-center d-flex flex-column justify-content-center">

                    <h6 class="text-secondary-custom fw-semibold text-uppercase tracking-wide mb-2">
                        @if($isBiddingOpen)
                            <i class="bi bi-alarm me-1"></i> Sisa Waktu Bidding
                        @else
                            <i class="bi bi-award me-1"></i> Status Pemenang
                        @endif
                    </h6>

                    @if($isBiddingOpen)
                        @php
                            $deadline = \Carbon\Carbon::parse($project->deadline);
                            $isNear = $deadline->diffInDays(now()) <= 1;
                        @endphp
                        <h2 id="liveCountdown" class="fw-bold {{ $isNear ? 'text-danger' : 'text-primary' }} mb-4 digital-clock display-5" data-deadline="{{ $deadline->toIso8601String() }}">{{ $deadline->diffForHumans() }}</h2>
                    @else
                        @if($project->winnerBid)
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-4 mt-2">
                            <div class="avatar-sm avatar-primary">{{ strtoupper(substr($project->winnerBid->freelancer->name, 0, 2)) }}</div>
                            <div class="text-start">
                                <h5 class="fw-bold text-main mb-0">{{ $project->winnerBid->freelancer->name }}</h5>
                                <span class="text-secondary-custom small">Terpilih sebagai pemenang</span>
                            </div>
                        </div>
                        @else
                        <div class="mb-4 mt-2">
                            <span class="text-secondary-custom small">Tidak ada pemenang</span>
                        </div>
                        @endif
                    @endif

                    <hr class="border-secondary opacity-25 my-4">

                    <div class="mb-4">
                        <p class="text-secondary-custom fw-medium mb-1 fs-6">Modal Dasar (Maksimal)</p>
                        <h4 class="fw-bold text-main mb-0">Rp {{ number_format($project->budget_max, 0, ',', '.') }}</h4>
                    </div>

                    <div class="p-3 bg-surface rounded-3 shadow-sm border border-light">
                        <p class="text-secondary-custom fw-medium mb-1 fs-6">Bid Terendah Saat Ini</p>
                        <h3 class="fw-bold text-success mb-0">{{ $project->lowestBid ? 'Rp ' . number_format($project->lowestBid->amount, 0, ',', '.') : 'Belum ada' }}</h3>
                    </div>

                </div>
            </div>
        </div>

        <section id="bidding-area">

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4">
                <h4 class="fw-bold text-main mb-2 mb-sm-0"><i class="bi bi-list-ol text-primary me-2"></i> Leaderboard Bidding</h4>
                @if($isBiddingOpen)
                    <span class="text-secondary-custom small fw-medium"><i class="bi bi-info-circle me-1"></i> Menampilkan 3 penawaran teratas.</span>
                @else
                    <span class="text-secondary-custom small fw-medium"><i class="bi bi-lock-fill me-1"></i> Bidding telah dikunci.</span>
                @endif
            </div>

            <div class="card section-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 10%;">Peringkat</th>
                                <th style="width: 30%;">Nama Freelancer</th>
                                <th style="width: 25%;">Nominal Penawaran</th>
                                <th style="width: 20%;">Waktu Bid</th>
                                <th class="text-center" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($project->bids->sortBy('amount')->values() as $index => $bid)
                                    <tr class="{{ $index === 0 ? 'rank-1' : '' }}">
                                        <td class="text-center">
                                            @if($index === 0)
                                                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm border border-success" style="width: 40px; height: 40px;">
                                                    <h5 class="fw-bold text-success mb-0">1</h5>
                                                </div>
                                                <span class="d-block mt-1 small text-success fw-bold"><i class="bi bi-trophy-fill me-1"></i>Leader</span>
                                            @else
                                                <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm border border-secondary" style="width: 40px; height: 40px;">
                                                    <h5 class="fw-bold text-secondary mb-0">{{ $index + 1 }}</h5>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-sm {{ $index === 0 ? 'avatar-primary' : 'avatar-dark' }}">
                                                    {{ strtoupper(substr($bid->freelancer->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <a href="{{ route('profilefreelancer', ['id' => $bid->freelancer_id]) }}" class="fw-bold text-primary text-decoration-none d-block hover-link">{{ $bid->freelancer->name }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td><h5 class="fw-bold {{ $index === 0 ? 'text-success' : 'text-main' }} mb-0">Rp {{ number_format($bid->amount, 0, ',', '.') }}</h5></td>
                                        <td class="text-secondary-custom small fw-medium">{{ $bid->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if($isBiddingOpen)
                                                <form action="{{ route('projects.choose-winner', ['project' => $project->id, 'bid' => $bid->id]) }}" method="POST" onsubmit="return confirmAction(event, 'Yakin memilih freelancer ini sebagai pemenang? Proyek akan langsung terkunci.', 'Ya, Pilih Pemenang')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn {{ $index === 0 ? 'btn-success-custom shadow-sm' : 'btn-outline-success-custom' }} fw-bold w-100">Pilih Pemenang</button>
                                                </form>
                                            @elseif($project->winnerBid && $project->winnerBid->id === $bid->id)
                                                <button class="btn btn-primary fw-bold shadow-sm w-100" disabled><i class="bi bi-check2 me-1"></i> Pemenang</button>
                                            @else
                                                <button class="btn btn-outline-secondary fw-bold w-100" disabled>Terkalahkan</button>
                                            @endif
                                        </td>
                                    </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada penawaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        @if(!$isBiddingOpen && $project->winnerBid)
        <div class="row mt-5">
            <div class="col-12">
                <div class="card section-card p-4 p-md-5 border-primary" style="border-width: 2px !important; background: linear-gradient(to right, rgba(139, 94, 60, 0.05), transparent);">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">

                        <div>
                            <h4 class="fw-bold text-main mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> Kontak Pemenang</h4>
                            <p class="text-secondary-custom mb-0">Hubungi freelancer untuk berdiskusi lebih lanjut tentang proyek ini di luar platform.</p>

                            <div class="d-flex flex-wrap gap-3 mt-4">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $project->winnerBid->freelancer->phone) }}" target="_blank" class="btn btn-success rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-whatsapp me-2"></i> {{ $project->winnerBid->freelancer->phone }}
                                </a>
                                <a href="mailto:{{ $project->winnerBid->freelancer->email }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-envelope me-2"></i> {{ $project->winnerBid->freelancer->email }}
                                </a>
                            </div>
                        </div>

                        <div class="text-md-end text-center p-4 bg-white rounded-4 shadow-sm" style="min-width: 300px;">
                            @if($project->status === 'closed')
                                <h6 class="fw-bold text-main mb-3">Pekerjaan Selesai?</h6>
                                <p class="small text-secondary-custom mb-3">Konfirmasi jika freelancer telah menyerahkan hasil pekerjaan secara lengkap.</p>
                                <form action="{{ route('projects.complete', $project->id) }}" method="POST" onsubmit="return confirmAction(event, 'Konfirmasi bahwa pengerjaan proyek ini telah selesai?', 'Ya, Selesai')">
                                    @csrf
                                    <button type="submit" class="btn btn-success fw-bold w-100 shadow-sm">
                                        <i class="bi bi-check-circle-fill me-1"></i> Tandai Selesai
                                    </button>
                                </form>
                            @elseif($project->status === 'completed')
                                <h6 class="fw-bold text-main mb-3">Proyek Selesai!</h6>
                                <p class="small text-secondary-custom mb-3">Silakan berikan ulasan atas kinerja freelancer untuk menutup proyek.</p>
                                <button type="button" class="btn btn-primary fw-bold w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                    <i class="bi bi-star-fill me-1"></i> Beri Ulasan
                                </button>
                            @else
                                <div class="text-center">
                                    <i class="bi bi-star-fill text-star fs-1 mb-2"></i>
                                    <h6 class="fw-bold text-success mb-1">Proyek Ditutup</h6>
                                    <p class="small text-secondary-custom mb-0">Proyek selesai dan telah diulas.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow" style="border-radius: 16px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold text-main" id="reviewModalLabel">Beri Ulasan ke Freelancer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projects.client-review', $project->id) }}" method="POST">
                            @csrf
                            <div class="text-center mb-4">
                                <div class="avatar-sm avatar-primary mx-auto mb-2" style="width: 60px; height: 60px; font-size: 24px;">{{ strtoupper(substr($project->winnerBid->freelancer->name, 0, 2)) }}</div>
                                <h6 class="fw-bold mb-0">{{ $project->winnerBid->freelancer->name }}</h6>
                            </div>

                            <div class="mb-3 text-center">
                                <label class="form-label fw-semibold d-block">Rating Anda</label>
                                <div class="fs-2 text-star" style="cursor: pointer;">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </div>
                                <input type="hidden" name="rating" value="4">
                            </div>

                            <div class="mb-4">
                                <label for="reviewText" class="form-label fw-semibold">Ulasan Pekerjaan</label>
                                <textarea class="form-control" id="reviewText" name="review" rows="4" placeholder="Bagaimana hasil kerja freelancer? Apakah sesuai ekspektasi Anda?" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary fw-bold w-100 py-2">Kirim Ulasan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const countdownEl = document.getElementById("liveCountdown");
        if (countdownEl) {
            const deadlineIso = countdownEl.getAttribute("data-deadline");
            const deadlineTime = new Date(deadlineIso).getTime();

            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = deadlineTime - now;

                if (distance < 0) {
                    clearInterval(timer);
                    countdownEl.innerHTML = "WAKTU HABIS";
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                let display = "";
                if (days > 0) display += days + "h ";
                display += String(hours).padStart(2, '0') + ":" + 
                           String(minutes).padStart(2, '0') + ":" + 
                           String(seconds).padStart(2, '0');

                countdownEl.innerHTML = display;
            }, 1000);
        }
    });
</script>
@endsection

