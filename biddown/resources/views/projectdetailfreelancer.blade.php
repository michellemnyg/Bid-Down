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
        @php
            // Mock state for UI preview (open, closed, completed)
            $projectStatus = request('status', $project->status ?? 'open');
        @endphp
        
        <div class="mb-4">
            <button onclick="history.back()" class="btn btn-outline-secondary shadow-sm fw-semibold px-4">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
        </div>

        <div class="row g-4 mb-5">
            
            <div class="col-lg-8">
                <div class="card section-card p-4 p-md-5 h-100">
                    <div class="mb-3">
                        <h2 class="fw-bold text-main mb-2">{{ $project->title ?? 'Pembuatan Landing Page Perusahaan' }}</h2>
                        <div class="d-flex align-items-center gap-2">
                            @if($projectStatus === 'open')
                                <span class="badge badge-soft-success rounded-pill px-3 py-2 fs-6 d-flex align-items-center gap-1">
                                    <span class="spinner-grow spinner-grow-sm text-success" style="width: 0.5rem; height: 0.5rem;" role="status"></span> OPEN BID
                                </span>
                            @elseif($projectStatus === 'closed')
                                <span class="badge badge-soft-primary rounded-pill px-3 py-2 fs-6 d-flex align-items-center gap-1">
                                    <i class="bi bi-lock-fill"></i> BIDDING DITUTUP
                                </span>
                            @else
                                <span class="badge badge-soft-secondary rounded-pill px-3 py-2 fs-6 d-flex align-items-center gap-1">
                                    <i class="bi bi-check-circle-fill"></i> PROYEK SELESAI
                                </span>
                            @endif
                        </div>
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
                    
                    <h6 class="text-secondary-custom fw-semibold text-uppercase tracking-wide mb-2">
                        @if($projectStatus === 'open')
                            <i class="bi bi-alarm me-1"></i> Sisa Waktu Bidding
                        @else
                            <i class="bi bi-award me-1"></i> Status Pemenang
                        @endif
                    </h6>
                    
                    @if($projectStatus === 'open')
                        <h2 class="fw-bold text-accent mb-4 digital-clock display-5">02:15:30</h2>
                    @else
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-4 mt-2">
                            <div class="avatar-sm avatar-primary">AS</div>
                            <div class="text-start">
                                <h5 class="fw-bold text-main mb-0">Andi Setiawan (Anda)</h5>
                                <span class="text-success small fw-semibold">Anda terpilih sebagai pemenang!</span>
                            </div>
                        </div>
                    @endif

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
            
            @if($projectStatus === 'open')
            <div class="bidding-form-card p-4 p-md-5 mb-5">

                <div class="row align-items-center g-4">

                    <div class="col-lg-5">

                        <div class="d-flex align-items-center gap-3">

                            <div class="bid-icon-box">
                                <i class="bi bi-cash-stack"></i>
                            </div>

                            <div>
                                <h4 class="fw-bold text-main mb-1">
                                    Ajukan Penawaran
                                </h4>

                                <p class="text-secondary-custom mb-0">
                                    Masukkan nominal penawaran Anda untuk bersaing dengan freelancer lain.
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-7">

                        <form
                            action="#"
                            method="POST"
                            onsubmit="return confirmAction(
                                event,
                                'Yakin ingin mengirim penawaran (bid) sebesar Rp ' + this.amount.value + '?',
                                'Ya, Kirim Bid'
                            )">

                            @csrf

                            <div class="input-group bid-input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="amount"
                                    placeholder="Masukkan nominal bid..."
                                    required>

                                <button
                                    class="btn btn-primary bid-submit-btn"
                                    type="submit">

                                    <i class="bi bi-send-fill me-2"></i>
                                    Kirim Bid

                                </button>

                            </div>

                            <small class="bid-hint d-block mt-3">

                                <i class="bi bi-info-circle me-1"></i>

                                @if(isset($lowestBid) && $lowestBid)
                                    Masukkan nominal lebih rendah dari
                                    <strong>
                                        Rp {{ number_format($lowestBid->amount, 0, ',', '.') }}
                                    </strong>
                                    untuk mengambil posisi teratas leaderboard.
                                @else
                                    Belum ada penawaran. Anda berkesempatan menjadi bidder pertama.
                                @endif

                            </small>

                        </form>

                    </div>

                </div>

            </div>
            @endif

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

        @if($projectStatus !== 'open')
        <div class="row mt-5">
            <div class="col-12">
                <div class="card section-card p-4 p-md-5 border-success" style="border-width: 2px !important; background: linear-gradient(to right, rgba(30, 142, 62, 0.05), transparent);">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                        
                        <div>
                            <h4 class="fw-bold text-main mb-2"><i class="bi bi-person-lines-fill text-success me-2"></i> Kontak Klien</h4>
                            <p class="text-secondary-custom mb-0">Hubungi klien untuk memulai pengerjaan proyek ini di luar platform.</p>
                            
                            <div class="d-flex flex-wrap gap-3 mt-4">
                                <a href="https://wa.me/6280987654321" target="_blank" class="btn btn-success rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-whatsapp me-2"></i> +62 809-8765-4321
                                </a>
                                <a href="mailto:klien@perusahaan.com" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-envelope me-2"></i> klien@perusahaan.com
                                </a>
                            </div>
                        </div>

                        <div class="text-md-end text-center p-4 bg-white rounded-4 shadow-sm" style="min-width: 300px;">
                            @if($projectStatus === 'completed')
                                <h6 class="fw-bold text-main mb-3">Proyek Selesai</h6>
                                <p class="small text-secondary-custom mb-3">Klien telah menandai proyek ini selesai. Silakan berikan ulasan balik untuk klien.</p>
                                <button type="button" class="btn btn-success fw-bold w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#reviewClientModal">
                                    <i class="bi bi-star-fill me-1"></i> Beri Ulasan Klien
                                </button>
                            @else
                                <div class="text-center">
                                    <i class="bi bi-tools text-primary fs-1 mb-2"></i>
                                    <h6 class="fw-bold text-main mb-1">Sedang Dikerjakan</h6>
                                    <p class="small text-secondary-custom mb-0">Menunggu klien menandai proyek selesai.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Ulasan untuk Klien -->
        <div class="modal fade" id="reviewClientModal" tabindex="-1" aria-labelledby="reviewClientModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow" style="border-radius: 16px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold text-main" id="reviewClientModalLabel">Beri Ulasan ke Klien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            @csrf
                            <div class="text-center mb-4">
                                <div class="avatar-sm bg-light text-secondary mx-auto mb-2" style="width: 60px; height: 60px; font-size: 24px;"><i class="bi bi-building"></i></div>
                                <h6 class="fw-bold mb-0">PT Jaya Abadi</h6>
                            </div>

                            <div class="mb-3 text-center">
                                <label class="form-label fw-semibold d-block">Rating Anda</label>
                                <div class="fs-2 text-star" style="cursor: pointer;">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <input type="hidden" name="rating" value="5">
                            </div>

                            <div class="mb-4">
                                <label for="reviewClientText" class="form-label fw-semibold">Pengalaman Bekerja Sama</label>
                                <textarea class="form-control" id="reviewClientText" name="review" rows="4" placeholder="Bagaimana pengalaman Anda bekerja dengan klien ini? (Komunikasi, kejelasan instruksi, dll)" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success fw-bold w-100 py-2">Kirim Ulasan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

@endsection


