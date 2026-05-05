<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebHostingController;
use App\Http\Controllers\GameHostingController;
use App\Http\Controllers\CartCheckoutController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MercadoPagoWebhookController;

Route::get('/', fn () => view('home'))->name('home');

Route::get('/host', fn () => view('host'))->name('host');
Route::get('/vps', fn () => view('vps'))->name('vps');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/registro', [AuthController::class, 'showRegister'])->name('registro');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/recuperar-senha', fn () => view('auth.forgot-password'))
    ->name('password.request');

Route::get('/web', [WebHostingController::class, 'index'])->name('web');

Route::get('/games', [GameHostingController::class, 'index'])->name('games.index');
Route::get('/games/{jogo:slug}', [GameHostingController::class, 'show'])->name('games.show');

Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
    ->name('social.redirect');

Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->name('social.callback');

Route::middleware('auth')->group(function () {
    Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrinho/add-plan/{plan}', [CartController::class, 'addPlan'])->name('cart.addPlan');
    Route::patch('/carrinho/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/carrinho/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/carrinho/clear', [CartController::class, 'clear'])->name('cart.clear');

});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/pagar', [CheckoutController::class, 'pay'])->name('checkout.pay');

    Route::get('/checkout/sucesso', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/pendente', [CheckoutController::class, 'pending'])->name('checkout.pending');
    Route::get('/checkout/falhou', [CheckoutController::class, 'failure'])->name('checkout.failure');
});

Route::post('/webhooks/mercadopago', [MercadoPagoWebhookController::class, 'handle'])
    ->name('webhooks.mercadopago')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);