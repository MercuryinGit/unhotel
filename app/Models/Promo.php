<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promo extends Model
{
    protected $fillable = [
        'judul',
        'kode',
        'deskripsi',
        'diskon_persen',
        'mulai_pada',
        'berakhir_pada',
        'aktif',
    ];

    protected function casts(): array
    {
        return [
            'diskon_persen' => 'decimal:2',
            'mulai_pada' => 'date',
            'berakhir_pada' => 'date',
            'aktif' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query, ?string $date = null): Builder
    {
        $date ??= now()->toDateString();

        return $query->where('aktif', true)
            ->whereDate('mulai_pada', '<=', $date)
            ->whereDate('berakhir_pada', '>=', $date);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function discountFor(float $amount): float
    {
        return round($amount * (float) $this->diskon_persen / 100, 2);
    }
}
