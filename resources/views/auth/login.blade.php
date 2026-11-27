<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk · UntitledStay</title>
    @include('components.auth_styles')
</head>
<body>
    <main class="auth-page">
        <section class="auth-visual">
            <a class="auth-brand" href="{{ route('home') }}">UntitledStay</a>
            <div class="auth-visual-copy">
                <p class="text-uppercase small fw-bold text-white-50">Menginap nyaman, cerita berkesan</p>
                <h2>Senang melihatmu kembali.</h2>
                <p class="text-white-50 mb-0">Masuk untuk melihat perjalanan dan mengelola pemesananmu.</p>
            </div>
            <span class="small text-white-50">Penginapan yang terasa lebih dekat.</span>
        </section>

        <section class="auth-form-side">
            <div class="auth-form-wrap">
                <a class="auth-home-link d-inline-block mb-4" href="{{ route('home') }}">&larr; Beranda</a>
                <p class="text-uppercase small fw-bold text-danger mb-2">Akun UntitledStay</p>
                <h1 class="mb-2">Masuk ke akun</h1>
                <p class="auth-muted mb-4">Gunakan email dan kata sandi yang terdaftar.</p>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger py-2 small">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com"
                            autocomplete="email" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata sandi</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Masukkan kata sandi" autocomplete="current-password" required>
                    </div>
                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label small" for="remember">Ingat saya</label>
                    </div>
                    <button type="submit" class="btn auth-submit w-100 py-2">Masuk</button>
                </form>

                <p class="text-center small auth-muted mt-4 mb-0">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                </p>
            </div>
        </section>
    </main>
</body>
</html>
