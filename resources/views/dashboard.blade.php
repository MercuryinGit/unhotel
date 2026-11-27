<x-unavbar />

<main>
    <section class="hotel-hero" style="background-image: linear-gradient(90deg, rgba(8, 39, 54, .86), rgba(8, 39, 54, .25)), url('{{ asset('assets/image/image.png') }}')">
        <div class="container py-5 py-lg-6">
            <div class="row py-lg-5">
                <div class="col-lg-8 col-xl-7">
                    <p class="hotel-eyebrow text-white-50">Menginap nyaman, cerita berkesan</p>
                    <h1 class="display-4 fw-bold text-white mb-3">Temukan tempat istirahat yang terasa seperti rumah.</h1>
                    <p class="lead text-white-50 mb-4">Pilih kamar yang tepat untuk perjalananmu, dengan proses pemesanan yang mudah dan jelas.</p>
                </div>
            </div>

            <form class="hotel-search-card" method="GET" action="{{ route('rooms.search') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="home_check_in" class="form-label">Check-in</label>
                        <input class="form-control hotel-form-control" type="date" id="home_check_in" name="check_in"
                            min="{{ now()->toDateString() }}" value="{{ request('check_in') }}" required>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                        <label for="home_check_out" class="form-label">Check-out</label>
                        <input class="form-control hotel-form-control" type="date" id="home_check_out" name="check_out"
                            min="{{ now()->addDay()->toDateString() }}" value="{{ request('check_out') }}" required>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-2">
                        <label for="home_guests" class="form-label">Jumlah tamu</label>
                        <input class="form-control hotel-form-control" type="number" id="home_guests" name="guests"
                            min="1" max="20" value="{{ request('guests', 1) }}" required>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 d-grid">
                        <button class="btn hotel-btn-primary btn-lg" type="submit">Cari kamar tersedia</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="container py-5 py-lg-6">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <p class="hotel-eyebrow mb-2">Pilihan untukmu</p>
                <h2 class="hotel-section-title mb-1">Kamar yang tersedia</h2>
                <p class="hotel-muted mb-0">Temukan kenyamanan yang sesuai dengan kebutuhan perjalananmu.</p>
            </div>
            <a href="{{ route('rooms.search') }}" class="btn hotel-btn-outline">Lihat semua kamar</a>
        </div>

        <div class="row g-4">
            @forelse ($featuredRooms as $kamar)
                <div class="col-12 col-md-6 col-xl-4">
                    <article class="hotel-card h-100">
                        <img class="hotel-room-image" src="{{ asset('assets/image/image.png') }}"
                            alt="Interior kamar {{ $kamar->nomor_kamar }}">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-start gap-2">
                                <div>
                                    <span class="hotel-eyebrow">{{ $kamar->tipe_kamar }}</span>
                                    <h3 class="h5 fw-bold mt-1 mb-2">Kamar {{ $kamar->nomor_kamar }}</h3>
                                </div>
                                <span class="hotel-status">Tersedia</span>
                            </div>
                            <p class="hotel-muted small">{{ $kamar->deskripsi ?: 'Kamar nyaman untuk masa menginap yang menyenangkan.' }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div>
                                    <strong class="fs-5 text-dark">Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</strong>
                                    <span class="small hotel-muted"> / malam</span>
                                </div>
                                <a class="btn hotel-btn-primary" href="{{ route('rooms.show', $kamar) }}">Lihat kamar</a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="hotel-card p-4 text-center">
                        <h3 class="h5 fw-bold">Kamar sedang disiapkan</h3>
                        <p class="hotel-muted mb-0">Silakan kembali lagi nanti untuk melihat pilihan kamar.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    @if ($activePromos->isNotEmpty())
        <section class="container pb-5">
            <div class="hotel-promo-banner">
                <div>
                    <p class="hotel-eyebrow text-white-50 mb-2">Penawaran terbatas</p>
                    <h2 class="h3 fw-bold text-white mb-2">Nikmati promo menginap</h2>
                    <p class="text-white-50 mb-0">Gunakan kode promo yang tersedia saat checkout.</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($activePromos as $promo)
                        <div class="hotel-promo-chip">
                            <strong>{{ $promo->kode }}</strong>
                            <span>Diskon {{ rtrim(rtrim(number_format($promo->diskon_persen, 2), '0'), '.') }}%</span>
                        </div>
                    @endforeach
                    <a href="{{ route('promos.index') }}" class="btn btn-light align-self-center">Lihat promo</a>
                </div>
            </div>
        </section>
    @endif

    @if ($featuredFacilities->isNotEmpty())
        <section class="container pb-5">
            <div class="d-flex justify-content-between align-items-end gap-3 mb-4">
                <div>
                    <p class="hotel-eyebrow mb-2">Untuk kenyamananmu</p>
                    <h2 class="hotel-section-title mb-0">Fasilitas hotel</h2>
                </div>
                <a href="{{ route('facilities.index') }}" class="btn hotel-btn-outline">Semua fasilitas</a>
            </div>
            <div class="row g-3">
                @foreach ($featuredFacilities as $facility)
                    <div class="col-6 col-md-3">
                        <article class="hotel-facility-card">
                            <span>{{ $facility->ikon }}</span>
                            <h3 class="h6 fw-bold mt-3">{{ $facility->nama }}</h3>
                            <p class="small hotel-muted mb-0">{{ $facility->deskripsi }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="d-flex gap-3">
                        <span class="hotel-benefit-number">01</span>
                        <div><h3 class="h6 fw-bold">Harga jelas</h3><p class="small hotel-muted mb-0">Lihat total biaya sebelum konfirmasi pemesanan.</p></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="d-flex gap-3">
                        <span class="hotel-benefit-number">02</span>
                        <div><h3 class="h6 fw-bold">Ketersediaan aktual</h3><p class="small hotel-muted mb-0">Kamar yang sudah dipesan tidak akan ditawarkan untuk tanggal yang sama.</p></div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="d-flex gap-3">
                        <span class="hotel-benefit-number">03</span>
                        <div><h3 class="h6 fw-bold">Kelola pemesanan</h3><p class="small hotel-muted mb-0">Pantau status dan riwayat pemesanan dari akunmu.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<footer class="hotel-footer py-4">
    <div class="container d-flex flex-wrap justify-content-between gap-2">
        <span class="fw-bold text-white">UntitledStay</span>
        <span class="small">Penginapan nyaman, dikelola dengan lebih mudah.</span>
    </div>
</footer>

<style>
    .hotel-hero {
        min-height: 520px;
        display: flex;
        align-items: center;
        background-position: center;
        background-size: cover;
    }

    .hotel-search-card {
        padding: 1.35rem;
        border: 1px solid rgb(255 255 255 / 55%);
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 22px 60px rgb(4 23 34 / 20%);
    }

    .hotel-search-card .form-label {
        color: #34566a;
        font-size: .85rem;
        font-weight: 700;
    }

    .hotel-benefit-number {
        display: grid;
        width: 2.4rem;
        height: 2.4rem;
        flex: 0 0 auto;
        place-items: center;
        border-radius: .75rem;
        background: #eaf2f6;
        color: var(--hotel-navy);
        font-size: .8rem;
        font-weight: 800;
    }

    .hotel-promo-banner {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem 2rem;
        border-radius: 1rem;
        background: linear-gradient(120deg, #103f55, #1d6579);
    }

    .hotel-promo-chip {
        display: grid;
        min-width: 120px;
        padding: .8rem 1rem;
        border: 1px dashed rgb(255 255 255 / 55%);
        border-radius: .75rem;
        color: #fff;
        text-align: center;
    }

    .hotel-promo-chip span {
        color: rgb(255 255 255 / 75%);
        font-size: .75rem;
    }

    .hotel-facility-card {
        height: 100%;
        padding: 1.2rem;
        border: 1px solid #e3eaee;
        border-radius: .9rem;
        background: #fff;
    }

    .hotel-facility-card > span {
        display: inline-grid;
        width: 2.5rem;
        height: 2.5rem;
        place-items: center;
        border-radius: .7rem;
        background: #eaf2f6;
        color: var(--hotel-navy);
        font-size: .8rem;
        font-weight: 800;
    }
</style>
