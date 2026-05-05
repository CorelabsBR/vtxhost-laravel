<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'mp_pagamento_id',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}   