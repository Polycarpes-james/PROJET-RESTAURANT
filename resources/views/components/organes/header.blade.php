@php
    $user = auth()->user();
    $navItems = [
        ['label' => 'Acceuil', 'href' => route('.rettine'), 'contain' => '.rettine'],
        ['label' => 'Nos plats', 'href' => route('rettine.plats'), 'contain' => '.plats'],
        ['label' => 'Commander', 'href' => route('rettine.commandes'), 'contain' => '.commandes'],
        ['label' => 'Reservation', 'href' => route('rettine.reservations'), 'contain' => '.reservations'],
        ['label' => 'Nous contacter', 'href' => '/contact', 'contain' => '.contact'],
    ];
@endphp

<header class="main-header-content {{ $background ?? null }}">
    <div class="main-logo">
        <h1><a href="{{ route('.rettine') }}"><span class="logo_R">R</span>ettine</a></h1>
    </div>
    <nav class="nav-content">
        @foreach ($navItems as $item)
            <a href="{{ $item['href'] }}" @class(['nav-link', 'modify' => str_contains($route, $item['contain'])])>{{ $item['label'] }}</a>
        @endforeach
    </nav>
    <div class="inscription-users">
        <a href="{{ auth()->check() ? route('rettine.panier') : route('guest.panier', ['invite_id' => Cookie::get('invite_id') ?? "guest"]) }}" id="ouvrirPanierBtn" class="btn btn-open-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            <span class="total-number-plats">{{ $total }}</span>   
        </a>
        @auth
            <div style="display: flex; align-items:center;">
                <p style="margin-bottom:8px; font-size: 19px;margin-right:10px">{{ truncateText($user->name, 5, false) }}</p>
                <button class="my-profile">
                    <svg class="user-icon" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor">
                        <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.4 0-8 2.2-8 5v1h16v-1c0-2.8-3.6-5-8-5Z"/>
                    </svg>
                </button>
                <div class="connexion_box tY">
                    <a href="{{ route('rettine.profile.index') }}" class="profile-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @method('delete')
                        @csrf
                        <button class="deconnexion">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                            Deconnexion
                        </button>
                    </form>
                </div>
            </div>
            {{-- <form action="{{ route('logout') }}" method="POST">
                @method('delete')
                @csrf
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                </button>
            </form> --}}
        @else
            <div class="inscription-simple">
                <a href="{{ route('signin.form') }}">Inscription</a>
                <a href="{{ route('login') }}">Connection</a>
            </div>
        @endauth              
    </div>
</header>