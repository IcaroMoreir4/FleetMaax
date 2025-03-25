<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    @vite('resources/css/app.css')
</head>
<body>
    
<div class="flex items-center justify-center min-h-[calc(100vh-140px)] bg-slate-900 relative">
        
        <div class="absolute top-4 left-4">
            <img src="{{ asset('assets/images/logoHome.png') }}" alt="Logo Home" class="h-22">
        </div>
        <img id="" class="" src="{{ asset('assets/images/logo404.png') }}" alt="Logo 404">
    </div>
    
  <!-- Footer -->
    <footer class="bg-yellow-500 w-full p-5">
        <div class="grid grid-cols-4 justify-items-center gap-4 text-slate-900">
            <div class="p-4">
                <img src="{{ asset('assets/images/logoFooter.png') }}" alt="">
            </div>

            <div class="p-4">
                <h1 class="inline-block text-xl font-medium relative mb-4">
                    Gestão de Frota
                    <span class="absolute inset-x-0 mx-auto left-0 -bottom-0.5 w-full h-0.5 bg-white"></span>
                </h1>
                <ul class="grid gap-2">
                    <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="#">
                        <li>DashBoard</li>
                    </a>
                    <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="#">
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
                    <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="#">
                        <li>Caminhões</li>
                    </a>
                    <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="#">
                        <li>Motoristas</li>
                    </a>
                    <a class="transition-all duration-300 ease-in-out hover:translate-x-1 hover:text-purple-900 hover:underline decoration-purple-900" href="#">
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
                    <a class=" hover:text-slate-900 transition-all duration-300 ease-in-out hover:translate-x-1 text-purple-900 hover:underline" href="#">
                        <li>suporte@fleetmax.com</li>
                    </a>
                </ul>
            </div>
        </div>

        <div class="text-right text-slate-900 mt-4 p-4">
            <p>FleetMax © Alguns direitos reservados. 2025</p>
        </div>
    </footer>
</body>
</html>