<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @viteReactRefresh
    @vite(['resources/js/app.tsx', 'resources/css/app.css'])
    <title>@yield('title') | RETTINE</title>
</head>
@php
    $route = request()->route()->getName();
    $background_header = trim($__env->yieldContent('background_header')); 

@endphp
<body>
    <div class="@yield('body-style', 'body-header')" style="background: radial-gradient(600% 200px at 0% 0%, #000000bc 0, transparent 500%), @yield('image-header')">
        <x-organes.header :route="$route" :background="$background_header"></x-organes.header>
        @yield('firstpart')
    </div>
    <main class="@yield('main-style', 'main-container')">
        @yield('content')
    </main>
    <x-organes.footer></x-organes.footer>
</body>
</html>