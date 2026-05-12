@extends('layouts.app')

@section('title', 'Área do Cliente')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/client-dashboard.css') }}">
@endpush

@section('content')

<main class="client-page">
    <section class="client-hero">
        <div class="container">
            <div class="client-hero-grid">

                <div class="client-hero-left">
                    <span class="pill pill-accent">
                        Área do Cliente
                    </span>

                    <h1>
                        Bem-vindo,
                        {{ explode(' ', auth()->user()->nome)[0] }}
                    </h1>

                    <p>
                        Gerencie serviços, pagamentos, servidores e informações
                        da sua conta em um único painel.
                    </p>

                    <div class="client-actions">
                        <a href="/games" class="btn btn-primary">
                            Contratar serviço
                        </a>

                        <a href="/suporte" class="btn btn-ghost">
                            Abrir ticket
                        </a>
                    </div>
                </div>

                <div class="client-hero-right">
                    <div class="hero-status-card">
                        <div class="hero-status-head">
                            <span>Status da Conta</span>

                            <div class="status-online">
                                <span></span>
                                Ativa
                            </div>
                        </div>

                        <div class="hero-status-grid">
                            <div>
                                <strong>0</strong>
                                <span>Serviços</span>
                            </div>

                            <div>
                                <strong>0</strong>
                                <span>Faturas</span>
                            </div>

                            <div>
                                <strong>R$ 0,00</strong>
                                <span>Último pagamento</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="client-content">
        <div class="container">

            <div class="dashboard-grid">

                <aside class="dashboard-sidebar">

                    <div class="sidebar-card">
                        <div class="sidebar-user">
                            <div class="sidebar-avatar">
                                {{ strtoupper(substr(auth()->user()->nome, 0, 1)) }}
                            </div>

                            <div>
                                <strong>{{ auth()->user()->nome }}</strong>
                                <span>{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <span class="sidebar-title">
                            Navegação
                        </span>

                        <nav class="sidebar-nav">
                            <a href="#" class="active">
                                Dashboard
                            </a>

                            <a href="#">
                                Meus Serviços
                            </a>

                            <a href="#">
                                Faturas
                            </a>

                            <a href="#">
                                Tickets
                            </a>

                            <a href="#">
                                Perfil
                            </a>

                            <a href="#">
                                Segurança
                            </a>
                        </nav>
                    </div>

                </aside>

                <div class="dashboard-main">

                    <div class="dashboard-cards">

                        <div class="dash-card">
                            <div class="dash-card-top">
                                <span class="dash-card-title">
                                    Serviços ativos
                                </span>

                                <span class="dash-card-icon">
                                    ⚡
                                </span>
                            </div>

                            <strong>0</strong>

                            <small>
                                Nenhum serviço ativo no momento
                            </small>
                        </div>

                        <div class="dash-card">
                            <div class="dash-card-top">
                                <span class="dash-card-title">
                                    Faturas pendentes
                                </span>

                                <span class="dash-card-icon">
                                    💳
                                </span>
                            </div>

                            <strong>0</strong>

                            <small>
                                Tudo em dia, товарищ
                            </small>
                        </div>

                        <div class="dash-card">
                            <div class="dash-card-top">
                                <span class="dash-card-title">
                                    Tickets abertos
                                </span>

                                <span class="dash-card-icon">
                                    🎧
                                </span>
                            </div>

                            <strong>0</strong>

                            <small>
                                Sem tickets ativos
                            </small>
                        </div>

                        <div class="dash-card">
                            <div class="dash-card-top">
                                <span class="dash-card-title">
                                    Conta criada
                                </span>

                                <span class="dash-card-icon">
                                    📅
                                </span>
                            </div>

                            <strong>
                                {{ auth()->user()->created_at?->format('d/m/Y') }}
                            </strong>

                            <small>
                                Cliente VortexHost
                            </small>
                        </div>

                    </div>

                    <div class="dashboard-panels">

                        <div class="dashboard-panel">
                            <div class="panel-head">
                                <div>
                                    <h2>Meus serviços</h2>
                                    <p>
                                        Seus servidores e hospedagens aparecerão aqui.
                                    </p>
                                </div>

                                <a href="/games" class="btn btn-sm btn-primary">
                                    Novo serviço
                                </a>
                            </div>

                            <div class="empty-state">
                                <div class="empty-icon">
                                    🖥
                                </div>

                                <h3>
                                    Nenhum serviço encontrado
                                </h3>

                                <p>
                                    Contrate uma hospedagem para começar.
                                </p>
                            </div>
                        </div>

                        <div class="dashboard-panel">
                            <div class="panel-head">
                                <div>
                                    <h2>Atividade recente</h2>
                                    <p>
                                        Últimos eventos da sua conta.
                                    </p>
                                </div>
                            </div>

                            <div class="activity-list">

                                <div class="activity-item">
                                    <div class="activity-dot"></div>

                                    <div>
                                        <strong>
                                            Conta criada
                                        </strong>

                                        <span>
                                            Sua conta foi criada com sucesso.
                                        </span>
                                    </div>

                                    <small>
                                        Agora
                                    </small>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </section>
</main>

@endsection