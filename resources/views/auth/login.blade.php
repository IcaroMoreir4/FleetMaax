<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  @vite('resources/css/app.css')
  @vite(['resources/js/app.js'])

</head>
<body class="bg-slate-800 grid grid-cols-12 ">
  <picture class="col-span-7">
  <img class="w-full overflow-scroll h-screen" src="{{ asset('assets/images/banners/bgLogin.png') }}" alt="">
  </picture>

  <div class="col-span-5 w-full flex items-center justify-center">
        <div class="w-full max-w-md rounded-lg">
            <h2 class="text-4xl font-light text-yellow-500 text-center mb-6">Acesse sua conta</h2>

            <form id="loginForm">

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-white">CNPJ</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-file-invoice mr-2 text-white"></i>  
                        <input type="text" id="cnpj" name="cnpj" class="w-full bg-transparent outline-none placeholder-white/50 text-white" placeholder="XX.XXX.XXX/XXXX-XX">
                    </div>
                    <p id="cnpjError" class="text-red-500 text-sm hidden">CNPJ inválido!</p>
                </div>


                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-white">Email</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-envelope mr-2 text-white"></i>
                        <input type="email" id="email" name="email" class="w-full bg-transparent outline-none placeholder-white/50 text-white" placeholder="exemplo@gmail.com">
                    </div>
                    <p id="emailError" class="text-red-500 text-sm hidden">Email inválido!</p>
                </div>

                <!-- Senha Login -->
                <div class="mb-4 text-white">
                    <label class="block text-sm font-medium mb-1">Senha</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-key mr-2 text-white"></i>
                        <input type="password" placeholder="********" id="password" name="password" class="w-full bg-transparent outline-none placeholder-white/50 text-white">
                        <i class="fas fa-eye ml-2 toggle-password cursor-pointer active:scale-75 transition-transform duration-150"></i>
                    </div>
                    <p id="passwordError" class="text-red-500 text-sm hidden">Senha inválida!</p>
                </div>

                <div class="text-right mb-4">
                    <a href="#" class="text-orange-400 text-sm hover:underline">Esqueci minha senha</a>
                </div>

                <button type="submit" class="w-full bg-orange-400 text-gray-900 font-bold py-2 rounded-lg hover:bg-yellow-500 transition-colors duration-300">Login</button>
            </form>

            <p class="text-center mt-4 text-sm text-white">Novo na Fleet Max? <a href="{{ route('register') }}" class="text-orange-400 font-bold hover:underline">Crie sua conta.</a></p>
        </div>
    </div>

</body>
</html>