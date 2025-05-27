<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Meu Site')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 text-gray-800">
  <header>
    <!-- Cabeçalho opcional -->
  </header>

  <main class="p-4">
    @yield('content')
  </main>

  <footer class="text-center py-4">
    <!-- Rodapé opcional -->
  </footer>
</body>
</html>
