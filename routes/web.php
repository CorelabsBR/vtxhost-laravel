<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebHostingController;
use App\Http\Controllers\GameHostingController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/host', function () {
    return view('host');
})->name('host');

Route::get('/vps', function () {
    return view('vps');
})->name('vps');

Route::get('/cpanel', function () {
    return view('cpanel');
})->name('cpanel');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/registro', [AuthController::class, 'showRegister'])->name('registro');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cliente', function () {
    return view('cliente.dashboard');
})->middleware('auth')->name('cliente.dashboard');
Route::get('/recuperar-senha', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/web', [WebHostingController::class, 'index'])->name('web');

Route::get('/carrinho/adicionar/{produto}', function ($produto) {
    return redirect()
        ->route('web')
        ->with('success', 'Produto adicionado ao carrinho.');
})->name('carrinho.add');

Route::get('/games', [GameHostingController::class, 'index'])->name('games.index');
Route::get('/games/{jogo}', [GameHostingController::class, 'show'])->name('games.show');