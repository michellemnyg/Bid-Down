@extends('layouts.app')

@section('title', 'Posting Proyek Baru | Bid Down')

@section('user-name', 'PT Jaya Abadi')
@section('user-avatar', 'PT')
@section('profile-link', url('/profileclient'))

@section('nav-links')
<li class="nav-item">
    <a class="nav-link nav-link-custom" href="{{ url('/dashboardclient') }}">
        <i class="bi bi-grid me-1"></i> Dashboard
    </a>
</li>
<li class="nav-item">
    <a class="nav-link nav-link-custom active" href="{{ url('/dashboardclient') }}#proyek-aktif">
        <i class="bi bi-briefcase me-1"></i> Proyek Saya
    </a>
</li>
@endsection

@section('content')

<style>
.section-card{
    border:none;
    border-radius:24px;
    overflow:hidden;
    background:rgba(255,255,255,.95);
    backdrop-filter:blur(12px);
    box-shadow:0 12px 35px rgba(0,0,0,.04);
    margin-bottom:2rem;
}

.section-card .card-header{
    background:transparent;
    border-bottom:1px solid var(--border-color);
    padding:1.5rem 2rem;
}

.section-card .card-body{
    padding:2rem;
}

.section-number{
    width:42px;
    height:42px;

    border-radius:14px;

    background:
        linear-gradient(
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

.settings-box{
    background:
        linear-gradient(
            135deg,
            #faf7f3,
            #ffffff
        );

    border:1px solid #eee6df;

    border-radius:18px;

    padding:1.5rem;
}

.form-label{
    font-weight:600;
    margin-bottom:.65rem;
}

.input-group-text{
    background:var(--primary-soft);
    border-color:#ebe6e0;
    color:var(--primary);
    font-weight:600;
}

.form-check-input:checked{
    background-color:var(--primary);
    border-color:var(--primary);
}

.info-card{
    background:
        linear-gradient(
            135deg,
            rgba(139,94,60,.06),
            rgba(139,94,60,.02)
        );

    border:1px solid rgba(139,94,60,.08);

    border-radius:18px;

    padding:1rem 1.25rem;
}

.publish-bar{
    background:white;

    border-radius:24px;

    padding:1.5rem;

    box-shadow:
        0 12px 35px rgba(0,0,0,.04);
}
</style>

<div class="hero-dashboard">
    <div>
        <h2 class="fw-bold mb-2">
            <i class="bi bi-plus-circle-fill text-primary me-2"></i>
            Posting Proyek Baru
        </h2>

        <p class="text-secondary-custom mb-0">
            Buat proyek baru dan biarkan freelancer bersaing memberikan penawaran terbaik.
        </p>
    </div>

    <a href="{{ url('/dashboardclient') }}"
       class="btn btn-outline-primary">
        <i class="bi bi-arrow-left me-2"></i>
        Kembali
    </a>
</div>

<form action="{{ route('projects.store') }}" method="POST">
    @csrf

    {{-- INFORMASI DASAR --}}
    <div class="card section-card">

        <div class="card-header d-flex align-items-center gap-3">
            <div class="section-number">1</div>

            <div>
                <h5 class="fw-bold mb-1">
                    Informasi Dasar Proyek
                </h5>

                <small class="text-secondary-custom">
                    Berikan gambaran jelas mengenai pekerjaan yang akan dikerjakan.
                </small>
            </div>
        </div>

        <div class="card-body">

            <div class="mb-4">
                <label class="form-label">
                    Judul Proyek
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="{{ old('title') }}"
                    placeholder="Contoh: Pembuatan Website E-Commerce Toko Baju"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Kategori Proyek
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="category"
                    class="form-select"
                    required
                >
                    <option value="" selected disabled>
                        Pilih kategori proyek...
                    </option>

                    <option value="Web Development">
                        Web Development
                    </option>

                    <option value="Mobile App Development">
                        Mobile App Development
                    </option>

                    <option value="UI/UX Design">
                        UI/UX Design
                    </option>

                    <option value="Graphic Design / Logo">
                        Graphic Design / Logo
                    </option>

                    <option value="Video Editing">
                        Video Editing
                    </option>

                    <option value="Content Writing / Copywriting">
                        Content Writing / Copywriting
                    </option>

                    <option value="Data Entry & Admin">
                        Data Entry & Admin
                    </option>
                </select>
            </div>

            <div>
                <label class="form-label">
                    Deskripsi & Spesifikasi
                    <span class="text-danger">*</span>
                </label>

                <textarea
                    name="description"
                    rows="7"
                    class="form-control"
                    placeholder="Jelaskan kebutuhan proyek secara rinci, fitur yang diinginkan, target pengguna, referensi desain, teknologi yang digunakan, dan hasil akhir yang diharapkan..."
                    required
                >{{ old('description') }}</textarea>
            </div>

        </div>
    </div>

    {{-- BIDDING --}}
    <div class="card section-card">

        <div class="card-header d-flex align-items-center gap-3">
            <div class="section-number">2</div>

            <div>
                <h5 class="fw-bold mb-1">
                    Pengaturan Bidding
                </h5>

                <small class="text-secondary-custom">
                    Tentukan batas penawaran dan aturan proses bidding.
                </small>
            </div>
        </div>

        <div class="card-body">

            <div class="row g-4 mb-4">

                <div class="col-lg-6">

                    <label class="form-label">
                        Harga Maksimal
                        <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">
                        <span class="input-group-text">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="max_price"
                            class="form-control"
                            value="{{ old('max_price') }}"
                            placeholder="5000000"
                            min="0"
                            required
                        >
                    </div>

                    <div class="form-text mt-2">
                        Freelancer tidak dapat menawar lebih tinggi dari nilai ini.
                    </div>

                </div>

                <div class="col-lg-6">

                    <label class="form-label">
                        Batas Waktu Bid
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="datetime-local"
                        name="bid_deadline"
                        class="form-control"
                        value="{{ old('bid_deadline') }}"
                        required
                    >

                </div>

            </div>

            <div class="settings-box">

                <div class="mb-4">

                    <div class="form-check form-switch d-flex align-items-center">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="blindReview"
                            name="blind_review"
                            value="1"
                            checked
                        >

                        <label
                            class="form-check-label fw-semibold ms-3"
                            for="blindReview"
                        >
                            Aktifkan Blind Review
                        </label>
                    </div>

                    <small class="text-secondary-custom d-block mt-2 ms-5">
                        Nama freelancer disembunyikan selama proses bidding berlangsung.
                    </small>

                </div>

                <hr>

                <div>

                    <div class="form-check form-switch d-flex align-items-center">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="autoStop"
                            name="auto_stop"
                            value="1"
                        >

                        <label
                            class="form-check-label fw-semibold ms-3"
                            for="autoStop"
                        >
                            Aktifkan Auto Stop (24 Jam)
                        </label>
                    </div>

                    <small class="text-secondary-custom d-block mt-2 ms-5">
                        Bidding akan ditutup otomatis 24 jam setelah proyek diterbitkan.
                    </small>

                </div>

            </div>

            <div class="info-card mt-4">
                <div class="d-flex align-items-start gap-3">
                    <i class="bi bi-lightbulb text-primary fs-4"></i>

                    <div>
                        <div class="fw-semibold mb-1">
                            Tips Mendapatkan Bid Berkualitas
                        </div>

                        <small class="text-secondary-custom">
                            Proyek dengan deskripsi detail, kebutuhan yang jelas,
                            dan batas waktu realistis biasanya mendapatkan
                            lebih banyak penawaran berkualitas.
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- ACTION --}}
    <div class="publish-bar mb-5">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">

            <div>
                <h6 class="fw-bold mb-1">
                    Siap menerbitkan proyek?
                </h6>

                <small class="text-secondary-custom">
                    Pastikan seluruh informasi sudah sesuai sebelum dipublikasikan.
                </small>
            </div>

            <div class="d-flex gap-3">

                <a
                    href="{{ url('/dashboardclient') }}"
                    class="btn btn-outline-secondary px-4"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary px-5"
                >
                    <i class="bi bi-rocket-takeoff me-2"></i>
                    Terbitkan Proyek
                </button>

            </div>

        </div>

    </div>

</form>

@endsection