<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Aboreto&display=swap" rel="stylesheet">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Aboreto&family=Martel:wght@200;300;400;600;700;800;900&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="/favicon.png">

        <title>{{ config('app.name') }}</title>

        {{-- Dev only for HTTP requests --}}
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <div class="main">
            @include('nav')

            <div class="content">
                @yield('content')
            </div>

            @include('footer')
        </div>
    </body>
</html>