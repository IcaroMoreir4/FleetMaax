<footer class="bg-yellow-500 w-full p-5">
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 justify-items-center gap-4 text-slate-900">
    <div class="p-4">
      <img src="{{ asset('assets/images/logoFooter.png') }}" alt="">
    </div>

    <div class="p-4">
      <h1 class="inline-block text-xl font-medium relative mb-4">
        Gestão de Frota
        <span class="absolute inset-x-0 mx-auto left-0 -bottom-0.5 w-full h-0.5 bg-white"></span>
      </h1>
      <ul class="grid gap-2">
        <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="{{ route('dashboard') }}">
          <li>DashBoard</li>
        </a>
        <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="{{ route('relatorios') }}">
          <li>Relatórios</li>
        </a>
      </ul>
    </div>

    <div class=" p-4">
      <h1 class="inline-block text-xl font-medium relative mb-4">
        Veículos e motorista
        <span class="absolute inset-x-0 mx-auto left-0 -bottom-0.5 w-full h-0.5 bg-white"></span>
      </h1>
      <ul class="grid gap-2">
        <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="{{ route('caminhoes.index') }}">
          <li>Caminhões</li>
        </a>
        <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="{{ route('motoristas.index') }}">
          <li>Motoristas</li>
        </a>
        <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="{{ route('rotas') }}">
          <li>Rotas</li>
        </a>
      </ul>
    </div>

    <div class="p-4">
      <h1 class="inline-block text-xl font-medium relative mb-4">
        Suporte e contato
        <span class="absolute inset-x-0 mx-auto left-0 -bottom-0.5 w-full h-0.5 bg-white"></span>
      </h1>
      <ul class="grid gap-2">
        <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="#">
          <li>FAQ</li>
        </a>
        <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="#">
          <li>Termos de Uso</li>
        </a>
        <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="#">
          <li>Política de Privacidade</li>
        </a>
        <a class="hover:text-slate-900 transition-all duration-300 ease-in-out hover:translate-x-1 text-purple-900 hover:underline" href="mailto:suporte@fleetmax.com">
          <li>suporte@fleetmax.com</li>
        </a>
      </ul>
    </div>
  </div>

  <div class="text-right text-slate-900 mt-4 p-4">
    <p>FleetMax © Alguns direitos reservados. 2025</p>
  </div>
</footer>