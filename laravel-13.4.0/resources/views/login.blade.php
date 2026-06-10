<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Bid-Down</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />

    <style>
        :root {
            /* Core Palette Refined */
            --primary: #8b5e3c;
            --primary-hover: #724d31;
            --primary-soft: rgba(139, 94, 60, 0.08);
            --secondary: #c8a27a;
            --background: #fbf9f6; 
            --surface: #ffffff;
            --text-main: #2d1f15;
            --text-secondary: #7a5f4c;
            --border-color: rgba(139, 94, 60, 0.12);
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background:
                radial-gradient(circle at 18% 18%, rgba(200, 162, 122, 0.20), transparent 28%),
                linear-gradient(135deg, #f7f2ec 0%, #ebe0d4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            -webkit-font-smoothing: antialiased;
        }

        .auth-shell {
            width: min(1120px, 100%);
            min-height: min(720px, calc(100vh - 3rem));
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(420px, 0.95fr);
            background-color: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(255,255,255,0.75);
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 28px 80px rgba(69, 45, 28, 0.16);
            backdrop-filter: blur(14px);
        }

        .auth-hero {
            position: relative;
            padding: 3rem;
            color: #fff;
            background:
                linear-gradient(135deg, rgba(45, 31, 21, 0.88), rgba(139, 94, 60, 0.78)),
                url("{{ asset('assets/images/logo.svg') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            overflow: hidden;
        }

        .auth-hero::after {
            content: "";
            position: absolute;
            inset: auto 2rem 2rem auto;
            width: 180px;
            height: 180px;
            border: 1px solid rgba(255,255,255,0.24);
            border-radius: 999px;
        }

        .hero-badge {
            width: max-content;
            border-radius: 999px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.22);
            padding: 0.55rem 0.9rem;
            font-weight: 700;
            margin-bottom: auto;
        }

        .hero-copy {
            position: relative;
            z-index: 1;
            max-width: 460px;
        }

        .auth-card {
            background-color: var(--surface);
            width: 100%;
            max-width: none;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Typography */
        .text-primary { color: var(--primary) !important; }
        .text-secondary-custom { color: var(--text-secondary) !important; }

        /* Forms */
        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.4rem;
        }
        .form-control {
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 0.8rem 1.2rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: var(--background);
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-soft);
            background-color: var(--surface);
        }
        .form-control::placeholder {
            color: #adb5bd;
        }

        /* Primary Button */
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
            border-radius: 12px;
            padding: 0.8rem;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 4px 12px rgba(139, 94, 60, 0.2);
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(139, 94, 60, 0.3);
        }

        /* =========================================================
           PURE CSS TAB TOGGLE (No JavaScript)
           Gaya Segmented Control SaaS Modern
           ========================================================= */
        .role-selector {
            display: flex;
            background-color: var(--background);
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
        }
        .role-label {
            flex: 1;
            text-align: center;
            padding: 0.6rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 0;
        }

        /* Logic for Visual Toggle */
        #roleFreelancer:checked ~ .role-selector .label-freelancer {
            background-color: var(--surface);
            color: var(--primary);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        #roleClient:checked ~ .role-selector .label-client {
            background-color: var(--surface);
            color: var(--primary);
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        /* Logo styling */
        .brand-logo {
            width: 48px;
            height: 48px;
            margin-bottom: 1rem;
        }
        
        .hover-link {
            transition: color 0.2s ease;
        }
        .hover-link:hover {
            color: var(--primary-hover) !important;
            text-decoration: underline !important;
        }

        @media (max-width: 900px) {
            body { padding: 1rem; }
            .auth-shell {
                grid-template-columns: 1fr;
                min-height: auto;
            }
            .auth-hero {
                min-height: 220px;
                padding: 2rem;
            }
            .auth-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    @include('partials.flash')

    <main class="auth-shell">
        <section class="auth-hero">
            <div class="hero-badge"><i class="bi bi-graph-down-arrow me-2"></i>Bid-Down</div>
            <div class="hero-copy">
                <h1 class="fw-bold mb-3">Masuk, pantau bid, dan pilih penawaran terbaik.</h1>
                <p class="mb-0 opacity-75">Platform lelang project yang membantu klien menemukan freelancer dengan harga paling kompetitif.</p>
            </div>
        </section>

    <div class="auth-card">
        
        <div class="text-center mb-4">
            <img src="{{ asset('assets/images/icon.svg') }}" alt="Bid-Down Logo" class="brand-logo" onerror="this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'48\' height=\'48\' viewBox=\'0 0 24 24\' fill=\'%238b5e3c\'%3E%3Cpath d=\'M13 10V3L4 14h7v7l9-11h-7z\'/%3E%3C/svg%3E';">
            <h3 class="fw-bold text-main mb-1">Selamat Datang Kembali</h3>
            <p class="text-secondary-custom small">Masuk ke akun Bid-Down Anda.</p>
        </div>

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
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
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

    </div>
    </main>

</body>
</html>


