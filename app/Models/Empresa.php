<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Empresa extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'cnpj',
        'razaoSocial',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function motoristas()
    {
        return $this->hasMany(Motorista::class);
    }

    public function caminhoes()
    {
        return $this->hasMany(Caminhao::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
