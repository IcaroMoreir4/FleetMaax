@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg relative">

    {{-- Botão de voltar / fechar --}}
    <a href="{{ route('caminhoes.index') }}" class="absolute top-4 right-4 text-gray-500 hover:text-red-600 text-2xl" title="Voltar">
        &times;
    </a>

    <h1 class="text-4xl font-bold text-yellow-500 mb-8 border-b pb-4">Editar Caminhão</h1>

    <form action="{{ route('caminhoes.update', $caminhao->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @php
            $fields = [
                'implemento' => 'Implemento',
                'marca_modelo' => 'Marca/Modelo',
                'ano' => 'Ano',
                'numero_chassi' => 'Número de Chassi',
                'placa' => 'Placa',
                'cor' => 'Cor'
            ];
        @endphp

        @foreach($fields as $name => $label)
        <div>
            <label for="{{ $name }}" class="block text-lg font-semibold text-gray-700 mb-1">{{ $label }}</label>
            <input type="{{ $name === 'ano' ? 'number' : 'text' }}" 
                   name="{{ $name }}" 
                   id="{{ $name }}"
                   value="{{ old($name, $caminhao->$name) }}"
                   class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-gray-700" 
                   placeholder="{{ $label }}">
        </div>
        @endforeach

        <div>
            <label for="motorista_id" class="block text-lg font-semibold text-gray-700 mb-1">Motorista</label>
            <select name="motorista_id" id="motorista_id"
                class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 text-gray-700">
                <option value="">Selecione um motorista</option>
                @foreach($motoristas as $motorista)
                    <option value="{{ $motorista->id }}" {{ $motorista->id == $caminhao->motorista_id ? 'selected' : '' }}>
                        {{ $motorista->nome_completo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end pt-6">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white text-lg font-bold py-2 px-8 rounded-full shadow transition">
                Salvar
            </button>
        </div>
    </form>
</div>
@endsection
