<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Bid-Down')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        <style>
:root{
    --primary:#8b5e3c;
    --primary-soft:#f4ece4;
    --primary-hover:#734c30;

    --secondary:#6c757d;

    --background:#f6f4f1;
    --surface:#ffffff;

    --text-main:#2b2b2b;
    --text-secondary:#6c757d;

    --border-color:#ece7e2;
}

/* ====================================
   BASE
==================================== */

body{
    font-family:'Inter',sans-serif;

    background:
        radial-gradient(
            circle at top right,
            rgba(139,94,60,.05),
            transparent 35%
        ),
        var(--background);

    color:var(--text-main);

    -webkit-font-smoothing:antialiased;

    min-height:100vh;
    display:flex;
    flex-direction:column;
}

.main-content{
    padding-top:2rem;
    padding-bottom:3rem;
}

.text-primary{
    color:var(--primary)!important;
}

.text-secondary-custom{
    color:var(--text-secondary);
}

/* ====================================
   NAVBAR
==================================== */

.navbar-custom{
    background:rgba(255,255,255,.92);

    backdrop-filter:blur(18px);

    border-bottom:1px solid rgba(0,0,0,.04);

    box-shadow:
        0 10px 30px rgba(0,0,0,.03);

    padding:1rem 0;
}

.navbar-brand-custom{
    font-weight:700;
    font-size:1.3rem;

    color:var(--primary)!important;

    display:flex;
    align-items:center;
    gap:.75rem;

    letter-spacing:-0.5px;
}

.navbar-brand-custom img{
    width:36px;
    height:36px;
}

.nav-link-custom{
    color:var(--text-secondary);

    font-weight:600;

    margin:0 .4rem;

    padding:.7rem 1rem !important;

    border-radius:12px;

    position:relative;

    transition:all .3s ease;

    overflow:hidden;
}

.nav-link-custom::before{
    content:'';

    position:absolute;

    inset:0;

    background:
        linear-gradient(
            135deg,
            rgba(139,94,60,.08),
            rgba(139,94,60,.03)
        );

    opacity:0;

    transition:.3s;
}

.nav-link-custom::after{
    content:'';

    position:absolute;

    left:50%;
    bottom:0;

    width:0;
    height:2px;

    background:var(--primary);

    border-radius:10px;

    transform:translateX(-50%);

    transition:.3s;
}

.nav-link-custom:hover{
    color:var(--primary)!important;

    transform:translateY(-2px);
}

.nav-link-custom:hover::before{
    opacity:1;
}

.nav-link-custom:hover::after{
    width:60%;
}

.nav-link-custom.active{
    color:var(--primary)!important;

    background:
        linear-gradient(
            135deg,
            rgba(139,94,60,.10),
            rgba(139,94,60,.03)
        );
}

.nav-link-custom.active::after{
    width:60%;
}

.nav-link-custom i{
    transition:.3s;
}

.nav-link-custom:hover i{
    transform:scale(1.15);
}

.nav-link-custom.active{
    box-shadow:
        0 8px 20px rgba(139,94,60,.10);
}

/* ==========================
   BID FORM
========================== */

.bidding-form-card{
    position:relative;
    overflow:hidden;

    background:
        linear-gradient(
            135deg,
            rgba(139,94,60,.08),
            rgba(255,255,255,.98)
        );

    border:1px solid rgba(139,94,60,.10);

    border-radius:28px;

    box-shadow:
        0 15px 40px rgba(139,94,60,.08);
}

.bidding-form-card::before{
    content:'';

    position:absolute;

    top:-120px;
    right:-120px;

    width:260px;
    height:260px;

    border-radius:50%;

    background:
        radial-gradient(
            rgba(139,94,60,.10),
            transparent 70%
        );

    pointer-events:none;
}

.bid-icon-box{
    width:60px;
    height:60px;

    border-radius:18px;

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

    font-size:1.5rem;

    box-shadow:
        0 12px 25px rgba(139,94,60,.25);
}

.bid-lowest-box{
    background:white;

    border:1px solid #ece7e2;

    border-radius:16px;

    padding:.9rem 1rem;

    margin-top:.8rem;

    display:flex;
    align-items:center;
    gap:.75rem;
}

