<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    const CREATED_AT = 'criado_em';
    const UPDATED_AT = 'atualizado_em';

protected $fillable = [
<<<<<<< HEAD
    'nome',
    'email',
    'senha',
    'cpf_cnpj',
    'celular',
=======
    'name',
    'email',
    'password',
    'cpf_cnpj',
    'celular',
    'data_nasc',
>>>>>>> e9adfd2 (feat: atualizações do vortex hosting)
    'cep',
    'rua',
    'numero',
    'complemento',
    'bairro',
    'cidade',
    'estado',
    'pais',
<<<<<<< HEAD
    'data_nasc',
    'tipo_usuario',
    'google_id',
    'discord_id',
    'avatar',
    'provider',
    'email_verified_at',
];

protected $hidden = [
    'senha',
=======
    'profile_completed_at',
>>>>>>> e9adfd2 (feat: atualizações do vortex hosting)
];

protected $casts = [
    'email_verified_at' => 'datetime',
<<<<<<< HEAD
    'data_nasc' => 'date',
=======
    'profile_completed_at' => 'datetime',
    'data_nasc' => 'date',
    'password' => 'hashed',
>>>>>>> e9adfd2 (feat: atualizações do vortex hosting)
];

public function getAuthPassword()
{
    return $this->senha;
}
<<<<<<< HEAD
=======
}
public function hasCompletedProfile(): bool
{
    return !is_null($this->profile_completed_at);
>>>>>>> e9adfd2 (feat: atualizações do vortex hosting)
}