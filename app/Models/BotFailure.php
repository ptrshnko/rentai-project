<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BotFailure extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'message_id',
        'reason',
        'details',
        'notified',
    ];

    protected function casts(): array
    {
        return [
            'details' => 'array',
            'notified' => 'boolean',
        ];
    }

    const UPDATED_AT = null;

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
