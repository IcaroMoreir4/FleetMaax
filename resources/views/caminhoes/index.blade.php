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

<body class="bg-slate-800 h-screen flex flex-col">
  <div class="relative flex flex-1">
    <x-sidebar />

    <div id="main-header" class="flex flex-col flex-1 ml-20">
      <x-header />

      <main class="flex-1 p-4">
        <div class="flex items-center justify-between bg-gray-800 p-4 rounded-lg">
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
                <button class="block w-full text-left px-4 py-2 hover:bg-gray-600">Placa</button>
                <button class="block w-full text-left px-4 py-2 hover:bg-gray-600">Implemento</button>
                <button class="block w-full text-left px-4 py-2 hover:bg-gray-600">Motorista</button>
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
              </tr>
            </thead>
            <tbody class="bg-gray-100 divide-y divide-gray-400 text-gray-900">
              @foreach($caminhoes as $caminhao)
              <tr 
                onclick="window.location='{{ route('caminhoes.show', $caminhao->id) }}'"
                class="cursor-pointer hover:bg-gray-200 transition"
              >
                <td class="px-4 py-3">{{ $caminhao->implemento }}</td>
                <td class="px-4 py-3">{{ $caminhao->marca_modelo }}</td>
                <td class="px-4 py-3">{{ $caminhao->ano }}</td>
                <td class="px-4 py-3">{{ $caminhao->numero_chassi }}</td>
                <td class="px-4 py-3">{{ $caminhao->placa }}</td>
                <td class="px-4 py-3">{{ $caminhao->cor }}</td>
                <td class="px-4 py-3">{{ $caminhao->motorista?->nome_completo ?? 'Sem motorista' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <x-table-browser />
        </div>
      </main>

    </div>
  </div>

  <!-- Modal - Novo Caminhão -->
  <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
    <div class="bg-gray-200 mx-6 my-10 w-1/2 max-h-[90vh] overflow-y-auto p-6 rounded-lg shadow-lg">
      <div class="flex justify-between items-center">
        <h1 class="text-yellow-500 text-5xl">Novo Caminhão</h1>
        <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo da empresa" class="h-18">
      </div>

      <div class="py-4">
        <form action="{{ route('caminhoes.store')}}" method="post">
          @csrf
            <div class="space-y-4">
              <!-- Inputs fixos -->
              @foreach(['implemento', 'marca_modelo', 'ano', 'numero_chassi', 'placa', 'cor'] as $field)
              <div>
                <label for="{{ $field }}" class="py-2 text-xl capitalize">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                <input type="text" name="{{ $field }}" id="{{ $field }}" placeholder="{{ ucwords(str_replace('_', ' ', $field)) }}"
                  class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
              </div>
              @endforeach

              <!-- Select motorista -->
              <div class="form-group">
                <label for="motorista_id" class="py-2 text-xl capitalize">Motorista</label>
                <select name="motorista_id" id="motorista_id" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                  <option value="">Selecione um motorista</option>
                  @foreach($motoristas as $motorista)
                    <option value="{{ $motorista->id }}">{{ $motorista->nome_completo }}</option>
                  @endforeach
                </select>
              </div>
              <div class="flex justify-end py-6">
                <button type="submit" class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                  Novo Caminhão
                </button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>

  <x-footer />

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const modal = document.getElementById('modal');
      const btnNovoCaminhao = document.getElementById('btn-novo-caminhao');
      const btnFiltrar = document.getElementById('btn-filtrar');
      const menuFiltro = document.getElementById('menu-filtro');

      btnNovoCaminhao.addEventListener('click', () => {
        modal.classList.remove('hidden');
      });

      modal.addEventListener('click', (e) => {
        if (e.target === modal) {
          modal.classList.add('hidden');
        }
      });

      btnFiltrar.addEventListener('click', () => {
        menuFiltro.classList.toggle('hidden');
      });

      document.addEventListener('click', (e) => {
        if (!btnFiltrar.contains(e.target) && !menuFiltro.contains(e.target)) {
          menuFiltro.classList.add('hidden');
        }
      });
    });
  </script>
</body>
</html>
