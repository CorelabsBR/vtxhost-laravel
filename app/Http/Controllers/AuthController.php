<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
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

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:user,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $user = User::create([
            'email' => $data['email'],
            'senha' => Hash::make($data['password']),
            'tipo_usuario' => 'cliente',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('cadastro.completar')
            ->with('success', 'Conta criada. Complete seu cadastro para continuar.');
    }

    public function showCompleteProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!empty($user->profile_completed_at)) {
            return redirect()->route('cliente.dashboard');
        }

        return view('auth.complete-profile');
    }

    public function completeProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cpf_cnpj' => ['required', 'string', 'max:20', 'unique:user,cpf_cnpj,' . $user->id],
            'celular' => ['required', 'string', 'max:20'],
            'data_nasc' => ['required', 'date'],

            'cep' => ['required', 'string', 'max:20'],
            'rua' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:20'],
            'complemento' => ['nullable', 'string', 'max:255'],
            'bairro' => ['required', 'string', 'max:255'],
            'cidade' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'pais' => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'nome' => $data['name'],
            'cpf_cnpj' => $data['cpf_cnpj'],
            'celular' => $data['celular'],
            'data_nasc' => $data['data_nasc'],

            'cep' => $data['cep'],
            'rua' => $data['rua'],
            'numero' => $data['numero'],
            'complemento' => $data['complemento'] ?? null,
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'estado' => $data['estado'],
            'pais' => $data['pais'],

            'profile_completed_at' => now(),
        ]);

        return redirect()
            ->route('cliente.dashboard')
            ->with('success', 'Cadastro completo com sucesso.');
    }

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
            'password' => $credentials['password'],
        ], $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Credenciais inválidas, товарищ.',
            ]);
        }

        $request->session()->regenerate();

        if (empty(Auth::user()->profile_completed_at)) {
            return redirect()->route('cadastro.completar');
        }

        return redirect()->intended('/cliente');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}