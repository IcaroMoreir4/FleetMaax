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

        <x-table-browser />


      </main>
    </div>
  </div>



  <!-- Novo Motorista -->
  <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
    <div class="bg-gray-200 w-full max-w-3xl h-[85vh] max-h-[90vh] mx-4 rounded-lg overflow-auto">
      <div class="flex justify-between items-center p-6">
        <h1 class="text-yellow-500 text-3xl sm:text-4xl md:text-5xl">Novo Motorista</h1>
        <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo" class="h-14 md:h-18">
      </div>

      <div class="py-4">
        <form action="" method="post">
          <div class="space-y-4 px-6">
            <div>
              <label for="nome_completo" class="block text-xl mb-1">Nome completo</label>
              <input type="text" name="nome_completo" id="nome_completo" placeholder="Nome completo" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
              <label for="cpf" class="block text-xl mb-1">CPF</label>
              <input type="text" name="cpf" id="cpf" placeholder="CPF" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
              <label for="cnh" class="block text-xl mb-1">CNH</label>
              <input type="text" name="cnh" id="cnh" placeholder="CNH" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
              <label for="data_nascimento" class="block text-xl mb-1">Data de Nascimento</label>
              <input type="date" name="data_nascimento" id="data_nascimento" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
              <label for="email" class="block text-xl mb-1">E-mail</label>
              <input type="email" name="email" id="email" placeholder="E-mail" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
            <div>
              <label for="telefone" class="block text-xl mb-1">Telefone</label>
              <input type="tel" name="telefone" id="telefone" placeholder="(XX) XXXXX-XXXX" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500" maxlength="15">
            </div>
            <div>
              <label for="data_admissao" class="block text-xl mb-1">Data de Admissão</label>
              <input type="date" name="data_admissao" id="data_admissao" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
            </div>
          </div>

          <div class="flex justify-end p-6">
            <button type="submit" class="bg-yellow-500 text-xl rounded-full w-full sm:w-60 py-3 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">Novo Motorista</button>
          </div>
        </form>
      </div>
    </div>
  </div>




  <!-- Footer -->
  <x-footer />


  <script>
    // Obter elementos do formulario e do botão
    const modal = document.getElementById('modal');
    const btnNovaRota = document.querySelector('button.bg-yellow-500'); // O botão "Novo Motorista"

    // Função para abrir o formulario
    btnNovaRota.addEventListener('click', () => {
      modal.classList.remove('hidden');
    });

    // Fechar o formulario clicando fora da área
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.add('hidden');
      }
    });
  </script>

</body>

</html>