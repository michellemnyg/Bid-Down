@extends('layouts.auth')

@section('title', 'Register | Bid-Down')

@section('hero_badge')
<i class="bi bi-stars me-2"></i>Mulai di Bid-Down
@endsection

@section('hero_title', 'Bangun project dengan proses bidding yang lebih transparan.')
@section('hero_subtitle', 'Daftar sebagai klien untuk membuka project, atau sebagai freelancer untuk memenangkan pekerjaan baru.')

@section('form_title', 'Buat Akun Baru')
@section('form_subtitle', 'Bergabung dengan Bid-Down hari ini.')

@section('styles')
<style>
    /* Logic for Toggling Forms */
    .role-label.active-role {
        background-color: var(--primary) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(139, 94, 60, 0.2) !important;
    }
    
    #tab-client:checked ~ .form-wrapper .form-client {
        display: block;
    }
    #tab-freelancer:checked ~ .form-wrapper .form-freelancer {
        display: block;
    }
</style>
@endsection

@section('content')
<input type="radio" name="role_toggle" id="tab-client" class="d-none" checked>
<input type="radio" name="role_toggle" id="tab-freelancer" class="d-none">

<div class="role-selector">
    <label for="tab-client" class="role-label label-client">Saya Klien</label>
    <label for="tab-freelancer" class="role-label label-freelancer">Saya Freelancer</label>
</div>

<div class="form-wrapper">
    
    <div class="form-client">
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="client">
            <div class="mb-3">
                <label for="client-name" class="form-label">Nama Lengkap / Perusahaan</label>
                <input type="text" class="form-control" id="client-name" name="name" value="{{ old('name') }}" placeholder="Misal: PT Jaya Abadi" required>
            </div>
            <div class="mb-3">
                <label for="client-email" class="form-label">Email Aktif</label>
                <input type="email" class="form-control" id="client-email" name="email" value="{{ old('email') }}" placeholder="nama@perusahaan.com" required>
            </div>
            <div class="mb-3">
                <label for="client-password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="client-password" name="password" placeholder="Minimal 8 karakter" required minlength="8">
                    <button class="btn" type="button" onclick="togglePassword(this)"><i class="bi bi-eye"></i></button>
                </div>
            </div>
            <div class="mb-4">
                <label for="client-phone" class="form-label">Nomor WhatsApp</label>
                <input type="tel" class="form-control phone-format" id="client-phone" name="phone" value="{{ old('phone') }}" placeholder="0800-0000-0000" maxlength="16" required>
            </div>
            <div class="mb-3">
                <label for="client-website" class="form-label">Link Website Perusahaan <span class="fw-normal text-secondary-custom">(Opsional)</span></label>
                <input type="url" class="form-control" id="client-website" name="website_url" value="{{ old('website_url') }}" placeholder="https://perusahaan.com">
            </div>
            
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="client-terms" required>
                <label class="form-check-label text-secondary-custom" for="client-terms">
                    Saya setuju dengan <a href="#" class="text-primary fw-semibold text-decoration-none hover-link">Syarat & Ketentuan</a>
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Daftar sebagai Klien</button>
        </form>
    </div>

    <div class="form-freelancer">
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <input type="hidden" name="role" value="freelancer">
            <div class="mb-3">
                <label for="freelancer-name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="freelancer-name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap sesuai KTP" required>
            </div>
            <div class="mb-3">
                <label for="freelancer-email" class="form-label">Email Aktif</label>
                <input type="email" class="form-control" id="freelancer-email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>
            <div class="mb-3">
                <label for="freelancer-password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="freelancer-password" name="password" placeholder="Minimal 8 karakter" required minlength="8">
                    <button class="btn" type="button" onclick="togglePassword(this)"><i class="bi bi-eye"></i></button>
                </div>
            </div>
            <div class="mb-3">
                <label for="freelancer-phone" class="form-label">Nomor WhatsApp</label>
                <input type="tel" class="form-control phone-format" id="freelancer-phone" name="phone" value="{{ old('phone') }}" placeholder="0800-0000-0000" maxlength="16" required>
            </div>
            <div class="mb-3">
                <label for="freelancer-skills" class="form-label">Kategori Keahlian Utama</label>
                <select class="form-select" id="freelancer-skills" name="skills" required>
                    <option value="" selected disabled>-- Pilih Kategori --</option>
                    <option value="web-dev">Web Development</option>
                    <option value="mobile-dev">Mobile Development</option>
                    <option value="design">Desain Grafis & UI/UX</option>
                    <option value="writing">Penulisan & Konten</option>
                    <option value="video">Video Editing & Animasi</option>
                    <option value="other">Lainnya</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="freelancer-portfolio" class="form-label">Link Portofolio <span class="fw-normal text-secondary-custom">(Opsional)</span></label>
                <input type="url" class="form-control" id="freelancer-portfolio" name="portfolio_url" value="{{ old('portfolio_url') }}" placeholder="https://github.com/...">
            </div>
            
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="freelancer-terms" required>
                <label class="form-check-label text-secondary-custom" for="freelancer-terms">
                    Saya setuju dengan <a href="#" class="text-primary fw-semibold text-decoration-none hover-link">Syarat & Ketentuan</a>
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Daftar sebagai Freelancer</button>
        </form>
    </div>

</div>

<div class="text-center mt-4">
    <p class="text-secondary-custom small mb-0">
        Sudah punya akun? 
        <a href="{{ url('/login') }}" class="text-primary text-decoration-none fw-bold hover-link">Masuk di sini</a>
    </p>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('input[name="role_toggle"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.role-label').forEach(lbl => lbl.classList.remove('active-role'));
            document.querySelectorAll('.form-client, .form-freelancer').forEach(form => form.style.display = 'none');
            
            if(this.id === 'tab-client') {
                document.querySelector('.label-client').classList.add('active-role');
                document.querySelector('.form-client').style.display = 'block';
            } else {
                document.querySelector('.label-freelancer').classList.add('active-role');
                document.querySelector('.form-freelancer').style.display = 'block';
            }
        });
    });
    
    // Trigger on load directly
    const checkedRole = document.querySelector('input[name="role_toggle"]:checked');
    if(checkedRole) checkedRole.dispatchEvent(new Event('change'));
    
    document.querySelectorAll('.phone-format').forEach(function(input) {
        input.addEventListener('input', function(e) {
            let val = this.value.replace(/\D/g, ''); 
            let formatted = '';
            if (val.length > 0) {
                formatted = val.substring(0, 4);
            }
            if (val.length > 4) {
                formatted += '-' + val.substring(4, 8);
            }
            if (val.length > 8) {
                formatted += '-' + val.substring(8, 12);
            }
            if (val.length > 12) {
                formatted += '-' + val.substring(12, 16);
            }
            this.value = formatted;
        });
    });
</script>
@endsection
