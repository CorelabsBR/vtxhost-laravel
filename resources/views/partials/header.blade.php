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
                <a class="btn btn-primary btn-sm" href="{{ url('/cadastro') }}">Criar conta</a>
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