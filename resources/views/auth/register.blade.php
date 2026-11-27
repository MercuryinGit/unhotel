<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar · UntitledStay</title>
    @include('components.auth_styles')
</head>
<body>
    <main class="auth-page">
        <section class="auth-visual">
            <a class="auth-brand" href="{{ route('home') }}">UntitledStay</a>
            <div class="auth-visual-copy">
                <p class="text-uppercase small fw-bold text-white-50">Mulai perjalananmu</p>
                <h2>Temukan tempat untuk cerita baru.</h2>
                <p class="text-white-50 mb-0">Buat akun untuk memesan kamar dan memantau status perjalananmu.</p>
            </div>
            <span class="small text-white-50">Penginapan yang terasa lebih dekat.</span>
        </section>

        <section class="auth-form-side">
            <div class="auth-form-wrap">
                <a class="auth-home-link d-inline-block mb-4" href="{{ route('home') }}">&larr; Beranda</a>
                <p class="text-uppercase small fw-bold text-danger mb-2">Bergabung bersama kami</p>
                <h1 class="mb-2">Buat akun</h1>
                <p class="auth-muted mb-4">Isi data berikut untuk memulai pemesanan.</p>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 small">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama lengkap</label>
                        <input id="name" name="name" value="{{ old('name') }}" class="form-control"
                            autocomplete="name" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                            autocomplete="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata sandi</label>
                        <input type="password" id="password" name="password" class="form-control"
                            autocomplete="new-password" required>
                    </div>
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi kata sandi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" autocomplete="new-password" required>
                    </div>
                    <button type="submit" class="btn auth-submit w-100 py-2">Buat akun</button>
                </form>

                <p class="text-center small auth-muted mt-4 mb-0">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
                </p>
            </div>
        </section>
    </main>
</body>
</html>
