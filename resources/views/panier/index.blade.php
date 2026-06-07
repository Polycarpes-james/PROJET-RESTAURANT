@extends('layout.second')


@section('title', "PANIER")

@section('main-style', 'panier-container')


@section('body-style', 'panier-body')

@section('background_header', "panier-header")

@section('header-content')
    <div class="content-commandes-header">
        <h1>Votre Panier</h1>
        <p>
            Effectuez vos commandes dans le panier <br> Dans votre panier vous trouvez touts les plats que vous avez ajouté
        </p>
    </div>
@endsection

@section('content_second')
    {{-- @php
        echo '<pre>';
print_r($panier);
die();
 @endphp --}}
 {{-- @php
    dump($plats)
 @endphp --}}
    <aside id="suppression_dish" class="modal" style="display: none;">
        <div class="suppression-modal-item">
            <header class="suppression-header-modal">
                <h3 id="suppression-title-modal">Suppression du plat</h3>
            </header>
            <main class="suppression-main-modal">
                <p class="suppression-message"></p>
            </main>
            <footer class="suppression-footer-modal">
                <button class="btn-suppression">Ok</button>
                <button class="btn-modal-close">×</button>
            </footer>
        </div>
    </aside>

    <aside id="customModal" class="modal" style="display: none;">
        <div class="modal-content" id="modalContent">
            <header class="modal-header-content">
                <h3 id="modalTitle">Mon panier</h3>
                <button id="closeModal" class="modal-close">×</button>
            </header>
            <main class="modal-main-content">
                <p id="modalMessage"></p>
            </main>
            <footer class="modal-footer-content">
                <a href="{{ auth()->check() ? route('rettine.panier') : route('invite.panier') }}" id="ouvrirPanierBtn" class="btn btn-primary">Voir votre panier</a>
            </footer>
        </div>
    </aside>

    <aside id="platWindowsInfo" class="modal" style="display: none;">
        <div class="main-modal-containt" id="mainModalContaint">
            <header id="modalHead">
                <h3 class="modalTitle"></h3>
                <button id="closeBtn" class="modal-close-btn">×</button>
            </header>
            <main class="modal-container">
            </main>
        </div>
    </aside>

    <aside id="panierModal" class="modal modal-panier" data-condition="{{ $panier_condition }}">
        <div class="modal-content-panier">
            <header class="modal-header-content">
                <h1 id="modalTitle">PANIER</h1>
                <button class="vider-panier">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brush-cleaning-icon lucide-brush-cleaning"><path d="m16 22-1-4"/><path d="M19 14a1 1 0 0 0 1-1v-1a2 2 0 0 0-2-2h-3a1 1 0 0 1-1-1V4a2 2 0 0 0-4 0v5a1 1 0 0 1-1 1H6a2 2 0 0 0-2 2v1a1 1 0 0 0 1 1"/><path d="M19 14H5l-1.973 6.767A1 1 0 0 0 4 22h16a1 1 0 0 0 .973-1.233z"/><path d="m8 22 1-4"/></svg>
                </button>
            </header>
            @if ($panier_condition !== 0)
                <main class="panier-main-content">
                    <p>La valeur TTC minimale des plats commandés doit être de 20.0€</p>
                    <div id="modalPanierList">
                        @foreach ($plats as $item)
                            <div class="plat-item-modal">
                                <div class="items">
                                    <div class="plat-item panier-item" data-plat="{{ $item['plat_id'] }}">
                                        <div class="picture-panier-panier">
                                            <img class="picture-plat-item" src="{{ $item['picture'] }}" alt="">
                                        </div>
                                        <div class="item-description-panier">
                                            <div class="description-plat-panier">                                                
                                                <a href="{{ $item['link_view'] }}">{{ $item['name'] }}</a>
                                                <span>{{ $item['price'] }} €</span>
                                            </div>
                                            <div class="actions">
                                                <div class="actions-items">
                                                    <button class="{{ $item['quantite'] === 1 ? "delete-dish-link" : "minus"}} minus-btn"  data-name="{{ $item['name'] }}" data-id="{{ $item['plat_id'] }}">
                                                        @if ($item['quantite'] <= 1)
                                                        ×
                                                        @else
                                                        −
                                                        @endif
                                                    </button>
                                                    <input type="text" class="text" data-id="{{ $item['plat_id'] }}" value="{{ $item['quantite'] }}" data-name="{{ $item['name'] }}" data-quantite="1" >
                                                    <button class="plus" data-id="{{ $item['plat_id'] }}">+</button>
                                                </div>
                                                <div class="total-price-number-item">
                                                    <p class="total-price-number">{{decimal($item['prix_total'])}} €</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </main>
                <footer class="panier-footer-content">
                        <h1>Listing et bilan des plats du panier</h1>
                        <div class="footer-main-container">
                            @foreach ($categories as $cate)
                                <div class="category-plat-item category-plat-{{ $cate['category']->getSlug()}}">
                                    <div class="items">
                                        <h4>{{ $cate['category']->name }}</h4>
                                        @foreach ($cate['plats'] as $item)
                                            {{-- @if ($item['category_id'] === $cate['category']->id) --}}
                                                <div class="plat-item plat-{{ $item['plat_id'] ?? $item->plat->id }}">
                                                <p style="opacity: 0.7">{{ $item['name'] ?? $item->plat->name }}</p>
                                                <div>
                                                    <small>{{ $item['quantite'] ?? $item->quantite }} × {{ $item['price'] ?? $item->plat->price }} €</small>
                                                    <p style="font-weight: bold">{{ $item['prix_total'] ?? $item->prix_total }} €</p>
                                                </div>
                                            </div> 
                                            {{-- @endif    --}}
                                        @endforeach
                                        <div class="decompte-plats">
                                            <p>Totals : {{ $cate['totalQuantite'] }} </p>
                                            <p style="font-weight: bold; color:#1E3A8A"> Prix : {{ $cate['totalPrix'] }} €</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="footer-header">
                            <p id="modalPanierTotal">{{ decimal($totalPrice) }} €</p>
                            <a href="{{ $session ? route('invite.commande') : route('rettine.commande_plats.index', $panier ?? 0) }}" id="btn-commande">Valide le panier</a>
                        </div>
                </footer>
            @else
                <div class="panier_empty">
                    <h2>Votre panier est vide pour le moment</h2>
                    <img src="/img/panier-vide.png" alt="PANIER VIDE" width="20%">
                    <a href="{{ route('rettine.commandes') }}" class="commandFromCart">Ajouter un plat au panier</a>
                </div>
            @endif
            <div class="panier_empty" style="display:none">
                <h2>Votre panier est vide pour le moment</h2>
                <img src="/img/panier-vide.png" alt="PANIER VIDE" width="20%">
                <a href="{{ route('rettine.commandes') }}" class="commandFromCart">Ajouter un plat au panier</a>
            </div>
        </div>
    </aside>
@endsection