<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container position-relative">
        <div class="row-1">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">UntitledStay</a>
            <p class="text-black-50 fw-bold">Ruang kerja operasional</p>
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
