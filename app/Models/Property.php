<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'address',
        'city',
        'price_per_night',
        'max_guests',
        'beds',
        'description',
        'attrs',
    ];

    protected function casts(): array
    {
        return [
            'attrs' => 'array',
            'price_per_night' => 'decimal:2',
        ];
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PropertyPhoto::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'property_amenities')
            ->withPivot([])
            ->withTimestamps(false);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Scope to find properties available between dates
     */
    public function scopeAvailableBetween($query, Carbon|string $start, Carbon|string $end)
    {
        $start = \Carbon\Carbon::parse($start)->toDateString();
        $end = \Carbon\Carbon::parse($end)->toDateString();

        return $query->whereDoesntHave('bookings', function($q) use ($start, $end) {
            $q->where(function($qq) use ($start, $end) {
                $qq->where('start_date', '<=', $end)
                   ->where('end_date', '>=', $start)
                   ->whereIn('status', ['reserved', 'confirmed', 'blocked']);
            });
        });
    }
}
