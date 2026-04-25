@extends('layouts.app')

@section('title', 'Registro - VortexHost')
@section('body_class', 'register-body')
@section('hide_header', true)
@section('hide_footer', true)
@section('main_class', 'register-main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')

<a href="{{ url('/') }}" class="register-back" title="Voltar">
    ← Voltar
</a>

<section class="register-split">

    <aside class="register-panel">
        <div class="register-panel-inner">
            <img src="{{ asset('img/logo_vtxhost.png') }}" alt="VortexHost" class="register-logo">

            <h2 class="register-panel-title">Comece com estrutura de verdade.</h2>

            <p class="register-panel-sub">
                Crie sua conta e gerencie hospedagem, VPS e servidores de jogos em um só lugar.
            </p>

            <div class="register-stats">
                <div>
                    <strong>99.9%</strong>
                    <span>Uptime</span>
                </div>
                <div>
                    <strong>24/7</strong>
                    <span>Suporte</span>
                </div>
                <div>
                    <strong>10Gbps</strong>
                    <span>Anti-DDoS</span>
                </div>
            </div>
        </div>
    </aside>

    <div class="register-form-side">
        <div class="register-card">

            <h1 class="register-title">Criar conta</h1>
            <p class="register-subtitle">Preencha seus dados para acessar a área do cliente.</p>

            <form method="POST" action="{{ route('registro.post') }}" class="register-form" novalidate>
                @csrf

                <div class="register-grid">

                    <div class="register-group full">
                        <label class="register-label" for="name">Nome completo</label>
                        <input class="register-input" type="text" id="name" name="name"
                               value="{{ old('name') }}" required placeholder="João Silva">
                    </div>

                    <div class="register-group full">
                        <label class="register-label" for="email">E-mail</label>
                        <input class="register-input" type="email" id="email" name="email"
                               value="{{ old('email') }}" required placeholder="seu@email.com">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="cpf_cnpj">CPF / CNPJ</label>
                        <input class="register-input" type="text" id="cpf_cnpj" name="cpf_cnpj"
                               value="{{ old('cpf_cnpj') }}" placeholder="000.000.000-00">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="celular">Celular</label>
                        <input class="register-input" type="text" id="celular" name="celular"
                               value="{{ old('celular') }}" placeholder="(00) 00000-0000">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="data_nasc">Data de nascimento</label>
                        <input class="register-input" type="date" id="data_nasc" name="data_nasc"
                               value="{{ old('data_nasc') }}">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="cep">CEP</label>
                        <input class="register-input" type="text" id="cep" name="cep"
                               value="{{ old('cep') }}" placeholder="00000-000">
                    </div>

                    <div class="register-group full">
                        <label class="register-label" for="rua">Rua</label>
                        <input class="register-input" type="text" id="rua" name="rua"
                               value="{{ old('rua') }}" placeholder="Rua Exemplo">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="numero">Número</label>
                        <input class="register-input" type="text" id="numero" name="numero"
                               value="{{ old('numero') }}" placeholder="123">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="complemento">Complemento</label>
                        <input class="register-input" type="text" id="complemento" name="complemento"
                               value="{{ old('complemento') }}" placeholder="Casa, ap, bloco...">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="bairro">Bairro</label>
                        <input class="register-input" type="text" id="bairro" name="bairro"
                               value="{{ old('bairro') }}">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="cidade">Cidade</label>
                        <input class="register-input" type="text" id="cidade" name="cidade"
                               value="{{ old('cidade') }}">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="estado">Estado</label>
                        <input class="register-input" type="text" id="estado" name="estado"
                               value="{{ old('estado') }}">
                    </div>

                    <div class="register-group">
                        <label class="register-label" for="pais">País</label>
                        <input class="register-input" type="text" id="pais" name="pais"
                               value="{{ old('pais', 'Brasil') }}">
                    </div>

                    <div class="register-group full">
                        <label class="register-label" for="password">Senha</label>
                        <div class="register-password-wrapper">
                            <input class="register-input" type="password" id="password" name="password"
                                   required placeholder="Mínimo 8 caracteres">
                            <button type="button" class="register-password-toggle" onclick="toggleRegisterPassword('password')">
                                👁
                            </button>
                        </div>
                    </div>

                    <div class="register-group full">
                        <label class="register-label" for="password_confirmation">Confirmar senha</label>
                        <div class="register-password-wrapper">
                            <input class="register-input" type="password" id="password_confirmation" name="password_confirmation"
                                   required placeholder="Repita a senha">
                            <button type="button" class="register-password-toggle" onclick="toggleRegisterPassword('password_confirmation')">
                                👁
                            </button>
                        </div>
                    </div>

                </div>

                <button class="register-submit" type="submit">
                    Criar conta
                </button>
            </form>

            <p class="register-note">
                Já tem uma conta?
                <a href="{{ route('login') }}">Entrar</a>
            </p>

        </div>
    </div>

</section>

@endsection

@push('scripts')
<script>
function toggleRegisterPassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endpush