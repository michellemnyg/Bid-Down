@extends('layouts.app')

@section('title', 'Dashboard Freelancer | Bid Down')

@section('user-name', 'Andi Setiawan')
@section('user-avatar', 'AS')
@section('profile-link', url('/profilefreelancer'))

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
        <h2 class="fw-bold mb-2">Selamat datang, <span class="text-primary">Andi!</span></h2>
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
                    <h3 class="fw-bold mb-0">28</h3>
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
                    <h3 class="fw-bold mb-0">8</h3>
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
                    <h3 class="fw-bold mb-0">Rp 32.5M</h3>
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
                    <tr>
                        <td>
                            <a href="{{ url('/projectdetailfreelancer') }}" class="fw-semibold text-decoration-none hover-link d-block">Pembuatan Landing Page Perusahaan</a>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <a href="{{ url('/profileclient') }}" class="text-secondary-custom small text-decoration-none hover-link"><i class="bi bi-building me-1"></i> PT Jaya Abadi</a>
                                <span class="text-secondary-custom small">&bull;</span>
                                <span class="text-secondary-custom small">Tgl Posting: 12 Okt 2024</span>
                            </div>
                        </td>
                        <td><span class="badge badge-soft-warning rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-clock me-1"></i> 2 Hari 4 Jam</span></td>
                        <td class="fw-bold text-success">Rp 2.100.000</td>
                        <td class="text-center fw-bold text-success fs-6">Rp 2.100.000</td>
                        <td><span class="badge badge-soft-success rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-trophy me-1"></i> Memimpin</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ url('/projectdetailfreelancer') }}" class="btn btn-sm btn-outline-primary fw-medium px-3" title="Lihat Proyek"><i class="bi bi-eye"></i></a>
                                <form action="#" method="POST" class="m-0" onsubmit="return confirmAction(event, 'Yakin ingin menarik (membatalkan) bid Anda pada proyek ini?', 'Ya, Tarik Bid')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2" title="Tarik Bid"><i class="bi bi-x-lg"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr class="row-terkalahkan">
                        <td>
                            <a href="{{ url('/projectdetailfreelancer') }}" class="fw-semibold text-decoration-none hover-link text-danger d-block">Desain UI/UX Aplikasi Mobile</a>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <a href="{{ url('/profileclient') }}" class="text-secondary-custom small text-decoration-none hover-link"><i class="bi bi-building me-1"></i> CV Maju Bersama</a>
                                <span class="text-secondary-custom small">&bull;</span>
                                <span class="text-secondary-custom small">Tgl Posting: 14 Okt 2024</span>
                            </div>
                        </td>
                        <td><span class="badge badge-soft-danger rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-clock me-1"></i> 5 Jam 30 Mnt</span></td>
                        <td class="fw-bold text-danger">Rp 7.000.000</td>
                        <td class="text-center fw-bold text-success fs-6">Rp 6.500.000</td>
                        <td><span class="badge badge-soft-danger rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-exclamation-triangle me-1"></i> Terkalahkan</span></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ url('/projectdetailfreelancer') }}#biddingarea" class="btn btn-sm btn-outline-primary fw-medium px-3" title="Turunkan Harga"><i class="bi bi-arrow-down-circle"></i></a>
                                <form action="#" method="POST" class="m-0" onsubmit="return confirmAction(event, 'Yakin ingin menarik (membatalkan) bid Anda pada proyek ini?', 'Ya, Tarik Bid')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2" title="Tarik Bid"><i class="bi bi-x-lg"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
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
                    <tr>
                        <td>
                            <a href="{{ url('/projectdetailfreelancer') }}" class="fw-semibold text-decoration-none hover-link d-block">Desain Logo Perusahaan Baru</a>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <a href="{{ url('/profileclient') }}" class="text-primary small text-decoration-none hover-link fw-medium"><i class="bi bi-building me-1"></i> PT Jaya Abadi</a>
                                <span class="text-secondary-custom small">&bull;</span>
                                <span class="text-secondary-custom small">Tgl Deal: 20 Okt 2024</span>
                            </div>
                        </td>
                        <td class="fw-bold text-dark">Rp 800.000</td>
                        <td><span class="badge badge-soft-warning rounded-pill px-3 py-2 fw-semibold">Menunggu Konfirmasi Klien</span></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-success fw-medium px-3"><i class="bi bi-whatsapp me-1"></i> Hubungi Klien</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ url('/projectdetailfreelancer') }}" class="fw-semibold text-decoration-none hover-link d-block">Video Company Profile 3 Menit</a>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <a href="{{ url('/profileclient') }}" class="text-primary small text-decoration-none hover-link fw-medium"><i class="bi bi-building me-1"></i> CV Maju Bersama</a>
                                <span class="text-secondary-custom small">&bull;</span>
                                <span class="text-secondary-custom small">Tgl Selesai: 01 Sep 2024</span>
                            </div>
                        </td>
                        <td class="fw-bold text-dark">Rp 4.200.000</td>
                        <td><span class="badge badge-soft-success rounded-pill px-3 py-2 fw-semibold">Selesai</span></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-outline-primary fw-medium px-3"><i class="bi bi-star me-1"></i> Beri Review</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
