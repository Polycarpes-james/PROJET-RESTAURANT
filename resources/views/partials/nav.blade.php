<header class="main-header-content {{ $background_header ?? null }}">
    <div class="main-logo">
        <h1><a href="{{ route('.rettine') }}"><span class="logo_R">R</span>ettine</a></h1>
    </div>
    <nav class="nav-content">
        <a href="{{ route('.rettine') }}" @class(['nav-link', 'modify' => str_contains($route, '.rettine')])>Acceuil</a>
        <a href="{{ route('rettine.plats') }}" @class(['nav-link', 'modify' => str_contains($route, '.plats')])>Plats</a>
        <a href="#">menus</a>
        <a href="{{ route('rettine.commandes') }}" @class(['nav-link', 'modify' => str_contains($route, '.commandes')])>commander</a>
        <a href="#">avis</a>
        <a href="{{ route('rettine.reservations') }}" @class(['nav-link', 'modify' => str_contains($route, '.reservations')])>reservation</a>
        <a href="#">a propos</a>
    </nav>
    <div class="inscription-users">
        <a href="{{ auth()->check() ? route('rettine.panier') : route('guest.panier', ['invite_id' => Cookie::get('invite_id')]) }}" id="ouvrirPanierBtn" class="btn btn-open-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            <span class="total-number-plats">{{ $total }}</span>   
        </a>
        @auth
            <div style="display: flex; align-items:center;">
                <p style="margin-bottom:8px; font-size: 19px">{{ Auth::user()->name }}</p>
                <a href="{{ route('rettine.profile.index') }}">
                <?xml version="1.0"?><svg style="background-color:white;width:35px;border-radius:100%;max-width:100%;border:none;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="info"/><g id="icons"><path d="M12,0C5.4,0,0,5.4,0,12c0,6.6,5.4,12,12,12s12-5.4,12-12C24,5.4,18.6,0,12,0z M12,4c2.2,0,4,2.2,4,5s-1.8,5-4,5   s-4-2.2-4-5S9.8,4,12,4z M18.6,19.5C16.9,21,14.5,22,12,22s-4.9-1-6.6-2.5c-0.4-0.4-0.5-1-0.1-1.4c1.1-1.3,2.6-2.2,4.2-2.7   c0.8,0.4,1.6,0.6,2.5,0.6s1.7-0.2,2.5-0.6c1.7,0.5,3.1,1.4,4.2,2.7C19.1,18.5,19.1,19.1,18.6,19.5z" id="user2"/></g></svg>                    
                </a>
                <div class="connexion_box">

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