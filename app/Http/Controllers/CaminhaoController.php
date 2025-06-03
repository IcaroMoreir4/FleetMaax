<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use App\Models\Motorista;
use Illuminate\Container\Attributes\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaminhaoController extends Controller
{
    public function index()
    {
        $empresa_id = Auth::id();
        $motoristas = Motorista::where('empresa_id', $empresa_id)
            ->where('status', 'ativo')
            ->get();
        $caminhoes = Caminhao::where('empresa_id', $empresa_id)->get();
        
        return view('caminhoes.index', compact('caminhoes', 'motoristas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'implemento' => 'required|string|max:255',
            'marca_modelo' => 'required|string|max:255',
            'ano' => 'required|string|max:4',
            'numero_chassi' => 'required|string|unique:caminhoes|max:255',
            'placa' => 'required|string|unique:caminhoes|max:255',
            'cor' => 'required|string|max:255',
            'motorista_id' => 'nullable|exists:motoristas,id',
        ]);

        // Adiciona o ID da empresa logada e status padrão
        $validated['empresa_id'] = Auth::id();
        $validated['status'] = 'disponivel';

        try {
            $caminhao = Caminhao::create($validated);
            return redirect()->route('caminhoes.index')
                ->with('success', 'Caminhão cadastrado com sucesso!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Erro ao cadastrar caminhão. ' . $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $caminhao = Caminhao::where('empresa_id', Auth::id())->findOrFail($id);
        return view('caminhoes.show', compact('caminhao'));
    }

    public function edit($id)
    {
        $empresa_id = Auth::id();
        $motoristas = Motorista::where('empresa_id', $empresa_id)
            ->where('status', 'ativo')
            ->get();
        $caminhao = Caminhao::where('empresa_id', $empresa_id)->findOrFail($id);
        
        return view('caminhoes.edit', compact('caminhao', 'motoristas'));
    }

    public function update(Request $request, Caminhao $caminhao)
    {
        // Verifica se o caminhão pertence à empresa logada
        if ($caminhao->empresa_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'implemento' => 'required|string|max:255',
            'marca_modelo' => 'required|string|max:255',
            'ano' => 'required|string|max:4',
            'numero_chassi' => 'required|string|unique:caminhoes,numero_chassi,' . $caminhao->id,
            'placa' => 'required|string|unique:caminhoes,placa,' . $caminhao->id,
            'cor' => 'required|string|max:255',
            'motorista_id' => 'nullable|exists:motoristas,id',
            'status' => 'required|in:disponivel,em_uso,manutencao',
        ]);

        try {
            $caminhao->update($validated);
            return redirect()->route('caminhoes.index')
                ->with('success', 'Caminhão atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Erro ao atualizar caminhão. ' . $e->getMessage()]);
        }
    }

    public function destroy(Caminhao $caminhao)
    {
        // Verifica se o caminhão pertence à empresa logada
        if ($caminhao->empresa_id !== Auth::id()) {
            abort(403);
        }

        try {
            $caminhao->delete();
            return redirect()->route('caminhoes.index')
                ->with('success', 'Caminhão removido com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Erro ao remover caminhão. ' . $e->getMessage()]);
        }
    }
}
