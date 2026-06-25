@extends('layouts.auth')

@section('title', 'Login | Bid-Down')

@section('hero_badge')
<i class="bi bi-graph-down-arrow me-2"></i>Bid-Down
@endsection

@section('hero_title', 'Masuk, pantau bid, dan pilih penawaran terbaik.')
@section('hero_subtitle', 'Platform lelang project yang membantu klien menemukan freelancer dengan harga paling kompetitif.')

@section('form_title', 'Selamat Datang Kembali')
@section('form_subtitle', 'Masuk ke akun Bid-Down Anda.')

@section('styles')
<style>
    /* Logic for Visual Toggle (Handled via JS for better reliability) */
    .role-label.active-role {
        background-color: var(--primary) !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(139, 94, 60, 0.2) !important;
    }
</style>
@endsection

@section('content')
<form action="{{ route('login.store') }}" method="POST">
    @csrf
    
    <input type="radio" name="role" id="roleFreelancer" class="d-none" value="freelancer" checked>
    <input type="radio" name="role" id="roleClient" class="d-none" value="client">

    <label class="form-label">Masuk Sebagai</label>
    <div class="role-selector">
        <label for="roleFreelancer" class="role-label label-freelancer">
            <i class="bi bi-person-badge me-1 d-none d-sm-inline"></i> Freelancer
        </label>
        <label for="roleClient" class="role-label label-client">
            <i class="bi bi-briefcase me-1 d-none d-sm-inline"></i> Klien
        </label>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
    </div>

    <div class="mb-2">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            <button class="btn" type="button" onclick="togglePassword(this)"><i class="bi bi-eye"></i></button>
        </div>
    </div>

    <div class="text-end mb-4">
        <a href="#" class="text-primary text-decoration-none small fw-medium hover-link">Lupa Password?</a>
    </div>

    <button type="submit" class="btn btn-primary w-100 mb-3">
        Masuk
    </button>

</form>

<div class="text-center mt-4">
    <p class="text-secondary-custom small mb-0">
        Belum punya akun? 
        <a href="{{ url('/register') }}" class="text-primary text-decoration-none fw-bold hover-link">Daftar Sekarang</a>
    </p>
</div>
<script>
    document.querySelectorAll('input[name="role"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.role-label').forEach(lbl => lbl.classList.remove('active-role'));
            if(this.checked) {
                document.querySelector('.label-' + this.value).classList.add('active-role');
            }
        });
    });
    // Trigger on load directly
    const checkedRole = document.querySelector('input[name="role"]:checked');
    if(checkedRole) checkedRole.dispatchEvent(new Event('change'));
</script>
@endsection
