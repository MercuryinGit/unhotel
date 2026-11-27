<x-anavbar />

@php
    $tabKamarAktif = request('tab') === 'kamar' || $errors->any();
@endphp

<div class="container-fluid">
    <div class="row">
        {{-- Menu untuk berpindah bagian admin --}}
        <aside class="col-12 col-md-3 col-lg-2 bg-light border-end min-vh-100 p-3">
            <h5>Menu Operasional</h5>

            <div class="nav nav-pills flex-column gap-1" role="tablist">
                <button class="nav-link {{ $tabKamarAktif ? '' : 'active' }} text-start" id="dashboard-tab"
                    data-bs-toggle="pill"
                    data-bs-target="#dashboard-panel" type="button" role="tab" aria-controls="dashboard-panel"
                    aria-selected="{{ $tabKamarAktif ? 'false' : 'true' }}">
                    Dashboard
                </button>

                <button class="nav-link {{ $tabKamarAktif ? 'active' : '' }} text-start" id="kamar-tab"
                    data-bs-toggle="pill" data-bs-target="#kamar-panel" type="button" role="tab"
                    aria-controls="kamar-panel" aria-selected="{{ $tabKamarAktif ? 'true' : 'false' }}">
                    Kelola Kamar
                </button>
            </div>
        </aside>

        <main class="col">
            <div class="tab-content">
                {{-- Isi setiap tab --}}
                <section class="tab-pane fade {{ $tabKamarAktif ? '' : 'show active' }}" id="dashboard-panel">
                    <h1>Dashboard Admin</h1>
                    <p>Konten dashboard di sini.</p>
                </section>

                <section class="tab-pane fade {{ $tabKamarAktif ? 'show active' : '' }}" id="kamar-panel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="mb-0">Kelola Kamar</h1>
                        <a class="btn btn-primary" href="{{ route('kamar.create') }}">
                            Tambah Kamar
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Kartu untuk setiap kamar --}}
                    <div class="row g-3">
                        @forelse ($kamars as $kamar)
                            <div class="col-12 col-sm-6 col-xl-4">
                                <a class="text-decoration-none text-reset" href="{{ route('kamar.edit', $kamar) }}">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold">{{ $kamar->nomor_kamar }}</h5>
                                            <p class="text-muted">{{ $kamar->tipe_kamar }}</p>
                                            <p class="fw-bold text-primary">{{ $kamar->status_label }}</p>

                                            @if ($kamar->deskripsi)
                                                <p class="card-text">{{ $kamar->deskripsi }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <p>Belum ada data kamar.</p>
                            </div>
                        @endforelse
                    </div>

                </section>
            </div>
        </main>
    </div>
</div>

