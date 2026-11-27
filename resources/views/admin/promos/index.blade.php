<x-anavbar />

<main class="admin-page py-4 py-lg-5">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <p class="admin-eyebrow mb-2">Konten hotel</p>
                <h1 class="admin-title mb-1">Promo</h1>
                <p class="admin-muted mb-0">Kelola kode dan periode promo untuk pemesanan kamar.</p>
            </div>
            <a class="btn admin-primary" href="{{ route('admin.promos.create') }}">Tambah promo</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="admin-promo-list">
            @forelse ($promos as $promo)
                @php
                    $promoAktif = $promo->aktif
                        && $promo->mulai_pada->toDateString() <= now()->toDateString()
                        && $promo->berakhir_pada->toDateString() >= now()->toDateString();
                @endphp
                <article class="admin-promo-row">
                    <div class="admin-promo-percent">{{ rtrim(rtrim(number_format($promo->diskon_persen, 2), '0'), '.') }}%</div>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <h2 class="h5 fw-bold mb-0">{{ $promo->judul }}</h2>
                            <span class="admin-promo-code">{{ $promo->kode }}</span>
                        </div>
                        <p class="admin-muted small mt-2 mb-1">{{ $promo->deskripsi }}</p>
                        <span class="admin-muted small">
                            {{ $promo->mulai_pada->format('d M Y') }} – {{ $promo->berakhir_pada->format('d M Y') }}
                        </span>
                    </div>
                    <span class="admin-content-status {{ $promoAktif ? 'is-active' : '' }}">
                        {{ $promoAktif ? 'Aktif' : 'Tidak aktif' }}
                    </span>
                    <div class="d-flex gap-2">
                        <a class="btn btn-sm admin-outline" href="{{ route('admin.promos.edit', $promo) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.promos.destroy', $promo) }}"
                            onsubmit="return confirm('Hapus promo {{ $promo->kode }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                        </form>
                    </div>
                </article>
            @empty
                <div class="admin-panel p-5 text-center admin-muted">Belum ada promo.</div>
            @endforelse
        </section>

        <div class="mt-4">{{ $promos->links() }}</div>
    </div>
</main>

<style>
    .admin-promo-list { display: grid; gap: .9rem; }
    .admin-promo-row { display: flex; align-items: center; gap: 1rem; padding: 1.2rem; border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
    .admin-promo-percent { display: grid; width: 3.5rem; height: 3.5rem; flex: 0 0 auto; place-items: center; border-radius: .8rem; background: #fff0ec; color: #d34a35; font-weight: 800; }
    .admin-promo-code { padding: .25rem .55rem; border: 1px dashed #e8523b; border-radius: .4rem; color: #b13d2a; font-size: .75rem; font-weight: 800; letter-spacing: .08em; }
    .admin-content-status { flex: 0 0 auto; padding: .35rem .65rem; border-radius: 999px; background: #f0f2f4; color: #667984; font-size: .72rem; font-weight: 700; }
    .admin-content-status.is-active { background: #e7f5ef; color: #247650; }
    .admin-panel { border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
    @media (max-width: 767.98px) { .admin-promo-row { align-items: flex-start; flex-wrap: wrap; } .admin-promo-row .flex-grow-1 { flex-basis: calc(100% - 5rem); } }
</style>
