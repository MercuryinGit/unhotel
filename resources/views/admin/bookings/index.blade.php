<x-anavbar />

<main class="admin-page py-4 py-lg-5">
    <div class="container">
        <div class="mb-4">
            <p class="admin-eyebrow mb-2">Operasional</p>
            <h1 class="admin-title mb-1">Pemesanan</h1>
            <p class="admin-muted mb-0">Tinjau permintaan tamu, status konfirmasi, dan pembayaran.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form class="admin-filter-panel mb-3" method="GET" action="{{ route('admin.bookings.index') }}">
            <label for="booking_status" class="form-label fw-semibold mb-0">Filter status</label>
            <select class="form-select" id="booking_status" name="status">
                <option value="">Semua pemesanan</option>
                @foreach (['pending' => 'Menunggu', 'confirmed' => 'Dikonfirmasi', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $value => $label)
                    <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn admin-primary">Terapkan</button>
        </form>

        <section class="admin-panel">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Kode / Tamu</th>
                            <th>Kamar</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th class="pe-4">Simpan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td class="ps-4">
                                    <strong class="d-block">{{ $booking->booking_code }}</strong>
                                    <small class="text-secondary">{{ $booking->user->name }}</small>
                                </td>
                                <td>{{ $booking->kamar->nomor_kamar }} · {{ $booking->kamar->tipe_kamar }}</td>
                                <td class="small">{{ $booking->check_in->format('d M Y') }}<br>{{ $booking->check_out->format('d M Y') }}</td>
                                <td class="text-nowrap">Rp{{ number_format($booking->total_amount, 0, ',', '.') }}</td>
                                <td colspan="3">
                                    <form class="admin-booking-update" method="POST" action="{{ route('admin.bookings.update', $booking) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select class="form-select form-select-sm" name="status" aria-label="Status pemesanan">
                                            @foreach (['pending' => 'Menunggu', 'confirmed' => 'Dikonfirmasi', 'completed' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $value => $label)
                                                <option value="{{ $value }}" @selected($booking->status === $value)>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <select class="form-select form-select-sm" name="payment_status" aria-label="Status pembayaran">
                                            <option value="pending" @selected($booking->payment_status === 'pending')>Belum dibayar</option>
                                            <option value="paid" @selected($booking->payment_status === 'paid')>Lunas</option>
                                        </select>
                                        <button class="btn btn-sm admin-primary" type="submit">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="p-5 text-center admin-muted" colspan="7">Belum ada data pemesanan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <div class="mt-4">{{ $bookings->links() }}</div>
    </div>
</main>

<style>
    .admin-panel { overflow: hidden; border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
    .admin-filter-panel { display: flex; align-items: center; gap: .75rem; padding: 1rem; border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
    .admin-filter-panel select { max-width: 240px; }
    .admin-booking-update { display: grid; grid-template-columns: minmax(130px, 1fr) minmax(130px, 1fr) auto; gap: .5rem; }
    .table thead th { padding-top: 1rem; padding-bottom: 1rem; background: #f8fafb; color: #526e7f; font-size: .75rem; text-transform: uppercase; letter-spacing: .05em; }
    .table tbody td { padding-top: .9rem; padding-bottom: .9rem; }
    @media (max-width: 767.98px) { .admin-filter-panel { align-items: stretch; flex-direction: column; } .admin-filter-panel select { max-width: none; } }
</style>
