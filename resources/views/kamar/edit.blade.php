<x-anavbar />
@include('kamar._form_styles')

<main class="kamar-page">
    <div class="container py-4 py-lg-5">
        <a href="{{ route('kamar.index', ['tab' => 'kamar']) }}" class="kamar-back-link">
            <span aria-hidden="true">&larr;</span> Kembali ke daftar kamar
        </a>

        <div class="d-flex justify-content-between align-items-start gap-3 mb-4">
            <div>
                <p class="kamar-eyebrow">Kelola kamar / Edit</p>
                <h1 class="kamar-title">Edit kamar</h1>
                <p class="kamar-subtitle mb-0">Perbarui informasi kamar, lalu simpan perubahan.</p>
            </div>
            <span class="kamar-tag">Kamar #{{ $kamar->nomor_kamar }}</span>
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
                <form class="kamar-panel" method="POST" action="{{ route('kamar.update', $kamar) }}">
                    @csrf
                    @method('PUT')
                    <div class="kamar-panel-heading">
                        <span class="kamar-step">01</span>
                        <div>
                            <h2 class="kamar-panel-title">Informasi kamar</h2>
                            <p class="kamar-panel-caption">Perubahan akan diterapkan ke kamar ini.</p>
                        </div>
                    </div>

                    <div class="kamar-fields">
                        @include('kamar._fields')
                    </div>

                    <div class="kamar-form-actions">
                        <a href="{{ route('kamar.index', ['tab' => 'kamar']) }}"
                            class="btn btn-outline-secondary">Batal</a>
                        <button type="submit" class="btn kamar-submit">Simpan perubahan</button>
                    </div>
                </form>
            </div>

            <aside class="col-12 col-lg-4">
                <section class="kamar-info-panel">
                    <span class="kamar-info-label">Identitas kamar</span>
                    <h2>Nomor kamar</h2>
                    <span class="kamar-info-number">#{{ $kamar->nomor_kamar }}</span>
                    <p>Nomor kamar adalah identitas tetap dan tidak dapat diubah dari formulir ini.</p>
                </section>
            </aside>
        </div>
    </div>
</main>
