<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProd extends Model
{
    protected $table = 'categoria_prod';

    public $timestamps = false;

    protected $fillable = [
        'nome',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'categoria_id');
    }
}