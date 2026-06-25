@extends('layouts.app')

@section('title', 'Edit Proyek | Bid Down')

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
    .section-card {
        background-color: var(--surface);
        border: 1px solid var(--border-color) !important;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.02) !important;
        margin-bottom: 24px;
        overflow: hidden;
    }
    .section-card .card-header {
        background-color: var(--surface);
        border-bottom: 1px solid var(--border-color);
        padding: 1.5rem;
    }
    .input-group-text {
        background-color: var(--primary-soft);
        border-color: var(--border-color);
        color: var(--primary);
        font-weight: 600;
    }
</style>
@endsection

@section('content')
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="fw-bold mb-1"><i class="bi bi-pencil-square text-primary me-2"></i>Edit Proyek</h2>
                <p class="text-secondary-custom mb-0">Ubah detail proyek Anda sebelum ada freelancer yang mengajukan penawaran.</p>
            </div>
            <a href="{{ url('/dashboardclient') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left me-1"></i> Batal
            </a>
        </div>

        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card section-card">
                <div class="card-header">
                    <h5 class="fw-bold text-main mb-0">1. Informasi Dasar Proyek</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <label for="projectTitle" class="form-label">Judul Proyek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="projectTitle" name="title" value="{{ old('title', $project->title) }}" {{ $project->bids_count > 0 ? 'readonly' : 'required' }}>
                    </div>

                    <div class="mb-4">
                        <label for="projectCategory" class="form-label">Kategori Proyek <span class="text-danger">*</span></label>
                        <select class="form-select" id="projectCategory" name="category" {{ $project->bids_count > 0 ? 'disabled' : 'required' }}>
                            <option value="">Pilih Kategori...</option>
                            <option value="Web Development" {{ old('category', $project->category) == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                            <option value="Mobile App Development" {{ old('category', $project->category) == 'Mobile App Development' ? 'selected' : '' }}>Mobile App Development</option>
                            <option value="UI/UX Design" {{ old('category', $project->category) == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="Graphic Design / Logo" {{ old('category', $project->category) == 'Graphic Design / Logo' ? 'selected' : '' }}>Graphic Design / Logo</option>
                            <option value="Video Editing" {{ old('category', $project->category) == 'Video Editing' ? 'selected' : '' }}>Video Editing</option>
                            <option value="Content Writing / Copywriting" {{ old('category', $project->category) == 'Content Writing / Copywriting' ? 'selected' : '' }}>Content Writing / Copywriting</option>
                            <option value="Data Entry & Admin" {{ old('category', $project->category) == 'Data Entry & Admin' ? 'selected' : '' }}>Data Entry & Admin</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="projectDesc" class="form-label">Deskripsi & Spesifikasi Pekerjaan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="projectDesc" name="description" rows="6" {{ $project->bids_count > 0 ? 'readonly' : 'required' }}>{{ old('description', $project->description) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card section-card">
                <div class="card-header">
                    <h5 class="fw-bold text-main mb-0">2. Pengaturan Bidding (Penawaran)</h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="maxPrice" class="form-label">Harga Maksimal (Modal Dasar) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" id="maxPrice" name="max_price" value="{{ old('max_price', $project->max_price) }}" min="0" {{ $project->bids_count > 0 ? 'readonly' : 'required' }}>
                            </div>
                            <div class="form-text text-secondary-custom mt-2">
                                @if($project->bids_count > 0)
                                    <i class="bi bi-lock-fill text-danger me-1"></i> <span class="text-danger">Modal dasar tidak bisa diubah karena sudah ada bid yang masuk.</span>
                                @else
                                    <i class="bi bi-info-circle me-1"></i> Freelancer tidak bisa menawar lebih tinggi dari harga ini. Semakin rendah mereka menawar, semakin baik untuk Anda.
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="bidDeadline" class="form-label">Batas Waktu Penerimaan Bid <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" id="bidDeadline" name="bid_deadline" value="{{ old('bid_deadline', $project->bid_deadline ? $project->bid_deadline->format('Y-m-d\TH:i') : '') }}" required>
                            @if($project->bids_count > 0)
                                <div class="form-text text-primary mt-2"><i class="bi bi-info-circle me-1"></i> Anda dapat memperpanjang batas waktu bidding.</div>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 bg-background rounded-3 border border-light">
                        <div class="mb-4">
                            <div class="form-check form-switch fs-5 mb-1 d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="checkbox" role="switch" id="blindReview" name="blind_review" value="1" {{ old('blind_review', $project->blind_review) ? 'checked' : '' }} {{ $project->bids_count > 0 ? 'disabled' : '' }}>
                                <label class="form-check-label fw-bold text-main ms-2" for="blindReview" style="font-size: 1rem;">Aktifkan Blind Review</label>
                            </div>
                            <p class="text-secondary-custom small ms-5 ps-1 mb-0">Sembunyikan nama freelancer saat proses bid berlangsung agar Anda dapat menilai secara objektif berdasarkan harga & portofolio, bukan nama atau gender.</p>
                        </div>

                        <div>
                            <div class="form-check form-switch fs-5 mb-1 d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="checkbox" role="switch" id="autoStop" name="auto_stop" value="1" {{ old('auto_stop', $project->auto_stop) ? 'checked' : '' }} {{ $project->bids_count > 0 ? 'disabled' : '' }}>
                                <label class="form-check-label fw-bold text-main ms-2" for="autoStop" style="font-size: 1rem;">Aktifkan Auto-Stop (24 Jam)</label>
                            </div>
                            <p class="text-secondary-custom small ms-5 ps-1 mb-0">Bidding akan tertutup secara otomatis 24 jam setelah proyek dipublikasikan, terlepas dari batas waktu yang diatur di atas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 mt-4 mb-5">
                <a href="{{ url('/dashboardclient') }}" class="btn btn-outline-secondary px-4 py-2 text-center">Batal</a>
                <button type="submit" class="btn btn-primary px-5 py-2 fs-6 shadow-sm">
                    <i class="bi bi-save me-2"></i> {{ $project->bids_count > 0 ? 'Perpanjang Deadline' : 'Simpan Perubahan' }}
                </button>
            </div>

        </form>
@endsection
