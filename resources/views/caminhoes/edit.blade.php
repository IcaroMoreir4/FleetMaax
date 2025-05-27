@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow">
    <h1 class="text-3xl font-bold text-yellow-600 mb-6">Editar Caminhão</h1>

    <form action="{{ route('caminhoes.update', $caminhao->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="implemento" class="block font-medium">Implemento</label>
            <input type="text" name="implemento" value="{{ old('implemento', $caminhao->implemento) }}" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="marca_modelo" class="block font-medium">Marca/Modelo</label>
            <input type="text" name="marca_modelo" value="{{ old('marca_modelo', $caminhao->marca_modelo) }}" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="ano" class="block font-medium">Ano</label>
            <input type="number" name="ano" value="{{ old('ano', $caminhao->ano) }}" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="numero_chassi" class="block font-medium">Número de Chassi</label>
            <input type="text" name="numero_chassi" value="{{ old('numero_chassi', $caminhao->numero_chassi) }}" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="placa" class="block font-medium">Placa</label>
            <input type="text" name="placa" value="{{ old('placa', $caminhao->placa) }}" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="cor" class="block font-medium">Cor</label>
            <input type="text" name="cor" value="{{ old('cor', $caminhao->cor) }}" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="motorista_id" class="py-2 text-xl capitalize">Motorista</label>
            <select name="motorista_id" id="motorista_id" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="">Selecione um motorista</option>
                @foreach($motoristas as $motorista)
                <option value="{{ $motorista->id }}">{{ $motorista->nome_completo }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-right mt-6">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-6 rounded">Salvar</button>
        </div>
    </form>
</div>
@endsection
