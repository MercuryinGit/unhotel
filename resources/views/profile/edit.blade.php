<x-unavbar />

<main class="hotel-page py-4 py-lg-5">
    <div class="container" style="max-width: 900px">
        <p class="hotel-eyebrow mb-2">Akun saya</p>
        <h1 class="hotel-section-title mb-2">Profil</h1>
        <p class="hotel-muted mb-4">Perbarui informasi akun dan kata sandi.</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="hotel-card p-4 p-lg-5" method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            <h2 class="h5 fw-bold mb-4">Informasi akun</h2>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="name">Nama lengkap</label>
                <input class="form-control hotel-form-control" type="text" id="name" name="name"
                    value="{{ old('name', $user->name) }}" autocomplete="name" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold" for="email">Email</label>
                <input class="form-control hotel-form-control" type="email" id="email" name="email"
                    value="{{ old('email', $user->email) }}" autocomplete="email" required>
            </div>

            <hr class="my-4">
            <h2 class="h5 fw-bold mb-1">Ubah kata sandi</h2>
            <p class="small hotel-muted mb-3">Kosongkan bagian ini jika tidak ingin mengganti kata sandi.</p>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="current_password">Kata sandi saat ini</label>
                <input class="form-control hotel-form-control" type="password" id="current_password" name="current_password"
                    autocomplete="current-password">
            </div>
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold" for="new_password">Kata sandi baru</label>
                    <input class="form-control hotel-form-control" type="password" id="new_password" name="new_password"
                        autocomplete="new-password">
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold" for="new_password_confirmation">Konfirmasi kata sandi baru</label>
                    <input class="form-control hotel-form-control" type="password" id="new_password_confirmation"
                        name="new_password_confirmation" autocomplete="new-password">
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between gap-2">
                <a class="btn hotel-btn-outline" href="{{ route('bookings.index') }}">Pemesanan saya</a>
                <button class="btn hotel-btn-primary" type="submit">Simpan profil</button>
            </div>
        </form>
    </div>
</main>
