<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use App\Models\Route;
use App\Models\Caminhao;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $empresa_id = Auth::id();

        $dados = [
            'motoristas_ativos' => Motorista::where('empresa_id', $empresa_id)
                ->where('status', 'ativo')
                ->count(),
            'motoristas_em_rota' => Motorista::where('empresa_id', $empresa_id)
                ->whereHas('routes', function($query) {
                    $query->where('status', 'em_andamento');
                })->count(),
            'veiculos_livres' => Caminhao::where('empresa_id', $empresa_id)
                ->where('status', 'disponivel')
                ->count(),
            'motoristas_retornando' => Motorista::where('empresa_id', $empresa_id)
                ->whereHas('routes', function($query) {
                    $query->where('status', 'retornando');
                })->count(),
        ];

        return view('dashboard', $dados);
    }
} 