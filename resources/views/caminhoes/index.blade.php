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
    <!-- Sidebar -->
    <x-sidebar />

    <div id="main-header" class="flex flex-col flex-1 ml-20">
      <x-header />

      <!-- Conteúdo Principal -->
      <main class="flex-1 p-4">
        <!-- Container do título e botões -->
        <div class="flex items-center justify-between bg-gray-800 p-4 rounded-lg">
          <!-- Título com detalhe lateral -->
          <div class="flex items-center space-x-3">
            <span class="w-1 h-12 bg-gradient-to-b from-yellow-500 to-emerald-300"></span>
            <h1 class="text-white text-5xl">Caminhões</h1>
          </div>

          <!-- Botões -->
          <div class="flex space-x-4">
            <!-- Botão Filtrar -->
            <div class="relative">
              <button id="btn-filtrar" class="bg-yellow-500 hover:bg-yellow-700 text-slate-800 font-bold py-2 px-4 border border-yellow-700 rounded flex items-center">
                <i class="fas fa-filter mr-2"></i> Filtrar <i class="fas fa-chevron-down ml-2"></i>
              </button>
              <div id="menu-filtro" class="absolute hidden bg-gray-700 text-white rounded mt-2 w-48 shadow-lg">
                <button class="block w-full text-left px-4 py-2 hover:bg-gray-600">Placa</button>
                <button class="block w-full text-left px-4 py-2 hover:bg-gray-600">Implemento</button>
                <button class="block w-full text-left px-4 py-2 hover:bg-gray-600">Motorista</button>
              </div>
            </div>

            <!-- Botão Novo Caminhão -->
            <button id="btn-novo-caminhao" class="bg-yellow-500 hover:bg-yellow-700 text-slate-800 font-bold py-2 px-4 border border-yellow-700 rounded">
              Novo Caminhão +
            </button>
          </div>
        </div>

        <!-- Tabela -->
        <div class="max-w-full">
          <div class="grid grid-cols-5 bg-gray-900 text-white text-xl font-bold p-3">
            <p>ID</p>
            <p>Motorista</p>
            <p>Placa</p>
            <p>Implemento</p>
            <p>Numeração do Veículo</p>
          </div>

          <div class="bg-gray-100 divide-y divide-gray-400">
            <div class="grid grid-cols-5 p-2 text-gray-800 bg-gray-300">
              <p>#1010</p>
              <p>Manoel Francisco</p>
              <p>BRA3R20</p>
              <p>Cavalo Mecânico</p>
              <p>245546564565347</p>
            </div>

            <div class="grid grid-cols-5 p-2 text-gray-800 bg-white">
              <p>#1011</p>
              <p>José da Silva</p>
              <p>XYZ1A23</p>
              <p>Carreta Baú</p>
              <p>123456789012345</p>
            </div>

            <div class="grid grid-cols-5 p-2 text-gray-800  bg-gray-300">
              <p>#1011</p>
              <p>José da Silva</p>
              <p>XYZ1A23</p>
              <p>Carreta Baú</p>
              <p>123456789012345</p>
            </div>

            <div class="grid grid-cols-5 p-2 text-gray-800 bg-white">
              <p>#1011</p>
              <p>José da Silva</p>
              <p>XYZ1A23</p>
              <p>Carreta Baú</p>
              <p>123456789012345</p>
            </div>

            <div class="grid grid-cols-5 p-2 text-gray-800  bg-gray-300">
              <p>#1011</p>
              <p>José da Silva</p>
              <p>XYZ1A23</p>
              <p>Carreta Baú</p>
              <p>123456789012345</p>
            </div>

            <div class="grid grid-cols-5 p-2 text-gray-800 bg-white">
              <p>#1011</p>
              <p>José da Silva</p>
              <p>XYZ1A23</p>
              <p>Carreta Baú</p>
              <p>123456789012345</p>
            </div>

            <div class="grid grid-cols-5 p-2 text-gray-800  bg-gray-300">
              <p>#1011</p>
              <p>José da Silva</p>
              <p>XYZ1A23</p>
              <p>Carreta Baú</p>
              <p>123456789012345</p>
            </div>

            <div class="grid grid-cols-5 p-2 text-gray-800 bg-white">
              <p>#1011</p>
              <p>José da Silva</p>
              <p>XYZ1A23</p>
              <p>Carreta Baú</p>
              <p>123456789012345</p>
            </div>
          
            </div>
        </div>
        <x-table-browser />
      </main>
    </div>
  </div>

 <!-- Modal - Novo Caminhão -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
  <div class="bg-gray-200 mx-6 my-10 w-1/2 h-[85%] p-6 rounded-lg shadow-lg">
    <div class="flex justify-between">
      <h1 class="text-yellow-500 text-5xl">Novo Caminhão</h1>
      <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo" class="h-18">
    </div>

    <div class="py-4">
      <form action="" method="post">
        <div class="space-y-4">
          <div>
            <label for="implemento" class="py-2 text-xl">Implemento</label>
            <input type="text" name="implemento" id="implemento" placeholder="Implemento" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
          <div>
            <label for="marca_modelo" class="py-2 text-xl">Marca/Modelo</label>
            <input type="text" name="marca_modelo" id="marca_modelo" placeholder="Marca/Modelo" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
          <div>
            <label for="ano" class="py-2 text-xl">Ano</label>
            <input type="text" name="ano" id="ano" placeholder="Ano" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
          <div>
            <label for="numero_chassi" class="py-2 text-xl">Número de Chassi</label>
            <input type="text" name="numero_chassi" id="numero_chassi" placeholder="Número de Chassi" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
          <div>
            <label for="placa" class="py-2 text-xl">Placa</label>
            <input type="text" name="placa" id="placa" placeholder="Placa" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
          <div>
            <label for="cor" class="py-2 text-xl">Cor</label>
            <input type="text" name="cor" id="cor" placeholder="Cor" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
          <div>
            <label for="nome_motorista" class="py-2 text-xl">Nome do Motorista</label>
            <input type="text" name="nome_motorista" id="nome_motorista" placeholder="Nome do Motorista" class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
          </div>
        </div>

        <div class="flex justify-end py-6">
          <button type="submit" class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            Novo Caminhão
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

  <!-- Footer -->
  <x-footer />

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const modal = document.getElementById('modal');
      const btnNovoCaminhao = document.getElementById('btn-novo-caminhao');
      const btnFiltrar = document.getElementById('btn-filtrar');
      const menuFiltro = document.getElementById('menu-filtro');

      // Abrir o modal ao clicar no botão
      btnNovoCaminhao.addEventListener('click', () => {
        modal.classList.remove('hidden');
      });

      // Fechar o modal ao clicar fora da caixa
      modal.addEventListener('click', (e) => {
        if (e.target === modal) {
          modal.classList.add('hidden');
        }
      });

      // Toggle do menu de filtro
      btnFiltrar.addEventListener('click', () => {
        menuFiltro.classList.toggle('hidden');
      });

      // Fechar menu se clicar fora
      document.addEventListener('click', (e) => {
        if (!btnFiltrar.contains(e.target) && !menuFiltro.contains(e.target)) {
          menuFiltro.classList.add('hidden');
        }
      });
    });
  </script>

</body>
</html>
