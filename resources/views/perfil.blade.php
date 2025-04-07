<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
    @vite(['resources/js/app.js'])
</head>

<body class="bg-slate-900 h-screen flex flex-col">
    <div class="relative flex flex-1">
        <!-- Sidebar -->
        <x-sidebar />

        <div id="main-header" class="flex flex-col flex-1 ml-20">
            <!-- Header -->
            <x-header />

            <!-- Conteúdo Principal -->
            <main class="flex flex-col flex-1 ml-20">
                <!-- Título -->
                <div class="flex items-center space-x-3 bg-gray-900 p-4 rounded-lg">
                    <span class="w-1 h-12 bg-gradient-to-b from-yellow-500 to-emerald-300"></span>
                    <h1 class="text-white text-5xl">Perfil</h1>
                </div>

                <!-- Perfil -->
                <div class="bg-yellow-500 flex mr-8">
                    <img src="{{ asset('assets/images/logoPerfil.png') }}" alt="Foto de Perfil" class="w-38 h-38 mx-10 my-10">
                    <h2 class="text-white text-5xl flex items-end my-10">LYSI TECH</h2>
                </div>

                <!-- Informações Adicionais -->
                <div>
                    <h2 class="text-yellow-500 text-4xl my-6">Informações Adicionais</h2>
                    <div class="">
                        <form action="" class="grid grid-cols-1 gap-4">
                            <div class="flex justify-between w-100 my-1">
                                <label class="text-white text-xl">CNPJ:</label>
                                <input type="text" class="border-1 border-white w-70">
                            </div>
                            <div class="flex justify-between w-100 my-1">
                                <label class="text-white text-xl ">Razão Social:</label>
                                <input type="text" class="border-1 border-white w-70">
                            </div>
                            <div class="flex justify-between w-100 my-1">
                                <label class="text-white text-xl">E-mail:</label>
                                <input type="email" class="border-1 border-white w-70">
                            </div>
                            <div class="flex justify-between w-100 my-1">
                                <label class="text-white text-xl">Senha:</label>
                                <input type="password" class="border-1 border-white w-70">
                            </div>
                            <div class="flex justify-end mr-8 my-8">
                                <button type="button" class="bg-yellow-500 text-xl rounded-md  w-40 py-2 px-4 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">Editar <i class="fa-solid fa-pen"></i></button>
                                <button type="submit" class="bg-yellow-500 text-xl rounded-md w-40 py-2 px-4 ml-5 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />
</body>

</html>
