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
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:user,email',
        'password' => 'required|confirmed|min:6',
    ]);

    User::create([
        'nome' => $request->name,
        'email' => $request->email,
        'senha' => Hash::make($request->password),

        'cpf_cnpj' => $request->cpf_cnpj,
        'celular' => $request->celular,
        'cep' => $request->cep,
        'rua' => $request->rua,
        'numero' => $request->numero,
        'complemento' => $request->complemento,
        'bairro' => $request->bairro,
        'cidade' => $request->cidade,
        'estado' => $request->estado,
        'pais' => $request->pais,
        'data_nasc' => $request->data_nasc,

        'tipo_usuario' => 'cliente',
    ]);

    return redirect()->route('login')->with('success', 'Conta criada com sucesso.');
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