<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use App\Models\Route;
use App\Models\Caminhao;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $empresa_id = Auth::id();

        // Obtém a data atual
        $hoje = Carbon::now();

        $dados = [
            // Estatísticas de motoristas
            'motoristas_ativos' => Motorista::where('empresa_id', $empresa_id)
                ->where('status', 'ativo')
                ->count(),
            'motoristas_em_rota' => Motorista::where('empresa_id', $empresa_id)
                ->where('status', 'em_rota')
                ->count(),
            'motoristas_retornando' => Motorista::where('empresa_id', $empresa_id)
                ->where('status', 'em_rota')
                ->whereHas('routes', function($query) {
                    $query->where('status', 'retornando');
                })->count(),
            'total_motoristas' => Motorista::where('empresa_id', $empresa_id)->count(),

            // Estatísticas de veículos
            'veiculos_livres' => Caminhao::where('empresa_id', $empresa_id)
                ->where('status', 'disponivel')
                ->count(),
            'veiculos_em_uso' => Caminhao::where('empresa_id', $empresa_id)
                ->where('status', 'em_uso')
                ->count(),
            'total_veiculos' => Caminhao::where('empresa_id', $empresa_id)->count(),

            // Estatísticas de rotas
            'rotas_hoje' => Route::whereHas('motorista', function($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })
            ->whereDate('data_saida', $hoje)
            ->count(),
            'rotas_em_andamento' => Route::whereHas('motorista', function($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })
            ->where('status', 'em_andamento')
            ->count(),
            'total_rotas' => Route::whereHas('motorista', function($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })->count(),
        ];

        return view('dashboard', $dados);
    }

    public function getData()
    {
        $empresa_id = Auth::id();
        $hoje = Carbon::now();

        $dados = [
            'motoristas_ativos' => Motorista::where('empresa_id', $empresa_id)
                ->where('status', 'ativo')
                ->count(),
            'motoristas_em_rota' => Motorista::where('empresa_id', $empresa_id)
                ->where('status', 'em_rota')
                ->count(),
            'motoristas_retornando' => Motorista::where('empresa_id', $empresa_id)
                ->where('status', 'em_rota')
                ->whereHas('routes', function($query) {
                    $query->where('status', 'retornando');
                })->count(),
            'total_motoristas' => Motorista::where('empresa_id', $empresa_id)->count(),
            'veiculos_livres' => Caminhao::where('empresa_id', $empresa_id)
                ->where('status', 'disponivel')
                ->count(),
            'veiculos_em_uso' => Caminhao::where('empresa_id', $empresa_id)
                ->where('status', 'em_uso')
                ->count(),
            'total_veiculos' => Caminhao::where('empresa_id', $empresa_id)->count(),
            'rotas_hoje' => Route::whereHas('motorista', function($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })
            ->whereDate('data_saida', $hoje)
            ->count(),
            'rotas_em_andamento' => Route::whereHas('motorista', function($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })
            ->where('status', 'em_andamento')
            ->count(),
            'total_rotas' => Route::whereHas('motorista', function($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })->count(),
        ];

        return response()->json($dados);
    }
} 