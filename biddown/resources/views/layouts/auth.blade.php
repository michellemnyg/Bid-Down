<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Bid-Down')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
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
            overflow-y: auto;
        }

        /* Brand Logo */
        .brand-logo {
            width: 48px;
            height: 48px;
            margin-bottom: 1rem;
        }

        /* Form toggles (Login & Register specific) */
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

        /* Animation for form toggle */
        .form-client, .form-freelancer {
            display: none;
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
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
    
    <!-- Auth specific overrides -->
    @yield('styles')
</head>
<body>
    @include('partials.flash')

    <main class="auth-shell">
        <section class="auth-hero">
            <div class="hero-badge">@yield('hero_badge', '<i class="bi bi-stars me-2"></i>Bid-Down')</div>
            <div class="hero-copy">
                <h1 class="fw-bold mb-3">@yield('hero_title')</h1>
                <p class="mb-0 opacity-75">@yield('hero_subtitle')</p>
            </div>
        </section>

        <div class="auth-card">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-main mb-1">@yield('form_title')</h3>
                <p class="text-secondary-custom small">@yield('form_subtitle')</p>
            </div>

            @yield('content')
        </div>
    </main>

    <script>
        function togglePassword(btn) {
            const input = btn.previousElementSibling;
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
