<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rotas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="bg-slate-900 h-screen flex flex-col">
    <div class="relative flex flex-1">
        <!-- Sidebar -->
        <x-sidebar />

        <div id="main-header" class="flex flex-col flex-1 ml-20">
            <x-header />

            <!-- Conteúdo Principal -->
            <main class="flex-1 p-4">
                <!-- Container do título e botão -->
                <div class="flex items-center justify-between bg-gray-900 p-4 rounded-lg">
                    <!-- Título com detalhe lateral -->
                    <div class="flex items-center space-x-3">
                        <span class="w-1 h-12 bg-gradient-to-b from-yellow-500 to-emerald-300"></span>
                        <h1 class="text-white text-5xl">Rotas</h1>
                    </div>

                    <!-- Botão alinhado à direita -->
                    <button onclick="openModal('novaRotaModal')" class="bg-yellow-500 hover:bg-yellow-700 text-slate-800 font-bold py-2 px-4 border border-yellow-700 rounded">
                        Nova Rota +
                    </button>
                </div>

                <!-- Tabela de rotas -->
                <div class="w-full mt-6 overflow-auto rounded-lg">
                    <table class="w-full text-left text-white text-xl">
                        <thead class="bg-gray-900 font-bold">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Origem</th>
                                <th class="px-4 py-3">Destino</th>
                                <th class="px-4 py-3">Distância</th>
                                <th class="px-4 py-3">Tempo Estimado</th>
                                <th class="px-4 py-3">Motorista</th>
                                <th class="px-4 py-3">Caminhão</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 divide-y divide-gray-400 text-gray-900">
                            @foreach($rotas as $rota)
                            <tr class="hover:bg-gray-200 transition">
                                <td class="px-4 py-3">{{ $rota->id }}</td>
                                <td class="px-4 py-3">{{ $rota->origem }}</td>
                                <td class="px-4 py-3">{{ $rota->destino }}</td>
                                <td class="px-4 py-3">{{ $rota->distancia }} km</td>
                                <td class="px-4 py-3">{{ $rota->tempo_estimado }}</td>
                                <td class="px-4 py-3">{{ $rota->motorista?->nome_completo ?? 'Não atribuído' }}</td>
                                <td class="px-4 py-3">{{ $rota->caminhao?->placa ?? 'Não atribuído' }}</td>
                                <td class="px-4 py-3">
                                    @if ($rota->status)
                                    <div class="bg-green-600 text-white p-2 font-bold rounded w-2/3 text-center">
                                        Ativa
                                    </div>
                                    @else
                                    <div class="bg-red-600 text-white p-2 font-bold rounded w-2/3 text-center">
                                        Inativa
                                    </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <button onclick="editarRota({{ $rota->id }})" class="text-blue-600 hover:text-blue-800 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('rotas.destroy', $rota->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Tem certeza que deseja excluir esta rota?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Nova Rota -->
    <div id="novaRotaModal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
        <div class="bg-gray-200 mx-6 my-10 w-1/2 h-[85%] overflow-auto rounded-lg">
            <div class="flex justify-between items-center m-6">
                <h1 class="text-yellow-500 text-5xl">Nova Rota</h1>
                <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo" class="h-18" />
            </div>

            <div class="py-4 px-6">
                <form action="{{ route('rotas.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="origem" class="py-2 text-xl block">Origem</label>
                            <input type="text" name="origem" id="origem" placeholder="Cidade/Estado de origem"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="destino" class="py-2 text-xl block">Destino</label>
                            <input type="text" name="destino" id="destino" placeholder="Cidade/Estado de destino"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="distancia" class="py-2 text-xl block">Distância (km)</label>
                            <input type="number" step="0.01" name="distancia" id="distancia" placeholder="Distância em quilômetros"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="tempo_estimado" class="py-2 text-xl block">Tempo Estimado</label>
                            <input type="text" name="tempo_estimado" id="tempo_estimado" placeholder="Ex: 2 horas e 30 minutos"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="motorista_id" class="py-2 text-xl block">Motorista</label>
                            <select name="motorista_id" id="motorista_id"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="">Selecione um motorista</option>
                                @foreach($motoristas as $motorista)
                                <option value="{{ $motorista->id }}">{{ $motorista->nome_completo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="caminhao_id" class="py-2 text-xl block">Caminhão</label>
                            <select name="caminhao_id" id="caminhao_id"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="">Selecione um caminhão</option>
                                @foreach($caminhoes as $caminhao)
                                <option value="{{ $caminhao->id }}">{{ $caminhao->placa }} - {{ $caminhao->marca_modelo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="py-2 text-xl block">Status</label>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name="status" id="status" value="1" checked
                                    class="w-4 h-4 text-yellow-500 focus:ring-yellow-500" />
                                <label for="status">Ativa</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end py-16">
                        <button type="submit"
                            class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            Criar Rota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Rota -->
    <div id="editarRotaModal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
        <div class="bg-gray-200 mx-6 my-10 w-1/2 h-[85%] overflow-auto rounded-lg">
            <div class="flex justify-between items-center m-6">
                <h1 class="text-yellow-500 text-5xl">Editar Rota</h1>
                <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo" class="h-18" />
            </div>

            <div class="py-4 px-6">
                <form id="formEditarRota" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="edit_origem" class="py-2 text-xl block">Origem</label>
                            <input type="text" name="origem" id="edit_origem" placeholder="Cidade/Estado de origem"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="edit_destino" class="py-2 text-xl block">Destino</label>
                            <input type="text" name="destino" id="edit_destino" placeholder="Cidade/Estado de destino"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="edit_distancia" class="py-2 text-xl block">Distância (km)</label>
                            <input type="number" step="0.01" name="distancia" id="edit_distancia" placeholder="Distância em quilômetros"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="edit_tempo_estimado" class="py-2 text-xl block">Tempo Estimado</label>
                            <input type="text" name="tempo_estimado" id="edit_tempo_estimado" placeholder="Ex: 2 horas e 30 minutos"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="edit_motorista_id" class="py-2 text-xl block">Motorista</label>
                            <select name="motorista_id" id="edit_motorista_id"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="">Selecione um motorista</option>
                                @foreach($motoristas as $motorista)
                                <option value="{{ $motorista->id }}">{{ $motorista->nome_completo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="edit_caminhao_id" class="py-2 text-xl block">Caminhão</label>
                            <select name="caminhao_id" id="edit_caminhao_id"
                                class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <option value="">Selecione um caminhão</option>
                                @foreach($caminhoes as $caminhao)
                                <option value="{{ $caminhao->id }}">{{ $caminhao->placa }} - {{ $caminhao->marca_modelo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="py-2 text-xl block">Status</label>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name="status" id="edit_status" value="1"
                                    class="w-4 h-4 text-yellow-500 focus:ring-yellow-500" />
                                <label for="edit_status">Ativa</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end py-16">
                        <button type="submit"
                            class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            Atualizar Rota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        // Fechar modal ao clicar fora
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
            }
        }

        function editarRota(rotaId) {
            // Buscar dados da rota
            fetch(`/rotas/${rotaId}`)
                .then(response => response.json())
                .then(rota => {
                    // Preencher formulário
                    document.getElementById('edit_origem').value = rota.origem;
                    document.getElementById('edit_destino').value = rota.destino;
                    document.getElementById('edit_distancia').value = rota.distancia;
                    document.getElementById('edit_tempo_estimado').value = rota.tempo_estimado;
                    document.getElementById('edit_motorista_id').value = rota.motorista_id || '';
                    document.getElementById('edit_caminhao_id').value = rota.caminhao_id || '';
                    document.getElementById('edit_status').checked = rota.status;

                    // Configurar action do formulário
                    document.getElementById('formEditarRota').action = `/rotas/${rotaId}`;

                    // Abrir modal
                    openModal('editarRotaModal');
                });
        }

        // Mensagens de sucesso
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif
    </script>
</body>

</html>