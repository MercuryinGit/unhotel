<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    protected $fillable = [
        'nomor_kamar',
        'tipe_kamar',
        'harga_per_malam',
        'kapasitas',
        'status',
        'deskripsi',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeAvailableBetween(Builder $query, string $checkIn, string $checkOut): Builder
    {
        return $query->where('status', 'tersedia')
            ->whereDoesntHave('bookings', function (Builder $bookings) use ($checkIn, $checkOut) {
                $bookings->whereIn('status', ['pending', 'confirmed'])
                    ->whereDate('check_in', '<', $checkOut)
                    ->whereDate('check_out', '>', $checkIn);
            });
    }

    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'tersedia' => 'Tersedia',
            'terisi' => 'Terisi',
            'cleaning' => 'Sedang dibersihkan',
            'maintenance' => 'Perbaikan',
        ];

        return $labels[$this->status] ?? ucfirst($this->status);
    }
}
