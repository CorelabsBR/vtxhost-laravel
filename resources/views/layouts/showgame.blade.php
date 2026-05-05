<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VortexHost')</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo_vtxhost.png') }}">

    <link rel="stylesheet" href="{{ asset('css/basegame.css') }}">
    <link rel="stylesheet" href="{{ asset('css/headergame.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footergame.css') }}">
    <link rel="stylesheet" href="{{ asset('css/game2.css') }}">

    @stack('styles')
</head>

<body class="@yield('body_class')">

@if (!View::hasSection('hide_header'))
    @include('partials.header')
@endif

<main class="@yield('main_class')">
    @yield('content')
</main>

@if (!View::hasSection('hide_footer'))
    @include('partials.footer')
@endif

@stack('scripts')

</body>
</html>