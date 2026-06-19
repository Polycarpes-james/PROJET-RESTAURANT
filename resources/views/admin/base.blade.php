<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    @vite(['resources/js/app.ts', 'resources/css/app.css'])
    <title>@yield('title') | ADMIN </title>
</head>
@php
    $route = request()->route()->getName();
@endphp
<body>
    <div class="container-admin">
        <aside class="header-container-admin">
            <div class="logo">
                <a href="{{ route('admin.dashboard') }}">
                    La Rettine Admin
                </a>
            </div>
            <nav class="nav-admin-container">
                <a href="{{ route('admin.user.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.user')])>Utilisateurs</a>
                <a href="{{ route('admin.plat.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, 'admin.plat')])>Plats</a>
                <a href="{{ route('admin.category.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.category')])>Categories</a>
                <a href="{{ route('admin.ingredient.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.ingredient')])>Ingredients</a>
                <a href="{{ route('admin.menu.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.menu')])>Menus</a>
                <a href="{{ route('admin.reservation.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.reservation')])>Reservations</a>
                <a href="{{ route('admin.commande.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.commande')])>Commandes</a>
                <a href="{{ route('admin.avis.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.avis')])>Avis</a>
            </nav>
        </aside>
        <div class="all-content-admin">
            <header class="authentification-topbar">
                <h1>@yield('page-title', 'Dashboard')</h1>
                @if (session('success'))
                    <p class="success btn-item-session">
                        {{ session('success') }}
                        <button class="btn-session">×</button>
                    </p>
                @endif
                @if (session('delete'))
                    <p class="delete btn-item-session">
                        {{ session('delete') }}
                        <button class="btn-session">×</button>
                    </p>
                @endif
                <div class="user">
                    Admin
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method("delete")
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                            </button>
                        </form>
                    @endauth
                </div>
            </header>
            <section class="content">
                @yield('content')
            </section>
        </div>
    </div>
</body>
</html>