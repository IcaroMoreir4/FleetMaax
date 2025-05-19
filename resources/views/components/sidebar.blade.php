<aside id="sidebar" class="fixed top-0 left-0 bottom-0 w-20 bg-yellow-500 flex flex-col items-center transition-all duration-500 overflow-hidden">
    <img id="sidebar-logo" class="w-14 py-3" src="{{ asset('assets/images/logoSideBar.svg') }}" alt="">

    <nav class="mt-24">
        <div class="flex items-center text-3xl text-gray-800 flex-col gap-8">
            <i id="menu-toggle" class="fas fa-bars text-white cursor-pointer hover:scale-125 hover:text-gray-500 transition-all duration-300"></i>

            <a class="hover:translate-x-1 hover:text-gray-500" href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a>
            <a class="hover:translate-x-1 hover:text-gray-500" href="{{ route('relatorios') }}"><i class="fas fa-file-alt"></i></a>
            <a class="hover:translate-x-1 hover:text-gray-500" href="{{ route('caminhoes.index') }}"><i class="fas fa-truck"></i></a>
            <a class="hover:translate-x-1 hover:text-gray-500" href="{{ route('rotas') }}"><i class="fas fa-route"></i></a>
            <a class="hover:translate-x-1 hover:text-gray-500" href="{{ route('relatorios.detalhado') }}"><i class="fas fa-folder"></i></a>
            <a class="hover:translate-x-1 hover:text-gray-500" href="{{ route('motoristas.index') }}"><i class="fas fa-user"></i></a>
        </div>
    </nav>
</aside>


<aside id="sidebar-expanded" class="absolute top-0 left-0 bottom-0 w-48 bg-yellow-500 flex flex-col transition-all duration-500 overflow-hidden hidden">
    <img class="p-3 w-44" src="{{ asset('assets/images/logoSideBarClick.png') }}" alt="">

    <nav class="mt-24">
        <div class="flex text-3xl text-gray-800 flex-col gap-8 p-3">
            <i id="menu-close" class="fas fa-bars text-white cursor-pointer transition-all duration-300 origin-left hover:scale-125 hover:text-gray-500"></i>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:translate-x-1 hover:text-gray-500">
                <i class="fas fa-home"></i>
                <p class="text-lg">Dashboard</p>
            </a>
            <a href="{{ route('motoristas.index') }}" class="flex items-center gap-2 hover:translate-x-1 hover:text-gray-500">
                <i class="fas fa-file-alt"></i>
                <p class="text-lg">Motorista</p>
            </a>
            <a href="{{ route('caminhoes.index') }}" class="flex items-center gap-2 hover:translate-x-1 hover:text-gray-500">
                <i class="fas fa-truck"></i>
                <p class="text-lg">Caminhão</p>
            </a>
            <a href="{{ route('rotas') }}" class="flex items-center gap-2 hover:translate-x-1 hover:text-gray-500">
                <i class="fas fa-route"></i>
                <p class="text-lg">Rotas</p>
            </a>
            <a href="{{ route('relatorios') }}" class="flex items-center gap-2 hover:translate-x-1 hover:text-gray-500">
                <i class="fas fa-folder"></i>
                <p class="text-lg">Relatórios</p>
            </a>
            <a href="{{ route('motoristas.index') }}" class="flex items-center gap-2 hover:translate-x-1 hover:text-gray-500">
                <i class="fas fa-user"></i>
                <p class="text-lg">Informações dos Motoristas</p>
            </a>
        </div>
    </nav>
</aside>


<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.add('hidden');
        document.getElementById('sidebar-expanded').classList.remove('hidden');
    });

    document.getElementById('menu-close').addEventListener('click', function() {
        document.getElementById('sidebar-expanded').classList.add('hidden');
        document.getElementById('sidebar').classList.remove('hidden');
    });
</script>