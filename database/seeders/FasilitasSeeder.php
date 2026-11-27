<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
    public function run(): void
    {
        $fasilitas = [
            ['nama' => 'Wi-Fi gratis', 'ikon' => 'WF', 'deskripsi' => 'Akses internet tersedia di area hotel dan kamar.'],
            ['nama' => 'Kolam renang', 'ikon' => 'PL', 'deskripsi' => 'Area kolam renang untuk bersantai selama menginap.'],
            ['nama' => 'Restoran', 'ikon' => 'RS', 'deskripsi' => 'Pilihan hidangan tersedia di area restoran hotel.'],
            ['nama' => 'Area parkir', 'ikon' => 'PK', 'deskripsi' => 'Area parkir tersedia untuk tamu hotel.'],
        ];

        foreach ($fasilitas as $item) {
            Fasilitas::firstOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
