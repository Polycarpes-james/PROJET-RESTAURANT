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

    <x-modals.show-modal panier="false" type="remove" contentId="suppression_dish" contentSecondClass="suppression-modal-item" headerClass="suppression-header-modal" mainClass="suppression-main-modal" footerClass="suppression-footer-modal"/>

    <aside class="modal modal-information-client">
        <div class="modal-content-panier">
            <header class="modal-header-content">
                <h3 id="modalTitle">INFORMATIONS POUR LA LIVRAISON</h3>
                <a href="{{ auth()->check() ? route('rettine.panier') : route('guest.panier', ['invite_id' => Cookie::get('invite_id')]) }}" class="back-panier">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-left-icon lucide-circle-arrow-left"><circle cx="12" cy="12" r="10"/><path d="m12 8-4 4 4 4"/><path d="M16 12H8"/></svg>
                </a>
            </header>
            {{-- @dd($commande->id) --}}
            <main class="modal-main-content">
                <form action="{{ auth()->check() ? route('rettine.livraison.store', $commande ?? 1) : route('guest.commande') }}" method="POST" id="information-client-form">
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