@extends('layouts.app')

@section('content')
<div class="bg-slate-900 h-screen flex flex-col">
    <div class="relative flex flex-1">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Conteúdo principal com header -->
        <div id="main-header" class="flex flex-col flex-1 ml-20">
            <x-header />

            <!-- Conteúdo da Página -->
            <main class="flex-1 p-4">
                <!-- Título -->
                <div class="flex items-center space-x-3 bg-gray-900 p-4 rounded-lg">
                    <span class="w-1 h-12 bg-gradient-to-b from-yellow-500 to-emerald-300"></span>
                    <h1 class="text-white text-5xl">Informações do Motorista</h1>
                </div>

                <!-- Card com dados do motorista -->
                <div class="bg-white p-6 mt-6 rounded-lg shadow-md w-full">
                    <div class="flex justify-between items-start">
                        <!-- Nome -->
                        <div class="flex items-center space-x-4">
                            <h2 class="text-3xl font-semibold">{{ strtoupper($motorista->nome_completo) }}</h2>
                        </div>

                        <!-- Atribuições -->
                        <div class="flex flex-col text-right">
                            <h3 class="text-slate-500 text-sm font-semibold">ATRIBUIÇÕES</h3>
                            <div class="mt-2 flex flex-col space-y-2">
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-slate-800 px-4 py-2 rounded flex items-center space-x-2">
                                    <i class="fas fa-route"></i>
                                    <span>Atribuir rota</span>
                                </button>
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-slate-800 px-4 py-2 rounded flex items-center space-x-2">
                                    <i class="fas fa-truck"></i>
                                    <span>Atribuir veículo</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Informações pessoais -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 text-gray-700">
                        <div>
                            <p><strong>CPF:</strong> {{ $motorista->cpf }}</p>
                            <p><strong>CNH:</strong> {{ $motorista->cnh }}</p>
                            <p><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($motorista->data_nascimento)->format('d/m/Y') }}</p>
                            <p><strong>Status:</strong> {{ $motorista->ativo ? 'Ativo' : 'Inativo' }}</p>
                        </div>

                        <div>
                            <p><strong>E-mail:</strong> {{ $motorista->email }}</p>
                            <p><strong>Telefone:</strong> {{ $motorista->telefone }}</p>
                            <p><strong>Data de Admissão:</strong> {{ \Carbon\Carbon::parse($motorista->data_admissao)->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <!-- Datas de criação/atualização -->
                    <div class="mt-4 border-t pt-4">
                        <p class="text-sm text-gray-500">
                            Cadastrado em: {{ $motorista->created_at->format('d/m/Y H:i') }} |
                            Última atualização: {{ $motorista->updated_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <!-- Botões -->
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('motoristas.index') }}" 
                           class="bg-gray-500 ">
                            Voltar
                        </a>
                        
                        <a href="{{ route('motoristas.edit', $motorista->id) }}" 
                           class="bg-blue-500">
                            Editar
                        </a>

                        <form action="{{ route('motoristas.destroy', $motorista->id) }}" method="POST" 
                              onsubmit="return confirm('Tem certeza que deseja excluir este motorista?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
</div>
@endsection
