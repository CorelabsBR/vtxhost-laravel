
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft Java - VortexHost</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo_vtxhost.png') }}">

    <link rel="stylesheet" href="{{ asset('css/minecraft.css') }}">
</head>
<body>    
<header class="site-header">
    <div class="container">
        <nav class="nav-inner">

            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo_vtxhost.png') }}" alt="logo_vtxhost" id="logo_img">
            </a>

            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Início</a></li>
                <li><a href="{{ url('/games') }}">Hospedagem de Jogos</a></li>
                <li><a href="{{ url('/vps') }}">VPS</a></li>
                <li><a href="{{ url('/cpanel') }}">Hospedagem Web</a></li>
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
            <a href="{{ url('/cpanel') }}">cPanel</a>
            <a href="{{ url('/login') }}">Entrar</a>
            <a href="{{ url('/registro') }}">Criar conta</a>
        </nav>
    </div>
</header>

<script src="{{ asset('js/header.js') }}"></script>
<section class="minecraftjava-section">
    <div class="container">

        <!-- HEADER DO JOGO -->
        <div class="minecraftjava-header">


            <div class="minecraftjava-header-info">
                <span class="minecraftjava-eyebrow">Servidor de Jogo</span>
                <h1 class="minecraftjava-title">{{ $jogo->nome }}</h1>
                <p class="minecraftjava-sub">Escolha um plano para seu servidor de {{ $jogo->nome }}.</p>
            </div>

        </div>

        <!-- GRID DE PLANOS -->
        <div class="minecraftjava-plans-grid">

            @forelse ($plans as $plan)
                <div class="minecraftjava-card">

<div class="minecraftjava-icon-fallback">
    @if ($jogo->icon)
        <img
            src="{{ asset('img/games/icons/' . $jogo->icon) }}"
            alt="{{ $jogo->nome }}"
            class="minecraftjava-icon-img"
        >
    @else
        <div class="minecraftjava-icon-fallback">🎮</div>
    @endif
</div>

                    <p class="minecraftjava-plan-tag">Plano</p>

                    <h3 class="minecraftjava-plan-name">{{ $plan->name }}</h3>

                    <ul class="minecraftjava-plan-specs">
                        <li>
                            <span class="spec-label">RAM</span>
                            <span class="spec-value">{{ $plan->ramFormatada() }}</span>
                        </li>
                        <li>
                            <span class="spec-label">Disco</span>
                            <span class="spec-value">{{ $plan->discoFormatado() }}</span>
                        </li>
                        <li>
                            <span class="spec-label">CPU</span>
                            <span class="spec-value">{{ $plan->cpuFormatada() }}</span>
                        </li>
                    </ul>

                    <hr class="minecraftjava-divider">

                    <div class="minecraftjava-card-footer">
                        <a href="{{ route('carrinho.add', $plan->plan) }}" class="btn btn-primary btn-sm">
                            Selecionar →
                        </a>
                    </div>

                </div>
            @empty

                <div class="minecraftjava-empty">
                    <p class="minecraftjava-empty-icon">⛏️</p>
                    <h3>Sem planos ainda</h3>
                    <p>Configura os planos no banco, camarada.</p>
                </div>

            @endforelse

        </div>

    </div>
</section>
</body>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">

            <div class="footer-brand">
                <div class="brand">
                    <img src="{{ asset('img/logo_vtxhost.png') }}" alt="logo_vtxhost" id="logo_img">
                </div>

                <p>
                    Criamos a infraestrutura que sempre faltou:
                    desempenho bruto, estabilidade real e suporte que resolve.
                </p>

                <a href="mailto:contato@vortexhost.com.br">
                    contato@vortexhost.com.br
                </a>

                <span class="footer-status" style="margin-top:.875rem;display:inline-flex">
                    SISTEMAS ONLINE
                </span>
            </div>

            <div class="footer-col">
                <h4>Serviços</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/host') }}">HospedaWeb</a></li>
                    <li><a href="{{ url('/vps') }}">VPS Premium</a></li>
                    <li><a href="{{ url('/cpanel') }}">Servidores de Jogos</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Suporte</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/cliente') }}">Área do Cliente</a></li>
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/registro') }}">Criar Conta</a></li>
                    <li><a href="mailto:contato@vortexhost.com.br">Abrir Ticket</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Legal</h4>
                <ul class="footer-links">
                    <li><a href="#">Termos de Serviço</a></li>
                    <li><a href="#">Política de Privacidade</a></li>
                    <li><a href="#">Política de Reembolso</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Redes Sociais</h4>
                <div class="social-icons">
                    <a href="https://instagram.com/Colocar_a_merda_do_link_aqui_gordao" target="_blank" rel="noopener noreferrer" class="social-icon" title="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>

                    <a href="https://discord.gg/Colocar_a_merda_do_link_aqui_gordao" target="_blank" rel="noopener noreferrer" class="social-icon" title="Discord">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.317 4.3698a19.7913 19.7913 0 00-4.8851-1.5152.0741.0741 0 00-.0785.0371c-.211.3753-.4447.8648-.6083 1.2495-1.8447-.2762-3.68-.2762-5.4868 0-.1636-.3933-.4058-.8742-.6177-1.2495a.077.077 0 00-.0785-.037 19.7363 19.7363 0 00-4.8852 1.515.0699.0699 0 00-.0321.0277C.5334 9.0458-.319 13.5799.0992 18.0578a.0824.0824 0 00.0312.0561c2.0528 1.5076 4.0413 2.4228 5.9929 3.0294a.0777.0777 0 00.0842-.0276c.4616-.6304.8731-1.2952 1.226-1.9942a.076.076 0 00-.0416-.1057c-.6528-.2476-1.2743-.5495-1.8722-.8923a.077.077 0 01-.0076-.1277c.1258-.0943.2517-.1923.3718-.2914a.0743.0743 0 01.0776-.0105c3.9278 1.7933 8.18 1.7933 12.0614 0a.0739.0739 0 01.0785.0095c.1202.099.246.1981.3728.2924a.077.077 0 01-.0066.1276 12.2986 12.2986 0 01-1.873.8914.0766.0766 0 00-.0407.1067c.3604.698.7719 1.3628 1.225 1.9932a.076.076 0 00.0842.0286c1.961-.6067 3.9495-1.5219 6.0023-3.0294a.077.077 0 00.0313-.0552c.5004-5.177-.8382-9.6739-3.5485-13.6604a.061.061 0 00-.0312-.0286zM8.02 15.3312c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9555-2.4189 2.157-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.9555 2.4189-2.1569 2.4189zm7.9748 0c-1.1825 0-2.1569-1.0857-2.1569-2.419 0-1.3332.9554-2.4189 2.1569-2.4189 1.2108 0 2.1757 1.0952 2.1568 2.419 0 1.3332-.946 2.4189-2.1568 2.4189z"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <span class="footer-copy">
                VortexHost © {{ date('Y') }}
            </span>

            <div class="footer-payments">
                <span class="payment-badge">PIX</span>
                <span class="payment-badge">Cartão</span>
                <span class="payment-badge">Boleto</span>
                <span class="payment-badge">PayPal</span>
            </div>
        </div>
    </div>
</footer>
</html>