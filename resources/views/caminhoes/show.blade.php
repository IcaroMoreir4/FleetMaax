@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-800 text-white rounded-lg">
  <h1 class="text-4xl mb-6">Detalhes do Caminhão</h1>

  <ul class="space-y-2">
    <li><strong>Implemento:</strong> {{ $caminhao->implemento }}</li>
    <li><strong>Marca/Modelo:</strong> {{ $caminhao->marca_modelo }}</li>
    <li><strong>Ano:</strong> {{ $caminhao->ano }}</li>
    <li><strong>Número Chassi:</strong> {{ $caminhao->numero_chassi }}</li>
    <li><strong>Placa:</strong> {{ $caminhao->placa }}</li>
    <li><strong>Cor:</strong> {{ $caminhao->cor }}</li>
    <li><strong>Nome Motorista:</strong> {{ $caminhao->motorista?->nome_completo ?? 'Sem motorista' }}</li>
  </ul>

  <div class="mt-6 space-x-4">
    <a href="{{ route('caminhoes.edit', $caminhao->id) }}" class="bg-yellow-500 px-4 py-2 rounded hover:bg-yellow-700">Editar</a>

    <form action="{{ route('caminhoes.destroy', $caminhao->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja realmente deletar este caminhão?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="bg-red-600 px-4 py-2 rounded hover:bg-red-800 text-white">Deletar</button>
    </form>
  </div>
</div>
@endsection
