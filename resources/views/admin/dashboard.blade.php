<x-anavbar />

<main class="admin-page py-4 py-lg-5">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <p class="admin-eyebrow mb-2">Ruang kerja operasional</p>
                <h1 class="admin-title mb-1">Ringkasan</h1>
                <p class="admin-muted mb-0">Pantau kamar dan pemesanan hotel hari ini.</p>
            </div>
            <a href="{{ route('kamar.create') }}" class="btn admin-primary">Tambah kamar</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-3">
                <article class="admin-stat-card"><span>Total kamar</span><strong>{{ $summary['rooms'] }}</strong><small>Inventaris terdaftar</small></article>
            </div>
            <div class="col-6 col-xl-3">
                <article class="admin-stat-card"><span>Kamar tersedia</span><strong>{{ $summary['available_rooms'] }}</strong><small>Siap dipesan</small></article>
            </div>
            <div class="col-6 col-xl-3">
                <article class="admin-stat-card"><span>Menunggu</span><strong>{{ $summary['pending_bookings'] }}</strong><small>Perlu ditinjau</small></article>
            </div>
            <div class="col-6 col-xl-3">
                <article class="admin-stat-card"><span>Dikonfirmasi</span><strong>{{ $summary['confirmed_bookings'] }}</strong><small>Pemesanan aktif</small></article>
            </div>
        </div>

        <section class="admin-panel">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 p-4 border-bottom">
                <div>
                    <h2 class="h5 fw-bold mb-1">Pemesanan terbaru</h2>
                    <p class="admin-muted small mb-0">Pemesanan yang baru masuk ke sistem.</p>
                </div>
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-sm admin-outline">Lihat semua</a>
            </div>

            @forelse ($recentBookings as $booking)
                <div class="admin-booking-row">
                    <div>
                        <strong>{{ $booking->booking_code }}</strong>
                        <span>{{ $booking->user->name }} · Kamar {{ $booking->kamar->nomor_kamar }}</span>
                    </div>
                    <span class="admin-badge status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                    <strong>Rp{{ number_format($booking->total_amount, 0, ',', '.') }}</strong>
                </div>
            @empty
                <div class="p-4 admin-muted">Belum ada pemesanan.</div>
            @endforelse
        </section>

        <div class="row g-3 mt-1">
            <div class="col-12 col-md-6">
                <a class="admin-shortcut" href="{{ route('kamar.index') }}">
                    <span><strong>Kelola kamar</strong><small>Perbarui tipe, harga, kapasitas, dan status.</small></span>
                    <b aria-hidden="true">&rarr;</b>
                </a>
            </div>
            <div class="col-12 col-md-6">
                <a class="admin-shortcut" href="{{ route('admin.bookings.index') }}">
                    <span><strong>Kelola pemesanan</strong><small>Konfirmasi pemesanan dan verifikasi pembayaran.</small></span>
                    <b aria-hidden="true">&rarr;</b>
                </a>
            </div>
        </div>
    </div>
</main>

<style>
    .admin-stat-card { display: grid; min-height: 145px; padding: 1.25rem; border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; box-shadow: 0 8px 24px rgb(22 57 77 / 5%); }
    .admin-stat-card span { color: #617b8a; font-size: .85rem; font-weight: 600; }
    .admin-stat-card strong { color: #103f55; font-size: 2rem; }
    .admin-stat-card small { color: #8799a4; }
    .admin-panel { overflow: hidden; border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
    .admin-booking-row { display: grid; grid-template-columns: minmax(0, 1fr) auto auto; align-items: center; gap: 1rem; padding: 1rem 1.5rem; border-bottom: 1px solid #edf1f3; }
    .admin-booking-row:last-child { border-bottom: 0; }
    .admin-booking-row div { display: grid; gap: .25rem; }
    .admin-booking-row span { color: #748895; font-size: .82rem; }
    .admin-booking-row strong:last-child { color: #17384b; font-size: .9rem; }
    .admin-badge { padding: .35rem .65rem; border-radius: 999px; background: #fff4e5; color: #9a5b08 !important; font-size: .72rem !important; font-weight: 700; text-transform: capitalize; }
    .admin-badge.status-confirmed, .admin-badge.status-completed { background: #e7f5ef; color: #247650 !important; }
    .admin-badge.status-cancelled { background: #fdecea; color: #ad302a !important; }
    .admin-shortcut { display: flex; justify-content: space-between; align-items: center; height: 100%; padding: 1.2rem; border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; color: #17384b; text-decoration: none; }
    .admin-shortcut span { display: grid; gap: .3rem; }
    .admin-shortcut small { color: #748895; }
    .admin-shortcut b { color: #e8523b; font-size: 1.3rem; }
    @media (max-width: 575.98px) { .admin-booking-row { grid-template-columns: 1fr auto; padding: 1rem; } .admin-booking-row strong:last-child { grid-column: 1 / -1; } }
</style>
