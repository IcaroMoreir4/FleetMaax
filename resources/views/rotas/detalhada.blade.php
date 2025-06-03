<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rota Detalhada</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

        <!-- titulo com detalhe do lado -->
        <div class="flex items-center space-x-3 bg-gray-900 p-4 rounded-lg">
          <span class="w-1 h-12 bg-gradient-to-b from-yellow-500 to-emerald-300"></span>
          <h1 class="text-white text-5xl">Rota Detalhada</h1>
        </div>

        <!-- Container Principal -->
        <div class="bg-white p-6 my-10 shadow-lg max-w-full">
          <!-- Formulário de Informações -->
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="text-2xl">Motorista:</label>
              <input type="text" class="border border-gray-400 rounded w-full px-2 py-1" placeholder="Nome do motorista">
            </div>
            <div>
              <label class="text-2xl">Veículo:</label>
              <input type="text" class="border border-gray-400 rounded w-full px-2 py-1" placeholder="Modelo do veículo">
            </div>
            <div>
              <label class="text-2xl">Origem:</label>
              <input type="text" class="border border-gray-400 rounded w-full px-2 py-1" placeholder="Cidade-Estado / Av./Rua">
            </div>
            <!-- Feito apenas para manter o proximo item do lado direito -->
            <div>
              <span class="w-full px-2 py-1">
            </div>
            <div class="flex mt-4 gap-4">
              <label class="text-2xl">Saída</label>
              <input type="time" class="border border-gray-400 rounded px-2 py-1 w-24 mr-10">
              <label class="text-2xl">Chegada</label>
              <input type="time" class="border border-gray-400 rounded px-2 py-1 w-24">
            </div>
          </div>

          <!-- Tabela -->
          <div class="max-w-full py-8">
            <div class="grid grid-cols-6 bg-gray-900 text-white text-xl font-bold p-3">
              <p>ID</p>
              <p>UF</p>
              <p>Cidade</p>
              <p>Bairro</p>
              <p>Endereço</p>
              <p>Distância</p>
            </div>

            <!-- Dados da Tabela -->
            <div class="bg-gray-100 divide-y divide-gray-400">
              <div class="grid grid-cols-6 p-2 text-gray-800 bg-gray-300">
                <p>#1010</p>
                <p>CE</p>
                <p>Crato</p>
                <p>São Miguel</p>
                <p>Rua Chiquinha Macedo</p>
                <p>520km</p>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- Footer -->
  <x-footer />
</body>

</html>