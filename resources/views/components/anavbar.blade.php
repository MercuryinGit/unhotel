<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />

<style>
    .admin-navbar {
        border-bottom: 3px solid #e8523b;
        background: #103f55;
    }

    .admin-navbar .navbar-brand,
    .admin-navbar .nav-link {
        color: #fff;
    }

    .admin-navbar .nav-link {
        color: rgb(255 255 255 / 75%);
        font-size: .9rem;
        font-weight: 600;
    }

    .admin-navbar .nav-link:hover,
    .admin-navbar .nav-link.active {
        color: #ffb8a9;
    }

    .admin-brand-mark {
        display: inline-grid;
        width: 2rem;
        height: 2rem;
        margin-right: .55rem;
        place-items: center;
        border-radius: .6rem;
        background: rgb(255 255 255 / 15%);
        font-size: .85rem;
    }
    .admin-navbar .navbar-toggler {
        border-color: rgb(255 255 255 / 35%);
    }
    .admin-navbar .navbar-toggler-icon {
        filter: invert(1);
    }

    .admin-page {
        min-height: calc(100vh - 64px);
        background: #f3f7fa;
        color: #17384b;
    }

    .admin-eyebrow {
        color: #e8523b;
        font-size: .73rem;
        font-weight: 800;
        letter-spacing: .13em;
        text-transform: uppercase;
    }

    .admin-title {
        color: #123b52;
        font-size: clamp(1.7rem, 3vw, 2.2rem);
        font-weight: 800;
        letter-spacing: -.04em;
    }

    .admin-muted {
        color: #748895;
    }

    .admin-primary {
        border-color: #e8523b;
        background: #e8523b;
        color: #fff;
        font-weight: 700;
    }

    .admin-primary:hover {
        border-color: #cf412d;
        background: #cf412d;
        color: #fff;
    }

    .admin-outline {
        border-color: #d6e0e5;
        color: #103f55;
        font-weight: 700;
    }

    .admin-outline:hover {
        border-color: #103f55;
        background: #103f55;
        color: #fff;
    }
</style>

<nav class="navbar navbar-expand-lg admin-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            <span class="admin-brand-mark">U</span>UntitledStay
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav"
            aria-controls="adminNav" aria-expanded="false" aria-label="Buka navigasi admin">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">Ringkasan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}"
                        href="{{ route('admin.bookings.index') }}">Pemesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}"
                        href="{{ route('admin.fasilitas.index') }}">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.promos.*') ? 'active' : '' }}"
                        href="{{ route('admin.promos.index') }}">Promo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kamar.*') ? 'active' : '' }}"
                        href="{{ route('kamar.index') }}">Kamar</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-light" type="submit">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
