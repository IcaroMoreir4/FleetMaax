<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use App\Models\Motorista;
use Illuminate\Container\Attributes\Cache;
use Illuminate\Http\Request;

class CaminhaoController extends Controller
{

    public function index()
    {
        $motoristas = Motorista::all();


        $motoristas = Motorista::all();
        $caminhoes = Caminhao::all();
        return view('caminhoes.index', compact('caminhoes', 'motoristas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'implemento' => 'required|string',
            'marca_modelo' => 'required|string',
            'ano' => 'required|string',
            'numero_chassi' => 'required|string|unique:caminhoes',
            'placa' => 'required|string|unique:caminhoes',
            'cor' => 'required|string',
            'motorista_id' => 'nullable|exists:motoristas,id',
        ]);

        Caminhao::create($validated);

        return redirect()->route('caminhoes.index')->with('success', 'Caminhão cadastrado com sucesso!');
    }

    public function show($id)
    {
        $caminhao = Caminhao::findOrFail($id);
        return view('caminhoes.show', compact('caminhao'));
    }

    public function edit($id)
    {
        $motoristas = Motorista::all();
        $caminhao = Caminhao::findOrFail($id);
        return view('caminhoes.edit', compact('caminhao', 'motoristas'));
    }

    public function update(Request $request, Caminhao $caminhao)
    {
        $validated = $request->validate([
            'implemento' => 'required|string',
            'marca_modelo' => 'required|string',
            'ano' => 'required|string', // ou 'integer', depende da sua decisão
            'numero_chassi' => 'required|string|unique:caminhoes,numero_chassi,' . $caminhao->id,
            'placa' => 'required|string|unique:caminhoes,placa,' . $caminhao->id,
            'cor' => 'required|string',
            'motorista_id' => 'nullable|exists:motoristas,id',  
        ]);

        $caminhao->update($validated);

        return redirect()->route('caminhoes.show', $caminhao->id)
            ->with('success', 'Caminhão atualizado com sucesso.');
    }

    public function destroy(Caminhao $caminhao)
    {
        $caminhao->delete();
        return redirect()->route('caminhoes.index')->with('success', 'Caminhão removido!');
    }
}
