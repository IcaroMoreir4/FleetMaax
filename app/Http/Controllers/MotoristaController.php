<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristaController extends Controller
{
    public function index()
    {
        $motoristas = Motorista::all();
        return view('motoristas.index', compact('motoristas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'cpf' => 'required|string|unique:motoristas|max:14',
            'cnh' => 'required|string|unique:motoristas|max:20',
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:motoristas',
            'telefone' => 'required|string|max:15',
            'data_admissao' => 'required|date',
            'ativo' => 'sometimes|boolean',
        ]);

        // Definindo valor padrão para 'ativo', caso não seja enviado (checkbox não marcado)
        if (!isset($validated['ativo'])) {
            $validated['ativo'] = false;
        }

        Motorista::create($validated);

        return redirect()->back()->with('success', 'Motorista cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $motorista = Motorista::findOrFail($id);
        return view('motoristas.edit', compact('motorista'));
    }


    public function update(Request $request, Motorista $motorista)
    {
        $validated = $request->validate([
            'nome_completo' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:motoristas,cpf,' . $motorista->id,
            'cnh' => 'required|string|max:20|unique:motoristas,cnh,' . $motorista->id,
            'data_nascimento' => 'required|date',
            'email' => 'required|email|unique:motoristas,email,' . $motorista->id,
            'telefone' => 'required|string|max:15',
            'data_admissao' => 'required|date',
            'ativo' => 'sometimes|boolean',
        ]);

        if (!isset($validated['ativo'])) {
            $validated['ativo'] = false;
        }

        $motorista->update($validated);

        return redirect()->route('motoristas.index')->with('success', 'Motorista atualizado com sucesso!');
    }

    public function destroy(Motorista $motorista)
    {
        $motorista->delete();
        return redirect()->route('motoristas.index')->with('success', 'Motorista removido com sucesso!');
    }

    public function show($id)
    {
        $motorista = Motorista::findOrFail($id);
        return view('motoristas.show', compact('motorista'));
    }

}
