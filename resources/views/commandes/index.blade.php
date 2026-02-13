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

        <aside id="panierModal" class="modal modal-information-client" style="display: none;">
            <div class="modal-content-panier">
                <header class="modal-header-content">
                    <h3 id="modalTitle">INFORMATIONS POUR LA LIVRAISON</h3>
                    <button id="closePanierModal" class="modal-close">×</button>
                </header>
                <main class="modal-main-content">
                    <button class="back-panier">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Revenir au panier</button>
                    <form action="{{ route('rettine.livraison.store', $commande ? $commande->id : 1) }}" method="POST" id="information-client-form">
                        @csrf
                        @method("POST")
                        <div style="display:flex; gap:1em;">
                            <x-form.index name="name" label="Entrer votre nom" value="{{ $livraison ? $livraison->name : null }}" placeholder="Dohe" paragraphe="votre nom, permet de vous identifier avec coutoisi lors de la livraison" />
                            <x-form.index name="lastname" label="Entrer votre prenom" value="{{ $livraison ? $livraison->lastname : null }}"  placeholder="John" paragraphe="votre prenom, permet de vous identifier avec coutoisi lors de la livraison" />
                        </div>
                        <x-form.index name="email" label="Entrer le adresse email" value="{{ $livraison ? $livraison->email : null  }}"  placeholder="johnDohe@gmail.com" paragraphe="votre adresse email peut aider à vous contacter en cas de difficulté" />
                        <x-form.index name="address" label="Entrer votre adresse de livraison" value="{{ $livraison ? $livraison->address : null  }}"  placeholder="144 Rue de volie" paragraphe="votre adresse de livraison est indispensable pour la livraison" />
                        <div style="display:flex; gap:1em;">
                            <x-form.index name="instructions" label="Entrer vos instructions pour la livraison" value="{{ $livraison ? $livraison->instructions : null  }}"  placeholder="Code, etage, batiment" paragraphe="vos instruction permettra de vous retrouver plus facilement malgé votre adresse" />
                            <x-form.index name="phone" label="Entrer votre numero de telephone" value="{{ $livraison ? $livraison->phone : null }}"  placeholder="+242 06 800 0906" paragraphe="votre nous permettra de communiquer si besoin" />
                        </div>
                        <button type="submit">
                            @if (!$livraison)
                                Envoyer les informations
                            @else
                                Modifier les informations
                            @endif
                        </button>
                    </form>
                </main>
            </div>
        </aside>
        <div class="plats-items">
            @foreach ($categories as $category)
                <div class="items-{{ $category->getSlug() }}" id="{{ $category->getSlug() }}">
                    <h2>{{ $category->name }}</h2>
                    <div class="content-plats">
                        @foreach ($category->plates as $plat)
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
                                            <a href="{{ route('rettine.plats.show', ['plat' => $plat, 'slug' => $plat->getSlug()]) }}">VOIR LE PLAT</a>
                                        </div>
                                    </div>
                                    <div class="pictures-parts">
                                        @if ($plat->getPicture())
                                            <img src="{{ $plat->getPicture()->getPictureUrl(240, 150) }}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

