<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
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
          <h1 class="text-white text-5xl">Motoristas</h1>
        </div>

        <!-- tabela -->
        <div class="max-w-full">
          <div class="grid grid-cols-7 bg-gray-900 text-white text-xl font-bold p-3">
            <p>ID</p>
            <p>Nome</p>
            <p>CPF</p>
            <p>CNH</p>
            <p>Data de Cadastro</p>
            <p>Ações</p>
          </div>

          <div class="bg-gray-100 divide-y divide-gray-400">
            <div class="grid grid-cols-7 p-2 text-gray-800 bg-gray-300">
              <p>#1010</p>
              <p>Manoel Francisco</p>
              <p>049.787.367-22</p>
              <p class="text-blue-500 hover:text-blue-800 cursor-pointer">Visualize a CNH</p>
              <p>16/02/1997</p>
              
              <button class="bg-lime-500 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-lime-900 active:scale-95 shadow-md hover:shadow-lg">
                Ativo
              </button>
            </div>
            <div class="grid grid-cols-7 p-2 text-gray-800 bg-white">
              <p>#1212</p>
              <p>João Batista</p>
              <p>603.194.884-20</p>
              <p class="text-blue-500 hover:text-blue-800 cursor-pointer">Visualize a CNH</p>
              <p>02/10/2001</p>
              
              <button class="bg-lime-500 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-lime-900 active:scale-95 shadow-md hover:shadow-lg">
                Ativo
              </button>
            </div>

            <div class="grid grid-cols-7 p-2 text-gray-800 bg-gray-300">
              <p>#1414</p>
              <p>Carlos Alberto</p>
              <p>186.962.414-95</p>
              <p class="text-blue-500 hover:text-blue-800 cursor-pointer">Visualize a CNH</p>
              <p>09/11/2005</p>
              
              <button class="bg-red-600 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-red-800 active:scale-95 shadow-md hover:shadow-lg">
                Inativo
              </button>
            </div>

            <div class="grid grid-cols-7 p-2 text-gray-800 bg-white">
              <p>#1515</p>
              <p>Antônio Ferreira</p>
              <p>626.343.534-80</p>
              <p class="text-blue-500 hover:text-blue-800 cursor-pointer">Visualize a CNH</p>
              <p>25/11/2014</p>
              
              <button class="bg-red-600 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-red-800 active:scale-95 shadow-md hover:shadow-lg">
                Inativo
              </button>
            </div>

            <div class="grid grid-cols-7 p-2 text-gray-800 bg-gray-300">
              <p>#1717</p>
              <p>Luiz Teixeira</p>
              <p>959.678.342-49</p>
              <p class="text-blue-500 hover:text-blue-800 cursor-pointer">Visualize a CNH</p>
              <p>02/02/2023</p>
              
              <button class="bg-red-600 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-red-800 active:scale-95 shadow-md hover:shadow-lg">
                Inativo
              </button>
            </div>

            <div class="grid grid-cols-7 p-2 text-gray-800 bg-white">
              <p>#1818</p>
              <p>Paulo José</p>
              <p>076.754.367-77</p>
              <p class="text-blue-500 hover:text-blue-800 cursor-pointer">Visualize a CNH</p>
              <p>25/11/2014</p>
              
              <button class="bg-lime-500 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-lime-900 active:scale-95 shadow-md hover:shadow-lg">
                Ativo
              </button>
            </div>
            <div class="grid grid-cols-7 p-2 text-gray-800 bg-gray-300">
              <p>#1010</p>
              <p>Manoel Francisco</p>
              <p>186.962.414-95</p>
              <p class="text-blue-500 hover:text-blue-800 cursor-pointer">Visualize a CNH</p>
              <p>09/11/2005</p>
            
              <button class="bg-lime-500 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-lime-900 active:scale-95 shadow-md hover:shadow-lg">
                Ativo
              </button>
            </div>

            <div class="grid grid-cols-7 p-2 text-gray-800 bg-white">
              <p>#1010</p>
              <p>Manoel Francisco</p>
              <p>626.343.534-80</p>
              <p class="text-blue-500 hover:text-blue-800 cursor-pointer">Visualize a CNH</p>
              <p>16/02/1997</p>
              
              <button class="bg-lime-500 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-lime-900 active:scale-95 shadow-md hover:shadow-lg">
                Ativo
              </button>
            </div>


          </div>
        </div>

        <!-- Navegação entre tabelas -->
        <div class="inline-flex items-center border border-gray-400 rounded-lg overflow-hidden shadow-md bg-white mt-4">
          <!-- Botão Anterior -->
          <button class="px-4 py-2 border-r border-gray-400 text-black flex items-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-200 active:scale-95 hover:text-yellow-500 hover:font-bold">
            <i class="fas fa-chevron-left mr-2"></i> Anterior
          </button>

          <!-- Páginas -->
          <button class="px-4 py-2 border-r border-gray-400 text-black transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-200 active:scale-95 hover:text-yellow-500 hover:font-bold">
            1
          </button>
          <button class="px-4 py-2 border-r border-gray-400 text-black transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-200 active:scale-95 hover:text-yellow-500 hover:font-bold">
            2
          </button>
          <button class="px-4 py-2 border-r border-gray-400 text-black transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-200 active:scale-95 hover:text-yellow-500 hover:font-bold">
            3
          </button>

          <!-- Botão Próximo -->
          <button class="px-4 py-2 text-black flex items-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-gray-200 active:scale-95 hover:text-yellow-500 hover:font-bold">
            Próximo <i class="fas fa-chevron-right ml-2"></i>
          </button>
        </div>


      </main>
    </div>
  </div>

  <!-- Footer -->
  <x-footer />
</body>

</html>