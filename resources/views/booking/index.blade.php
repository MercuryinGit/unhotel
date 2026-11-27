<x-unavbar />

<main class="hotel-page py-4 py-lg-5">
    <div class="container">
        <p class="hotel-eyebrow mb-2">Akun saya</p>
        <h1 class="hotel-section-title mb-2">Pemesanan saya</h1>
        <p class="hotel-muted mb-4">Lihat status dan detail semua pemesananmu.</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-3">
            @forelse ($bookings as $booking)
                <div class="col-12">
                    <article class="hotel-card p-3 p-lg-4">
                        <div class="row align-items-center g-3">
                            <div class="col-12 col-md-3">
                                <span class="hotel-eyebrow">{{ $booking->booking_code }}</span>
                                <h2 class="h6 fw-bold mt-1 mb-0">Kamar {{ $booking->kamar->nomor_kamar }}</h2>
                            </div>
                            <div class="col-6 col-md-3">
                                <span class="d-block small hotel-muted">Tanggal menginap</span>
                                <strong class="small">{{ $booking->check_in->format('d M Y') }} – {{ $booking->check_out->format('d M Y') }}</strong>
                            </div>
                            <div class="col-6 col-md-2">
                                <span class="d-block small hotel-muted">Total</span>
                                <strong class="small">Rp{{ number_format($booking->total_amount, 0, ',', '.') }}</strong>
                            </div>
                            <div class="col-6 col-md-2">
                                <span class="hotel-booking-status status-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
                            </div>
                            <div class="col-6 col-md-2 text-md-end">
                                <a class="btn hotel-btn-outline btn-sm" href="{{ route('bookings.show', $booking) }}">Lihat detail</a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="hotel-card p-5 text-center">
                        <p class="hotel-eyebrow mb-2">Belum ada pemesanan</p>
                        <h2 class="h4 fw-bold">Perjalanan berikutnya dimulai di sini</h2>
                        <p class="hotel-muted">Cari kamar yang sesuai, lalu semua detail pemesanan akan tersimpan di halaman ini.</p>
                        <a class="btn hotel-btn-primary" href="{{ route('rooms.search') }}">Cari kamar</a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">{{ $bookings->links() }}</div>
    </div>
</main>

<style>
    .hotel-booking-status {
        display: inline-flex;
        padding: .4rem .7rem;
        border-radius: 999px;
        background: #fff4e5;
        color: #9a5b08;
        font-size: .75rem;
        font-weight: 700;
        text-transform: capitalize;
    }

    .hotel-booking-status.status-confirmed,
    .hotel-booking-status.status-completed {
        background: #e7f5ef;
        color: #247650;
    }

    .hotel-booking-status.status-cancelled {
        background: #fdecea;
        color: #ad302a;
    }
</style>
