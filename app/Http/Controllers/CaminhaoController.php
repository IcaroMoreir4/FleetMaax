<?php

namespace App\Http\Controllers;

use App\Models\Caminhao;
use App\Models\Motorista;
use App\Models\Route;
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
        try {
            $validated = $request->validate([
                'implemento' => 'required|string|max:255',
                'marca_modelo' => 'required|string|max:255',
                'ano' => [
                    'required',
                    'string',
                    'max:4',
                    'regex:/^(19|20)\d{2}$/',
                    function ($attribute, $value, $fail) {
                        $ano = intval($value);
                        $anoAtual = intval(date('Y'));
                        if ($ano < 1900 || $ano > ($anoAtual + 1)) {
                            $fail("O ano deve estar entre 1900 e " . ($anoAtual + 1));
                        }
                    }
                ],
                'numero_chassi' => [
                    'required',
                    'string',
                    'unique:caminhoes',
                    'max:255',
                    'regex:/^[A-HJ-NPR-Z0-9]{17}$/'
                ],
                'placa' => [
                    'required',
                    'string',
                    'unique:caminhoes',
                    'max:8',
                    function ($attribute, $value, $fail) {
                        // Remove hífens e espaços
                        $placa = str_replace(['-', ' '], '', strtoupper($value));
                        
                        // Formato Mercosul: 3 letras + 1 número + 1 letra + 2 números
                        $mercosul = preg_match('/^[A-Z]{3}[0-9][A-Z][0-9]{2}$/', $placa);
                        
                        // Formato Antigo: 3 letras + 4 números
                        $antigo = preg_match('/^[A-Z]{3}[0-9]{4}$/', $placa);
                        
                        if (!$mercosul && !$antigo) {
                            $fail('A placa deve estar no formato Mercosul (ABC1D23) ou formato antigo (ABC-1234).');
                        }
                    }
                ],
                'cor' => 'required|string|max:255',
                'motorista_id' => 'nullable|exists:motoristas,id',
            ], [
                'implemento.required' => 'O implemento é obrigatório.',
                'marca_modelo.required' => 'A marca/modelo é obrigatória.',
                'ano.required' => 'O ano é obrigatório.',
                'ano.regex' => 'O ano deve estar no formato AAAA (ex: 2024).',
                'numero_chassi.required' => 'O número do chassi é obrigatório.',
                'numero_chassi.unique' => 'Este número de chassi já está em uso.',
                'numero_chassi.regex' => 'O número do chassi deve ter 17 caracteres alfanuméricos.',
                'placa.required' => 'A placa é obrigatória.',
                'placa.unique' => 'Esta placa já está em uso.',
                'cor.required' => 'A cor é obrigatória.',
                'motorista_id.exists' => 'O motorista selecionado não existe.',
            ]);

            // Formata a placa (remove hífens e espaços, converte para maiúsculo)
            $validated['placa'] = str_replace(['-', ' '], '', strtoupper($validated['placa']));

            // Adiciona o ID da empresa logada e status padrão
            $validated['empresa_id'] = Auth::id();
            $validated['status'] = 'disponivel';

            $caminhao = Caminhao::create($validated);
            
            if ($request->expectsJson()) {
                // Carrega o relacionamento com o motorista se existir
                if ($caminhao->motorista_id) {
                    $caminhao->load('motorista');
                }
                
                return response()->json([
                    'message' => 'Caminhão cadastrado com sucesso!',
                    'caminhao' => $caminhao
                ]);
            }
            
            return redirect()->route('caminhoes.index')
                ->with('success', 'Caminhão cadastrado com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Erro de validação',
                    'errors' => $e->errors()
                ], 422);
            }
            
            throw $e;
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => 'Erro ao cadastrar caminhão. ' . $e->getMessage()
                ], 500);
            }
            
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
        try {
            // Verifica se o caminhão pertence à empresa logada
            if ($caminhao->empresa_id !== Auth::id()) {
                return back()->withErrors(['error' => 'Você não tem permissão para excluir este caminhão.']);
            }

            // Verifica se o caminhão está em uso em alguma rota ativa
            $rotaAtiva = Route::where('caminhao_id', $caminhao->id)
                ->whereIn('status', ['em_andamento', 'retornando'])
                ->exists();

            if ($rotaAtiva) {
                return back()->withErrors(['error' => 'Não é possível excluir um caminhão que está em uso em uma rota ativa.']);
            }

            // Se o caminhão tem um motorista vinculado, remove a vinculação
            if ($caminhao->motorista_id) {
                $caminhao->motorista()->update(['status' => 'ativo']);
            }

            $caminhao->delete();
            return redirect()->route('caminhoes.index')
                ->with('success', 'Caminhão removido com sucesso!');
        } catch (\Exception $e) {
            \Log::error('Erro ao excluir caminhão: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => 'Erro ao remover caminhão. Por favor, tente novamente.']);
        }
    }
}
