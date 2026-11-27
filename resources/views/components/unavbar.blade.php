<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />

<style>
    :root {
        --hotel-navy: #103f55;
        --hotel-navy-dark: #0b3042;
        --hotel-coral: #e8523b;
        --hotel-muted: #748895;
        --hotel-bg: #f4f7f9;
    }

    .hotel-navbar {
        position: relative;
        z-index: 5;
        border-bottom: 1px solid #e8eef1;
        background: #fff;
    }

    .hotel-brand {
        display: inline-flex;
        align-items: center;
        gap: .65rem;
        color: var(--hotel-navy);
        font-size: 1.15rem;
        font-weight: 800;
        letter-spacing: -.03em;
        text-decoration: none;
    }

    .hotel-brand-mark {
        display: grid;
        width: 2rem;
        height: 2rem;
        place-items: center;
        border-radius: .6rem;
        background: var(--hotel-navy);
        color: #fff;
        font-size: .85rem;
    }

    .hotel-navbar .nav-link {
        padding: .7rem .85rem !important;
        color: #587080;
        font-size: .9rem;
        font-weight: 600;
    }

    .hotel-navbar .nav-link:hover,
    .hotel-navbar .nav-link.active {
        color: var(--hotel-coral);
    }

    .hotel-btn-primary {
        border-color: var(--hotel-coral);
        background: var(--hotel-coral);
        color: #fff;
        font-weight: 700;
    }

    .hotel-btn-primary:hover,
    .hotel-btn-primary:focus {
        border-color: #cf412d;
        background: #cf412d;
        color: #fff;
    }

    .hotel-btn-outline {
        border-color: #d6e0e5;
        color: var(--hotel-navy);
        font-weight: 700;
    }

    .hotel-btn-outline:hover {
        border-color: var(--hotel-navy);
        background: var(--hotel-navy);
        color: #fff;
    }

    .hotel-page {
        min-height: calc(100vh - 72px);
        background: var(--hotel-bg);
    }

    .hotel-eyebrow {
        color: var(--hotel-coral);
        font-size: .75rem;
        font-weight: 800;
        letter-spacing: .14em;
        text-transform: uppercase;
    }

    .hotel-section-title {
        color: var(--hotel-navy);
        font-size: clamp(1.7rem, 3vw, 2.25rem);
        font-weight: 800;
        letter-spacing: -.04em;
    }

    .hotel-muted {
        color: var(--hotel-muted);
    }

    .hotel-card {
        overflow: hidden;
        border: 1px solid #e3eaee;
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 12px 30px rgb(22 57 77 / 6%);
    }

    .hotel-room-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }

    .hotel-form-control {
        min-height: 2.85rem;
        border-color: #d8e2e8;
        border-radius: .6rem;
    }

    .hotel-form-control:focus {
        border-color: #e97861;
        box-shadow: 0 0 0 .2rem rgb(232 82 59 / 12%);
    }

    .hotel-status {
        display: inline-flex;
        align-items: center;
        padding: .35rem .65rem;
        border-radius: 999px;
        background: #e7f5ef;
        color: #247650;
        font-size: .75rem;
        font-weight: 700;
    }

    .hotel-footer {
        background: var(--hotel-navy-dark);
        color: rgb(255 255 255 / 75%);
    }
</style>

<nav class="navbar navbar-expand-lg hotel-navbar">
    <div class="container py-2">
        <a class="hotel-brand" href="{{ route('home') }}">
            <span class="hotel-brand-mark">U</span>
            UntitledStay
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#hotelNav"
            aria-controls="hotelNav" aria-expanded="false" aria-label="Buka navigasi">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="hotelNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('rooms.*') ? 'active' : '' }}"
                        href="{{ route('rooms.search') }}">Cari kamar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('facilities.*') ? 'active' : '' }}"
                        href="{{ route('facilities.index') }}">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('promos.*') ? 'active' : '' }}"
                        href="{{ route('promos.index') }}">Promo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('location.*') ? 'active' : '' }}"
                        href="{{ route('location.show') }}">Lokasi</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('bookings.*') ? 'active' : '' }}"
                            href="{{ route('bookings.index') }}">Pemesanan saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}"
                            href="{{ route('profile.edit') }}">Profil</a>
                    </li>
                    @if (in_array(auth()->user()->role, ['admin', 'super_admin'], true))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Operasional</a>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="d-flex align-items-center gap-2">
                @auth
                    <span class="small hotel-muted d-none d-xl-inline">Hai, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn hotel-btn-outline btn-sm">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn hotel-btn-outline btn-sm">Masuk</a>
                    <a href="{{ route('register') }}" class="btn hotel-btn-primary btn-sm">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
