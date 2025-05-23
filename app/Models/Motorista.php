<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_completo',
        'cpf',
        'cnh',
        'data_nascimento',
        'email',
        'telefone',
        'data_admissao',
        'ativo',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_admissao' => 'date',
        'ativo' => 'boolean',
    ];

    public function caminhoes()
    {
        return $this->hasMany(Caminhao::class);
    }
}
