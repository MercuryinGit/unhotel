<x-unavbar />

<main class="hotel-page py-4 py-lg-5">
    <div class="container">
        <a href="{{ route('rooms.search') }}" class="hotel-back-link">&larr; Kembali ke pencarian</a>

        <div class="row g-4 align-items-start mt-1">
            <div class="col-12 col-lg-8">
                <div class="hotel-card">
                    <img class="hotel-detail-image" src="{{ asset('assets/image/image.png') }}"
                        alt="Interior kamar {{ $kamar->nomor_kamar }}">
                    <div class="p-4 p-lg-5">
                        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                            <div>
                                <p class="hotel-eyebrow mb-2">{{ $kamar->tipe_kamar }}</p>
                                <h1 class="hotel-section-title mb-2">Kamar {{ $kamar->nomor_kamar }}</h1>
                                <span class="hotel-status">{{ $kamar->status_label }}</span>
                            </div>
                            <div class="text-lg-end">
                                <strong class="fs-4">Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</strong>
                                <div class="small hotel-muted">per malam</div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <h2 class="h5 fw-bold">Tentang kamar ini</h2>
                        <p class="hotel-muted">{{ $kamar->deskripsi ?: 'Kamar nyaman dengan fasilitas untuk menunjang waktu istirahat Anda.' }}</p>
                        <div class="hotel-room-facts">
                            <div><span class="hotel-muted small">Kapasitas</span><strong>{{ $kamar->kapasitas }} tamu</strong></div>
                            <div><span class="hotel-muted small">Tipe</span><strong>{{ $kamar->tipe_kamar }}</strong></div>
                            <div><span class="hotel-muted small">Nomor kamar</span><strong>{{ $kamar->nomor_kamar }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="col-12 col-lg-4">
                <form class="hotel-card p-4" method="GET" action="{{ route('booking.create', $kamar) }}">
                    <p class="hotel-eyebrow mb-2">Rencanakan menginap</p>
                    <h2 class="h5 fw-bold mb-3">Pilih tanggal</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="room_check_in">Check-in</label>
                        <input class="form-control hotel-form-control" type="date" id="room_check_in" name="check_in"
                            min="{{ now()->toDateString() }}" value="{{ old('check_in', $filters['check_in'] ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="room_check_out">Check-out</label>
                        <input class="form-control hotel-form-control" type="date" id="room_check_out" name="check_out"
                            min="{{ now()->addDay()->toDateString() }}" value="{{ old('check_out', $filters['check_out'] ?? '') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold" for="room_guests">Jumlah tamu</label>
                        <input class="form-control hotel-form-control" type="number" id="room_guests" name="guests"
                            min="1" max="{{ $kamar->kapasitas }}" value="{{ old('guests', $filters['guests'] ?? 1) }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold" for="room_promo_code">Kode promo <span class="hotel-muted">(opsional)</span></label>
                        <input class="form-control hotel-form-control" type="text" id="room_promo_code" name="promo_code"
                            value="{{ old('promo_code', $filters['promo_code'] ?? '') }}" placeholder="Masukkan kode promo">
                    </div>

                    @if ($kamar->status === 'tersedia')
                        <button class="btn hotel-btn-primary w-100 btn-lg" type="submit">Lanjutkan pemesanan</button>
                    @else
                        <button class="btn btn-secondary w-100 btn-lg" type="button" disabled>Kamar tidak tersedia</button>
                    @endif

                    <p class="small hotel-muted text-center mt-3 mb-0">Ketersediaan akan diperiksa kembali sebelum pemesanan disimpan.</p>
                </form>
            </aside>
        </div>
    </div>
</main>

<style>
    .hotel-back-link {
        color: #31596d;
        font-size: .9rem;
        font-weight: 700;
        text-decoration: none;
    }

    .hotel-back-link:hover {
        color: var(--hotel-coral);
    }

    .hotel-detail-image {
        width: 100%;
        max-height: 430px;
        object-fit: cover;
    }

    .hotel-room-facts {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
        padding: 1rem 0;
        border-top: 1px solid #e8eef1;
    }

    .hotel-room-facts div {
        display: grid;
        gap: .3rem;
    }

    @media (max-width: 575.98px) {
        .hotel-room-facts {
            grid-template-columns: 1fr;
        }
    }
</style>
