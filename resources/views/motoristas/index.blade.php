<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Motorista</title>
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
            <h1 class="text-white text-5xl">Motoristas</h1>
          </div>

          <!-- Botão alinhado à direita -->
          <button class="bg-yellow-500 hover:bg-yellow-700 text-slate-800 font-bold py-2 px-4 border border-yellow-700 rounded">
            Novo Motorista +
          </button>
        </div>

        <!-- Tabela de motoristas -->
        <div class="w-full mt-6 overflow-auto rounded-lg">
          <table class="w-full text-left text-white text-xl">
            <thead class="bg-gray-900 font-bold">
              <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Nome</th>
                <th class="px-4 py-3">CPF</th>
                <th class="px-4 py-3">CNH</th>
                <th class="px-4 py-3">Telefone</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-gray-100 divide-y divide-gray-400 text-gray-900">
              @foreach($motoristas as $motorista)
              <tr class="hover:bg-gray-200 transition">
                <td class="px-4 py-3">{{ $motorista->id }}</td>
                <td class="px-4 py-3">{{ $motorista->nome }}</td>
                <td class="px-4 py-3">{{ $motorista->cpf }}</td>
                <td class="px-4 py-3">{{ $motorista->cnh }}</td>
                <td class="px-4 py-3">{{ $motorista->telefone }}</td>
                <td class="px-4 py-3">
                  @if ($motorista->status === 'ativo')
                  <div class="bg-green-600 text-white p-2 font-bold rounded w-2/3 text-center">
                    Ativo
                  </div>
                  @else
                  <div class="bg-red-600 text-white p-2 font-bold rounded w-2/3 text-center">
                    Inativo
                  </div>
                  @endif
                </td>
                <td class="px-4 py-3">
                  <div class="flex space-x-2">
                    <button onclick="event.stopPropagation(); openEditModal({{ $motorista->id }})"
                      class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded transition-all duration-200 transform hover:scale-110 active:scale-95">
                      <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('motoristas.destroy', $motorista->id) }}" method="POST" class="inline"
                      onsubmit="return confirm('Tem certeza que deseja excluir este motorista?')">
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

      <!-- Novo Motorista Modal -->
      <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
        <div class="bg-gray-200 mx-6 my-10 w-1/2 overflow-auto rounded-lg shadow-lg">
          <div class="flex justify-between items-center m-6">
            <h1 class="text-yellow-500 text-5xl">Novo Motorista</h1>
            <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo" class="h-18" />
          </div>

          <div class="py-4 px-6">
            <form action="{{ route('motoristas.store') }}" method="POST">
              @csrf
              <div class="space-y-4">
                <div>
                  <label for="nome" class="py-2 text-xl block">Nome completo</label>
                  <input type="text" name="nome" id="nome" placeholder="Nome completo"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="cpf" class="py-2 text-xl block">CPF</label>
                  <input type="text" name="cpf" id="cpf" placeholder="CPF"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="cnh" class="py-2 text-xl block">CNH</label>
                  <input type="text" name="cnh" id="cnh" placeholder="CNH"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="telefone" class="py-2 text-xl block">Telefone</label>
                  <input type="tel" name="telefone" id="telefone" placeholder="(XX) XXXXX-XXXX" maxlength="15"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
              </div>

              <div class="flex justify-end py-16 space-x-4">
                <button type="button" onclick="document.getElementById('modal').classList.add('hidden')"
                  class="text-red-600 border border-red-600 font-semibold px-6 py-2 rounded transition-all duration-200 transform hover:scale-105 hover:bg-red-100 hover:border-red-700 hover:text-red-700 active:scale-95">
                  Sair
                </button>
                <button type="submit"
                  class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 transition-all duration-200 transform hover:scale-105 hover:bg-yellow-600 active:scale-95 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                  Novo Motorista
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Editar Motorista -->
      <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
        <div class="bg-gray-200 mx-6 my-10 w-1/2 overflow-auto rounded-lg shadow-lg">
          <div class="flex justify-between items-center m-6">
            <h1 class="text-yellow-500 text-5xl">Editar Motorista</h1>
            <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo" class="h-18" />
          </div>

          <div class="py-4 px-6">
            <form id="editForm" method="POST">
              @csrf
              @method('PUT')
              <div class="space-y-4">
                <div>
                  <label for="edit_nome" class="py-2 text-xl block">Nome completo</label>
                  <input type="text" name="nome" id="edit_nome" placeholder="Nome completo"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                </div>

                <div>
                  <label for="edit_cpf" class="py-2 text-xl block">CPF</label>
                  <input type="text" name="cpf" id="edit_cpf" placeholder="CPF"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                </div>

                <div>
                  <label for="edit_cnh" class="py-2 text-xl block">CNH</label>
                  <input type="text" name="cnh" id="edit_cnh" placeholder="CNH"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                </div>

                <div>
                  <label for="edit_telefone" class="py-2 text-xl block">Telefone</label>
                  <input type="text" name="telefone" id="edit_telefone" placeholder="Telefone"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required />
                </div>

                <div>
                  <label for="edit_status" class="py-2 text-xl block">Status</label>
                  <select name="status" id="edit_status"
                    class="px-4 py-1 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                  </select>
                </div>

                <div class="flex justify-end space-x-3 pt-6">
                  <button type="button" onclick="closeEditModal()"
                    class="text-red-600 border border-red-600 font-semibold px-6 py-2 rounded transition-all duration-200 transform hover:scale-105 hover:bg-red-100 hover:border-red-700 hover:text-red-700 active:scale-95">
                    Sair
                  </button>
                  <button type="submit" 
                    class="bg-yellow-500 text-xl rounded-full px-6 py-2 transition-all duration-200 transform hover:scale-105 hover:bg-yellow-600 active:scale-95 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    Salvar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <x-footer />
    </div>
  </div>

  <script>
    const modal = document.getElementById('modal');
    const btnNovaRota = document.querySelector('button.bg-yellow-500');

    btnNovaRota.addEventListener('click', () => {
      modal.classList.remove('hidden');
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
      }
    });

    function openEditModal(id) {
      const form = document.getElementById('editForm');
      form.action = `/motoristas/${id}`;

      // Fazer uma requisição para buscar os dados do motorista
      fetch(`/motoristas/${id}`)
        .then(response => response.json())
        .then(data => {
          document.getElementById('edit_nome').value = data.nome;
          document.getElementById('edit_cpf').value = data.cpf;
          document.getElementById('edit_cnh').value = data.cnh;
          document.getElementById('edit_telefone').value = data.telefone;
          document.getElementById('edit_status').value = data.status;
          document.getElementById('editModal').classList.remove('hidden');
        });
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
    }
  </script>
</body>

</html>