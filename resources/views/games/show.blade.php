@extends('layouts.game')

@section('title', $jogo->nome . ' - VortexHost')

@section('content')


<section class="game-section">
    <div class="container">

        <!-- HEADER DO JOGO -->
        <div class="game-header">

            @if ($jogo->banner)
                <div class="game-banner-wrap">
                    <img
                        src="{{ asset('img/games/' . $jogo->banner) }}"
                        alt="{{ $jogo->nome }}"
                        class="game-banner"
                    >
                    <div class="game-banner-overlay"></div>
                </div>
            @endif

            <div class="game-header-info">
                <span class="game-eyebrow">Servidor de Jogo</span>
                <h1 class="game-title">{{ $jogo->nome }}</h1>
                <p class="game-sub">Escolha um plano para seu servidor de {{ $jogo->nome }}.</p>
            </div>

        </div>

        <!-- GRID DE PLANOS -->
        <div class="game-plans-grid">

            @forelse ($plans as $plan)
                <div class="game-card">

                    <div class="game-card-icon">
                        @if ($jogo->icon)
                            <img
                                src="{{ asset('img/games/icons/' . $jogo->icon) }}"
                                alt="{{ $jogo->nome }}"
                                class="game-icon-img"
                            >
                        @else
                            <div class="game-icon-fallback">🎮</div>
                        @endif
                    </div>

                    <p class="game-plan-tag">Plano</p>

                    <h3 class="game-plan-name">{{ $plan->name }}</h3>

                    <ul class="game-plan-specs">
                        <li>
                            <span class="game-spec-label">RAM</span>
                            <span class="game-spec-value">{{ $plan->ramFormatada() }}</span>
                        </li>
                        <li>
                            <span class="game-spec-label">Disco</span>
                            <span class="game-spec-value">{{ $plan->discoFormatado() }}</span>
                        </li>
                        <li>
                            <span class="game-spec-label">CPU</span>
                            <span class="game-spec-value">{{ $plan->cpuFormatada() }}</span>
                        </li>
                    </ul>

                    <hr class="game-divider">

                    <div class="game-card-footer">
                        <a href="{{ route('carrinho.add', $plan->plan) }}" class="btn btn-primary btn-sm">
                            Selecionar →
                        </a>
                    </div>

                </div>
            @empty

                <div class="game-empty">
                    <p class="game-empty-icon">🎮</p>
                    <h3>Sem planos ainda</h3>
                    <p>Configura os planos no banco, camarada.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>

<footer class="game-site-footer">
    <div class="container">
        <div class="game-footer-grid">

            <div class="game-footer-brand">
                <a class="game-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo_vtxhost.png') }}" alt="logo_vtxhost" id="logo_img_footer">
                </a>
                <p>
                    Criamos a infraestrutura que sempre faltou:
                    desempenho bruto, estabilidade real e suporte que resolve.
                </p>
                <a href="mailto:contato@vortexhost.com.br">contato@vortexhost.com.br</a>
                <span class="game-footer-status">SISTEMAS ONLINE</span>
            </div>

            <div class="game-footer-col">
                <h4>Serviços</h4>
                <ul class="game-footer-links">
                    <li><a href="{{ url('/host') }}">Hospedagem Web</a></li>
                    <li><a href="{{ url('/vps') }}">VPS Premium</a></li>
                    <li><a href="{{ url('/games') }}">Servidores de Jogos</a></li>
                </ul>
            </div>

            <div class="game-footer-col">
                <h4>Suporte</h4>
                <ul class="game-footer-links">
                    <li><a href="{{ url('/cliente') }}">Área do Cliente</a></li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/registro') }}">Criar Conta</a></li>
                    <li><a href="mailto:contato@vortexhost.com.br">Abrir Ticket</a></li>
                </ul>
            </div>

            <div class="game-footer-col">
                <h4>Legal</h4>
                <ul class="game-footer-links">
                    <li><a href="#">Termos de Serviço</a></li>
                    <li><a href="#">Política de Privacidade</a></li>
                    <li><a href="#">Política de Reembolso</a></li>
                </ul>
            </div>

            <div class="game-footer-col">
                <h4>Redes Sociais</h4>
                <div class="game-social-icons">
                    <a href="https://instagram.com/" target="_blank" rel="noopener noreferrer" class="game-social-icon" title="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                    <a href="https://discord.gg/" target="_blank" rel="noopener noreferrer" class="game-social-icon" title="Discord">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.317 4.3698a19.7913 19.7913 0 00-4.8851-1.5152.0741.0741 0 00-.0785.0371c-.211.3753-.4447.8648-.6083 1.2495-1.8447-.2762-3.68-.2762-5.4868 0-.1636-.3933-.4058-.8742-.6177-1.2495a.077.077 0 00-.0785-.037 19.7363 19.7363 0 00-4.8852 1.515.0699.0699 0 00-.0321.0277C.5334 9.0458-.319 13.5799.0992 18.0578a.0824.0824 0 00.0312.0561c2.0528 1.5076 4.0413 2.4228 5.9929 3.0294a.0777.0777 0 00.0842-.0276c.4616-.6304.8731-1.2952 1.226-1.9942a.076.076 0 00-.0416-.1057c-.6528-.2476-1.2743-.5495-1.8722-.8923a.077.077 0 01-.0076-.1277c.1258-.0943.2517-.1923.3718-.2914a.0743.0743 0 01.0776-.0105c3.9278 1.7933 8.18 1.7933 12.0614 0a.0739.0739 0 01.0785.0095c.1202.099.246.1981.3728.2924a.077.077 0 01-.0066.1276 12.2986 12.2986 0 01-1.873.8914.0766.0766 0 00-.0407.1067c.3604.698.7719 1.3628 1.225 1.9932a.076.076 0 00.0842.0286c1.961-.6067 3.9495-1.5219 6.0023-3.0294a.077.077 0 00.0313-.0552c.5004-5.177-.8382-9.6739-3.5485-13.6604a.061.061 0 00-.0312-.0286zM8.02 15.3312c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9555-2.4189 2.157-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.9555 2.4189-2.1569 2.4189zm7.9748 0c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9554-2.4189 2.1569-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.4189-2.1568 2.4189z"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <div class="game-footer-bottom">
            <span class="game-footer-copy">VortexHost © {{ date('Y') }}</span>
            <div class="game-footer-payments">
                <span class="game-payment-badge">PIX</span>
                <span class="game-payment-badge">Cartão</span>
                <span class="game-payment-badge">Boleto</span>
                <span class="game-payment-badge">PayPal</span>
            </div>
        </div>
    </div>
</footer>

<script>
    const hamburger = document.getElementById('game-hamburger');
    const mobileNav = document.getElementById('game-mobile-nav');
    hamburger.addEventListener('click', () => {
        mobileNav.classList.toggle('open');
        hamburger.classList.toggle('is-open');
    });
</script>

@endsection