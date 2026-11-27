<x-anavbar />

<main class="admin-page py-4 py-lg-5">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <p class="admin-eyebrow mb-2">Operasional / Inventaris</p>
                <h1 class="admin-title mb-1">Kelola kamar</h1>
                <p class="admin-muted mb-0">Atur informasi, kapasitas, harga, dan status kamar.</p>
            </div>
            <a class="btn admin-primary" href="{{ route('kamar.create') }}">Tambah kamar</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row g-3 mb-4">
            <div class="col-4">
                <article class="admin-stat-card"><span>Total kamar</span><strong>{{ $summary['total'] }}</strong></article>
            </div>
            <div class="col-4">
                <article class="admin-stat-card"><span>Tersedia</span><strong>{{ $summary['available'] }}</strong></article>
            </div>
            <div class="col-4">
                <article class="admin-stat-card"><span>Terisi</span><strong>{{ $summary['occupied'] }}</strong></article>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h5 fw-bold mb-0">Daftar kamar</h2>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm admin-outline">Lihat pemesanan</a>
        </div>

        <div class="row g-3">
            @forelse ($kamars as $kamar)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                    <article class="admin-room-card h-100">
                        <a class="text-decoration-none text-reset" href="{{ route('kamar.edit', $kamar) }}">
                            <img src="{{ asset('assets/image/image.png') }}" alt="Kamar {{ $kamar->nomor_kamar }}">
                            <div class="p-3">
                                <span class="admin-eyebrow">{{ $kamar->tipe_kamar }}</span>
                                <h3 class="h6 fw-bold mt-1 mb-2">Kamar {{ $kamar->nomor_kamar }}</h3>
                                <span class="admin-room-status status-{{ $kamar->status }}">{{ $kamar->status_label }}</span>
                                <p class="small admin-muted mt-2 mb-1">{{ $kamar->kapasitas }} tamu</p>
                                <strong class="small">Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}<span class="admin-muted fw-normal"> / malam</span></strong>
                            </div>
                        </a>
                        <div class="admin-room-actions">
                            <a class="btn btn-sm admin-outline" href="{{ route('kamar.edit', $kamar) }}">Edit</a>
                            <form method="POST" action="{{ route('kamar.destroy', $kamar) }}"
                                onsubmit="return confirm('Hapus kamar {{ $kamar->nomor_kamar }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="admin-panel p-5 text-center">
                        <h2 class="h5 fw-bold">Belum ada kamar</h2>
                        <p class="admin-muted">Tambahkan kamar untuk mulai menerima pemesanan.</p>
                        <a class="btn admin-primary" href="{{ route('kamar.create') }}">Tambah kamar pertama</a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">{{ $kamars->links() }}</div>
    </div>
</main>

<style>
    .admin-stat-card { display: grid; min-height: 100px; padding: 1rem 1.2rem; border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
    .admin-stat-card span { color: #617b8a; font-size: .85rem; font-weight: 600; }
    .admin-stat-card strong { color: #103f55; font-size: 1.8rem; }
    .admin-room-card { overflow: hidden; border: 1px solid #e1e9ee; border-radius: .85rem; background: #fff; box-shadow: 0 8px 24px rgb(22 57 77 / 5%); }
    .admin-room-card img { width: 100%; height: 110px; object-fit: cover; }
    .admin-room-status { display: inline-flex; padding: .3rem .55rem; border-radius: 999px; background: #e7f5ef; color: #247650; font-size: .68rem; font-weight: 700; }
    .admin-room-status.status-terisi { background: #fff4e5; color: #9a5b08; }
    .admin-room-status.status-cleaning, .admin-room-status.status-maintenance { background: #fdecea; color: #ad302a; }
    .admin-room-actions { display: flex; justify-content: space-between; gap: .4rem; padding: 0 .75rem .75rem; }
    .admin-room-actions .btn { padding: .3rem .45rem; font-size: .72rem; }
    @media (max-width: 575.98px) { .admin-room-actions { align-items: stretch; flex-direction: column; } .admin-room-actions .btn { width: 100%; } }
</style>
