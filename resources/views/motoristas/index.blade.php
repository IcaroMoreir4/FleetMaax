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

        <!-- tabela -->
        <div class="w-full mt-6 overflow-auto rounded-lg">
          <table class="w-full text-left text-white text-xl">
            <thead class="bg-gray-900 font-bold">
              <tr>
                <th class="px-4 py-3">ID</th>
                <th class="px-4 py-3">Nome</th>
                <th class="px-4 py-3">CPF</th>
                <th class="px-4 py-3">CNH</th>
                <th class="px-4 py-3">Data de Cadastro</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-gray-100 divide-y divide-gray-400 text-gray-900">
              @foreach($motoristas as $motorista)
              <tr 
                onclick="window.location='{{ route('motoristas.show', $motorista->id) }}'"
                class="cursor-pointer hover:bg-gray-200 transition">
                <td class="px-4 py-3">{{ $motorista->id }}</td>
                <td class="px-4 py-3">{{ $motorista->nome_completo }}</td>
                <td class="px-4 py-3">{{ $motorista->cpf }}</td>
                <td class="px-4 py-3">{{ $motorista->cnh }}</td>
                <td class="px-4 py-3">{{ $motorista->created_at->format('d/m/Y') }}</td>
                <td class="px-4 py-3">
                  @if ($motorista->ativo)
                    <div class="bg-green-600 text-black font-bold rounded w-1/3 text-center">
                      Ativo
                    </div>
                  @else
                    <div class="bg-red-600 text-white font-bold rounded w-1/3 text-center">
                      Inativo
                    </div>
                  @endif
                </td>
                <td class="px-4 py-3">
                  <!-- Botões de ação aqui -->
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <x-table-browser />
        </div>
      </main>

      <!-- Novo Motorista Modal -->
      <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
        <div class="bg-gray-200 mx-6 my-10 w-1/2 h-[85%] overflow-auto rounded-lg shadow-lg">
          <div class="flex justify-between items-center m-6">
            <h1 class="text-yellow-500 text-5xl">Novo Motorista</h1>
            <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo" class="h-18" />
          </div>

          <div class="py-4 px-6">
            <form action="{{ route('motoristas.store') }}" method="POST">
              @csrf
              <div class="space-y-4">
                <div>
                  <label for="nome_completo" class="py-2 text-xl block">Nome completo</label>
                  <input type="text" name="nome_completo" id="nome_completo" placeholder="Nome completo"
                    class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="cpf" class="py-2 text-xl block">CPF</label>
                  <input type="text" name="cpf" id="cpf" placeholder="CPF"
                    class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="cnh" class="py-2 text-xl block">CNH</label>
                  <input type="text" name="cnh" id="cnh" placeholder="CNH"
                    class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="data_nascimento" class="py-2 text-xl block">Data de Nascimento</label>
                  <input type="date" name="data_nascimento" id="data_nascimento" placeholder="Data de Nascimento"
                    class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="email" class="py-2 text-xl block">E-mail</label>
                  <input type="email" name="email" id="email" placeholder="E-mail"
                    class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="telefone" class="py-2 text-xl block">Telefone</label>
                  <input type="tel" name="telefone" id="telefone" placeholder="(XX) XXXXX-XXXX" maxlength="15"
                    class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="data_admissao" class="py-2 text-xl block">Data de Admissão</label>
                  <input type="date" name="data_admissao" id="data_admissao" placeholder="Data de Admissão"
                    class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>

                <div>
                  <label for="ativo" class="py-2 text-xl block">Status</label>
                  <select name="ativo" id="ativo"
                    class="px-4 py-1 w-full border rounded-lg text-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                  </select>
                </div>
              </div>

              <div class="flex justify-end py-16">
                <button type="submit"
                  class="bg-yellow-500 text-xl rounded-full w-60 py-3 px-4 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                  Novo Motorista
                </button>
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
  </script>
</body>

</html>
