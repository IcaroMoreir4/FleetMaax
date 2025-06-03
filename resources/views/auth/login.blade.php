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

            <form method="POST" action="{{ route('loginAcount') }}">
                @csrf
                
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-white">Email</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-envelope mr-2 text-white"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full bg-transparent outline-none placeholder-white/50 text-white"
                            placeholder="exemplo@empresa.com"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Senha -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1 text-white">Senha</label>
                    <div class="flex items-center border border-orange-400 rounded-lg p-2">
                        <i class="fas fa-lock mr-2 text-white"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full bg-transparent outline-none placeholder-white/50 text-white"
                            placeholder="********"
                            required
                        >
                        <button type="button" class="toggle-password text-white focus:outline-none">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lembrar-me -->
                <div class="mb-4 flex items-center">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="rounded border-orange-400 text-yellow-500 focus:ring-yellow-500"
                    >
                    <label for="remember" class="ml-2 text-sm text-white">Lembrar-me</label>
                </div>

                <!-- Esqueci a senha -->
                <div class="text-right mb-4">
                    <a href="#" class="text-orange-400 text-sm hover:underline">Esqueci minha senha</a>
                </div>

                <!-- Botão de Login -->
                <button type="submit" class="w-full bg-yellow-500 text-slate-800 py-2 px-4 rounded-lg hover:bg-yellow-600 transition duration-200">
                    Entrar
                </button>

                <!-- Link de Registro -->
                <div class="mt-4 text-center">
                    <a href="{{ route('register') }}" class="text-yellow-500 hover:text-yellow-600 transition duration-200">
                        Não tem uma conta? Registre-se
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>