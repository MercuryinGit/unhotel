<x-navbar></x-navbar>
<div class="bg-primary">
    <div class="container p-3">
        <p class="fw-bold text-white-50 font-sans">MENGINAP NYAMAN, CERITA BERKESAN</p>
        @auth
            @if (in_array(auth()->user()->role, ['admin', 'super_admin'], true))
                <span class="badge text-bg-danger me-2 fw-bold text-white font-sans">
                    Kamu {{ auth()->user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}
                </span>
            @endif
        @endauth
        <br>
        @auth
            <span class="navbar-text me-3 fw-bold text-white font-sans">
                Halo, {{ auth()->user()->name }}
            </span>
        @endauth
        <h1 class="text-white">Temukan & Pesan Hotel Impianmu dengan Harga Terbaik</h1>
        <p class="text-white">Pilihan penginapan lengkap mulai dari hotel berbintang hingga vila nyaman di seluruh
            indonesia</p>
        <div class="card text-start">
            <div class="card-body">
                <h4 class="card-title">Rencanakan Masa Menginap anda</h4>
                <div class="container">
                    <form method="GET">
                        <div class="row row-cols-1 g-3 justify-content-evenly">
                            <div class="col-10 col-sm-5 col-lg-2">
                                <label for="" class="form-label text-black-50">Tanggal Check-In</label>
                                <input type="date" class="form-control" name="" id="" aria-describedby="helpId"
                                    placeholder="" />
                            </div>
                            <div class="col-10 col-sm-5 col-lg-2">
                                <label for="" class="form-label text-black-50">Tanggal Check-Out</label>
                                <input type="date" class="form-control" name="" id="" aria-describedby="helpId"
                                    placeholder="" />
                            </div>
                            <div class="col-10 col-sm-5 col-lg-2">
                                <label for="" class="form-label text-black-50">Jumlah Tamu</label>
                                <input type="number" class="form-control" name="" id="" aria-describedby="helpId"
                                    placeholder="" />
                            </div>
                            <div class="col-10 col-sm-5 col-lg-2">
                                <label for="" class="form-label text-black-50">Jumlah Kamar</label>
                                <input type="number" class="form-control" name="" id="" aria-describedby="helpId"
                                    placeholder="" />
                            </div>
                            <div class="col-10 col-sm-5 col-lg-2 d-grid">
                                <button type="submit" class="btn bg-info text-white fw-bold">Cek Ketersediaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
