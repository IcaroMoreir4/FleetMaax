<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'origem',
        'destino',
        'data_saida',
        'data_chegada',
        'status',
        'motorista_id',
        'caminhao_id',
        'empresa_id'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }

    public function caminhao()
    {
        return $this->belongsTo(Caminhao::class);
    }
} 