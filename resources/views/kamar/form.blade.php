<x-anavbar />

@php
    $sedangEdit = $kamar !== null;
    $tipeKamarTerpilih = strtolower(trim(old('tipe_kamar', $kamar->tipe_kamar ?? '')));
@endphp

<div class="container py-4">
    <a href="{{ route('kamar.index', ['tab' => 'kamar']) }}" class="btn btn-outline-secondary mb-3">
        Kembali ke daftar kamar
    </a>

    <h1>{{ $sedangEdit ? 'Edit Kamar' : 'Tambah Kamar' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <p class="mb-1">Periksa kembali data berikut:</p>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($sedangEdit)
        <p>Nomor kamar: <strong>{{ $kamar->nomor_kamar }}</strong></p>
    @else
        <div class="alert alert-info">Nomor kamar akan dibuat otomatis saat disimpan.</div>
    @endif

    <form method="POST"
        action="{{ $sedangEdit ? route('kamar.update', $kamar) : route('kamar.store') }}">
        @csrf
        @if ($sedangEdit)
            @method('PUT')
        @endif

        <div class="row g-3">
            <div class="col-12 col-md-3">
                <label for="tipe_kamar" class="form-label">Tipe kamar</label>
                <select class="form-select" id="tipe_kamar" name="tipe_kamar" required>
                    <option value="">Pilih tipe kamar</option>
                    <option value="Standar" @selected($tipeKamarTerpilih === 'standar')>Standar</option>
                    <option value="Deluxe" @selected($tipeKamarTerpilih === 'deluxe')>Deluxe</option>
                    <option value="Suite" @selected($tipeKamarTerpilih === 'suite')>Suite</option>
                </select>
            </div>

            <div class="col-12 col-md-3">
                <label for="harga_per_malam" class="form-label">Harga per malam</label>
                <input type="number" class="form-control" id="harga_per_malam" name="harga_per_malam"
                    min="0" step="0.01" value="{{ old('harga_per_malam', $kamar->harga_per_malam ?? '') }}"
                    required>
            </div>

            <div class="col-12 col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="tersedia" @selected(old('status', $kamar->status ?? 'tersedia') === 'tersedia')>Available</option>
                    <option value="terisi" @selected(old('status', $kamar->status ?? '') === 'terisi')>Occupied</option>
                    <option value="cleaning" @selected(old('status', $kamar->status ?? '') === 'cleaning')>Cleaning</option>
                    <option value="maintenance" @selected(old('status', $kamar->status ?? '') === 'maintenance')>Maintenance</option>
                </select>
            </div>

            <div class="col-12 col-md-3">
                <label for="kapasitas" class="form-label">Kapasitas</label>
                <input type="number" class="form-control" id="kapasitas" name="kapasitas" min="1"
                    value="{{ old('kapasitas', $kamar->kapasitas ?? '') }}" required>
            </div>

            <div class="col-12">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $kamar->deskripsi ?? '') }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            {{ $sedangEdit ? 'Simpan Perubahan' : 'Simpan Kamar' }}
        </button>
    </form>
</div>
