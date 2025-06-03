<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Motorista</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  @vite('resources/css/app.css')
  @vite(['resources/js/app.js'])
</head>

<body class="bg-slate-900 h-screen flex flex-col">
  <div class="relative flex flex-1">
    <x-sidebar />

    <div id="main-header" class="flex flex-col flex-1 ml-20">
      <x-header />

      <main class="flex-1 p-4">
        <div class="flex items-center justify-between p-4 rounded-lg">
          <div class="flex items-center space-x-3">
            <span class="w-1 h-12 bg-gradient-to-b from-yellow-500 to-emerald-300"></span>
            <h1 class="text-white text-5xl">Caminhões</h1>
          </div>

          <div class="flex space-x-4">
            <div class="relative">
              <button id="btn-filtrar" class="bg-yellow-500 hover:bg-yellow-700 text-slate-800 font-bold py-2 px-4 border border-yellow-700 rounded flex items-center">
                <i class="fas fa-filter mr-2"></i> Filtrar <i class="fas fa-chevron-down ml-2"></i>
              </button>
              <div id="menu-filtro" class="absolute hidden bg-gray-700 text-white rounded mt-2 w-48 shadow-lg z-10">
                @foreach(['Placa', 'Implemento', 'Motorista'] as $filtro)
                <button class="block w-full text-left px-4 py-2 hover:bg-gray-600" onclick="aplicarFiltro('{{ strtolower($filtro) }}')">{{ $filtro }}</button>
                @endforeach
              </div>
            </div>

            <button id="btn-novo-caminhao" class="bg-yellow-500 hover:bg-yellow-700 text-slate-800 font-bold py-2 px-4 border border-yellow-700 rounded">
              Novo Caminhão +
            </button>
          </div>
        </div>

        <!-- Tabela -->
        <div class="w-full mt-6 overflow-auto rounded-lg">
          <table class="w-full text-left text-white text-xl">
            <thead class="bg-gray-900 font-bold">
              <tr>
                <th class="px-4 py-3">Implemento</th>
                <th class="px-4 py-3">Marca/Modelo</th>
                <th class="px-4 py-3">Ano</th>
                <th class="px-4 py-3">Número Chassi</th>
                <th class="px-4 py-3">Placa</th>
                <th class="px-4 py-3">Cor</th>
                <th class="px-4 py-3">Nome Motorista</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-gray-100 divide-y divide-gray-400 text-gray-900">
              @foreach($caminhoes as $caminhao)
              <tr class="hover:bg-gray-200 transition">
                <td class="px-4 py-3">{{ $caminhao->implemento }}</td>
                <td class="px-4 py-3">{{ $caminhao->marca_modelo }}</td>
                <td class="px-4 py-3">{{ $caminhao->ano }}</td>
                <td class="px-4 py-3">{{ $caminhao->numero_chassi }}</td>
                <td class="px-4 py-3">{{ $caminhao->placa }}</td>
                <td class="px-4 py-3">{{ $caminhao->cor }}</td>
                <td class="px-4 py-3">{{ $caminhao->motorista?->nome ?? 'Sem motorista' }}</td>
                <td class="px-4 py-3">
                  @if($caminhao->status === 'disponivel')
                    <span class="bg-green-500 text-green-500 px-2 py-1 rounded">Disponível</span>
                  @elseif($caminhao->status === 'em_uso')
                    <span class="bg-blue-500 text-yellow-500 px-2 py-1 rounded">Em Uso</span>
                  @else
                    <span class="bg-red-500 text-red-500 px-2 py-1 rounded">Manutenção</span>
                  @endif
                </td>
                <td class="px-4 py-3">
                  <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded"
                    onclick="openEditModal({{ $caminhao }})">
                    Editar
                  </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <!-- Modal - Novo Caminhão -->
  <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
    <div class="bg-gray-200 mx-6 my-10 w-1/2 max-h-[90vh] overflow-y-auto p-6 rounded-lg shadow-lg relative">
      <button class="absolute top-4 right-4 text-gray-700 hover:text-red-600 text-2xl" onclick="document.getElementById('modal').classList.add('hidden')">
        &times;
      </button>
      <div class="flex justify-between items-center">
        <h1 class="text-yellow-500 text-5xl">Novo Caminhão</h1>
        <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo da empresa" class="h-18">
      </div>

      <div class="py-4">
        <form action="{{ route('caminhoes.store') }}" method="POST">
          @csrf
          <div class="space-y-4">
            <div>
              <label for="implemento" class="py-2 text-xl capitalize">Implemento</label>
              <input type="text" name="implemento" id="implemento" placeholder="Implemento"
                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <div>
              <label for="marca_modelo" class="py-2 text-xl capitalize">Marca/Modelo</label>
              <input type="text" name="marca_modelo" id="marca_modelo" placeholder="Marca/Modelo"
                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <div>
              <label for="ano" class="py-2 text-xl capitalize">Ano</label>
              <input type="text" name="ano" id="ano" placeholder="Ano"
                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <div>
              <label for="numero_chassi" class="py-2 text-xl capitalize">Número do Chassi</label>
              <input type="text" name="numero_chassi" id="numero_chassi" placeholder="Número do Chassi"
                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <div>
              <label for="placa" class="py-2 text-xl capitalize">Placa</label>
              <input type="text" name="placa" id="placa" placeholder="Placa"
                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <div>
              <label for="cor" class="py-2 text-xl capitalize">Cor</label>
              <input type="text" name="cor" id="cor" placeholder="Cor"
                class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
            </div>

            <div class="form-group">
              <label for="motorista_id" class="py-2 text-xl capitalize">Motorista</label>
              <select name="motorista_id" id="motorista_id" class="px-4 py-1 w-full border rounded-lg text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-yellow-500">
                <option value="">Selecione um motorista</option>
                @foreach($motoristas as $motorista)
                <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                @endforeach
              </select>
            </div>

            <div class="flex justify-end py-6">
              <button type="submit" class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                Cadastrar Caminhão
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal de Edição -->
  <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
    <div class="bg-white w-1/2 max-h-[90vh] overflow-y-auto p-6 rounded-lg shadow-lg relative">
      <h2 class="text-2xl font-bold text-yellow-600 mb-4">Editar Caminhão</h2>

      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="edit_id">
        <div class="space-y-4">
          <div>
            <label for="edit_implemento" class="block font-medium">Implemento</label>
            <input type="text" name="implemento" id="edit_implemento" class="w-full border px-4 py-2 rounded text-gray-800 bg-white">
          </div>
          <div>
            <label for="edit_marca_modelo" class="block font-medium">Marca/Modelo</label>
            <input type="text" name="marca_modelo" id="edit_marca_modelo" class="w-full border px-4 py-2 rounded text-gray-800 bg-white">
          </div>
          <div>
            <label for="edit_ano" class="block font-medium">Ano</label>
            <input type="number" name="ano" id="edit_ano" class="w-full border px-4 py-2 rounded text-gray-800 bg-white">
          </div>
          <div>
            <label for="edit_numero_chassi" class="block font-medium">Número de Chassi</label>
            <input type="text" name="numero_chassi" id="edit_numero_chassi" class="w-full border px-4 py-2 rounded text-gray-800 bg-white">
          </div>
          <div>
            <label for="edit_placa" class="block font-medium">Placa</label>
            <input type="text" name="placa" id="edit_placa" class="w-full border px-4 py-2 rounded text-gray-800 bg-white">
          </div>
          <div>
            <label for="edit_cor" class="block font-medium">Cor</label>
            <input type="text" name="cor" id="edit_cor" class="w-full border px-4 py-2 rounded text-gray-800 bg-white">
          </div>
          <div>
            <label for="edit_motorista_id" class="block font-medium">Motorista</label>
            <select name="motorista_id" id="edit_motorista_id" class="w-full border px-4 py-2 rounded text-gray-800 bg-white">
              <option value="">Selecione um motorista</option>
              @foreach($motoristas as $motorista)
              <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label for="edit_status" class="block font-medium">Status</label>
            <select name="status" id="edit_status" class="w-full border px-4 py-2 rounded text-gray-800 bg-white">
              <option value="disponivel">Disponível</option>
              <option value="em_uso">Em Uso</option>
              <option value="manutencao">Manutenção</option>
            </select>
          </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
          <button
            type="button"
            onclick="closeEditModal()"
            class="text-red-600 border border-red-600 font-semibold px-6 py-2 rounded transition duration-200
           hover:bg-red-100 hover:border-red-700 hover:text-red-700
           active:bg-red-200 active:border-red-800">
            Sair
          </button>

          <button
            type="submit"
            class="bg-yellow-500 text-white font-semibold px-6 py-2 rounded transition duration-200
           hover:bg-yellow-600 active:bg-yellow-700">
            Salvar
          </button>
        </div>
      </form>
    </div>
  </div>

  <x-footer />

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const modal = document.getElementById('modal');
      const btnNovoCaminhao = document.getElementById('btn-novo-caminhao');
      const btnFiltrar = document.getElementById('btn-filtrar');
      const menuFiltro = document.getElementById('menu-filtro');
      const editModal = document.getElementById('editModal');
      const editForm = document.getElementById('editForm');

      // Abrir modal de novo caminhão
      btnNovoCaminhao.addEventListener('click', () => modal.classList.remove('hidden'));

      // Fechar modal ao clicar fora
      modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.add('hidden');
      });

      editModal.addEventListener('click', (e) => {
        if (e.target === editModal) editModal.classList.add('hidden');
      });

      // Menu filtro
      btnFiltrar.addEventListener('click', () => {
        menuFiltro.classList.toggle('hidden');
      });

      document.addEventListener('click', (e) => {
        if (!btnFiltrar.contains(e.target) && !menuFiltro.contains(e.target)) {
          menuFiltro.classList.add('hidden');
        }
      });

      // Envio do formulário de edição via AJAX
      editForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const id = document.getElementById('edit_id').value;
        const formData = new FormData(editForm);
        const token = formData.get('_token');
        const url = `/caminhoes/${id}`; // certifique-se que sua rota PUT está correta

        try {
          const response = await fetch(url, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': token,
              'Accept': 'application/json',
            },
            body: formData
          });

          if (response.ok) {
            alert('Caminhão atualizado com sucesso!');
            closeEditModal();
            location.reload(); // Atualiza a página de caminhões
          } else {
            const error = await response.json();
            console.error(error);
            alert('Erro ao salvar. Verifique os campos.');
          }
        } catch (error) {
          console.error(error);
          alert('Erro inesperado.');
        }
      });
    });

    function aplicarFiltro(tipo) {
      alert("Filtro aplicado: " + tipo);
    }

    function openEditModal(caminhao) {
      document.getElementById('edit_id').value = caminhao.id;
      document.getElementById('edit_implemento').value = caminhao.implemento;
      document.getElementById('edit_marca_modelo').value = caminhao.marca_modelo;
      document.getElementById('edit_ano').value = caminhao.ano;
      document.getElementById('edit_numero_chassi').value = caminhao.numero_chassi;
      document.getElementById('edit_placa').value = caminhao.placa;
      document.getElementById('edit_cor').value = caminhao.cor;
      document.getElementById('edit_motorista_id').value = caminhao.motorista_id || '';
      document.getElementById('edit_status').value = caminhao.status;
      document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
    }
  </script>


</body>

</html>