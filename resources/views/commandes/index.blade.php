@extends('layout.second')

@section('title', 'COMMANDES')

@section('main-style', 'commande-main-contain')

@section('body-style', 'commandes-body')

@section('background_header', "commandes-header")

@section('header-content')
    <div class="content-commandes-header">
        <h1>Faites vos commandes en ligne, pour une meuilleur experience</h1>
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Pariatur adipisci totam voluptatibus nesciunt dolor distinctio velit fugit consequuntur voluptas mollitia, a eligendi facilis vero accusantium eveniet reprehenderit doloribus in eos? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt, ut. Voluptates, non distinctio voluptatibus laboriosam quas officiis nam unde tempore aperiam rerum eius, omnis fuga. Alias atque nihil dignissimos nesciunt.
        </p>
    </div>
@endsection

@section('content_second')
    <aside id="customModal" class="modal" style="display: none;">
        <div class="modal-content" id="modalContent">
            <header class="modal-header-content">
                <h3 id="modalTitle"></h3>
                <button id="closeModal" class="modal-close">×</button>
            </header>   
            <main class="modal-main-content">
                <p id="modalMessage"></p>
            </main>
            <footer class="modal-footer-content">
                <a href="{{ auth()->check() ? route('rettine.panier') : route('invite.panier') }}" id="ouvrirPanierBtn" class="btn btn-open-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="33" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                </a>
            </footer>
        </div>
    </aside>

    <div class="pass-commande-items">
        <div>
            <div>
                <h2 class="commande-h2">Passez votre commande</h2>
                <p>Parcourir les plats pour votre choix de commande</p>
            </div>
        </div>            
        <div class="categories-items-commandes">
            @foreach ($categories as $category)
                <a href="#{{ $category->getSlug() }}" class="cat-link">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="pass-commande">

        <aside id="modal-connect" class="connect-modal" style="display: none;">
            <div class="modal-content-connect">
                <img src="{{ asset('img/modal-2.jpg') }}" alt="">
                <div class="modal-content-item"></div>
            </div>
        </aside>

        <div class="plats-items">
            @foreach ($categories as $cate)
                <div class="items-{{ $cate->getSlug() }} plats-item" id="{{ $cate->getSlug() }}">
                    <h2>{{ $cate->name }}</h2>
                    <div class="content-plats">
                        @forelse ($cate->plates as $plat)
                            <div class="items">
                                <div class="items-content {{  in_array($plat->getSlug(), session('platsInCard') ?? []) ? "deep-active" : "" }}" data-plat-id="{{ $plat->id }}">
                                    <div class="item">
                                        <div class="disponible-plat">
                                            <h3>{{ $plat->truncateText($plat->name, 25)}}</h3>
                                            <div>
                                                <p class="price">{{ $plat->price }} €</p>
                                                <p class="price-none">{{ $plat->price + 12 }} €</p>
                                            </div>
                                        </div>
                                        <div class="btns-panier">
                                            <p class="description">{{ $plat->truncateText($plat->description, 50) }}</p>
                                            @if ($plat->disponible === 'yes')
                                                <button class="add-card" type="button" data-id="{{ $plat->id }}" data-name="{{ $plat->name }}" data-price="{{ $plat->price }}" data-picture="{{ $plat->getPicture()->getPictureUrl(100, 100) }}" data-quantite="1">
                                                    <span class="clickable"></span>
                                                </button>
                                            @endif
                                            <div class="items-btns">
                                                <a href="{{ route('rettine.plats.show', ['plat' => $plat, 'slug' => $plat->getSlug()]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                                </a>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="33" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                                <span class="total-number-plats-command total-number-plats-header" data-id="{{ $plat->id }}" >{{ auth()->check() ? $plat->panierPlats->where('panier_id', ($panier ? $panier->id : 0))->pluck('quantite')->sum() : 0  }}</span>                                                   
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pictures-parts">
                                        @if ($plat->getPicture())
                                            <img src="{{ $plat->getPicture()->getPictureUrl(240, 150) }}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Il n'y pas de plat sur cette category</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

