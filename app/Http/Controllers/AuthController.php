<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // =========================
    // VIEWS
    // =========================
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('cliente.dashboard');
        }

        return view('auth.login');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('cliente.dashboard');
        }

        return view('auth.register');
    }

    // =========================
    // REGISTER
    // =========================
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:user,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Mete teu nome.',
            'email.required' => 'Mete teu e-mail.',
            'email.email' => 'E-mail inválido.',
            'email.unique' => 'E-mail já cadastrado.',
            'password.required' => 'Mete uma senha.',
            'password.min' => 'Senha fraca demais.',
            'password.confirmed' => 'As senhas não batem.',
        ]);

        $user = User::create([
            'nome' => $data['name'],
            'email' => strtolower($data['email']),
            'senha' => Hash::make($data['password']),
            'tipo_usuario' => 'cliente'
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('cliente.dashboard');
    }

    // =========================
    // LOGIN
    // =========================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Mete teu e-mail.',
            'email.email' => 'E-mail inválido.',
            'password.required' => 'Mete tua senha.',
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ], $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Credenciais inválidas, товарищ.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(route('cliente.dashboard'));
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}