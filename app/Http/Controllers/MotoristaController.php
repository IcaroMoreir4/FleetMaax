<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MotoristaController extends Controller
{
    public function index()
    {
        $motoristas = Motorista::where('empresa_id', Auth::id())->get();
        return view('motoristas.index', compact('motoristas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:motoristas|max:14',
            'cnh' => 'required|string|unique:motoristas|max:20',
            'telefone' => 'required|string|max:15',
        ]);

        // Adiciona o ID da empresa logada
        $validated['empresa_id'] = Auth::id();
        $validated['status'] = 'ativo';

        Motorista::create($validated);

        return redirect()->back()->with('success', 'Motorista cadastrado com sucesso!');
    }

    public function show($id)
    {
        $motorista = Motorista::where('empresa_id', Auth::id())->findOrFail($id);
        return response()->json($motorista);
    }

    public function update(Request $request, Motorista $motorista)
    {
        // Verifica se o motorista pertence à empresa logada
        if ($motorista->empresa_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:motoristas,cpf,' . $motorista->id,
            'cnh' => 'required|string|max:20|unique:motoristas,cnh,' . $motorista->id,
            'telefone' => 'required|string|max:15',
            'status' => 'required|in:ativo,inativo',
        ]);

        $motorista->update($validated);

        return redirect()->route('motoristas.index')->with('success', 'Motorista atualizado com sucesso!');
    }

    public function destroy(Motorista $motorista)
    {
        // Verifica se o motorista pertence à empresa logada
        if ($motorista->empresa_id !== Auth::id()) {
            abort(403);
        }

        $motorista->delete();
        return redirect()->route('motoristas.index')->with('success', 'Motorista removido com sucesso!');
    }
}
