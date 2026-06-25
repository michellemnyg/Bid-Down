@extends('layouts.app')

@section('title', 'Dashboard Klien | Bid Down')

@section('user-name', 'PT Jaya Abadi')
@section('user-avatar', 'PT')
@section('profile-link', url('/profileclient'))

@section('nav-links')
<li class="nav-item">
    <a class="nav-link nav-link-custom active" href="{{ url('/dashboardclient') }}"><i class="bi bi-grid me-1"></i> Dashboard</a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="#proyek-aktif"><i class="bi bi-activity me-1"></i> Proyek Aktif Saya</a>
</li>
@endsection

@section('content')
<div class="hero-dashboard">
    <div>
        <h2 class="fw-bold mb-2">Selamat datang, <span class="text-primary">PT Jaya Abadi!</span></h2>
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
                    <h3 class="fw-bold mb-0">12</h3>
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
                    <h3 class="fw-bold mb-0">3</h3>
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
                    <h3 class="fw-bold mb-0">Rp 45.5M</h3>
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
                    <tr>
                        <td>
                            <a href="{{ url('/projectdetailclient') }}" class="fw-semibold text-decoration-none hover-link d-block">Pembuatan Landing Page Perusahaan</a>
                            <span class="text-secondary-custom small">Tanggal Posting: 12 Okt 2024</span>
                        </td>
                        <td><span class="badge badge-soft-warning rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-clock me-1"></i> 2 Hari 4 Jam</span></td>
                        <td class="fw-medium text-dark">Rp 3.000.000</td>
                        <td><span class="badge bg-secondary rounded-pill px-3 py-2">12 Bid</span></td>
                        <td class="text-center fw-bold text-success fs-6">Rp 2.100.000</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ url('/projectdetailclient') }}" class="btn btn-sm btn-outline-primary fw-medium px-3" title="Lihat Bids"><i class="bi bi-eye me-1"></i> Detail</a>
                                <a href="{{ url('/edit-project') }}" class="btn btn-sm btn-outline-secondary fw-medium px-2" title="Edit Proyek"><i class="bi bi-pencil"></i></a>
                                <form action="#" method="POST" class="m-0" onsubmit="return confirmAction(event, 'Yakin ingin menghapus proyek ini?', 'Ya, Hapus')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ url('/projectdetailclient') }}" class="fw-semibold text-decoration-none hover-link d-block">Desain UI/UX Aplikasi Mobile</a>
                            <span class="text-secondary-custom small">Tanggal Posting: 14 Okt 2024</span>
                        </td>
                        <td><span class="badge badge-soft-danger rounded-pill px-3 py-2 fw-semibold"><i class="bi bi-clock me-1"></i> 5 Jam 30 Mnt</span></td>
                        <td class="fw-medium text-dark">Rp 8.000.000</td>
                        <td><span class="badge bg-secondary rounded-pill px-3 py-2">5 Bid</span></td>
                        <td class="text-center fw-bold text-success fs-6">Rp 6.500.000</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ url('/projectdetailclient') }}" class="btn btn-sm btn-outline-primary fw-medium px-3" title="Lihat Bids"><i class="bi bi-eye me-1"></i> Detail</a>
                                <a href="{{ url('/edit-project') }}" class="btn btn-sm btn-outline-secondary fw-medium px-2" title="Edit Proyek"><i class="bi bi-pencil"></i></a>
                                <form action="#" method="POST" class="m-0" onsubmit="return confirmAction(event, 'Yakin ingin menghapus proyek ini?', 'Ya, Hapus')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-medium px-2" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
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
                    <tr>
                        <td>
                            <a href="{{ url('/projectdetailclient') }}" class="fw-semibold text-decoration-none hover-link d-block">Pembuatan Video Profil Perusahaan</a>
                            <span class="text-secondary-custom small">Tanggal Deal: 20 Okt 2024</span>
                        </td>
                        <td>
                            <a href="{{ url('/profilefreelancer') }}" class="d-flex align-items-center gap-2 text-decoration-none hover-link">
                                <div class="avatar-sm shadow-sm">MD</div>
                                <span class="fw-medium">Maya Dwi</span>
                            </a>
                        </td>
                        <td class="fw-bold text-dark">Rp 4.200.000</td>
                        <td><span class="badge badge-soft-warning rounded-pill px-3 py-2 fw-semibold">Sedang Dikerjakan</span></td>
                        <td class="text-center">
                            <form action="#" method="POST" class="m-0 d-inline" onsubmit="return confirmAction(event, 'Konfirmasi bahwa pengerjaan proyek ini telah selesai?', 'Ya, Selesai')">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success fw-medium px-3"><i class="bi bi-check-circle me-1"></i> Konfirmasi Selesai</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ url('/projectdetailclient') }}" class="fw-semibold text-decoration-none hover-link d-block">Desain Logo Perusahaan Baru</a>
                            <span class="text-secondary-custom small">Tanggal Selesai: 01 Sep 2024</span>
                        </td>
                        <td>
                            <a href="{{ url('/profilefreelancer') }}" class="d-flex align-items-center gap-2 text-decoration-none hover-link">
                                <div class="avatar-sm shadow-sm">AS</div>
                                <span class="fw-medium">Agus Setiawan</span>
                            </a>
                        </td>
                        <td class="fw-bold text-dark">Rp 800.000</td>
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
