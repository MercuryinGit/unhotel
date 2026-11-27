<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
         'nomor_kamar',
        'tipe_kamar',
        'harga_per_malam',
        'kapasitas',
        'status',
        'deskripsi'
    ];

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'tersedia' => 'Available',
            'terisi' => 'Occupied',
            'cleaning' => 'Cleaning',
            'maintenance' => 'Maintenance',
        ];

        return $labels[$this->status] ?? ucfirst($this->status);
    }
}
