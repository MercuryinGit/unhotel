<x-unavbar />

<main class="hotel-page py-4 py-lg-5">
    <div class="container" style="max-width: 900px">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <section class="hotel-card overflow-hidden">
            <div class="booking-confirmation-header p-4 p-lg-5 text-center">
                <span class="booking-checkmark" aria-hidden="true">&#10003;</span>
                <p class="hotel-eyebrow mt-3 mb-2">Pemesanan terkirim</p>
                <h1 class="h2 fw-bold text-white mb-2">
                    @if ($booking->status === 'cancelled')
                        Pemesanan dibatalkan
                    @elseif ($booking->status === 'confirmed')
                        Pemesanan dikonfirmasi
                    @else
                        Menunggu konfirmasi
                    @endif
                </h1>
                <p class="text-white-50 mb-0">Kode pemesanan: <strong class="text-white">{{ $booking->booking_code }}</strong></p>
            </div>

            <div class="p-4 p-lg-5">
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <span class="hotel-eyebrow">Detail kamar</span>
                        <h2 class="h5 fw-bold mt-2">Kamar {{ $booking->kamar->nomor_kamar }} · {{ $booking->kamar->tipe_kamar }}</h2>
                        <p class="hotel-muted mb-0">Kapasitas kamar {{ $booking->kamar->kapasitas }} tamu</p>
                    </div>
                    <div class="col-12 col-md-6">
                        <span class="hotel-eyebrow">Tanggal menginap</span>
                        <h2 class="h5 fw-bold mt-2">{{ $booking->check_in->format('d M Y') }} – {{ $booking->check_out->format('d M Y') }}</h2>
                        <p class="hotel-muted mb-0">{{ $booking->guest_count }} tamu</p>
                    </div>
                </div>

                <hr class="my-4">

                <dl class="hotel-confirmation-list">
                    <div><dt>Status pemesanan</dt><dd>{{ ucfirst($booking->status) }}</dd></div>
                    <div><dt>Status pembayaran</dt><dd>{{ $booking->payment_status === 'paid' ? 'Lunas' : 'Menunggu pembayaran' }}</dd></div>
                    <div><dt>Metode pembayaran</dt><dd>{{ $booking->payment_method === 'bank_transfer' ? 'Transfer bank' : 'Bayar di hotel' }}</dd></div>
                    @if ($booking->promo_code)
                        <div><dt>Promo {{ $booking->promo_code }}</dt><dd class="text-success">-Rp{{ number_format($booking->discount_amount, 0, ',', '.') }}</dd></div>
                    @endif
                    <div><dt>Total biaya</dt><dd class="text-danger">Rp{{ number_format($booking->total_amount, 0, ',', '.') }}</dd></div>
                </dl>

                <div class="alert alert-info mb-4">
                    @if ($booking->payment_method === 'bank_transfer')
                        Permintaan transfer akan dikonfirmasi oleh petugas. Status pembayaran berubah setelah pembayaran diverifikasi.
                    @else
                        Pembayaran dilakukan di hotel. Hubungi petugas untuk memastikan rincian pembayaran sebelum kedatangan.
                    @endif
                </div>

                @if ($booking->special_request)
                    <div class="mb-4">
                        <span class="hotel-eyebrow">Permintaan khusus</span>
                        <p class="mb-0 mt-1">{{ $booking->special_request }}</p>
                    </div>
                @endif

                <div class="d-flex flex-wrap justify-content-between gap-2">
                    <a href="{{ route('bookings.index') }}" class="btn hotel-btn-outline">Semua pemesanan</a>
                    @if ($booking->status === 'pending' && $booking->payment_status === 'pending')
                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}"
                            onsubmit="return confirm('Batalkan pemesanan ini?')">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-outline-danger" type="submit">Batalkan pemesanan</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </div>
</main>

<style>
    .booking-confirmation-header {
        background: linear-gradient(135deg, #103f55, #1a6177);
    }

    .booking-checkmark {
        display: inline-grid;
        width: 3.25rem;
        height: 3.25rem;
        place-items: center;
        border-radius: 50%;
        background: rgb(255 255 255 / 15%);
        color: #fff;
        font-size: 1.5rem;
        font-weight: 800;
    }

    .hotel-confirmation-list {
        display: grid;
        gap: .8rem;
    }

    .hotel-confirmation-list div {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .hotel-confirmation-list dt {
        color: var(--hotel-muted);
        font-weight: 500;
    }

    .hotel-confirmation-list dd {
        margin: 0;
        font-weight: 700;
        text-align: right;
    }
</style>