.bid-lowest-box i{
    color:#f5b301;
    font-size:1.1rem;
}

.bid-input-group{
    background:white;

    border-radius:18px;

    padding:.4rem;

    border:1px solid #ece7e2;

    box-shadow:
        0 10px 25px rgba(0,0,0,.04);
}

.bid-input-group .input-group-text{
    background:transparent;
    border:none;

    font-size:1.15rem;
    font-weight:700;

    color:var(--primary);
}

.bid-input-group .form-control{
    border:none !important;
    box-shadow:none !important;

    font-size:1.05rem;
    font-weight:600;

    background:transparent;
}

.bid-submit-btn{
    border-radius:14px !important;

    min-width:160px;

    font-weight:700;

    padding:.9rem 1.5rem;
}

.bid-hint{
    color:#8b5e3c;
    font-weight:500;
    font-size:.9rem;
}

/* ====================================
   PROFILE
==================================== */

.profile-dropdown-toggle{
    display:flex;
    align-items:center;
    gap:.75rem;

    padding:.4rem .5rem .4rem 1rem;

    border-radius:999px;

    border:1px solid var(--border-color);

    background:white;

    text-decoration:none;

    color:var(--text-main);

    transition:.25s;
}

.profile-dropdown-toggle:hover{
    transform:translateY(-1px);

    border-color:var(--primary);

    box-shadow:
        0 10px 20px rgba(0,0,0,.04);
}

