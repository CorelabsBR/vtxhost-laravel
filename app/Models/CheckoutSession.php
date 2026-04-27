<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CheckoutSession extends Model
{
    protected $fillable = [
        'user_id',
        'token_hash',
        'cart_payload',
        'source',
        'expires_at',
        'used_at',
    ];

    protected $casts = [
        'cart_payload' => 'array',
        'expires_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}