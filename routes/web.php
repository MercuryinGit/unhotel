<?php

use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\Promo;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredRooms = Kamar::query()
        ->where('status', 'tersedia')
        ->orderBy('harga_per_malam')
        ->limit(3)
        ->get();
    $featuredFacilities = Fasilitas::query()
        ->where('aktif', true)
        ->orderBy('nama')
        ->limit(4)
        ->get();
    $activePromos = Promo::query()
        ->active()
        ->orderBy('berakhir_pada')
        ->limit(2)
        ->get();

    return view('dashboard', compact('featuredRooms', 'featuredFacilities', 'activePromos'));
})->name('home');

Route::get('/dashboard', function () {
    if (in_array(auth()->user()->role, ['admin', 'super_admin'], true)) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home');
})->middleware('auth')->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cari-kamar', [BookingController::class, 'search'])->name('rooms.search');
Route::get('/kamar/{kamar}/detail', [BookingController::class, 'showRoom'])->name('rooms.show');
Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('facilities.index');
Route::get('/promo', [PromoController::class, 'index'])->name('promos.index');
Route::view('/lokasi', 'location.index')->name('location.show');

Route::middleware('auth')->group(function () {
    Route::get('/kamar/{kamar}/pesan', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/kamar/{kamar}/pesan', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/pemesanan', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/pemesanan/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/pemesanan/{booking}/batal', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminBookingController::class, 'dashboard'])->name('dashboard');
    Route::get('/pemesanan', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::patch('/pemesanan/{booking}', [AdminBookingController::class, 'update'])->name('bookings.update');
    Route::get('/fasilitas', [FasilitasController::class, 'adminIndex'])->name('fasilitas.index');
    Route::resource('fasilitas', FasilitasController::class)
        ->except(['index', 'show'])
        ->parameters(['fasilitas' => 'fasilitas']);
    Route::get('/promos', [PromoController::class, 'adminIndex'])->name('promos.index');
    Route::resource('promos', PromoController::class)->except(['index', 'show']);
});

Route::middleware(['auth', 'role:admin,super_admin'])->group(function () {
    Route::resource('kamar', KamarController::class)->except(['show']);
});
