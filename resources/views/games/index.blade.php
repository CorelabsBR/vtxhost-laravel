@extends('layouts.app')

@section('title', 'Servidores de Jogos - VortexHost')
@section('hide_header', true)
@section('content')
<header class="site-header">
    <div class="container">
        <nav class="nav-inner">

            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo_vtxhost.png') }}" alt="logo_vtxhost" id="logo_img">
            </a>

            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Início</a></li>
                <li><a href="{{ url('/vps') }}">VPS</a></li>
                <li><a href="{{ url('/web') }}">Hospedagem Web</a></li>
            </ul>

            <div class="nav-actions">
                <span class="nav-area-note">Cliente?</span>
                <a class="btn btn-ghost btn-sm" href="{{ url('/login') }}">Entrar</a>
                <a class="btn btn-primary btn-sm" href="{{ url('/registro') }}">Criar conta</a>
            </div>

            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>

        </nav>

        <nav class="mobile-nav" id="mobile-nav">
            <a href="{{ url('/') }}">Início</a>
            <a href="{{ url('/host') }}">Hospedagem</a>
            <a href="{{ url('/vps') }}">VPS</a>
            <a href="{{ url('/web') }}">web</a>
            <a href="{{ url('/login') }}">Entrar</a>
            <a href="{{ url('/registro') }}">Criar conta</a>
        </nav>
    </div>
</header>
<script src="{{ asset('js/header.js') }}"></script>

<section class="services-section">
    <div class="container">

        <div class="section-head center">
            <h1 class="section-title">
                
                Servidores de Jogos

            </h1>
            <p class="section-sub">Escolha seu jogo e configure seu servidor.</p>
        </div>

        <div class="services-grid">

            @forelse ($jogos as $jogo)
               <a href="{{ route('games.show', ['jogo' => $jogo->slug]) }}" class="svc-card" style="text-decoration:none;">
                    @if ($jogo->banner)
                        <img
                            src="{{ asset('img/games/' . $jogo->banner) }}"
                            alt="{{ $jogo->nome }}"
                            style="width:100%;height:160px;object-fit:cover;border-radius:18px;margin-bottom:1rem;"
                        >
                    @else
                        <div class="svc-icon">🎮</div>
                    @endif

                    <p class="svc-tag">Game Server</p>

                    <h3 class="svc-title">{{ $jogo->nome }}</h3>

                    <p class="svc-desc">
                        Ver planos disponíveis
                    </p>

                </a>
            @empty

                <div style="text-align:center; padding:60px;">
                    <h3>Nenhum jogo encontrado</h3>
                    <p>Popula a tabela jogos_prod.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>
@endsection