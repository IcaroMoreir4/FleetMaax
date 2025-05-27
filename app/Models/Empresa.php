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

}
