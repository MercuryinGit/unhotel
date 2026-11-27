<x-unavbar />

<main class="hotel-page py-4 py-lg-5">
    <div class="container">
        <div class="mb-4">
            <p class="hotel-eyebrow mb-2">Temukan penginapan</p>
            <h1 class="hotel-section-title mb-2">Kamar yang tersedia</h1>
            <p class="hotel-muted mb-0">
                @if ($filters['check_in'] && $filters['check_out'])
                    {{ \Illuminate\Support\Carbon::parse($filters['check_in'])->format('d M Y') }}
                    – {{ \Illuminate\Support\Carbon::parse($filters['check_out'])->format('d M Y') }}
                    · {{ $filters['guests'] }} tamu
                @else
                    Pilih tanggal menginap untuk memeriksa ketersediaan.
                @endif
            </p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form class="hotel-card p-3 p-lg-4 mb-4" method="GET" action="{{ route('rooms.search') }}">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label fw-semibold" for="search_check_in">Check-in</label>
                    <input class="form-control hotel-form-control" type="date" id="search_check_in" name="check_in"
                        min="{{ now()->toDateString() }}" value="{{ $filters['check_in'] }}">
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <label class="form-label fw-semibold" for="search_check_out">Check-out</label>
                    <input class="form-control hotel-form-control" type="date" id="search_check_out" name="check_out"
                        min="{{ now()->addDay()->toDateString() }}" value="{{ $filters['check_out'] }}">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label fw-semibold" for="search_guests">Jumlah tamu</label>
                    <input class="form-control hotel-form-control" type="number" id="search_guests" name="guests"
                        min="1" max="20" value="{{ $filters['guests'] }}">
                </div>
                <div class="col-12 col-sm-6 col-lg-2">
                    <label class="form-label fw-semibold" for="search_promo_code">Kode promo</label>
                    <input class="form-control hotel-form-control" type="text" id="search_promo_code" name="promo_code"
                        value="{{ $filters['promo_code'] ?? '' }}" placeholder="Opsional">
                </div>
                <div class="col-12 col-sm-6 col-lg-2 d-grid">
                    <button class="btn hotel-btn-primary" type="submit">Perbarui pencarian</button>
                </div>
            </div>
        </form>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="hotel-muted mb-0">{{ $kamars->total() }} pilihan kamar</p>
            <a href="{{ route('home') }}" class="small text-decoration-none">Kembali ke beranda</a>
        </div>

        <div class="row g-4">
            @forelse ($kamars as $kamar)
                <div class="col-12 col-md-6 col-xl-4">
                    <article class="hotel-card h-100">
                        <img class="hotel-room-image" src="{{ asset('assets/image/image.png') }}"
                            alt="Interior kamar {{ $kamar->nomor_kamar }}">
                        <div class="p-4">
                            <div class="d-flex justify-content-between gap-2">
                                <div>
                                    <span class="hotel-eyebrow">{{ $kamar->tipe_kamar }}</span>
                                    <h2 class="h5 fw-bold mt-1">Kamar {{ $kamar->nomor_kamar }}</h2>
                                </div>
                                <span class="hotel-status align-self-start">Tersedia</span>
                            </div>
                            <p class="hotel-muted small">{{ $kamar->deskripsi ?: 'Kamar nyaman dengan kapasitas hingga '.$kamar->kapasitas.' tamu.' }}</p>
                            <div class="small hotel-muted mb-3">Kapasitas {{ $kamar->kapasitas }} tamu</div>
                            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                <div>
                                    <strong class="fs-5 text-dark">Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</strong>
                                    <span class="small hotel-muted"> / malam</span>
                                </div>
                                <a class="btn hotel-btn-primary"
                                    href="{{ route('rooms.show', array_merge(['kamar' => $kamar], array_filter($filters))) }}">Lihat detail</a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="hotel-card p-5 text-center">
                        <span class="hotel-eyebrow">Belum ada hasil</span>
                        <h2 class="h4 fw-bold mt-2">Tidak ada kamar yang cocok</h2>
                        <p class="hotel-muted">Coba ubah tanggal atau jumlah tamu untuk melihat pilihan lain.</p>
                        <a href="{{ route('rooms.search') }}" class="btn hotel-btn-outline">Hapus filter</a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">{{ $kamars->links() }}</div>
    </div>
</main>
