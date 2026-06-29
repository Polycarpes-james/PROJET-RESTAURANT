<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/js/app.ts', 'resources/css/app.css'])
    <title>@yield('title') | ADMIN </title>
</head>
@php
    $route = request()->route()->getName();
    $user = Auth::user()->role;
    $userRole = $user === "admin" ? "Administrateur" : "Super Administrateur";
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
                <div class="main-part">
                    <h4>PRINCIPAL</h4>
                    <a href="{{ route('admin.dashboard') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.dashboard')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>                    
                        Dashboard
                    </a>
                    <a href="{{ route('admin.plat.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, 'admin.plat')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-template-icon lucide-layout-template"><rect width="18" height="7" x="3" y="3" rx="1"/><rect width="9" height="7" x="3" y="14" rx="1"/><rect width="5" height="7" x="16" y="14" rx="1"/></svg>
                        Plats
                    </a>
                    <a href="{{ route('admin.category.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.category')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-sort-descending-icon lucide-list-sort-descending"><path d="M15 12H3"/><path d="M3 5h18"/><path d="M9 19H3"/></svg>
                        Categories
                    </a>
                    <a href="{{ route('admin.ingredient.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.ingredient')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-basket-icon lucide-shopping-basket"><path d="m15 11-1 9"/><path d="m19 11-4-7"/><path d="M2 11h20"/><path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4"/><path d="M4.5 15.5h15"/><path d="m5 11 4-7"/><path d="m9 11 1 9"/></svg>
                        Ingredients
                    </a>
                    <a href="{{ route('admin.menu.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.menu')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-app-window-icon lucide-app-window"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M10 4v4"/><path d="M2 8h20"/><path d="M6 4v4"/></svg>
                        Menus
                    </a>
                    <a href="{{ route('admin.reservation.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.reservation')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-text-icon lucide-notebook-text"><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M9.5 8h5"/><path d="M9.5 12H16"/><path d="M9.5 16H14"/></svg>
                        Reservations
                    </a>
                    <a href="{{ route('admin.commande.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.commande')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-notebook-icon lucide-notebook"><path d="M2 6h4"/><path d="M2 10h4"/><path d="M2 14h4"/><path d="M2 18h4"/><rect width="16" height="20" x="4" y="2" rx="2"/><path d="M16 2v20"/></svg>
                        Commandes
                    </a>
                    <a href="{{ route('admin.avis.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.avis')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-navigation-icon lucide-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                        Avis
                    </a>
                </div>
                <div class="gestion-part">
                    <h4>GESTION</h4>
                    <a href="{{ route('admin.avis.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.avis')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cog-icon lucide-cog"><path d="M11 10.27 7 3.34"/><path d="m11 13.73-4 6.93"/><path d="M12 22v-2"/><path d="M12 2v2"/><path d="M14 12h8"/><path d="m17 20.66-1-1.73"/><path d="m17 3.34-1 1.73"/><path d="M2 12h2"/><path d="m20.66 17-1.73-1"/><path d="m20.66 7-1.73 1"/><path d="m3.34 17 1.73-1"/><path d="m3.34 7 1.73 1"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="12" r="8"/></svg>                        
                        Paramètres
                    </a>
                    <a href="{{ route('admin.user.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.user')])>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
                        Users
                    </a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="avatar">
                        <img src="{{ Auth::user()->getPictureUrl(40, 40) }}" style="border-radius:100%" alt="">
                    </div>
                    <div class="user-info">
                        <p class="user-name">{{ Auth::user()->name }}</p>
                        <p class="user-role">{{ $userRole }}</p>
                    </div>
                </div>
            </div>
        </aside>
        <div class="all-content-admin">
            <header class="authentification-topbar">
                <h1>@yield('page-title', 'Dashboard')</h1>
                @if (session('success') || session('delete'))
                    <p class="success btn-item-session">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" height="20" width="20" class="flex-none">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"></path>
                        </svg>
                        <span>{{ session('success') ?? session('delete')}}</span>
                        <button class="btn-session">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                        </button>
                    </p>
                @endif
                <div class="user">
                    Admin
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            @method("delete")
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
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