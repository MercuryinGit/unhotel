<x-unavbar />

<main class="hotel-page py-5">
    <div class="container">
        <p class="hotel-eyebrow mb-2">Kenyamanan ekstra</p>
        <h1 class="hotel-section-title mb-2">Fasilitas hotel</h1>
        <p class="hotel-muted mb-4">Lihat fasilitas yang tersedia untuk mendukung masa menginapmu.</p>

        <div class="row g-3">
            @forelse ($fasilitas as $facility)
                <div class="col-12 col-sm-6 col-lg-4">
                    <article class="hotel-card p-4 h-100">
                        <span class="facility-icon">{{ $facility->ikon }}</span>
                        <h2 class="h5 fw-bold mt-3">{{ $facility->nama }}</h2>
                        <p class="hotel-muted mb-0">{{ $facility->deskripsi }}</p>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="hotel-card p-5 text-center">
                        <h2 class="h5 fw-bold">Informasi fasilitas belum tersedia</h2>
                        <p class="hotel-muted mb-0">Silakan hubungi pengelola untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="hotel-card p-4 mt-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <h2 class="h5 fw-bold mb-1">Siap memilih kamar?</h2>
                <p class="hotel-muted mb-0">Periksa kamar yang tersedia untuk tanggal perjalananmu.</p>
            </div>
            <a href="{{ route('rooms.search') }}" class="btn hotel-btn-primary">Cari kamar</a>
        </div>
    </div>
</main>

<style>
    .facility-icon {
        display: inline-grid;
        width: 3rem;
        height: 3rem;
        place-items: center;
        border-radius: .8rem;
        background: #eaf2f6;
        color: var(--hotel-navy);
        font-size: .85rem;
        font-weight: 800;
    }
</style>
