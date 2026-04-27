@extends('layouts.app')
@section('hide_header', true)
@section('hide_footer', true)
@section('content')

<header class="site-header">
    <div class="container">
        <nav class="nav-inner">

            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo_vtxhost.png') }}" alt="logo_vtxhost" id="logo_img">
            </a>

            <ul class="nav-links">
                <li><a href="{{ url('/') }}">Início</a></li>
                <li><a href="{{ url('/host') }}">Hospedagem</a></li>
                <li><a href="{{ url('/vps') }}">VPS</a></li>
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

<section class="hosting-section">
    <div class="container">

        <div class="hosting-header">
            <h1 class="section-title">Hospedagem Web</h1>
            <p class="section-sub">
                Infraestrutura otimizada para sites, WordPress e sistemas PHP.
            </p>
        </div>

        <div class="plans-grid">

            @forelse ($produtos as $produto)
                <div class="plan-card {{ $produto->featured ? 'plan-highlighted' : '' }}">

                    <div class="plan-card-header">
                        <div class="plan-icon">🌐</div>
                        <span class="plan-label">
                            {{ $produto->featured ? 'Mais vendido' : 'Hospedagem Web' }}
                        </span>
                    </div>

                    <h3 class="plan-name">{{ $produto->nome }}</h3>

                    <p class="plan-description">
                        {{ $produto->descricao ?? 'Hospedagem rápida, segura e pronta para produção.' }}
                    </p>

                    <ul class="plan-features">
                        <li><strong>RAM</strong> {{ $produto->ram ?? '-' }}</li>
                        <li><strong>Armazenamento</strong> {{ $produto->armazenamento ?? '-' }}</li>
                        <li><strong>Processamento</strong> {{ $produto->processamento ?? '-' }}</li>
                        <li><strong>Bancos de dados</strong> {{ $produto->bancos_dados ?? '-' }}</li>
                        <li><strong>Domínios</strong> {{ $produto->dominios ?? '-' }}</li>
                    </ul>

                    <hr class="plan-divider">

                    <div class="plan-footer">
                        <div class="plan-pricing">
                            <span class="plan-pricing-label">a partir de</span>
                            <div class="plan-pricing-value">
                                <span class="amount">R$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                                <span class="period">/mês</span>
                            </div>
                        </div>
<form method="POST" action="{{ route('checkout.redirect') }}" class="plan-checkout-form">
    @csrf

    <input type="hidden" name="items[0][plan_id]" value="{{ $produto->id }}">
    <input type="hidden" name="items[0][quantity]" value="1">

    <button type="submit" class="btn btn-primary">
        Contratar agora
    </button>
</form>
                    </div>

                </div>
            @empty

                <div class="plans-empty">
                    <h3>Nenhum plano disponível</h3>
                    <p>Cadastre produtos no banco para exibi-los aqui.</p>
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
                    <li><a href="{{ url('/web') }}">Servidores de Jogos</a></li>
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

@endsection