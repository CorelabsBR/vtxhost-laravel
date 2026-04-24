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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    // depois ligamos auth real aqui
    return back()->with('error', 'Login ainda não implementado.');
})->name('login.post');

Route::get('/registro', function () {
    return view('auth.register');
})->name('registro');

Route::post('/registro', function () {
    // depois ligamos cadastro real aqui
    return back()->with('error', 'Registro ainda não implementado.');
})->name('registro.post');

Route::get('/cliente', function () {
    return view('cliente.dashboard');
})->name('cliente.dashboard');

Route::get('/recuperar-senha', function () {
    return view('auth.forgot-password');
})->name('password.request');