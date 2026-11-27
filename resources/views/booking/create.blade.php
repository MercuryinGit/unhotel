<x-unavbar />

<main class="hotel-page py-4 py-lg-5">
    <div class="container">
        <a href="{{ route('rooms.show', $kamar) }}" class="hotel-back-link">&larr; Kembali ke detail kamar</a>

        <div class="mt-3 mb-4">
            <p class="hotel-eyebrow mb-2">Langkah terakhir</p>
            <h1 class="hotel-section-title mb-2">Konfirmasi pemesanan</h1>
            <p class="hotel-muted mb-0">Periksa detail perjalanan sebelum mengirim permintaan pemesanan.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7">
                <form class="hotel-card p-4 p-lg-5" method="POST" action="{{ route('booking.store', $kamar) }}">
                    @csrf
                    <h2 class="h5 fw-bold mb-4">Detail tamu dan pembayaran</h2>
                    <input type="hidden" name="check_in" value="{{ $filters['check_in'] }}">
                    <input type="hidden" name="check_out" value="{{ $filters['check_out'] }}">
                    <input type="hidden" name="promo_code" value="{{ $filters['promo_code'] ?? '' }}">

                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <label class="form-label fw-semibold" for="guest_count">Jumlah tamu</label>
                            <input class="form-control hotel-form-control" type="number" id="guest_count" name="guest_count"
                                min="1" max="{{ $kamar->kapasitas }}" value="{{ old('guest_count', $filters['guests']) }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold" for="special_request">Permintaan khusus <span class="hotel-muted fw-normal">(opsional)</span></label>
                            <textarea class="form-control hotel-form-control" id="special_request" name="special_request"
                                rows="3" maxlength="500" placeholder="Tuliskan permintaan jika ada">{{ old('special_request') }}</textarea>
                        </div>
                    </div>

                    <fieldset class="mb-4">
                        <legend class="h6 fw-bold mb-3">Metode pembayaran</legend>
                        <label class="hotel-payment-option mb-2">
                            <input type="radio" name="payment_method" value="bank_transfer"
                                @checked(old('payment_method', 'bank_transfer') === 'bank_transfer') required>
                            <span><strong>Transfer bank</strong><small>Instruksi pembayaran diberikan setelah pemesanan dibuat.</small></span>
                        </label>
                        <label class="hotel-payment-option">
                            <input type="radio" name="payment_method" value="pay_at_hotel"
                                @checked(old('payment_method') === 'pay_at_hotel')>
                            <span><strong>Bayar di hotel</strong><small>Konfirmasi metode pembayaran langsung dengan petugas hotel.</small></span>
                        </label>
                    </fieldset>

                    <button class="btn hotel-btn-primary btn-lg w-100" type="submit">Buat pemesanan</button>
                    <p class="small hotel-muted text-center mt-3 mb-0">Status pemesanan akan menunggu konfirmasi petugas.</p>
                </form>
            </div>

            <aside class="col-12 col-lg-5">
                <section class="hotel-card p-4">
                    <img class="hotel-summary-image mb-3" src="{{ asset('assets/image/image.png') }}"
                        alt="Interior kamar {{ $kamar->nomor_kamar }}">
                    <p class="hotel-eyebrow mb-1">{{ $kamar->tipe_kamar }}</p>
                    <h2 class="h5 fw-bold">Kamar {{ $kamar->nomor_kamar }}</h2>

                    <form class="hotel-promo-form" method="GET" action="{{ route('booking.create', $kamar) }}">
                        <input type="hidden" name="check_in" value="{{ $filters['check_in'] }}">
                        <input type="hidden" name="check_out" value="{{ $filters['check_out'] }}">
                        <input type="hidden" name="guests" value="{{ old('guest_count', $filters['guests']) }}">
                        <label class="form-label fw-semibold" for="promo_code">Punya kode promo?</label>
                        <div class="input-group">
                            <input class="form-control hotel-form-control" type="text" id="promo_code" name="promo_code"
                                value="{{ $filters['promo_code'] ?? '' }}" placeholder="Masukkan kode">
                            <button class="btn hotel-btn-outline" type="submit">Terapkan</button>
                        </div>
                        @error('promo_code')
                            <small class="text-danger d-block mt-1">{{ $message }}</small>
                        @enderror
                    </form>

                    <dl class="hotel-summary-list">
                        <div><dt>Check-in</dt><dd>{{ \Illuminate\Support\Carbon::parse($filters['check_in'])->format('d M Y') }}</dd></div>
                        <div><dt>Check-out</dt><dd>{{ \Illuminate\Support\Carbon::parse($filters['check_out'])->format('d M Y') }}</dd></div>
                        <div><dt>Jumlah tamu</dt><dd>{{ $filters['guests'] }} orang</dd></div>
                        <div><dt>Durasi</dt><dd>{{ $nights }} malam</dd></div>
                        <div><dt>Harga per malam</dt><dd>Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</dd></div>
                        <div><dt>Subtotal</dt><dd>Rp{{ number_format($subtotal, 0, ',', '.') }}</dd></div>
                        @if ($promo)
                            <div><dt>Promo {{ $promo->kode }} ({{ rtrim(rtrim(number_format($promo->diskon_persen, 2), '0'), '.') }}%)</dt><dd class="text-success">-Rp{{ number_format($discountAmount, 0, ',', '.') }}</dd></div>
                        @endif
                    </dl>

                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        <strong>Total pembayaran</strong>
                        <strong class="fs-5 text-danger">Rp{{ number_format($totalAmount, 0, ',', '.') }}</strong>
                    </div>
                </section>
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

    .hotel-payment-option {
        display: flex;
        align-items: flex-start;
        gap: .8rem;
        padding: 1rem;
        border: 1px solid #dfe8ed;
        border-radius: .75rem;
        cursor: pointer;
    }

    .hotel-payment-option:has(input:checked) {
        border-color: var(--hotel-coral);
        background: #fff8f6;
    }

    .hotel-payment-option input {
        margin-top: .25rem;
        accent-color: var(--hotel-coral);
    }

    .hotel-payment-option span {
        display: grid;
        gap: .25rem;
    }

    .hotel-payment-option small {
        color: var(--hotel-muted);
    }

    .hotel-summary-image {
        width: 100%;
        height: 170px;
        border-radius: .7rem;
        object-fit: cover;
    }

    .hotel-summary-list {
        display: grid;
        gap: .8rem;
        margin: 1.25rem 0;
    }

    .hotel-promo-form {
        margin-top: 1.2rem;
        padding: 1rem;
        border-radius: .75rem;
        background: #f5f8fa;
    }

    .hotel-summary-list div {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        font-size: .9rem;
    }

    .hotel-summary-list dt {
        color: var(--hotel-muted);
        font-weight: 500;
    }

    .hotel-summary-list dd {
        margin: 0;
        color: #243f50;
        font-weight: 700;
        text-align: right;
    }
</style>
