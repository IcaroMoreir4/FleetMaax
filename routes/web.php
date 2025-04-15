<?php

use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/error404', function () {
    return view('errors.error404');
})->name('error404');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

/*
// 🔒 Grupo de rotas protegidas (somente usuários autenticados)
// ❗ Removido temporariamente para permitir acesso sem login durante o desenvolvimento
Route::middleware('auth')->group(function () {
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/motoristas', function () {
    return view('motoristas.index');
})->name('motoristas');

Route::get('/caminhoes', function () {
    return view('caminhoes.index');
})->name('caminhoes');

Route::get('/motoristas/{id}', function ($id) {
    return view('motoristas.profile', compact('id'));
})->name('motoristas.profile');


Route::get('/relatorios', function () {
    return view('relatorios.index');
})->name('relatorios');

Route::get('/relatorios/detalhado', function () {
    return view('relatorios.detalhado');
})->name('relatorios.detalhado');

Route::get('/rotas', function () {
    return view('rotas.index');
})->name('rotas');

Route::get('/rotas/detalhada', function () {
    return view('rotas.detalhada');
})->name('rotas.detalhada');

Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil');
/*
});
*/

// 📌 Como reativar a proteção por login depois?
// 1️⃣ Descomente o bloco `Route::middleware('auth')->group(function () {` e `});` 
// 2️⃣ Implemente a autenticação para os usuários no back-end
// 3️⃣ As páginas protegidas só poderão ser acessadas por usuários logados
