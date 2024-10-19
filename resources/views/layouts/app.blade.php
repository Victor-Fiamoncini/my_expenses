<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="theme-color" content="#78c2ad" />
        <meta name="msapplication-navbutton-color" content="#78c2ad" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#78c2ad" />
        <link type="image/png" sizes="96x96" rel="icon" href="{{ asset('images/favicon.png') }}" />
        <title>My Expenses @yield('title', '')</title>

        @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        @include('partials.header')

        <div class="container py-4">
            @yield('content')
        </div>
    </body>
</html>
