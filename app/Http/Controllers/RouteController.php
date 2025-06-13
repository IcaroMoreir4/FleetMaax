<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Motorista;
use App\Models\Caminhao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    public function index()
    {
        $empresa_id = Auth::id();
        
        $routes = Route::with(['motorista', 'caminhao'])
            ->whereHas('motorista', function($query) use ($empresa_id) {
                $query->where('empresa_id', $empresa_id);
            })
            ->get();
            
        $motoristas = Motorista::where('empresa_id', $empresa_id)
            ->where('status', 'ativo')
            ->get();
            
        $caminhoes = Caminhao::where('empresa_id', $empresa_id)
            ->where(function($query) {
                $query->where('status', 'disponivel')
                    ->orWhere('status', 'em_uso');
            })
            ->get();
            
        return view('routes.index', compact('routes', 'motoristas', 'caminhoes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'origem' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'data_saida' => 'required|date',
            'data_chegada' => 'required|date|after:data_saida',
            'motorista_id' => 'required|exists:motoristas,id',
            'caminhao_id' => 'required|exists:caminhoes,id',
        ]);

        // Verifica se o motorista e o caminhão pertencem à empresa
        $empresa_id = Auth::id();
        $motorista = Motorista::where('empresa_id', $empresa_id)
            ->where('id', $validated['motorista_id'])
            ->first();
            
        $caminhao = Caminhao::where('empresa_id', $empresa_id)
            ->where('id', $validated['caminhao_id'])
            ->first();

        if (!$motorista || !$caminhao) {
            return back()->withErrors(['error' => 'Motorista ou caminhão inválido.']);
        }

        // Define o status inicial como pendente
        $validated['status'] = 'pendente';

        try {
            Route::create($validated);
            
            // Atualiza o status do caminhão para em_uso
            $caminhao->update(['status' => 'em_uso']);
            
            // Atualiza o status do motorista para em_rota
            $motorista->update(['status' => 'em_rota']);

            return redirect()->route('routes.index')
                ->with('success', 'Rota cadastrada com sucesso!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Erro ao cadastrar rota. ' . $e->getMessage()]);
        }
    }

    public function show(Route $route)
    {
        // Verifica se a rota pertence à empresa
        if ($route->motorista->empresa_id !== Auth::id()) {
            abort(403);
        }

        return response()->json($route->load(['motorista', 'caminhao']));
    }

    public function update(Request $request, Route $route)
    {
        // Verifica se a rota pertence à empresa
        if ($route->motorista->empresa_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'origem' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'data_saida' => 'required|date',
            'data_chegada' => 'required|date|after:data_saida',
            'motorista_id' => 'required|exists:motoristas,id',
            'caminhao_id' => 'required|exists:caminhoes,id',
            'status' => 'required|in:pendente,em_andamento,retornando,finalizada',
        ]);

        // Verifica se o motorista e o caminhão pertencem à empresa
        $empresa_id = Auth::id();
        $motorista = Motorista::where('empresa_id', $empresa_id)
            ->where('id', $validated['motorista_id'])
            ->first();
            
        $caminhao = Caminhao::where('empresa_id', $empresa_id)
            ->where('id', $validated['caminhao_id'])
            ->first();

        if (!$motorista || !$caminhao) {
            return back()->withErrors(['error' => 'Motorista ou caminhão inválido.']);
        }

        try {
            // Se a rota foi finalizada, libera o caminhão
            if ($validated['status'] === 'finalizada' && $route->status !== 'finalizada') {
                $caminhao->update(['status' => 'disponivel']);
                $motorista->update(['status' => 'ativo']);
            }
            // Se a rota foi reativada, ocupa o caminhão
            elseif ($validated['status'] !== 'finalizada' && $route->status === 'finalizada') {
                $caminhao->update(['status' => 'em_uso']);
                $motorista->update(['status' => 'em_rota']);
            }
            // Se o status mudou para em_andamento ou retornando
            elseif (in_array($validated['status'], ['em_andamento', 'retornando'])) {
                $motorista->update(['status' => 'em_rota']);
            }

            $route->update($validated);

            return redirect()->route('routes.index')
                ->with('success', 'Rota atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Erro ao atualizar rota. ' . $e->getMessage()]);
        }
    }

    public function destroy(Route $route)
    {
        // Verifica se a rota pertence à empresa
        if ($route->motorista->empresa_id !== Auth::id()) {
            abort(403);
        }

        try {
            // Se a rota estava em andamento, libera o caminhão
            if ($route->status !== 'finalizada') {
                $route->caminhao->update(['status' => 'disponivel']);
                $route->motorista->update(['status' => 'ativo']);
            }

            $route->delete();
            return redirect()->route('routes.index')
                ->with('success', 'Rota removida com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Erro ao remover rota. ' . $e->getMessage()]);
        }
    }
}
