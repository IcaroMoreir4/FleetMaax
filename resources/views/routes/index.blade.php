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
                                <th class="px-4 py-3">Data Saída</th>
                                <th class="px-4 py-3">Data Chegada</th>
                                <th class="px-4 py-3">Motorista</th>
                                <th class="px-4 py-3">Caminhão</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 divide-y divide-gray-400 text-gray-900">
                            @foreach($routes as $route)
                            <tr class="hover:bg-gray-200 transition">
                                <td class="px-4 py-3">{{ $route->id }}</td>
                                <td class="px-4 py-3">{{ $route->origem }}</td>
                                <td class="px-4 py-3">{{ $route->destino }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($route->data_saida)->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($route->data_chegada)->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-3">{{ $route->motorista?->nome ?? 'Não atribuído' }}</td>
                                <td class="px-4 py-3">{{ $route->caminhao?->placa ?? 'Não atribuído' }}</td>
                                <td class="px-4 py-3">
                                    @if($route->status === 'pendente')
                                        <div class="bg-yellow-600 text-white p-2 font-bold rounded w-2/3 text-center">
                                            Pendente
                                        </div>
                                    @elseif($route->status === 'em_andamento')
                                        <div class="bg-blue-600 text-white p-2 font-bold rounded w-2/3 text-center">
                                            Em Andamento
                                        </div>
                                    @elseif($route->status === 'retornando')
                                        <div class="bg-purple-600 text-white p-2 font-bold rounded w-2/3 text-center">
                                            Retornando
                                        </div>
                                    @else
                                        <div class="bg-green-600 text-white p-2 font-bold rounded w-2/3 text-center">
                                            Finalizada
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex space-x-2">
                                        <button onclick="event.stopPropagation(); editarRota({{ $route->id }})"
                                            class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded transition-all duration-200 transform hover:scale-110 active:scale-95">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('routes.destroy', $route->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta rota?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="event.stopPropagation()"
                                                class="bg-red-500 hover:bg-red-600 text-white p-2 rounded transition-all duration-200 transform hover:scale-110 active:scale-95">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
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
                <form action="{{ route('routes.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="origem" class="py-2 text-xl block">Origem</label>
                            <input type="text" name="origem" id="origem" placeholder="Cidade/Estado de origem"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="destino" class="py-2 text-xl block">Destino</label>
                            <input type="text" name="destino" id="destino" placeholder="Cidade/Estado de destino"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="data_saida" class="py-2 text-xl block">Data de Saída</label>
                            <input type="datetime-local" name="data_saida" id="data_saida"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="data_chegada" class="py-2 text-xl block">Data de Chegada</label>
                            <input type="datetime-local" name="data_chegada" id="data_chegada"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="motorista_id" class="py-2 text-xl block">Motorista</label>
                            <select name="motorista_id" id="motorista_id"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                                <option value="">Selecione um motorista</option>
                                @foreach($motoristas as $motorista)
                                <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="caminhao_id" class="py-2 text-xl block">Caminhão</label>
                            <select name="caminhao_id" id="caminhao_id"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                                <option value="">Selecione um caminhão</option>
                                @foreach($caminhoes as $caminhao)
                                <option value="{{ $caminhao->id }}">{{ $caminhao->placa }} - {{ $caminhao->marca_modelo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end py-16 space-x-4">
                        <button type="button" onclick="closeModal('novaRotaModal')"
                            class="text-red-600 border border-red-600 font-semibold px-6 py-2 rounded transition-all duration-200 transform hover:scale-105 hover:bg-red-100 hover:border-red-700 hover:text-red-700 active:scale-95">
                            Sair
                        </button>
                        <button type="submit"
                            class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 transition-all duration-200 transform hover:scale-105 hover:bg-yellow-600 active:scale-95 focus:outline-none focus:ring-2 focus:ring-yellow-500">
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
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="edit_destino" class="py-2 text-xl block">Destino</label>
                            <input type="text" name="destino" id="edit_destino" placeholder="Cidade/Estado de destino"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="edit_data_saida" class="py-2 text-xl block">Data de Saída</label>
                            <input type="datetime-local" name="data_saida" id="edit_data_saida"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="edit_data_chegada" class="py-2 text-xl block">Data de Chegada</label>
                            <input type="datetime-local" name="data_chegada" id="edit_data_chegada"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                        </div>

                        <div>
                            <label for="edit_motorista_id" class="py-2 text-xl block">Motorista</label>
                            <select name="motorista_id" id="edit_motorista_id"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                                <option value="">Selecione um motorista</option>
                                @foreach($motoristas as $motorista)
                                <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="edit_caminhao_id" class="py-2 text-xl block">Caminhão</label>
                            <select name="caminhao_id" id="edit_caminhao_id"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                                <option value="">Selecione um caminhão</option>
                                @foreach($caminhoes as $caminhao)
                                <option value="{{ $caminhao->id }}">{{ $caminhao->placa }} - {{ $caminhao->marca_modelo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="edit_status" class="py-2 text-xl block">Status</label>
                            <select name="status" id="edit_status"
                                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                                <option value="pendente">Pendente</option>
                                <option value="em_andamento">Em Andamento</option>
                                <option value="retornando">Retornando</option>
                                <option value="finalizada">Finalizada</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end py-16 space-x-4">
                        <button type="button" onclick="closeModal('editarRotaModal')"
                            class="text-red-600 border border-red-600 font-semibold px-6 py-2 rounded transition-all duration-200 transform hover:scale-105 hover:bg-red-100 hover:border-red-700 hover:text-red-700 active:scale-95">
                            Sair
                        </button>
                        <button type="submit"
                            class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 transition-all duration-200 transform hover:scale-105 hover:bg-yellow-600 active:scale-95 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Fechar modais ao clicar fora
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });

        async function editarRota(id) {
            try {
                const response = await fetch(`/routes/${id}`);
                const rota = await response.json();

                // Preenche o formulário com os dados da rota
                document.getElementById('edit_origem').value = rota.origem;
                document.getElementById('edit_destino').value = rota.destino;
                document.getElementById('edit_data_saida').value = rota.data_saida.slice(0, 16);
                document.getElementById('edit_data_chegada').value = rota.data_chegada.slice(0, 16);
                document.getElementById('edit_motorista_id').value = rota.motorista_id || '';
                document.getElementById('edit_caminhao_id').value = rota.caminhao_id || '';
                document.getElementById('edit_status').value = rota.status;

                // Define a action do formulário
                document.getElementById('formEditarRota').action = `/routes/${id}`;

                // Abre o modal
                openModal('editarRotaModal');
            } catch (error) {
                console.error('Erro ao carregar dados da rota:', error);
                alert('Erro ao carregar dados da rota');
            }
        }

        // Validação das datas
        document.getElementById('data_chegada').addEventListener('change', function() {
            const dataSaida = document.getElementById('data_saida').value;
            if (dataSaida && this.value <= dataSaida) {
                alert('A data de chegada deve ser posterior à data de saída');
                this.value = '';
            }
        });

        document.getElementById('edit_data_chegada').addEventListener('change', function() {
            const dataSaida = document.getElementById('edit_data_saida').value;
            if (dataSaida && this.value <= dataSaida) {
                alert('A data de chegada deve ser posterior à data de saída');
                this.value = '';
            }
        });
    </script>
</body>

</html>