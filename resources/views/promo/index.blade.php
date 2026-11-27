<x-unavbar />

<main class="hotel-page py-5">
    <div class="container">
        <p class="hotel-eyebrow mb-2">Penawaran untukmu</p>
        <h1 class="hotel-section-title mb-2">Promo menginap</h1>
        <p class="hotel-muted mb-4">Gunakan kode promo yang masih berlaku saat checkout.</p>

        <div class="row g-4">
            @forelse ($promos as $promo)
                <div class="col-12 col-md-6">
                    <article class="promo-card h-100">
                        <div class="promo-card-main">
                            <span class="promo-discount">{{ rtrim(rtrim(number_format($promo->diskon_persen, 2), '0'), '.') }}%</span>
                            <div>
                                <span class="hotel-eyebrow">Kode promo</span>
                                <h2 class="h4 fw-bold mt-1">{{ $promo->judul }}</h2>
                                <p class="hotel-muted">{{ $promo->deskripsi }}</p>
                                <div class="promo-code">{{ $promo->kode }}</div>
                            </div>
                        </div>
                        <div class="promo-card-footer">
                            <span class="small hotel-muted">
                                Berlaku sampai {{ $promo->berakhir_pada->format('d M Y') }}
                            </span>
                            <a class="btn hotel-btn-primary"
                                href="{{ route('rooms.search', ['promo_code' => $promo->kode]) }}">Pakai promo</a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="hotel-card p-5 text-center">
                        <h2 class="h5 fw-bold">Belum ada promo aktif</h2>
                        <p class="hotel-muted mb-0">Promo baru akan tampil di halaman ini saat tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</main>

<style>
    .promo-card {
        overflow: hidden;
        border: 1px solid #e1e9ee;
        border-radius: 1rem;
        background: #fff;
        box-shadow: 0 12px 30px rgb(22 57 77 / 6%);
    }

    .promo-card-main {
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
        padding: 1.5rem;
    }

    .promo-discount {
        display: grid;
        min-width: 4.5rem;
        min-height: 4.5rem;
        place-items: center;
        border-radius: 1rem;
        background: #fff0ec;
        color: #d34a35;
        font-size: 1.15rem;
        font-weight: 800;
    }

    .promo-code {
        display: inline-block;
        padding: .5rem .85rem;
        border: 1px dashed #e8523b;
        border-radius: .5rem;
        color: #b13d2a;
        font-weight: 800;
        letter-spacing: .12em;
    }

    .promo-card-footer {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: .75rem;
        padding: 1rem 1.5rem;
        border-top: 1px solid #edf1f3;
        background: #f9fbfc;
    }
</style>
