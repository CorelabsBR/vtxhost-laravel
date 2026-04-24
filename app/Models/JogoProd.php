<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JogoProd extends Model
{
    protected $table = 'jogos_prod';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'slug',
        'banner',
        'icon',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class, 'jogo_id');
    }
}