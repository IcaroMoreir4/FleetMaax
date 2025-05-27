<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CaminhaoController;
use App\Http\Controllers\MotoristaController;
use Illuminate\Support\Facades\Route;

// 📄 Páginas públicas
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/error404', function () {
    return view('errors.error404');
})->name('error404');

// 🔐 Autenticação
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'loginAcount'])->name('loginAcount');

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ⚠️ Rotas protegidas - desativadas temporariamente
/*
Route::middleware('auth')->group(function () {
*/

// 🧭 Dashboard
Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

// 🧍 Motoristas
Route::get('/motoristas', [MotoristaController::class, 'index'])->name('motoristas.index');
Route::post('/motoristas', [MotoristaController::class, 'store'])->name('motoristas.store')->middleware('motorista.status');
// Exibir um motorista específico
Route::get('/motoristas/{motorista}', [MotoristaController::class, 'show'])->name('motoristas.show');

// Exibir formulário de edição
Route::get('/motoristas/{motorista}/edit', [MotoristaController::class, 'edit'])->name('motoristas.edit');

// Atualizar dados de um motorista
Route::put('/motoristas/{motorista}', [MotoristaController::class, 'update'])->name('motoristas.update');

// Remover um motorista
Route::delete('/motoristas/{motorista}', [MotoristaController::class, 'destroy'])->name('motoristas.destroy');

// 🚚 Caminhões
// Lista todos os caminhões
Route::get('/caminhoes', [CaminhaoController::class, 'index'])->name('caminhoes.index');

// Exibe o formulário de edição de um caminhão
Route::get('/caminhoes/{caminhao}/edit', [CaminhaoController::class, 'edit'])->name('caminhoes.edit');

// Atualiza um caminhão
Route::put('/caminhoes/{caminhao}', [CaminhaoController::class, 'update'])->name('caminhoes.update');

// Mostra um caminhão específico
Route::get('/caminhoes/{caminhao}', [CaminhaoController::class, 'show'])->name('caminhoes.show');

// Salva um novo caminhão
Route::post('/caminhoes', [CaminhaoController::class, 'store'])->name('caminhoes.store');

// Deleta um caminhão
Route::delete('/caminhoes/{caminhao}', [CaminhaoController::class, 'destroy'])->name('caminhoes.destroy');

// 📊 Relatórios
Route::get('/relatorios', fn () => view('relatorios.index'))->name('relatorios');
Route::get('/relatorios/detalhado', fn () => view('relatorios.detalhado'))->name('relatorios.detalhado');

// 🗺️ Rotas
Route::get('/rotas', fn () => view('rotas.index'))->name('rotas');
Route::get('/rotas/detalhada', fn () => view('rotas.detalhada'))->name('rotas.detalhada');


// 📌 Como reativar a proteção por login depois?
// 1️⃣ Descomente o bloco `Route::middleware('auth')->group(function () {` e `});` 
// 2️⃣ Implemente a autenticação para os usuários no back-end
// 3️⃣ As páginas protegidas só poderão ser acessadas por usuários logados
