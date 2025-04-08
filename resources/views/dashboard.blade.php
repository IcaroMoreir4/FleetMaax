<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DashBoard</title>
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
      <main class="flex-1 p-4 grid items-center justify-items-center">
        <picture class="grid items-center justify-center w-full">
          <img class="w-[120rem]" src="{{ asset('assets/images/bgDashBoard.png') }}" alt="">
        </picture>

        <div class="flex justify-center gap-8 mb-16 w-[100rem] mt-8">

          <div class="bg-white p-3 rounded shadow-2xs w-full min-h-full">
            <i class="fas fa-file-alt text-4xl text-slate-800 mb-10"></i>
            <p class="text-slate-800 text-2xl font-bold"><span class="text-yellow-500">150</span> Motoristas ativos</p>
          </div>

          <div class="bg-white p-3 rounded shadow-2xs w-full min-h-full">
            <i class="fas fa-route text-4xl text-slate-800 mb-10"></i>
            <p class="text-slate-800 text-2xl font-bold"><span class="text-yellow-500">70</span> Motoristas em
              rota</p>
          </div>

          <div class="bg-white p-3 rounded shadow-2xs w-full min-h-full">
            <i class="fas fa-truck text-4xl text-slate-800 mb-10"></i>
            <p class="text-slate-800 text-2xl font-bold"><span class="text-yellow-500">98</span> Veículos livres</p>
          </div>

          <div class="bg-white p-3 rounded shadow-2xs w-full min-h-full">
            <i class="fas fa-map-marked-alt text-4xl text-slate-800 mb-10"></i>
            <p class="text-slate-800 text-2xl font-bold"><span class="text-yellow-500">80</span> Motoristas retornando</p>
          </div>

        </div>

      </main>
    </div>
  </div>

  <!-- Footer -->
  <x-footer />
</body>

</html>