<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caminhao extends Model
{
    use HasFactory;

    protected $table = 'caminhoes';

    protected $fillable = [
        'implemento',
        'marca_modelo',
        'ano',
        'numero_chassi',
        'placa',
        'cor',
        'nome_motorista',
        'motorista_id',
    ];

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }

}
