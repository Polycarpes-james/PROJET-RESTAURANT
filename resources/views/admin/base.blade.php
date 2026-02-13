<!DOCTYPE html>
<html lang="en">
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
            <h1><a href="{{ route('admin.dashboard') }}">Dashboard</a></h1>
            <nav class="nav-admin-container">
                <a href="{{ route('admin.plat.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, 'admin.plat')])>Les Plats</a>
                <a href="{{ route('admin.category.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.category')])>Les Categories</a>
                <a href="{{ route('admin.ingredient.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.ingredient')])>Les Ingredients</a>
                <a href="{{ route('admin.menu.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.menu')])>Les Menus</a>
                <a href="{{ route('admin.reservation.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.reservation')])>Les Reservations</a>
                <a href="{{ route('admin.commande.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.commande')])>Les Commandes</a>
                <a href="{{ route('admin.avis.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.avis')])>Les Avis</a>
            </nav>
        </aside>
        <div class="all-content-admin">
            <div class="authentification">
                @if (session('success'))
                    <p class="success">{{ session('success') }}</p>
                @endif
                @if (session('delete'))
                    <p class="delete">{{ session('delete') }}</p>
                @endif
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
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        // new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
        // document.addEventListener("DOMContentLoaded", function() {
        //     new TomSelect("#select-multiple", {
        //         create: true, // possibilité d’ajouter de nouvelles valeurs
        //         sortField: {
        //             field: "text",
        //             direction: "asc"
        //         },
        //         maxItems: null, // limite le nombre d’éléments sélectionnés
        //         placeholder: "Sélectionnez ou ajoutez...",
        //         persist: false,
        //         render: {
        //             item: function(data, escape) {
        //                 // Tom Select a besoin de data-value pour supprimer
        //                 return `<div class="ts-item" data-value="${escape(data.value)}">
        //                             ${escape(data.text)}
        //                             <span class="ts-remove">&times;</span>
        //                         </div>`;
        //             },
        //             option: function(data, escape) {
        //                 return `<div class="option">${escape(data.text)}</div>`;
        //             }
        //         }
        //     });
        // });
    </script>
</body>
</html>