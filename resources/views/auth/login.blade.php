@extends('layouts.app')

@section('title', 'Login - VortexHost')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@section('content')

<body class="auth-body">

<!-- VOLTAR -->
<a href="{{ url('/') }}" class="auth-back" title="Voltar">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
         fill="none" stroke="currentColor" stroke-width="2.5"
         stroke-linecap="round" stroke-linejoin="round">
        <path d="M19 12H5"/>
        <path d="M12 19l-7-7 7-7"/>
    </svg>
    Voltar
</a>

<div class="auth-split">

    <!-- ESQUERDA -->
    <div class="auth-panel">
        <div class="auth-panel-inner">
            <img src="{{ asset('img/logo_vtxhost.png') }}" alt="VortexHost" class="auth-logo">

            <h2 class="auth-panel-title">Bem-vindo de volta.</h2>

            <p class="auth-panel-sub">
                Infraestrutura de alto desempenho,<br>
                anti-DDoS incluso e suporte que resolve.
            </p>

            <div class="auth-stats">
                <div class="auth-stat">
                    <span class="auth-stat-value">99.9%</span>
                    <span class="auth-stat-label">Uptime</span>
                </div>
                <div class="auth-stat-divider"></div>
                <div class="auth-stat">
                    <span class="auth-stat-value">24/7</span>
                    <span class="auth-stat-label">Suporte</span>
                </div>
                <div class="auth-stat-divider"></div>
                <div class="auth-stat">
                    <span class="auth-stat-value">10Gbps</span>
                    <span class="auth-stat-label">Anti-DDoS</span>
                </div>
            </div>
        </div>

        <div class="auth-panel-grid"></div>
    </div>

    <!-- DIREITA -->
    <div class="auth-form-side">
        <div class="auth-card">

            <h1 class="auth-title">Entrar</h1>
            <p class="auth-subtitle">Acesse sua área do cliente.</p>

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">E-MAIL</label>
                    <input class="form-input" type="email" name="email"
                           required value="{{ old('email') }}" placeholder="seu@email.com">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        SENHA
                        <a href="#" class="form-label-link">Esqueceu a senha?</a>
                    </label>

                    <div class="input-password-wrapper">
                        <input class="form-input" type="password" id="password" name="password"
                               required placeholder="••••••••">

                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="remember">
                    <label>Lembrar de mim</label>
                </div>

                <button class="btn btn-primary btn-full" type="submit">
                    Entrar
                </button>
            </form>

            <p class="auth-note">
                Não tem conta?
                <a href="{{ url('/registro') }}">Criar conta grátis</a>
            </p>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endpush