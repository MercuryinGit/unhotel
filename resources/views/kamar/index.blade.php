<x-anavbar />

@php
    $showKamar = request('tab') === 'kamar' || $errors->any();
@endphp

<div class="container-fluid">
    <div class="row">
        <aside class="col-12 col-md-3 col-lg-2 bg-light border-end min-vh-100 p-3">
            <h5>Menu Operasional</h5>

            <div class="nav nav-pills flex-column gap-1" role="tablist">
                <button class="nav-link {{ $showKamar ? '' : 'active' }} text-start" id="dashboard-tab" data-bs-toggle="pill"
                    data-bs-target="#dashboard-panel" type="button" role="tab" aria-controls="dashboard-panel"
                    aria-selected="{{ $showKamar ? 'false' : 'true' }}">
                    Dashboard
                </button>

                <button class="nav-link {{ $showKamar ? 'active' : '' }} text-start" id="kamar-tab" data-bs-toggle="pill" data-bs-target="#kamar-panel" type="button"
                    role="tab" aria-controls="kamar-panel" aria-selected="{{ $showKamar ? 'true' : 'false' }}">
                    Kelola Kamar
                </button>
            </div>
        </aside>

        <main class="col">
            <div class="tab-content">
                <section class="tab-pane fade {{ $showKamar ? '' : 'show active' }}" id="dashboard-panel">
                    <h1>Dashboard Admin</h1>
                    <p>Konten dashboard di sini.</p>
                </section>

                <section class="tab-pane fade {{ $showKamar ? 'show active' : '' }}" id="kamar-panel">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="mb-0">Kelola Kamar</h1>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createKamarModal">
                            Tambah Kamar
                        </button>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="row g-3">
                        @forelse ($kamars as $kamar)
                            <div class="col-12 col-sm-6 col-xl-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $kamar->nomor_kamar }}</h5>
                                        <p class="text-muted">{{ $kamar->tipe_kamar }}</p>
                                        <p class="fw-bold text-primary">{{ $kamar->status }}</p>

                                        @if ($kamar->deskripsi)
                                            <p class="card-text">{{ $kamar->deskripsi }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p>Belum ada data kamar.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="modal fade" id="createKamarModal" tabindex="-1"
                        aria-labelledby="createKamarModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('kamar.store') }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h2 class="modal-title fs-5" id="createKamarModalLabel">Tambah Kamar</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="alert alert-info">
                                            Nomor kamar akan dibuat otomatis saat kamar disimpan.
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-12 col-md-3">
                                                <label for="tipe_kamar" class="form-label">Tipe kamar</label>
                                                <select class="form-select @error('tipe_kamar') is-invalid @enderror"
                                                    id="tipe_kamar" name="tipe_kamar" required>
                                                    <option value="">Pilih tipe kamar</option>
                                                    <option value="Standar" @selected(old('tipe_kamar') === 'Standar')>Standar</option>
                                                    <option value="Deluxe" @selected(old('tipe_kamar') === 'Deluxe')>Deluxe</option>
                                                    <option value="Suite" @selected(old('tipe_kamar') === 'Suite')>Suite</option>
                                                </select>
                                                @error('tipe_kamar')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label for="harga_per_malam" class="form-label">Harga per malam</label>
                                                <input type="number" class="form-control @error('harga_per_malam') is-invalid @enderror"
                                                    id="harga_per_malam" name="harga_per_malam" min="0" step="0.01"
                                                    value="{{ old('harga_per_malam') }}" required>
                                                @error('harga_per_malam')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select @error('status') is-invalid @enderror"
                                                    id="status" name="status" required>
                                                    <option value="tersedia" @selected(old('status', 'tersedia') === 'tersedia')>Tersedia</option>
                                                    <option value="terisi" @selected(old('status') === 'terisi')>Terisi</option>
                                                    <option value="maintenance" @selected(old('status') === 'maintenance')>Maintenance</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                                <input type="number" class="form-control @error('kapasitas') is-invalid @enderror"
                                                    id="kapasitas" name="kapasitas" min="1" value="{{ old('kapasitas') }}" required>
                                                @error('kapasitas')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                                    id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                                @error('deskripsi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Kamar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</div>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            bootstrap.Modal.getOrCreateInstance(document.querySelector('#createKamarModal')).show();
        });
    </script>
@endif
