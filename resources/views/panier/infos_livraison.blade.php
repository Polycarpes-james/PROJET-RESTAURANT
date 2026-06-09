@extends('layout.second')

@section('title', "PANIER")

@section('main-style', 'panier-container-livraison')


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

    <aside class="modal modal-information-client">
        <div class="modal-content-panier">
            <header class="modal-header-content">
                <h3 id="modalTitle">INFORMATIONS POUR LA LIVRAISON</h3>
                <a href="{{ auth()->check() ? route('rettine.panier') : route('invite.panier') }}" class="back-panier">Revenir au panier</a>
            </header>
            {{-- @dd($commande->id) --}}
            <main class="modal-main-content">
                <form action="{{ route('rettine.livraison.store', $commande ?? 1) }}" method="POST" id="information-client-form">
                    @csrf
                    @method("POST")
                    <div style="display:flex; gap:1em;">
                        <x-form.index name="name" label="Entrer votre nom" value="{{ $livraison ? $livraison->name : null }}" placeholder="Dohe" paragraphe="votre nom, permet de vous identifier avec coutoisi lors de la livraison" />
                        <x-form.index name="lastname" label="Entrer votre prenom" value="{{ $livraison ? $livraison->lastname : null }}"  placeholder="John" paragraphe="votre prenom, permet de vous identifier avec coutoisi lors de la livraison" />
                    </div>
                    <x-form.index name="email" label="Entrer le adresse email" value="{{ $livraison ? $livraison->email : null  }}"  placeholder="johnDohe@gmail.com" paragraphe="votre adresse email peut aider à vous contacter en cas de difficulté" />
                    <x-form.index name="address" label="Entrer votre adresse de livraison" value="{{ $livraison ? $livraison->address : null  }}"  placeholder="144 Rue de volie" paragraphe="votre adresse de livraison est indispensable pour la livraison" />
                    <div style="display:flex; gap:1em;align-items:end">
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
        <div class="panier-infos-part">
            <h1>PANIER</h1>
            <p>{{ $total }}</p>
        </div>
    </aside>
@endsection