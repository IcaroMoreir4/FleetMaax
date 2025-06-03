<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caminhao extends Model
{
    use HasFactory;

    protected $table = 'caminhoes';

    protected $fillable = [
        'empresa_id',
        'implemento',
        'marca_modelo',
        'ano',
        'numero_chassi',
        'placa',
        'cor',
        'status',
        'motorista_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
