<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'cnh',
        'telefone',
        'empresa_id',
        'status'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_admissao' => 'date',
        'ativo' => 'boolean',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function caminhoes()
    {
        return $this->hasMany(Caminhao::class);
    }
}
