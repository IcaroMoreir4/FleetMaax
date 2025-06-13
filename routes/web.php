<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CaminhaoController;
use App\Http\Controllers\MotoristaController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// 📄 Páginas públicas
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/error404', function () {
    return view('errors.error404');
})->name('error404');

// 🔐 Autenticação
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'loginAcount'])->name('loginAcount');
    Route::get('/register', fn () => view('auth.register'))->name('register');
    Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');
});

// 🔒 Rotas protegidas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::resource('motoristas', MotoristaController::class);
    Route::resource('caminhoes', CaminhaoController::class);
    Route::resource('routes', RouteController::class);
});

// 🗺️ Rotas
Route::get('/rotas/detalhada', fn () => view('rotas.detalhada'))->name('rotas.detalhada');