.profile-avatar{
    width:36px;
    height:36px;

    border-radius:50%;

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

.dropdown-menu-custom{
    border:none;

    border-radius:16px;

    padding:.75rem;

    margin-top:.8rem!important;

    box-shadow:
        0 20px 50px rgba(0,0,0,.08);
}

/* ====================================
   CARD
==================================== */

.card{
    border:none;

    border-radius:22px;

    background:
        rgba(255,255,255,.92);

    backdrop-filter:blur(12px);

    box-shadow:
        0 12px 35px rgba(0,0,0,.04);
}

.stat-card{
    position:relative;

    overflow:hidden;

    transition:.3s;
}

.stat-card::before{
    content:'';

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:4px;

    background:
        linear-gradient(
            90deg,
            #8b5e3c,
            #c8a27a
        );
}

.stat-card:hover{
    transform:translateY(-6px);

    box-shadow:
        0 20px 40px rgba(0,0,0,.08);
}

.stat-icon{
    width:64px;
    height:64px;

    border-radius:18px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:1.5rem;

    box-shadow:
        0 10px 25px rgba(0,0,0,.15);
}

.search-card{
    background:
        rgba(255,255,255,.95);

    backdrop-filter:blur(12px);

    border:none;

    border-radius:24px;

    box-shadow:
        0 15px 40px rgba(0,0,0,.05);

    margin-top:-25px;

    position:relative;

    overflow:hidden;
}

.search-card::before{
    content:'';

    position:absolute;

    left:0;
    top:0;

    width:100%;
    height:4px;

    background:
        linear-gradient(
            90deg,
            #8b5e3c,
            #c8a27a
        );
}

/* ====================================
   HERO SECTION
==================================== */

.hero-dashboard{
    background:
        linear-gradient(
            135deg,
            rgba(139,94,60,.08),
            rgba(255,255,255,.95)
        );

    border:1px solid rgba(139,94,60,.08);

    border-radius:24px;

    padding:2rem 2.5rem;

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;

    gap:1rem;

    margin-bottom:2rem;

    position: relative;
    overflow: hidden;
}

.hero-dashboard::before{
    content:'';
    position:absolute;
    width:300px;
    height:300px;
    border-radius:50%;
    background: radial-gradient(rgba(139,94,60,.08), transparent 70%);
    top:-120px;
    right:-100px;
    pointer-events: none;
}

/* ====================================
   BUTTON
==================================== */

.btn{
    border-radius:12px;

    font-weight:600;

    transition:.25s;
}

.btn-primary{
    background:
        linear-gradient(
            135deg,
            #8b5e3c,
            #6f492e
        );

    border:none;

    box-shadow:
        0 10px 20px rgba(139,94,60,.25);
}

.btn-primary:hover{
    transform:translateY(-2px);

    box-shadow:
        0 15px 30px rgba(139,94,60,.35);
}

.btn-outline-primary{
    color:var(--primary);

    border-color:var(--primary);
}

.btn-outline-primary:hover{
    background:var(--primary);
    border-color:var(--primary);
}

/* ====================================
   TABLE
==================================== */

.table-custom{
    border:none;

    border-radius:20px;

    overflow:hidden;
}

.table-custom thead th{
    background:#faf8f6;

    color:var(--text-secondary);

    border:none;

    font-size:.78rem;

    text-transform:uppercase;

    letter-spacing:1px;

    padding:1.2rem 1rem;
}

.table-custom tbody td{
    padding:1.2rem 1rem;

    border-bottom:
        1px solid rgba(0,0,0,.05);

    vertical-align:middle;
}

.table-custom tbody tr{
    transition:.25s;
}

.table-custom tbody tr:hover td{
    background:#fcfaf8;
}

.table-custom tbody tr:last-child td{
    border-bottom:none;
}

/* ====================================
   BADGES
==================================== */

.badge{
    font-weight:600;
    letter-spacing:.3px;
}

.badge-soft-warning{
    background:#fff3cd;
    color:#856404;
}

.badge-soft-danger{
    background:#ffe3e3;
    color:#c92a2a;
}

.badge-soft-success{
    background:#d3f9d8;
    color:#2b8a3e;
}

.badge-soft-primary{
    background:
        rgba(139,94,60,.10);

    color:#8b5e3c;

    font-weight:600;
}

.badge-soft-secondary{
    background:
        #f6f7f8;

    color:#495057;

    font-weight:600;
}

/* ====================================
   AVATAR
==================================== */

.avatar-sm{
    width:42px;
    height:42px;

    border-radius:12px;

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

/* ====================================
   LINK
==================================== */

.hover-link{
    color:var(--text-main);

    transition:.25s;
}

.hover-link:hover{
    color:var(--primary);

    transform:translateX(2px);
}

/* ====================================
   SECTION TITLE
==================================== */

.section-title{
    display:flex;
    align-items:center;
    gap:.75rem;

    margin-bottom:1.5rem;
}

.section-title i{
    width:42px;
    height:42px;

    border-radius:12px;

    background:
        rgba(139,94,60,.08);

    display:flex;
    align-items:center;
    justify-content:center;
}

/* ====================================
   FORM
==================================== */

.form-control,
.form-select{
    border-radius:14px;

    border:1px solid #ebe6e0;

    min-height:50px;

    transition:.3s;
}

.form-control:focus,
.form-select:focus{
    border-color:#8b5e3c;

    box-shadow:
        0 0 0 4px rgba(139,94,60,.10);
}

.input-group-text{
    border-radius:14px 0 0 14px;

    border-color:#ebe6e0;
}

/* ====================================
   PROJECT CARD
==================================== */

.project-card{
    border:none;

    border-radius:24px;

    overflow:hidden;

    position:relative;

    background:white;

    transition:all .35s ease;

    box-shadow:
        0 10px 30px rgba(0,0,0,.04);
}

.project-card::before{
    content:'';

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:4px;

    background:
        linear-gradient(
            90deg,
            #8b5e3c,
            #c8a27a
        );

    transform:scaleX(0);

    transform-origin:left;

    transition:.35s;
}

.project-card:hover{
    transform:
        translateY(-8px);

    box-shadow:
        0 25px 50px rgba(139,94,60,.10);
}

.project-card:hover::before{
    transform:scaleX(1);
}

.project-card .btn-primary{
    border-radius:12px;

    padding:.6rem 1.2rem;

    font-size:.92rem;
}

.project-card .btn-primary i{
    transition:.3s;
}

.project-card .btn-primary:hover i{
    transform:translateX(4px);
}

.project-budget{
    background:
        linear-gradient(
            135deg,
            #faf7f3,
            #ffffff
        );

    border:1px solid #eee6df;

    border-radius:16px;

    padding:1rem;
}

.project-counter{
    background:white;

    padding:.8rem 1.2rem;

    border-radius:14px;

    box-shadow:
        0 8px 20px rgba(0,0,0,.04);

    font-weight:600;
}

/* ====================================
   PAGINATION
==================================== */

.pagination{
    gap:.5rem;
}

.page-link{
    border:none !important;

    border-radius:12px !important;

    min-width:44px;
    height:44px;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#6c757d;

    font-weight:600;

    background:white;

    box-shadow:
        0 5px 15px rgba(0,0,0,.04);

    transition:.3s;
}

.page-link:hover{
    color:white;

    background:#8b5e3c;

    transform:translateY(-2px);
}

.page-item.active .page-link{
    background:
        linear-gradient(
            135deg,
            #8b5e3c,
            #6f492e
        );

    color:white;

    box-shadow:
        0 10px 25px rgba(139,94,60,.25);
}

.page-item.disabled .page-link{
    background:#f8f9fa;
}

/* ==========================
   SWEETALERT MODERN
========================== */

.swal-modern{
    border-radius:24px !important;

    padding:1.5rem !important;

    border:none !important;

    box-shadow:
        0 25px 60px rgba(0,0,0,.12) !important;
}

.swal-title{
    font-size:1.4rem !important;
    font-weight:700 !important;
    color:#2b2b2b !important;
}

.swal-btn-confirm{
    background:linear-gradient(
        135deg,
        #8b5e3c,
        #6f492e
    ) !important;

    color:white !important;

    border:none !important;

    border-radius:12px !important;

    padding:12px 24px !important;

    font-weight:600 !important;

    margin-left:8px !important;

    transition:.3s !important;
}

.swal-btn-confirm:hover{
    transform:translateY(-2px);
}

.swal-btn-cancel{
    background:#f5f5f5 !important;

    color:#495057 !important;

    border:none !important;

    border-radius:12px !important;

    padding:12px 24px !important;

    font-weight:600 !important;

    margin-right:8px !important;
}

.swal-btn-cancel:hover{
    background:#ececec !important;
}
</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand navbar-brand-custom" href="/">
                <img src="{{ asset('assets/images/icon.svg') }}" alt="Logo" onerror="this.src='data:image/svg+xml;charset=UTF-8,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'32\' height=\'32\' viewBox=\'0 0 24 24\' fill=\'%238b5e3c\'%3E%3Cpath d=\'M13 10V3L4 14h7v7l9-11h-7z\'/%3E%3C/svg%3E';">
                Bid-Down
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-1 text-primary"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-2">
                    @yield('nav-links')
                    
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0 dropdown">
                        <a class="profile-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-avatar">
                                @auth
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @else
                                    G
                                @endauth
                            </div>
                            <span class="fw-semibold">
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    Guest
                                @endauth
                            </span>
                            <i class="bi bi-chevron-down small text-secondary"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="@auth {{ Auth::user()->isClient() ? route('profileclient') : route('profilefreelancer') }} @else # @endauth">
                                    <i class="bi bi-person me-2"></i> Profil Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0" onsubmit="return confirmAction(event, 'Apakah Anda yakin ingin keluar?', 'Ya, Keluar')">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-item-custom text-danger w-100 text-start">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
    function confirmAction(event, message, confirmText = 'Ya, Lanjutkan') {
        event.preventDefault();
        
        // Simpan referensi form secara sinkron agar tidak hilang di dalam Promise
        const formElement = event.target;

        Swal.fire({
            title: 'Konfirmasi Tindakan',
            html: `
                <div style="font-size:15px;color:#6c757d;">
                    ${message}
                </div>
            `,
            icon: 'question',

            showCancelButton: true,
            reverseButtons: true,

            confirmButtonText: `
                <i class="bi bi-check-circle me-1"></i>
                ${confirmText}
            `,

            cancelButtonText: `
                <i class="bi bi-x-circle me-1"></i>
                Batal
            `,

            buttonsStyling: false,

            customClass: {
                popup: 'swal-modern',
                title: 'swal-title',
                confirmButton: 'swal-btn-confirm',
                cancelButton: 'swal-btn-cancel'
            },

            showClass: {
                popup: `
                    animate__animated
                    animate__fadeInUp
                    animate__faster
                `
            },

            hideClass: {
                popup: `
                    animate__animated
                    animate__fadeOutDown
                    animate__faster
                `
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form secara terprogram
                formElement.submit();
            }
        });

        return false;
    }
    </script>
    @yield('scripts')
</body>
</html>