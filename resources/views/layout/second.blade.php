<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @viteReactRefresh
    @vite(['resources/js/app.tsx', 'resources/css/app.css'])
    <title>@yield('title') | RETTINE</title>
</head>
@php
    $route = request()->route()->getName();
    $background_header = trim($__env->yieldContent('background_header')); 
@endphp
<body>
    <div class="@yield('body-style', 'body-header')">
        <x-organes.header :route="$route" :background="$background_header"></x-organes.header>
        <div class="@yield('header-content-style', 'header-content')">
            @yield('header-content')
        </div>
    </div>
    <main class="@yield('main-style', 'main-container')">
        @yield('content_second')
    </main>
    <x-organes.footer></x-organes.footer>
</body>
</html>