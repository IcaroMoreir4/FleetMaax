<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  @vite('resources/css/app.css')
  @vite(['resources/js/app.js'])

</head>

<body class="h-screen bg-slate-800 ">

  <div class="flex justify-between items-center p-4">
    <img src="{{ asset('assets/images/logoHome.png') }}" alt="">
    <a class="text-yellow-500 underline" href="" #>Acesse sua conta</a>
  </div>

  <picture class="grid items-center justify-items-center w-full p-8">
    <img src="{{ asset('assets/images/bgLandingPage.svg') }}" alt="">
  </picture>

  <div class="grid items-start justify-items-center h-[120px]">
    <button type="button" class="text-slate-800 bg-gradient-to-r from-yellow-500 via-yellow-600 to-yellow-400 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:focus:ring-yellow-600 shadow-lg shadow-yellow-600/50 dark:shadow-lg dark:shadow-yellow-600/80 font-bold rounded-xl text-lg px-8 py-3.5 text-center me-2 mb-2">Faça seu cadastro aqui</button>
  </div>

  <x-footer />

</body>

</html>