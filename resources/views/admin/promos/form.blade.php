<x-anavbar />

@php
    $sedangEdit = $promo !== null;
@endphp

<main class="admin-page py-4 py-lg-5">
    <div class="container" style="max-width: 860px">
        <a class="admin-back-link" href="{{ route('admin.promos.index') }}">&larr; Kembali ke promo</a>
        <div class="my-4">
            <p class="admin-eyebrow mb-2">Konten hotel</p>
            <h1 class="admin-title mb-1">{{ $sedangEdit ? 'Edit promo' : 'Tambah promo' }}</h1>
            <p class="admin-muted mb-0">Kode promo aktif dapat digunakan tamu saat checkout.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form class="admin-panel p-4 p-lg-5" method="POST"
            action="{{ $sedangEdit ? route('admin.promos.update', $promo) : route('admin.promos.store') }}">
            @csrf
            @if ($sedangEdit)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label fw-semibold" for="judul">Judul promo</label>
                <input class="form-control" id="judul" name="judul" value="{{ old('judul', $promo->judul ?? '') }}" required>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold" for="kode">Kode promo</label>
                    <input class="form-control text-uppercase" id="kode" name="kode" maxlength="30"
                        value="{{ old('kode', $promo->kode ?? '') }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold" for="diskon_persen">Diskon (%)</label>
                    <input class="form-control" type="number" id="diskon_persen" name="diskon_persen"
                        min="0.01" max="100" step="0.01" value="{{ old('diskon_persen', $promo->diskon_persen ?? '') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold" for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $promo->deskripsi ?? '') }}</textarea>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold" for="mulai_pada">Mulai berlaku</label>
                    <input class="form-control" type="date" id="mulai_pada" name="mulai_pada"
                        value="{{ old('mulai_pada', $promo?->mulai_pada?->format('Y-m-d') ?? now()->toDateString()) }}" required>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label fw-semibold" for="berakhir_pada">Berakhir</label>
                    <input class="form-control" type="date" id="berakhir_pada" name="berakhir_pada"
                        value="{{ old('berakhir_pada', $promo?->berakhir_pada?->format('Y-m-d') ?? now()->addDays(30)->toDateString()) }}" required>
                </div>
            </div>
            <input type="hidden" name="aktif" value="0">
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="aktif" name="aktif" value="1"
                    @checked(old('aktif', $promo->aktif ?? true))>
                <label class="form-check-label" for="aktif">Aktifkan promo</label>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a class="btn admin-outline" href="{{ route('admin.promos.index') }}">Batal</a>
                <button class="btn admin-primary" type="submit">{{ $sedangEdit ? 'Simpan perubahan' : 'Tambah promo' }}</button>
            </div>
        </form>
    </div>
</main>

<style>
    .admin-back-link { color: #31596d; font-size: .9rem; font-weight: 700; text-decoration: none; }
    .admin-panel { border: 1px solid #e1e9ee; border-radius: .9rem; background: #fff; }
</style>
