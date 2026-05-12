<header class="site-header">
    <div class="container">
        <nav class="nav-inner">

            <a class="brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo_vtxhost.png') }}" alt="logo_vtxhost" id="logo_img">
            </a>

            @php
                $current = request()->path();

                function navActive($paths = []) {
                    foreach ($paths as $path) {
                        if (request()->is($path)) {
                            return 'active';
                        }
                    }

                    return '';
                }
            @endphp

            <ul class="nav-links">
                <li>
                    <a
                        href="{{ url('/') }}"
                        class="{{ request()->is('/') ? 'active' : '' }}"
                    >
                        Início
                    </a>
                </li>

                <li>
                    <a
                        href="{{ url('/games') }}"
                        class="{{ navActive(['games', 'games/*']) }}"
                    >
                        Hospedagem de Jogos
                    </a>
                </li>

                <li>
                    <a
                        href="{{ url('/vps') }}"
                        class="{{ navActive(['vps', 'vps/*']) }}"
                    >
                        VPS
                    </a>
                </li>

                <li>
                    <a
                        href="{{ url('/web') }}"
                        class="{{ navActive(['web', 'web/*']) }}"
                    >
                        Hospedagem Web
                    </a>
                </li>
            </ul>

            <div class="nav-actions">
                @auth
                    <span class="nav-area-note">Área do cliente</span>

                    <a class="btn btn-primary btn-sm" href="{{ url('/dashboard') }}">
                        Painel
                    </a>
                @else
                    <span class="nav-area-note">Cliente?</span>

                    <a class="btn btn-ghost btn-sm" href="{{ url('/login') }}">
                        Entrar
                    </a>

                    <a class="btn btn-primary btn-sm" href="{{ url('/registro') }}">
                        Criar conta
                    </a>
                @endauth
            </div>

            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>

        </nav>

        <nav class="mobile-nav" id="mobile-nav">
            <a
                href="{{ url('/') }}"
                class="{{ request()->is('/') ? 'active' : '/' }}"
            >
                Início
            </a>

            <a
                href="{{ url('/games') }}"
                class="{{ navActive(['games', 'games/*']) }}"
            >
                Hospedagem de Jogos
            </a>

            <a
                href="{{ url('/vps') }}"
                class="{{ navActive(['vps', 'vps/*']) }}"
            >
                VPS
            </a>

            <a
                href="{{ url('/web') }}"
                class="{{ navActive(['web', 'web/*']) }}"
            >
                Hospedagem Web
            </a>

            @auth
                <a href="{{ url('/dashboard') }}">
                    Área do Cliente
                </a>
            @else
                <a href="{{ url('/login') }}">
                    Entrar
                </a>

                <a href="{{ url('/registro') }}">
                    Criar conta
                </a>
            @endauth
        </nav>
    </div>
</header>

<script src="{{ asset('js/header.js') }}"></script>