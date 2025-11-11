<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'start_date',
        'end_date',
        'status',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'meta' => 'array',
        ];
    }

    const UPDATED_AT = null;

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
