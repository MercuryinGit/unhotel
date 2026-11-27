<x-anavbar />

<main class="admin-page py-4 py-lg-5">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <p class="admin-eyebrow mb-2">Konten hotel</p>
                <h1 class="admin-title mb-1">Fasilitas</h1>
                <p class="admin-muted mb-0">Kelola fasilitas yang ditampilkan kepada tamu.</p>
            </div>
            <a class="btn admin-primary" href="{{ route('admin.fasilitas.create') }}">Tambah fasilitas</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-3">
            @forelse ($fasilitas as $facility)
                <div class="col-12 col-md-6 col-xl-4">
                    <article class="admin-content-card h-100">
                        <div class="d-flex justify-content-between align-items-start gap-2">
                            <span class="admin-facility-icon">{{ $facility->ikon }}</span>
                            <span class="admin-content-status {{ $facility->aktif ? 'is-active' : '' }}">
                                {{ $facility->aktif ? 'Aktif' : 'Disembunyikan' }}
                            </span>
                        </div>
                        <h2 class="h5 fw-bold mt-3">{{ $facility->nama }}</h2>
                        <p class="admin-muted">{{ $facility->deskripsi }}</p>
                        <div class="d-flex gap-2 mt-auto">
                            <a class="btn btn-sm admin-outline" href="{{ route('admin.fasilitas.edit', $facility) }}">Edit</a>
                            <form method="POST" action="{{ route('admin.fasilitas.destroy', $facility) }}"
                                onsubmit="return confirm('Hapus fasilitas {{ $facility->nama }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                            </form>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12"><div class="admin-panel p-5 text-center admin-muted">Belum ada fasilitas.</div></div>
            @endforelse
        </div>

        <div class="mt-4">{{ $fasilitas->links() }}</div>
    </div>
</main>

<style>
    .admin-content-card { display: flex; flex-direction: column; padding: 1.3rem; border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
    .admin-facility-icon { display: inline-grid; width: 2.8rem; height: 2.8rem; place-items: center; border-radius: .75rem; background: #eaf2f6; color: #103f55; font-size: .8rem; font-weight: 800; }
    .admin-content-status { padding: .35rem .65rem; border-radius: 999px; background: #f0f2f4; color: #667984; font-size: .72rem; font-weight: 700; }
    .admin-content-status.is-active { background: #e7f5ef; color: #247650; }
    .admin-panel { border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
</style>
