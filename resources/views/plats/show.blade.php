@extends('layout.base')

@section('image-header', 'url(' . $platService['firstPicture'] . ')')

@section('title', $platService['plat']['name'])

@section('body-style', 'plat-item-body')

@section('main-style', 'main-container-show-plat')

@section('background_header', "plat-item-header")

@section('firstpart')
   <div class="content-plat-item">
        <div class="description-plat">
            <h1>{{ $platService['plat']['name'] }}</h1>
            <p>{{ $platService['plat']['description'] }}</p>
        </div>
        <div class="price-plat">
            <p>{{ $platService['plat']['price'] }} €</p>
            {{-- <p>{{ $platService->plat->plat_status }}</p> --}}
        </div>
    </div>
@endsection

@section('content')
    <x-modals.show-modal panier="false" type="remove" contentId="suppression_dish" contentSecondClass="suppression-modal-item" headerClass="suppression-header-modal" mainClass="suppression-main-modal" footerClass="suppression-footer-modal"/>
    <x-modals.show-modal panier="false" type="message" contentId="customModal" contentSecondClass="modal-content" headerClass="modal-header-content" mainClass="modal-main-content" footerClass="modal-footer-content"/>

    <div class="main-container-show-plat-item">
        <div class="back-side">
            <a href="{{ route('.rettine') }}">Accueil</a>/
            <a href="{{ route('rettine.plats') }}">listing des plats</a>
            /
            <p>{{ $platService['plat']['name'] }}</p>
        </div>
        <div class="main-show-plat">
           <div class="panier-item" data-plat="{{ $platService['plat']['id'] }}">
                <div class="remove-from-card">
                    <p class="max-hidden"></p>
                    <button class="delete-dish delete-dish-link btn-show border-radius" data-id="{{ $platService['plat']['id'] }}" data-name="{{ $platService['plat']['name'] }}">×</button>
                </div>
                <div class="header-panier">
                    <h3>Votre panier</h3>
                    <p>Vous pouvez effectuer des operations (Ajouter, retirer ) sur ce plat dans votre panier</p>
                </div>
                <div class="items">
                    <div class="item">
                        <button class="add-card-show"  data-id="{{ $platService['plat']['id'] }}" data-name="{{ $platService['plat']['name'] }}"  data-quantite="1">+</button>
                    </div>
                    <div class="item expect">
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg" width="90" height="90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                        <input type="text" class="text" data-id="{{ $platService['plat']['id'] }}" data-name="{{ $platService['plat']['name'] }}" value="{{ $platService['quantite'] }}" data-quantite="1" >
                    </div>
                    <div class="item">
                        <button class="minus"  data-id="{{ $platService['plat']['id'] }}" data-quantite="1" >-</button>
                    </div>
                </div>      
                <p class="total-price innertTotal">{{ decimal($platService['quantite'] * $platService['plat']['price']) }}€</p>        
            </div>
            <div class="category">
                <p>Le plat est un(e) {{ $platService['category']['name'] }}</p>
                <p>Temps de cuissant : <strong>{{ $platService['plat']['temps_preparation'] }}</strong></p>
            </div>
            <div class="ingredients-item">
                <h3>Tous les ingredients sur plat</h3>
                @foreach ($platService['ingredients'] as $ingredient)
                    <div>
                        <p>{{ $ingredient['name'] }}</p>
                        <p>{{ $ingredient['price'] }} €</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="picture-item-main">
            <div class="header-picture">
                <h3>Les images du plat</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores iusto quisquam, aspernatur quam facilis quidem porro sint eos quas inventore dolore laboriosam delectus qui esse dolorum dignissimos modi incidunt possimus?</p>
            </div>
            <div class="pictures-plat">
                @foreach ($platService['pictures'] as $picture)
                    <div class="picture-item">
                        <div class="item">
                          
                            <img src="{{ $picture['filename'] }}" alt="photo">
                            <button class="btn-picture" type="button">
                                <span class="clickable" data-picture="{{ $picture['filename'] }}" data-name="{{ $picture['filename'] }}"></span>
                            </button>
                            <div class="affiche" style="display: none">
                                <p>Voir l'image</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="btn-navigue">
                <button id="prevBtn" class="disabled" disabled >◀</button>
                <button id="nextBtn">▶</button>
            </div>
        </div>

        
        <aside id="modal-connect" class="connect-modal" style="display: none;">
            <div class="modal-content-connect">
                <img src="{{ asset('img/modal-2.jpg') }}" alt="">
                <div class="modal-content-item"></div>
            </div>
        </aside>

        <div class="comments-side">
            <div class="header-avis">
                <h3>Les avis et notes des clients sur ce plat</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores iusto quisquam, aspernatur quam facilis quidem porro sint eos quas inventore dolore laboriosam delectus qui esse dolorum dignissimos modi incidunt possimus?</p>
            </div>
            @if ($platService['avis'])
                @foreach ($platService['avis']['data'] as $avi)
                    @if ($avi['user'])
                        <div class="avis-item">
                            <div class="item">                        
                                <div class="items-i">
                                    @if ($avi['user']['avatar'])
                                        <img id="avatarPreview" src="{{ $avi['user']['avatar'] ? $avi['user']['avatar'] : asset('img/user.png')}}" 
                                    alt="Avatar" class="{{ $avi['user']['avatar'] ? "profile-user" : "no-profile-user" }}">
                                    @else
                                        @php
                                            $initiales = collect(explode(' ', $avi['user']['name'] . " " . $avi['user']['firstname']))->map(fn ($part) => mb_substr($part, 0, 1))->implode('');
                                            $name = strtoupper($initiales);
                                        @endphp     
                                        <p>{{ $name }}</p>
                                    @endif
                                    <div class="items">
                                        <div class="i"> 
                                            <strong>{{ $avi['user']['name'] }} {{ $avi['user']['firstname'] }}</strong>
                                        </div>
                                        <small class="text-muted">{{ str_replace('Il y a', 'Il y a ', $avi['user']['updated_at'])}}</small>
                                    </div>
                                </div>
                                <div class="stars-display" data-note="{{ $avi['note'] }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="star" data-index="{{ $i }}"></span>
                                    @endfor
                                </div>
                            </div>                 
                            <div class="comment-parts">
                                @if ($avi['commentaire'])
                                    <p class="mb-0">{{ $avi['commentaire'] }}</p>
                                @endif
                            </div>
                            <div class="reply">
                                <button class="item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-thumbs-up-icon lucide-thumbs-up"><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z"/><path d="M7 10v12"/></svg>
                                    <p class="top-5">J'aime</p>
                                </button>
                                <button class="item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send-horizontal-icon lucide-send-horizontal"><path d="M3.714 3.048a.498.498 0 0 0-.683.627l2.843 7.627a2 2 0 0 1 0 1.396l-2.842 7.627a.498.498 0 0 0 .682.627l18-8.5a.5.5 0 0 0 0-.904z"/><path d="M6 12h16"/></svg>
                                    <p class="top-5">Repondre</p>
                                </button>
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="more-users-avis">
                    <a href="#">Voir plus d'avis</a>
                </div>
            @else
                <p class="text-muted fst-italic">Aucun avis pour ce plat pour le moment.</p>
            @endif           
        </div>
    </div>
    <aside class="plat-comments">
        <div class="avis-widget" data-plat="{{ $platService['plat']['id'] }}">
            <h2>Votre avis et note sur ce plat</h2>
            <div class="avis-item">
                <div class="stars" role="radiogroup" aria-label="Votre note">
                    <p>Selectionner pour votre note sur le plat</p>
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star {{ $platService['aviUserPlat'] && $platService['aviUserPlat']['note'] >= $i ? 'filled' : '' }}"
                            data-value="{{ $i  }}" role="radio"
                            aria-checked="{{ $platService['aviUserPlat'] && $platService['aviUserPlat']['note'] == $i ? 'true' : 'false' }}">
                        </span>
                    @endfor
                </div>
            </div>  
            @auth
                <form action="{{ route('rettine.avis.store', $platService['plat']['id']) }}" class="avis-form" method="POST">
                    @csrf
                    <div class="item-input">
                        <label for="commentaire">Entrer votre commentaire sur le plat</label>
                        <p class="paragraphe">vos instruction permettra de vous retrouver plus facilement malgé votre adresse</p>
                        <textarea name="commentaire" id="commentaire" cols="20" rows="10">
                            {{ old('commentaire', $platService['aviUserPlat'] ? $platService['aviUserPlat']['commentaire'] : "") }}
                        </textarea>
                    </div>
                    <button class="btn-submit-avis" type="button">Envoyer mon avis</button>
                </form>
                <div class="avis-feedback" aria-live="polite"></div>
            @else
                <p><a href="{{ route('login') }}">Connectez-vous</a> pour laisser un avis.</p>
            @endauth
        </div>
        <div class="whole-notes">
            <div class="stars-display">
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
                <span class="star"></span>
            </div>
            <p class="all-notes" data-all="{{ $platService['notes'] }}"></p>
        </div>
    </aside>
@endsection
