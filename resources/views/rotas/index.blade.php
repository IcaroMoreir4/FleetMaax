<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotas</title>
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
                        <h1 class="text-white text-5xl">Rotas</h1>
                    </div>

                    <!-- Botão alinhado à direita -->
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-slate-800 font-bold py-2 px-4 border border-yellow-700 rounded">
                        Nova Rota +
                    </button>
                </div>

                <!-- Tabela -->
                <div class="max-w-full">
                    <div class="grid grid-cols-7 bg-gray-900 text-white text-xl font-bold p-3">
                        <p>ID</p>
                        <p>UF</p>
                        <p>Cidade</p>
                        <p>Bairro</p>
                        <p>Endereço</p>
                        <p>Distância</p>
                        <p>Ações</p>
                    </div>

                    <!-- Dados da Tabela -->
                    <div class="bg-gray-100 divide-y divide-gray-400">
                        <div class="grid grid-cols-7 p-2 text-gray-800 bg-gray-300">
                            <p>#1010</p>
                            <p>CE</p>
                            <p>Crato</p>
                            <p>São Miguel</p>
                            <p>Rua Chiquinha Macedo</p>
                            <p>520km</p>
                            <button class="bg-yellow-500 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-yellow-700 active:scale-95 shadow-md hover:shadow-lg">
                                Detalhada
                            </button>
                        </div>

                        <div class="grid grid-cols-7 p-2 text-gray-800 bg-gray-300">
                            <p>#1010</p>
                            <p>CE</p>
                            <p>Crato</p>
                            <p>São Miguel</p>
                            <p>Rua Chiquinha Macedo</p>
                            <p>520km</p>
                            <button class="bg-yellow-500 text-white font-bold rounded w-1/3 text-center transition-all duration-300 ease-in-out transform hover:scale-105 hover:bg-yellow-700 active:scale-95 shadow-md hover:shadow-lg">
                                Detalhada
                            </button>
                        </div>
                    </div>

                    <x-table-browser />
                </div>
            </main>
        </div>
    </div>


    <!-- Nova Rota -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-700/80 hidden z-50">
        <div class="bg-gray-200 w-full max-w-3xl h-[80vh] max-h-[90vh] mx-4 p-6 rounded-lg shadow-lg overflow-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-yellow-500 text-3xl sm:text-4xl md:text-5xl">Nova Rota</h1>
                <img src="{{ asset('assets/images/logoModal.png') }}" alt="Logo" class="h-14 md:h-18">
            </div>

            <form action="" method="post">
                <div class="space-y-4">
                    <div>
                        <label for="uf" class="block text-xl mb-1">UF</label>
                        <input type="text" name="uf" id="uf" placeholder="UF" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div>
                        <label for="cidade" class="block text-xl mb-1">Cidade</label>
                        <input type="text" name="cidade" id="cidade" placeholder="Cidade" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div>
                        <label for="bairro" class="block text-xl mb-1">Bairro</label>
                        <input type="text" name="bairro" id="bairro" placeholder="Bairro" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div>
                        <label for="endereco" class="block text-xl mb-1">Endereço</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Endereço" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div>
                        <label for="origem" class="block text-xl mb-1">Origem</label>
                        <input type="text" name="origem" id="origem" placeholder="Origem" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                    <div>
                        <label for="distancia" class="block text-xl mb-1">Distância</label>
                        <input type="text" name="distancia" id="distancia" placeholder="Distância" class="px-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    </div>
                </div>

                <div class="flex justify-end pt-10">
                    <button type="submit" class="bg-yellow-500 text-xl rounded-full w-full sm:w-60 py-3 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        Cadastrar Rota
                    </button>
                </div>
            </form>
        </div>
    </div>







    <!-- Footer -->
    <x-footer />


    <script>
        // Obter elementos do formulario e do botão
        const modal = document.getElementById('modal');
        const btnNovaRota = document.querySelector('button.bg-yellow-500'); // O botão "Nova Rota"

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