<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTA V - VortexHost</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo_vtxhost.png') }}">
    <link rel="stylesheet" href="{{ asset('css/gtav.css') }}">
</head>
<body>
<header class="site-header">
    <div class="container">
        <nav class="nav-inner">
            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo_vtxhost.png') }}" alt="logo_vtxhost" id="logo_img">
                <span class="brand-mark">VORTEX<span>HOST</span></span>
            </a>

            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Início</a></li>
                <li><a href="{{ url('/games') }}">Hospedagem de Jogos</a></li>
                <li><a href="{{ url('/vps') }}">VPS</a></li>
                <li><a href="{{ url('/web') }}">Hospedagem Web</a></li>
            </ul>

            <div class="nav-actions">
                <span class="nav-area-note">Los Santos Online</span>
                <a class="btn btn-ghost btn-sm" href="{{ url('/login') }}">Entrar</a>
                <a class="btn btn-primary btn-sm" href="{{ url('/registro') }}">Criar conta</a>
            </div>

            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </nav>

        <nav class="mobile-nav" id="mobile-nav">
            <a href="{{ url('/') }}">Início</a>
            <a href="{{ url('/games') }}">Hospedagem de Jogos</a>
            <a href="{{ url('/vps') }}">VPS</a>
            <a href="{{ url('/web') }}">Hospedagem Web</a>
            <a href="{{ url('/login') }}">Entrar</a>
            <a href="{{ url('/registro') }}">Criar conta</a>
        </nav>
    </div>
</header>

<script src="{{ asset('js/header.js') }}"></script>

<section class="gta5-section">
    <div class="gta5-skyline"></div>
    <div class="gta5-noise"></div>

    <div class="container">
        <div class="gta5-hero">
            <div class="gta5-badge">Premium Game Hosting</div>
            <h1 class="gta5-title">{{ $jogo->nome }}</h1>
            <p class="gta5-sub">
                Hospedagem no clima de Los Santos: rápida, estável e pronta pra caos pesado de servidor.
            </p>
            <div class="gta5-meta">
                <span>SSD NVMe</span>
                <span>Proteção DDoS</span>
                <span>Deploy instantâneo</span>
            </div>
        </div>

        <div class="gta5-plans-grid">
            @forelse ($plans as $plan)
                <article class="gta5-card">
                    <div class="gta5-card-top">
                        <div class="gta5-icon-box">
                            @if ($jogo->icon)
                                <img src="{{ asset('img/games/icons/' . $jogo->icon) }}" alt="{{ $jogo->nome }}" class="gta5-icon-img">
                            @else
                                <span>V</span>
                            @endif
                        </div>
                        <span class="gta5-wanted">★ ★ ★ ★ ★</span>
                    </div>

                    <p class="gta5-plan-tag">Plano</p>
                    <h3 class="gta5-plan-name">{{ $plan->name }}</h3>

                    <ul class="gta5-plan-specs">
                        <li><span>RAM</span><strong>{{ $plan->ramFormatada() }}</strong></li>
                        <li><span>Disco</span><strong>{{ $plan->discoFormatado() }}</strong></li>
                        <li><span>CPU</span><strong>{{ $plan->cpuFormatada() }}</strong></li>
                    </ul>

                    <div class="gta5-card-footer">
                        <a href="{{ route('cart.checkout', $plan->plan) }}" class="btn btn-primary btn-md">Selecionar plano →</a>
                    </div>
                </article>
            @empty
                <div class="gta5-empty">
                    <span>V</span>
                    <h3>Sem planos ainda</h3>
                    <p>Configura os planos no banco, camarada.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <div class="brand">
                    <img src="{{ asset('img/logo_vtxhost.png') }}" alt="logo_vtxhost" id="logo_img">
                    <span class="brand-mark">VORTEX<span>HOST</span></span>
                </div>
                <p>Infraestrutura bruta para servidores de jogos, VPS e hospedagem web.</p>
                <a href="mailto:contato@vortexhost.com.br">contato@vortexhost.com.br</a>
                <span class="footer-status">SISTEMAS ONLINE</span>
            </div>

            <div class="footer-col"><h4>Serviços</h4><ul class="footer-links"><li><a href="{{ url('/web') }}">HospedaWeb</a></li><li><a href="{{ url('/vps') }}">VPS Premium</a></li><li><a href="{{ url('/games') }}">Servidores de Jogos</a></li></ul></div>
            <div class="footer-col"><h4>Suporte</h4><ul class="footer-links"><li><a href="{{ url('/cliente') }}">Área do Cliente</a></li><li><a href="{{ url('/login') }}">Login</a></li><li><a href="{{ url('/registro') }}">Criar Conta</a></li><li><a href="mailto:contato@vortexhost.com.br">Abrir Ticket</a></li></ul></div>
            <div class="footer-col"><h4>Legal</h4><ul class="footer-links"><li><a href="#">Termos de Serviço</a></li><li><a href="#">Política de Privacidade</a></li><li><a href="#">Política de Reembolso</a></li></ul></div>
            <div class="footer-col"><h4>Pagamentos</h4><div class="footer-payments"><span>PIX</span><span>Cartão</span><span>Boleto</span><span>PayPal</span></div></div>
        </div>
        <div class="footer-bottom"><span>VortexHost © {{ date('Y') }}</span><span>Los Santos Datacenter Division</span></div>
    </div>
</footer>
</body>
</html>
