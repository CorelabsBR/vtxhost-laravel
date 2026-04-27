<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebHostingController;
use App\Http\Controllers\GameHostingController;
use App\Http\Controllers\CheckoutRedirectController;
use App\Http\Controllers\CartCheckoutController;
use App\Http\Controllers\ClientAreaAccessController;
use App\Http\Controllers\Auth\SocialAuthController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/host', function () {
    return view('host');
})->name('host');

Route::get('/vps', function () {
    return view('vps');
})->name('vps');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/registro', [AuthController::class, 'showRegister'])->name('registro');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cliente', [ClientAreaAccessController::class, 'redirect'])
    ->middleware('auth')
    ->name('cliente.dashboard');

Route::get('/recuperar-senha', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/web', [WebHostingController::class, 'index'])->name('web');

Route::post('/carrinho/adicionar/{produto}', [CartCheckoutController::class, 'checkout'])
    ->middleware('auth')
    ->name('cart.checkout');
Route::get('/games', [GameHostingController::class, 'index'])->name('games.index');
Route::get('/games/{jogo:slug}', [GameHostingController::class, 'show'])->name('games.show');

    Route::middleware(['auth'])->post('/checkout/redirecionar', [CheckoutRedirectController::class, 'redirect'])
        ->name('checkout.redirect');

    Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
        ->name('social.redirect');

    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
        ->name('social.callback');