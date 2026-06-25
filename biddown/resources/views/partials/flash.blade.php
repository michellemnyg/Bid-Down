@if (session('success') || session('error') || $errors->any())
    <div class="bid-flash-wrap">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show bid-flash" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show bid-flash" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show bid-flash" role="alert">
                <strong>Periksa input:</strong> {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <style>
        .bid-flash-wrap {
            position: fixed;
            top: 1.25rem;
            left: 50%;
            width: min(92vw, 560px);
            transform: translateX(-50%);
            z-index: 1080;
            pointer-events: none;
            transition: opacity 0.5s ease-out;
        }

        .bid-flash {
            border: 0;
            border-radius: 14px;
            box-shadow: 0 18px 48px rgba(45, 31, 21, 0.18);
            padding: 1rem 3rem 1rem 1.15rem;
            pointer-events: auto;
        }
    </style>

    <script>
        // Auto-hide the flash message after 4 seconds
        setTimeout(() => {
            const flashWrap = document.querySelector('.bid-flash-wrap');
            if (flashWrap) {
                flashWrap.style.opacity = '0';
                setTimeout(() => {
                    flashWrap.remove();
                }, 500); // Wait for transition to finish
            }
        }, 4000);
    </script>
@endif
