@extends('layouts.app')

@section('title', 'Detail Proyek & Bidding - Tampilan Freelancer | Bid Down')

@section('user-name', 'Andi Setiawan')
@section('user-avatar', 'AS')
@section('profile-link', url('/profilefreelancer'))

@section('nav-links')
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardfreelancer') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/explore') }}"><i class="bi bi-search me-1"></i> Eksplor Proyek</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom active" href="{{ url('/dashboardfreelancer') }}#bid-aktif"><i class="bi bi-tag me-1"></i> Bid Aktif Saya</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardfreelancer') }}#proyek-berjalan"><i class="bi bi-briefcase me-1"></i> Proyek Berjalan</a>
</li>
@endsection

@section('styles')
<style>
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
    .bidding-form-card {
        background-color: var(--surface);
        border: 1px solid var(--border-color);
        border-left: 6px solid var(--primary);
        border-radius: 16px;
        box-shadow: 0 12px 32px rgba(139, 94, 60, 0.05);
    }
    .rank-1 td {
        background-color: #e6f4ea !important;
        border-bottom: 1px solid #ceead6;
    }
    .my-bid-row td {
        background-color: var(--primary-soft) !important;
        border-bottom: 1px solid rgba(139, 94, 60, 0.1);
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
</style>
@endsection

@section('content')
        <div class="mb-4">
            <button onclick="history.back()" class="btn btn-outline-secondary shadow-sm fw-semibold px-4">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
        </div>

        <div class="row g-4 mb-5">
            
            <div class="col-lg-8">
                <div class="card section-card p-4 p-md-5 h-100">
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <h2 class="fw-bold text-main mb-0">{{ $project->title ?? 'Pembuatan Landing Page Perusahaan' }}</h2>
                        <span class="badge badge-soft-success rounded-pill px-3 py-2 fs-6 d-flex align-items-center gap-1">
                            <span class="spinner-grow spinner-grow-sm text-success" style="width: 0.5rem; height: 0.5rem;" role="status"></span> OPEN BID
                        </span>
                    </div>

                    <div class="d-flex flex-wrap gap-3 text-secondary-custom mb-4 align-items-center border-bottom border-light pb-4">
                        <span>
                            Diterbitkan oleh: <a href="{{ url('/profileclient') }}" class="text-primary fw-semibold text-decoration-none hover-link"><i class="bi bi-building me-1"></i> {{ $project->client->name ?? 'PT Jaya Abadi' }}</a>
                        </span>
                        <span class="d-none d-sm-inline">|</span>
                        <span><i class="bi bi-calendar-date me-1"></i> {{ isset($project) ? $project->created_at->format('d M Y') : '12 Okt 2024' }}</span>
                    </div>

                    <h5 class="fw-bold text-main mb-3">Deskripsi Proyek</h5>
                    <p class="text-main" style="line-height: 1.7;">
                        {{ $project->description ?? 'Kami mencari Web Developer yang berpengalaman untuk membuat sebuah Landing Page modern dan responsif untuk peluncuran produk baru kami. Website harus dibuat menggunakan framework HTML/CSS/JS modern (Bootstrap 5 atau Tailwind CSS) dan dipastikan memiliki skor load speed yang baik.' }}
                    </p>
                    <p class="text-main" style="line-height: 1.7;">
                        <strong>Persyaratan Khusus:</strong><br>
                        <span class="d-block mb-1">- Desain harus mengikuti brand guidelines perusahaan (akan diberikan kepada pemenang).</span>
                        <span class="d-block mb-1">- Terdapat form kontak yang terintegrasi (minimal kirim ke email).</span>
                        <span class="d-block mb-1">- Waktu pengerjaan maksimal 7 hari setelah pemenang dipilih.</span>
                    </p>
                    
                    <h6 class="fw-bold text-main mt-4 mb-3">Kategori & Keahlian Dibutuhkan:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge badge-soft-secondary px-3 py-2">{{ $project->category ?? 'Web Development' }}</span>
                        <span class="badge badge-soft-secondary px-3 py-2">HTML/CSS</span>
                        <span class="badge badge-soft-secondary px-3 py-2">Bootstrap 5</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="timer-box p-4 p-md-5 h-100 text-center d-flex flex-column justify-content-center">
                    
                    <h6 class="text-secondary-custom fw-semibold text-uppercase tracking-wide mb-2"><i class="bi bi-alarm me-1"></i> Sisa Waktu Bidding</h6>
                    <h2 class="fw-bold text-accent mb-4 digital-clock display-5">02:15:30</h2>

                    <hr class="border-secondary opacity-25 my-4">

                    <div class="mb-4">
                        <p class="text-secondary-custom fw-medium mb-1 fs-6">Modal Dasar (Maksimal)</p>
                        <h4 class="fw-bold text-main mb-0">Rp {{ isset($project) ? number_format($project->max_price, 0, ',', '.') : '3.000.000' }}</h4>
                    </div>

                    <div class="p-3 bg-surface rounded-3 shadow-sm border border-light">
                        <p class="text-secondary-custom fw-medium mb-1 fs-6">Bid Terendah Saat Ini</p>
                        <h3 class="fw-bold text-success mb-0">{{ isset($lowestBid) && $lowestBid ? 'Rp ' . number_format($lowestBid->amount, 0, ',', '.') : 'Belum ada' }}</h3>
                    </div>

                </div>
            </div>
        </div>

        <section id="biddingarea">
            
            <div class="bidding-form-card p-4 p-md-5 mb-5">
                <div class="row align-items-center g-4">
                    <div class="col-md-6">
                        <h4 class="fw-bold text-main mb-2"><i class="bi bi-tag-fill text-primary me-2"></i> Ajukan Penawaran Baru</h4>
                        <p class="text-secondary-custom mb-0" style="line-height: 1.6;">Masukkan angka yang lebih rendah dari bid terendah saat ini untuk merebut posisi memimpin (peringkat #1).</p>
                    </div>
                    <div class="col-md-6">
                        <form action="#" method="POST" onsubmit="return confirmAction(event, 'Yakin ingin mengirim penawaran (bid) sebesar Rp ' + this.amount.value + '?', 'Ya, Kirim Bid')">
                            @csrf
                            <div class="input-group input-group-lg mb-2 shadow-sm">
                                <span class="input-group-text border-end-0">Rp</span>
                                <input type="number" class="form-control border-start-0 ps-0" name="amount" placeholder="Masukkan nominal bid..." aria-label="Nominal Bid" required>
                                <button class="btn btn-primary fw-bold px-4" type="submit">Kirim Bid</button>
                            </div>
                            <small class="text-accent fw-medium d-block mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i> Bid saat ini terendah adalah {{ isset($lowestBid) && $lowestBid ? 'Rp ' . number_format($lowestBid->amount, 0, ',', '.') : 'belum ada' }}.
                            </small>
                        </form>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4">
                <h4 class="fw-bold text-main mb-2 mb-sm-0"><i class="bi bi-list-ol text-primary me-2"></i> Leaderboard Bidding</h4>
                <span class="badge badge-soft-primary px-3 py-2 rounded-pill"><i class="bi bi-broadcast me-1"></i> Live Update Aktif</span>
            </div>

            <div class="card section-card overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-custom align-middle">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 15%;">Peringkat</th>
                                <th style="width: 40%;">Nama Freelancer</th>
                                <th style="width: 25%;">Nominal Penawaran</th>
                                <th style="width: 20%;">Waktu Bid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($project)
                                @foreach ($project->bids->sortBy('amount')->values() as $index => $bid)
                                    <tr>
                                        <td class="text-center fw-bold">#{{ $index + 1 }}</td>
                                        <td>
                                            <span class="fw-bold text-main d-block">
                                                {{ $project->blind_review ? 'Anonymous Freelancer' : $bid->freelancer->name }}
                                            </span>
                                        </td>
                                        <td><h5 class="fw-bold text-success mb-0">Rp {{ number_format($bid->amount, 0, ',', '.') }}</h5></td>
                                        <td class="text-secondary-custom small fw-medium">{{ $bid->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                            <tr class="rank-1">
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm border border-success" style="width: 40px; height: 40px;">
                                        <h5 class="fw-bold text-success mb-0">1</h5>
                                    </div>
                                    <span class="d-block mt-1 small text-success fw-bold"><i class="bi bi-trophy-fill me-1"></i>Leader</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-sm avatar-dark"><i class="bi bi-incognito"></i></div>
                                        <div>
                                            <span class="fw-bold text-main d-block">Anonymous Freelancer</span>
                                            <span class="text-secondary-custom small">Identitas disamarkan klien</span>
                                        </div>
                                    </div>
                                </td>
                                <td><h5 class="fw-bold text-success mb-0">Rp 2.100.000</h5></td>
                                <td class="text-secondary-custom small fw-medium">10 Menit yang lalu</td>
                            </tr>
                            
                            <tr class="my-bid-row">
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm border border-primary" style="width: 40px; height: 40px;">
                                        <h5 class="fw-bold text-primary mb-0">2</h5>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-sm avatar-primary">AS</div>
                                        <div>
                                            <span class="fw-bold text-primary d-block">Andi Setiawan (Anda)</span>
                                            <span class="badge bg-primary mt-1">Posisi Anda Saat Ini</span>
                                        </div>
                                    </div>
                                </td>
                                <td><h5 class="fw-bold text-primary mb-0">Rp 2.300.000</h5></td>
                                <td class="text-secondary-custom small fw-medium">1 Jam yang lalu</td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 40px; height: 40px;">
                                        <h5 class="fw-bold text-secondary mb-0">3</h5>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-sm avatar-dark"><i class="bi bi-incognito"></i></div>
                                        <div>
                                            <span class="fw-bold text-main d-block">Anonymous Freelancer</span>
                                            <span class="text-secondary-custom small">Identitas disamarkan klien</span>
                                        </div>
                                    </div>
                                </td>
                                <td><h5 class="fw-bold text-main mb-0">Rp 2.500.000</h5></td>
                                <td class="text-secondary-custom small fw-medium">3 Jam yang lalu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

@endsection


