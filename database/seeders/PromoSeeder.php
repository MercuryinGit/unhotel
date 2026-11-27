<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        Promo::firstOrCreate(
            ['kode' => 'STAY10'],
            [
                'judul' => 'Hemat 10% untuk pemesanan langsung',
                'deskripsi' => 'Masukkan kode promo saat checkout untuk mendapatkan potongan harga kamar.',
                'diskon_persen' => 10,
                'mulai_pada' => now()->toDateString(),
                'berakhir_pada' => now()->addDays(30)->toDateString(),
                'aktif' => true,
            ]
        );
    }
}
