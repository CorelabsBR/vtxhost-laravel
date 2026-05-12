@extends('layouts.app')

@section('title', 'Servidores de Jogos - VortexHost')
@section('content')

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