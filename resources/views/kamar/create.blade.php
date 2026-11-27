<x-anavbar />
@include('kamar._form_styles')

<main class="kamar-page">
    <div class="container py-4 py-lg-5">
        <a href="{{ route('kamar.index', ['tab' => 'kamar']) }}" class="kamar-back-link">
            <span aria-hidden="true">&larr;</span> Kembali ke daftar kamar
        </a>

        <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
            <div>
                <p class="kamar-eyebrow">Kelola kamar / Tambah</p>
                <h1 class="kamar-title">Tambah kamar</h1>
                <p class="kamar-subtitle mb-0">Lengkapi informasi kamar yang akan ditambahkan.</p>
            </div>
            <span class="kamar-tag">Kamar baru</span>
        </div>

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

        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-8">
                <form class="kamar-panel" method="POST" action="{{ route('kamar.store') }}">
                    @csrf
                    <div class="kamar-panel-heading">
                        <span class="kamar-step">01</span>
                        <div>
                            <h2 class="kamar-panel-title">Informasi kamar</h2>
                            <p class="kamar-panel-caption">Isi detail utama kamar dengan benar.</p>
                        </div>
                    </div>

                    <div class="kamar-fields">
                        @include('kamar._fields', ['kamar' => null])
                    </div>

                    <div class="kamar-form-actions">
                        <a href="{{ route('kamar.index', ['tab' => 'kamar']) }}"
                            class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn kamar-submit">Simpan kamar</button>
                    </div>
                </form>
            </div>

            <aside class="col-12 col-lg-4">
                <section class="kamar-info-panel">
                    <span class="kamar-info-label">Informasi</span>
                    <h2>Nomor kamar otomatis</h2>
                    <span class="kamar-info-number">Dibuat saat disimpan</span>
                    <p>Nomor kamar akan mengikuti nomor terakhir yang tersedia, jadi tidak perlu diisi manual.</p>
                </section>
            </aside>
        </div>
    </div>
</main>
