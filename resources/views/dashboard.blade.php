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

<body class="bg-slate-900 min-h-screen flex flex-col">
  <div class="relative flex flex-1">
    <!-- Sidebar -->
    <x-sidebar />

    <div id="main-header" class="flex flex-col flex-1 ml-20">
      <x-header />

      <!-- Conteúdo Principal -->
      <main class="flex-1 p-8 max-w-7xl mx-auto">
        <picture class="flex justify-center mb-12">
          <img class="max-w-full h-auto" src="{{ asset('assets/images/bgDashBoard.png') }}" alt="Dashboard Background">
        </picture>

        <!-- Estatísticas de Motoristas -->
        <div class="mb-12">
          <h2 class="text-2xl font-bold text-white mb-6">Motoristas</h2>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
              <i class="fas fa-file-alt text-4xl text-slate-800 mb-4"></i>
              <p class="text-slate-800 text-xl font-bold"><span class="text-yellow-500" data-stat="motoristas_ativos">{{ $motoristas_ativos }}</span> Ativos</p>
              <p class="text-slate-600 text-sm mt-2">Total: <span data-stat="total_motoristas">{{ $total_motoristas }}</span></p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
              <i class="fas fa-route text-4xl text-slate-800 mb-4"></i>
              <p class="text-slate-800 text-xl font-bold"><span class="text-yellow-500" data-stat="motoristas_em_rota">{{ $motoristas_em_rota }}</span> Em rota</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
              <i class="fas fa-map-marked-alt text-4xl text-slate-800 mb-4"></i>
              <p class="text-slate-800 text-xl font-bold"><span class="text-yellow-500" data-stat="motoristas_retornando">{{ $motoristas_retornando }}</span> Retornando</p>
            </div>
          </div>
        </div>

        <!-- Estatísticas de Veículos -->
        <div class="mb-12">
          <h2 class="text-2xl font-bold text-white mb-6">Veículos</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
              <i class="fas fa-truck text-4xl text-slate-800 mb-4"></i>
              <p class="text-slate-800 text-xl font-bold"><span class="text-yellow-500" data-stat="veiculos_livres">{{ $veiculos_livres }}</span> Livres</p>
              <p class="text-slate-600 text-sm mt-2">Total: <span data-stat="total_veiculos">{{ $total_veiculos }}</span></p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
              <i class="fas fa-truck-loading text-4xl text-slate-800 mb-4"></i>
              <p class="text-slate-800 text-xl font-bold"><span class="text-yellow-500" data-stat="veiculos_em_uso">{{ $veiculos_em_uso }}</span> Em uso</p>
            </div>
          </div>
        </div>

        <!-- Estatísticas de Rotas -->
        <div>
          <h2 class="text-2xl font-bold text-white mb-6">Rotas</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
              <i class="fas fa-calendar-day text-4xl text-slate-800 mb-4"></i>
              <p class="text-slate-800 text-xl font-bold"><span class="text-yellow-500" data-stat="rotas_hoje">{{ $rotas_hoje }}</span> Hoje</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
              <i class="fas fa-route text-4xl text-slate-800 mb-4"></i>
              <p class="text-slate-800 text-xl font-bold"><span class="text-yellow-500" data-stat="rotas_em_andamento">{{ $rotas_em_andamento }}</span> Em andamento</p>
              <p class="text-slate-600 text-sm mt-2">Total: <span data-stat="total_rotas">{{ $total_rotas }}</span></p>
            </div>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- Footer -->
  <x-footer />

  <script>
    // Função para atualizar os dados do dashboard
    function atualizarDashboard() {
      fetch('/dashboard/data')
        .then(response => response.json())
        .then(data => {
          // Atualiza cada número no dashboard
          Object.entries(data).forEach(([key, value]) => {
            const element = document.querySelector(`[data-stat="${key}"]`);
            if (element && element.textContent !== value.toString()) {
              element.textContent = value;
              // Adiciona uma animação de atualização
              element.classList.add('animate-pulse');
              setTimeout(() => element.classList.remove('animate-pulse'), 1000);
            }
          });
        })
        .catch(error => console.error('Erro ao atualizar dashboard:', error));
    }

    // Atualiza o dashboard a cada 30 segundos
    setInterval(atualizarDashboard, 30000);
  </script>
</body>

</html>