<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  @vite('resources/css/app.css')
  @vite(['resources/js/app.js'])

</head>
<body class="bg-slate-800 grid grid-cols-12 h-screen">

  <div class="col-span-5 w-full flex items-center justify-center">
        <div class="w-full max-w-md rounded-lg">
            <h2 class="text-4xl font-light text-yellow-500 text-center mb-6">Crie sua conta</h2>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-white">CNPJ</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-file-invoice mr-2 text-white"></i>
                        <input type="text" id="cnpj" name="cnpj" class="w-full bg-transparent outline-none placeholder-white/50 text-white" placeholder="XX.XXX.XXX/XXXX-XX">
                    </div>
                    <p id="cnpjError" class="text-red-500 text-sm hidden">CNPJ inválido!</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-white">Razão Social</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-user mr-2 text-white"></i>
                        <input type="text" id="razaoSocial" name="razaoSocial" class="w-full bg-transparent outline-none placeholder-white/50 text-white" placeholder="Fulano de fulano">
                    </div>
                    <p id="razaoError" class="text-red-500 text-sm hidden">Razão Social é obrigatória!</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-white">Email</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-envelope mr-2 text-white"></i>
                        <input type="email" id="email" name="email" class="w-full bg-transparent outline-none placeholder-white/50 text-white" placeholder="exemplo@gmail.com">
                    </div>
                    <p id="emailError" class="text-red-500 text-sm hidden">Email inválido!</p>
                </div>

                <div class="mb-4 text-white">
                    <label class="block text-sm font-medium mb-1">Senha</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-key mr-2 text-white"></i>
                        <input type="password" id="password" name="password" placeholder="********" class="w-full bg-transparent outline-none placeholder-white/50 text-white">
                        <i class="fas fa-eye cursor-pointer ml-2 toggle-password"></i>
                    </div>
                    <p id="passwordError" class="text-red-500 text-sm hidden">A senha deve ter pelo menos 6 caracteres!</p>
                </div>

                <div class="mb-8 text-white">
                    <label class="block text-sm font-medium mb-1">Confirme sua senha</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-key mr-2 text-yellow-500"></i>
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="********" class="w-full bg-transparent outline-none placeholder-white/50 text-white">
                        <i class="fas fa-eye ml-2 toggle-password"></i>
                    </div>
                    <p id="confirmPasswordError" class="text-red-500 text-sm hidden">As senhas não coincidem!</p>
                </div>

                <button type="submit" class="w-full bg-orange-400 text-gray-900 font-bold py-2 rounded-lg hover:bg-yellow-500 transition-colors duration-300">Cadastrar</button>
            </form>

            <div class="grid justify-items-center">
                <p class="text-center mt-4 text-sm text-white">Já tem conta na Fllet Max?</p>
                <a href="{{ route('login') }}" class="text-orange-400 font-bold hover:underline">Entre na sua conta</a>
            </div>
        </div>
    </div>

    <picture class="col-span-7">
      <img class="w-full h-screen" src="{{ asset('assets/images/banners/bgRegister.png') }}" alt="">
    </picture>

</body>
</html>