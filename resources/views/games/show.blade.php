    @extends('layouts.app')

    @section('title', $jogo->nome . ' - VortexHost')

    @section('content')

    <section class="services-section">
        <div class="container">

            <!-- HEADER DO JOGO -->
            <div class="section-head center">


                <h1 class="section-title">{{ $jogo->nome }}</h1>

                <p class="section-sub">
                    Escolha um plano para seu servidor de {{ $jogo->nome }}.
                </p>

            </div>

            <!-- GRID DE PLANOS -->
            <div class="services-grid">

                @forelse ($plans as $plan)
                    <div class="svc-card">

                        @if ($jogo->icon)
    <img
        src="{{ asset('img/games/icons/' . $jogo->icon) }}"
        alt="{{ $jogo->nome }}"
        style="width:48px;height:48px;object-fit:contain;margin-bottom:10px;"
    >
@else
    <div class="svc-icon">🎮</div>
@endif

                        <p class="svc-tag">Plano</p>

                        <h3 class="svc-title">{{ $plan->name }}</h3>

                        <ul class="svc-feats">
                            <li><strong>RAM:</strong> {{ $plan->ramFormatada() }}</li>
                            <li><strong>Disco:</strong> {{ $plan->discoFormatado() }}</li>
                            <li><strong>CPU:</strong> {{ $plan->cpuFormatada() }}</li>
                        </ul>

                        <div class="svc-divider"></div>

                        <div class="svc-footer">
                            <a href="{{ route('carrinho.add', $plan->plan) }}"
                            class="btn btn-primary btn-sm">
                                Selecionar →
                            </a>
                        </div>

                    </div>
                @empty

                    <div style="text-align:center; padding:60px;">
                        <h3>Sem planos ainda</h3>
                        <p>Configura os planos no banco, camarada.</p>
                    </div>

                @endforelse

            </div>

        </div>
    </section>

    @endsection