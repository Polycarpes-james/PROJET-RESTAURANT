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
    <aside id="suppression_dish" class="modal" style="display: none;">
        <div class="suppression-modal-item">
            <header class="suppression-header-modal">
                <h3 id="suppression-title-modal">Suppression du plat</h3>
            </header>
            <main class="suppression-main-modal">
                <p class="suppression-message"></p>
            </main>
            <footer class="suppression-footer-modal">
                <button class="btn-suppression" data-id="">Supprimer</button>
                <button class="btn-modal-close">Annuler</button>
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
                <a href="#panier" id="ouvrirPanierBtn" class="btn btn-primary">Voir votre panier</a>
            </footer>
        </div>
    </aside>


    <aside id="panierModal" class="modal modal-panier">
        <div class="modal-content-panier">
            <header class="modal-header-content">
                <h1 id="modalTitle">PANIER</h1>
            </header>
            <main class="modal-main-content">
                <p>La valeur TTC minimale des plats commandés doit être de 20.0€</p>
                <div id="modalPanierList">
                    @foreach ($plats as $item)
                        <div class="plat-item-modal">
                            <div class="items">
                                <div class="plat-item panier-item" data-plat="{{ $item['plat_id'] }}">
                                    <button class="delete-dish" data-id="{{ $item['plat_id']  }}" data-name="{{ $item['name'] ?? $item['plat']['name'] }}">×</button>
                                    <div class="picture-panier-panier">
                                        <img src="{{ $item['picture'] ?? $item['plat']->getPicture()->getPictureUrl(270, 200)}}" alt="">
                                    </div>
                                    <div class="item-description-panier">
                                        <div class="description-plat-panier">
                                            <a href="{{ $item['link_view'] ?? route('rettine.plats.show', ['plat' => $item['plat_id'], 'slug' => $item['plat']->getSlug()]) }}">{{ $item['name'] ?? $item['plat']['name'] }} <br> <span>{{ $item['price'] ?? $item['plat']['price']}} €</span></a>
                                            <p>{{ $item['description'] ?? $item['plat']->truncateText($item['plat']['description'], 75)}}</p>
                                        </div>
                                        <div class="actions">
                                            <div class="actions-items">
                                                <button class="minus" data-id="{{ $item['plat_id'] }}">−</button>
                                                <input type="text" class="text" data-id="{{ $item['plat_id'] }}" value="{{ $item['quantite'] }}" data-name="{{ $item['name'] ?? $item['plat']['name']}}" data-quantite="1" >
                                                <button class="plus" data-id="{{ $item['plat_id'] }}">+</button>
                                            </div>
                                            <div class="total-price-number-item">
                                                <p class="total-price-number innertTotal">Totals : {{decimal($item['prix_total'])}} €</p> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
            <footer class="modal-footer-content">
                <p><strong>Total :</strong> <span id="modalPanierTotal">{{ decimal($totalPrice) }}</span> €</p>
                <button id="btn-commande">Valide le panier</button>
            </footer>
        </div>
    </aside>
@endsection