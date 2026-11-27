<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run(): void
    {
        $kamars = [
            ['nomor_kamar' => '101', 'tipe_kamar' => 'Standar', 'harga_per_malam' => 450000, 'kapasitas' => 2, 'status' => 'tersedia', 'deskripsi' => 'Kamar nyaman untuk perjalanan singkat dengan suasana yang tenang.'],
            ['nomor_kamar' => '102', 'tipe_kamar' => 'Standar', 'harga_per_malam' => 450000, 'kapasitas' => 2, 'status' => 'tersedia', 'deskripsi' => 'Pilihan praktis dengan ruang istirahat yang hangat dan nyaman.'],
            ['nomor_kamar' => '201', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 750000, 'kapasitas' => 3, 'status' => 'tersedia', 'deskripsi' => 'Ruang lebih luas untuk menikmati waktu bersama keluarga.'],
            ['nomor_kamar' => '202', 'tipe_kamar' => 'Deluxe', 'harga_per_malam' => 750000, 'kapasitas' => 3, 'status' => 'tersedia', 'deskripsi' => 'Kamar deluxe dengan suasana santai dan fasilitas lengkap.'],
            ['nomor_kamar' => '301', 'tipe_kamar' => 'Suite', 'harga_per_malam' => 1200000, 'kapasitas' => 4, 'status' => 'tersedia', 'deskripsi' => 'Pilihan suite yang lapang untuk pengalaman menginap istimewa.'],
        ];

        foreach ($kamars as $kamar) {
            Kamar::firstOrCreate(
                ['nomor_kamar' => $kamar['nomor_kamar']],
                $kamar
            );
        }
    }
}
