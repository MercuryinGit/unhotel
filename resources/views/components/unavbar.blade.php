<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
<nav class="navbar navbar-expand-sm navbar-light bg-light shadow">
    <div class="container position-relative">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">UntitledStay</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavId">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kamar.*') ? 'text-primary' : 'text-black-50' }}"
                        href="{{ route('kamar.index') }}">Kamar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('fasilitas.*') ? 'text-primary' : 'text-black-50' }}"
                        href="#">Fasilitas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('promo.*') ? 'text-primary' : 'text-black-50' }}"
                        href="#">Promo</a>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('lokasi.*') ? 'text-primary' : 'text-black-50' }}"
                        href="#">Lokasi</a>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('profil.*') ? 'text-primary' : 'text-black-50' }}"
                        href="#">Profil</a>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn bg-primary bg-opacity-10 text-primary font-monospace">Logout</button>
            </form>
        </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
