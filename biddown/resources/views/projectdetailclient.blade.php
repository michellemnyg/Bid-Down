@extends('layouts.app')

@section('title', 'Detail Proyek - Pembuatan Landing Page | Bid Down')

@section('user-name', 'PT Jaya Abadi')
@section('user-avatar', 'PT')
@section('profile-link', url('/profileclient'))

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
            // Mock state for UI preview (open, closed, completed)
            $projectStatus = request('status', $project->status ?? 'open');
        @endphp
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <button onclick="history.back()" class="btn btn-outline-secondary shadow-sm fw-semibold px-4">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
            <a href="{{ url('/edit-project') }}" class="btn btn-primary fw-semibold px-4 shadow-sm">
                <i class="bi bi-pencil me-2"></i> Edit Proyek
            </a>
        </div>

        <div class="row g-4 mb-5">
            
            <div class="col-lg-8">
                <div class="card section-card p-4 p-md-5 h-100">
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <h2 class="fw-bold text-main mb-0">{{ $project->title ?? 'Pembuatan Landing Page Perusahaan' }}</h2>
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

                    <div class="d-flex flex-wrap gap-3 text-secondary-custom mb-4 align-items-center border-bottom border-light pb-4">
                        <span>
                            Diterbitkan oleh: <a href="{{ url('/profileclient') }}" class="text-primary fw-semibold text-decoration-none hover-link"><i class="bi bi-building me-1"></i> {{ $project->client->name ?? 'PT Jaya Abadi' }} (Anda)</a>
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
                        <h2 class="fw-bold text-danger mb-4 digital-clock display-5">02:15:30</h2>
                    @else
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-4 mt-2">
                            <div class="avatar-sm avatar-primary">AS</div>
                            <div class="text-start">
                                <h5 class="fw-bold text-main mb-0">Andi Setiawan</h5>
                                <span class="text-secondary-custom small">Terpilih sebagai pemenang</span>
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
                        <h3 class="fw-bold text-success mb-0">{{ isset($project) && $project->bids->count() ? 'Rp ' . number_format($project->bids->min('amount'), 0, ',', '.') : 'Belum ada' }}</h3>
                    </div>

                </div>
            </div>
        </div>

        <section id="bidding-area">
            
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4">
                <h4 class="fw-bold text-main mb-2 mb-sm-0"><i class="bi bi-list-ol text-primary me-2"></i> Leaderboard Bidding</h4>
                @if($projectStatus === 'open')
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
                            @isset($project)
                                @foreach ($project->bids->sortBy('amount')->values() as $index => $bid)
                                    <tr>
                                        <td class="text-center fw-bold">#{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ url('/profilefreelancer') }}" class="fw-bold text-primary text-decoration-none d-block hover-link">{{ $bid->freelancer->name }}</a>
                                            <span class="text-secondary-custom small">{{ $bid->freelancer->job_title }}</span>
                                        </td>
                                        <td><h5 class="fw-bold text-success mb-0">Rp {{ number_format($bid->amount, 0, ',', '.') }}</h5></td>
                                        <td class="text-secondary-custom small fw-medium">{{ $bid->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-outline-success-custom fw-bold w-100" disabled>Pilih Pemenang</button>
                                        </td>
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
                                        <div class="avatar-sm avatar-primary">AS</div>
                                        <div>
                                            <a href="{{ url('/profilefreelancer') }}" class="fw-bold text-primary text-decoration-none d-block hover-link">Andi Setiawan</a>
                                            <span class="text-star small"><i class="bi bi-star-fill"></i> 4.9 (34 Proyek)</span>
                                        </div>
                                    </div>
                                </td>
                                <td><h5 class="fw-bold text-success mb-0">Rp 2.100.000</h5></td>
                                <td class="text-secondary-custom small fw-medium">10 Menit yang lalu</td>
                                <td class="text-center">
                                    @if($projectStatus === 'open')
                                        <form action="#" method="POST" onsubmit="return confirmAction(event, 'Yakin memilih freelancer ini sebagai pemenang? Proyek akan langsung terkunci.', 'Ya, Pilih Pemenang')">
                                            <button type="submit" class="btn btn-success-custom fw-bold shadow-sm w-100">Pilih Pemenang</button>
                                        </form>
                                    @elseif($projectStatus === 'closed')
                                        <button class="btn btn-primary fw-bold shadow-sm w-100" disabled><i class="bi bi-check2 me-1"></i> Pemenang</button>
                                    @else
                                        <button class="btn btn-secondary fw-bold shadow-sm w-100" disabled>Selesai</button>
                                    @endif
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm border border-secondary" style="width: 40px; height: 40px;">
                                        <h5 class="fw-bold text-secondary mb-0">2</h5>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-sm avatar-dark"><i class="bi bi-incognito"></i></div>
                                        <div>
                                            <span class="fw-bold text-main d-block">Anonymous Freelancer</span>
                                            <span class="text-secondary-custom small">Blind Review Aktif</span>
                                        </div>
                                    </div>
                                </td>
                                <td><h5 class="fw-bold text-main mb-0">Rp 2.300.000</h5></td>
                                <td class="text-secondary-custom small fw-medium">1 Jam yang lalu</td>
                                <td class="text-center">
                                    @if($projectStatus === 'open')
                                        <form action="#" method="POST" onsubmit="return confirmAction(event, 'Yakin memilih freelancer ini sebagai pemenang? Proyek akan langsung terkunci.', 'Ya, Pilih Pemenang')">
                                            <button type="submit" class="btn btn-outline-success-custom fw-bold w-100">Pilih Pemenang</button>
                                        </form>
                                    @else
                                        <button class="btn btn-outline-secondary fw-bold w-100" disabled>Terkunci</button>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm border border-secondary" style="width: 40px; height: 40px;">
                                        <h5 class="fw-bold text-secondary mb-0">3</h5>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar-sm" style="background-color: var(--secondary); color: white;">MD</div>
                                        <div>
                                            <a href="{{ url('/profilefreelancer') }}" class="fw-bold text-primary text-decoration-none d-block hover-link">Maya Dwi</a>
                                            <span class="text-star small"><i class="bi bi-star-fill"></i> 4.5 (12 Proyek)</span>
                                        </div>
                                    </div>
                                </td>
                                <td><h5 class="fw-bold text-main mb-0">Rp 2.500.000</h5></td>
                                <td class="text-secondary-custom small fw-medium">3 Jam yang lalu</td>
                                <td class="text-center">
                                    @if($projectStatus === 'open')
                                        <form action="#" method="POST" onsubmit="return confirmAction(event, 'Yakin memilih freelancer ini sebagai pemenang? Proyek akan langsung terkunci.', 'Ya, Pilih Pemenang')">
                                            <button type="submit" class="btn btn-outline-success-custom fw-bold w-100">Pilih Pemenang</button>
                                        </form>
                                    @else
                                        <button class="btn btn-outline-secondary fw-bold w-100" disabled>Terkunci</button>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        @if($projectStatus !== 'open')
        <div class="row mt-5">
            <div class="col-12">
                <div class="card section-card p-4 p-md-5 border-primary" style="border-width: 2px !important; background: linear-gradient(to right, rgba(139, 94, 60, 0.05), transparent);">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                        
                        <div>
                            <h4 class="fw-bold text-main mb-2"><i class="bi bi-telephone-fill text-primary me-2"></i> Kontak Pemenang</h4>
                            <p class="text-secondary-custom mb-0">Hubungi freelancer untuk berdiskusi lebih lanjut tentang proyek ini di luar platform.</p>
                            
                            <div class="d-flex flex-wrap gap-3 mt-4">
                                <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-success rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-whatsapp me-2"></i> +62 812-3456-7890
                                </a>
                                <a href="mailto:andi@example.com" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
                                    <i class="bi bi-envelope me-2"></i> andi@example.com
                                </a>
                            </div>
                        </div>

                        <div class="text-md-end text-center p-4 bg-white rounded-4 shadow-sm" style="min-width: 300px;">
                            @if($projectStatus === 'closed')
                                <h6 class="fw-bold text-main mb-3">Selesaikan Proyek?</h6>
                                <p class="small text-secondary-custom mb-3">Jika pekerjaan sudah selesai dan diserahkan sepenuhnya, tandai selesai untuk memberi ulasan.</p>
                                <button type="button" class="btn btn-primary fw-bold w-100 shadow-sm" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                    <i class="bi bi-check-circle-fill me-1"></i> Tandai Selesai & Ulas
                                </button>
                            @else
                                <div class="text-center">
                                    <i class="bi bi-star-fill text-star fs-1 mb-2"></i>
                                    <h6 class="fw-bold text-success mb-1">Proyek Selesai</h6>
                                    <p class="small text-secondary-custom mb-0">Anda sudah memberikan ulasan.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Ulasan -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow" style="border-radius: 16px;">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold text-main" id="reviewModalLabel">Beri Ulasan ke Freelancer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            @csrf
                            <div class="text-center mb-4">
                                <div class="avatar-sm avatar-primary mx-auto mb-2" style="width: 60px; height: 60px; font-size: 24px;">AS</div>
                                <h6 class="fw-bold mb-0">Andi Setiawan</h6>
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
                                <textarea class="form-control" id="reviewText" name="review" rows="4" placeholder="Bagaimana hasil kerja Andi? Apakah sesuai ekspektasi Anda?" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary fw-bold w-100 py-2">Kirim Ulasan & Selesaikan Proyek</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

@endsection


