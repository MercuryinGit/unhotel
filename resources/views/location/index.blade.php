<x-unavbar />

<main class="hotel-page py-5">
    <div class="container">
        <p class="hotel-eyebrow mb-2">Temukan kami</p>
        <h1 class="hotel-section-title mb-2">Lokasi hotel</h1>
        <p class="hotel-muted mb-4">Informasi lokasi membantu merencanakan perjalanan sebelum check-in.</p>

        <div class="row g-4 align-items-stretch">
            <div class="col-12 col-lg-7">
                <div class="location-map-placeholder">
                    <div class="location-map-pin">U</div>
                    <strong>Peta lokasi</strong>
                    <span>Alamat hotel belum dikonfigurasi.</span>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <section class="hotel-card p-4 p-lg-5 h-100">
                    <span class="hotel-eyebrow">UntitledStay</span>
                    <h2 class="h4 fw-bold mt-2">Informasi alamat</h2>
                    @if (config('hotel.address'))
                        <p class="hotel-muted">{{ config('hotel.address') }}</p>
                        @if (config('hotel.map_url'))
                            <a class="btn hotel-btn-primary" href="{{ config('hotel.map_url') }}" target="_blank" rel="noopener noreferrer">
                                Buka petunjuk arah
                            </a>
                        @endif
                    @else
                        <p class="hotel-muted">Pengelola belum mengatur alamat untuk ditampilkan. Silakan konfirmasi lokasi langsung dengan pihak hotel sebelum berangkat.</p>
                    @endif
                    <hr class="my-4">
                    <p class="small hotel-muted mb-0">Waktu check-in dan check-out dapat dilihat pada detail pemesanan setelah reservasi dibuat.</p>
                </section>
            </div>
        </div>
    </div>
</main>

<style>
    .location-map-placeholder {
        display: grid;
        min-height: 360px;
        place-content: center;
        justify-items: center;
        gap: .75rem;
        border: 1px solid #dfe8ed;
        border-radius: 1rem;
        background:
            linear-gradient(45deg, rgb(255 255 255 / 55%) 25%, transparent 25%, transparent 75%, rgb(255 255 255 / 55%) 75%),
            linear-gradient(45deg, rgb(255 255 255 / 55%) 25%, transparent 25%, transparent 75%, rgb(255 255 255 / 55%) 75%),
            #eaf1f4;
        background-position: 0 0, 18px 18px;
        background-size: 36px 36px;
        color: #657f8e;
        text-align: center;
    }

    .location-map-pin {
        display: grid;
        width: 3rem;
        height: 3rem;
        place-items: center;
        border-radius: 50%;
        background: #e8523b;
        color: #fff;
        font-weight: 800;
    }
</style>
