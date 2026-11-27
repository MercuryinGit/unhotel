<x-anavbar />

@php
    $sedangEdit = $fasilitas !== null;
@endphp

<main class="admin-page py-4 py-lg-5">
    <div class="container" style="max-width: 860px">
        <a class="admin-back-link" href="{{ route('admin.fasilitas.index') }}">&larr; Kembali ke fasilitas</a>
        <div class="my-4">
            <p class="admin-eyebrow mb-2">Konten hotel</p>
            <h1 class="admin-title mb-1">{{ $sedangEdit ? 'Edit fasilitas' : 'Tambah fasilitas' }}</h1>
            <p class="admin-muted mb-0">Informasi ini tampil pada halaman fasilitas untuk tamu.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form class="admin-panel p-4 p-lg-5" method="POST"
            action="{{ $sedangEdit ? route('admin.fasilitas.update', $fasilitas) : route('admin.fasilitas.store') }}">
            @csrf
            @if ($sedangEdit)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold" for="nama">Nama fasilitas</label>
                <input class="form-control" id="nama" name="nama" value="{{ old('nama', $fasilitas->nama ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="ikon">Kode ikon singkat</label>
                <input class="form-control" id="ikon" name="ikon" maxlength="20"
                    value="{{ old('ikon', $fasilitas->ikon ?? '') }}" placeholder="Misalnya: WF" required>
                <div class="form-text">Gunakan singkatan pendek yang mudah dikenali.</div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $fasilitas->deskripsi ?? '') }}</textarea>
            </div>
            <input type="hidden" name="aktif" value="0">
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="aktif" name="aktif" value="1"
                    @checked(old('aktif', $fasilitas->aktif ?? true))>
                <label class="form-check-label" for="aktif">Tampilkan sebagai fasilitas aktif</label>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a class="btn admin-outline" href="{{ route('admin.fasilitas.index') }}">Batal</a>
                <button class="btn admin-primary" type="submit">{{ $sedangEdit ? 'Simpan perubahan' : 'Tambah fasilitas' }}</button>
            </div>
        </form>
    </div>
</main>

<style>
    .admin-back-link { color: #31596d; font-size: .9rem; font-weight: 700; text-decoration: none; }
    .admin-panel { border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
</style>
