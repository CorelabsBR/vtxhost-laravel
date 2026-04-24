<?php

use Illuminate\Support\Facades\Route;

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