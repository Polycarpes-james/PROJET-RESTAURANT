@extends('admin.base')

@section('title', $plat->exists ? "Modification" : "Ajout")
    
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="formulaire-create-update">
        <div class="{{ $menu === null ? "" : "formulaire-h"}}">
            <h1>@yield('title') d'un plat</h1>
            <p>
                @if ($menu === null)
                @else
                    <strong>Menu: |</strong>
                    <a href="{{ route('admin.menu.show', $menu) }}">{{ $menu->name }}</a>
                @endif
            </p>
        </div>
        <form class="formulaire-create-plats" action="{{ route($plat->exists ? ($store === "store" ? "admin.plat.update" : "") : ($store === "store" ? "admin.plat.store" : "admin.plat.store_"), ["plat" => $plat, "menu" => $menu]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($plat->exists ? 'PUT' : "POST")
            {{-- @dd($menu) --}}
            <x-form.index name="name" label="Entrer le nom du plat" value="{{ $plat->name }}" placeholder="Sauce de france" paragraphe="cette partie permet a distinguer les plats les uns des autres" />
            <x-form.index name="description" type="textarea" value="{{ $plat->description }}" label="Entrer la description du plat" paragraphe="la description d'un plat contient un peu de details sur le plat" />
            <div class="timePreparation-convertisseur">
                <div class="convert-number">
                    <h2>Convertisseur</h2>
                    <div class="items">
                        <label for="minutes">Entrer l'heure pour convertire en secondes</label>
                        <input type="number" id="hours" placeholder="0. 1. 2. ... (heures)">
                    </div>
                    <div class="items">
                        <label for="minutes">Entrer la minutes pour convertire en secondes</label>
                        <input type="number" id="minutes" placeholder="0. 1. 2. ... (minutes)">
                    </div>
                    <div class="element-converted"></div>
                </div>
                <div class="items">
                    <x-form.index name="temps_preparation" type="number" id="temps-preparation" paragraphe="la durée de cuissant du plat est en secondes (ex: 200 secondes)" label="Entrer le temps de cuissant du plat" value="{{ $plat->temps_preparation }}" placeholder="20..."/>
                    <x-form.index name="price" id="price-plat" label="Entrer le prix du plat" paragraphe="le prix du plat en format numeric pour faciliter la gerence dans la base de données" value="{{ $plat->price }}" placeholder="200,00"/>
                </div>
            </div>
            <x-form.select-multiple headCategories="Chosis les ingredients" paragraphe="ces elements sont indispensables dans un plat complet" id="select-multiple" name="ingredients[]" multiple="true" :value="$plat->ingredients()->pluck('id')" label="Entrer les ingredients du plat" :categories="$ingredients" />
            <x-form.select headCategories="---- Choisis la categorie du plat ----" name="category_id" :value="$plat->category()->pluck('id')" paragraphe="les categories sont utiles pour classer les plats par leurs qualités" label="Choisisez la category du plat" :categories="$categories" />
            {{-- @dd($menu->id) --}}
            @if ($menu)
                <x-form.select-multiple-menu headCategories="Choisis le menu du plat" id="select-multiple" name="menus[]" paragraphe="un plat peut être lié à un menu en particulié pour accompagner ce dernier" multiple="true" label="Choisisez le menu du plat" :menu="$menu" />
            @else
                <x-form.select-multiple headCategories="Choisis le menu du plat" id="select-multiple" name="menus[]" multiple="true" paragraphe="un plat peut être lié à un menu en particulié pour accompagner ce dernier" :value="$plat->menus->pluck('id')" label="Choisisez le menu du plat" :categories="$menus" />  
            @endif
                
            <x-form.input-file name="pictures[]" accepte="image/*" id="images" paragraphe="ces photos sont des elements majeurs pour illustrer et bien detailler le plat" label="Choisir une(s) photo(s) pour le plat" span="Aucun fichier choisi"/>
                 <div class="item-picture">
                    @foreach ($plat->pictures as $picture)
                        <div class="picture-items" data-picture="{{ $picture->id}}">
                            <img src="{{ $picture->getPictureUrl(200, 200) }}" alt="Photo">
                            <button class="hiddenNone delete-picture" type="button" data-target="{{ $picture->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 23 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            <x-form.input-radios name="disponible" :selected="$plat->disponible ?? 'yes'" paragraphe="cette partie est essentielle pour s'assurer que le client ne puisse pas reserver un plat qui ne sera jamais livré dans les delaits" label="La disponibilité du plat"/>
            
            <div class="add-input hidden-content">
                <x-form.index name="raison_indisponible" value="{{ $plat->raison_indisponible }}" type="textarea" label="Entrer la raison de l'indiposition du plat" paragraphe="Pourquoi le plat est il indisponible ?"/>  
            </div>
            
            <button type="submit">
                @if ($plat->exists)
                    Modification
                @else
                    Ajout
                @endif
                du plat
            </button>
        </form>
    </div>
@endsection