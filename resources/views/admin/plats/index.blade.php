@extends('admin.base')

@section('title', 'PLATS')
    
@section('content')
    <x-show-modal-admin kind="btn-delete-admin" contentId="admin_plat_delete" contentSecondClass="admin_plat_content" headerClass="admin_plat_header" mainClass="admin_plat_main" footerClass="admin_plat_footer"/>

    <div class="container-items-admin">
        <div class="presentation-categories">
            <div class="item">
                <h1>les plats</h1>    
                <a href="{{ route('admin.plat.create') }}" style="border:1px solid #1E3A8A;padding:5px 10px;display: flex; align-items:center;gap:10px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>                
                    Ajouter le plat
                </a>
            </div>
            <div class="actions-item-categories">
                <div class="item item-1">
                    <label for="search-plat-id">Rechercher par ID</label>
                    <input type="number" name="search-plat-id" data-target="id" class="input-search" id="search-plat-id" placeholder="1, 89, 299, 100 ...">
                </div>
                <div class="item item-2">
                    <label for="search-plat-name">Rechercher par nom</label>
                    <input type="search" name="search-plat-name" data-target="name" class="input-search" id="search-plat-name" placeholder="Poulet Yassa">
                </div>
                <div class="item item-3">
                    <label for="search-plat-price">Rechercher par prix</label>
                    <input type="number" name="search-plat-name" data-target="price" class="input-search" id="search-plat-price" placeholder="Dessert">
                </div>
                <div class="item item-4">
                    <label for="search-plat-name">Rechercher par disponibilité</label>
                    <div class="item-select">
                        <button class="item-btn-select user-filter" data-target="state" data-value="">Choisir un état</button>
                        <ul class="item-options" data-target="state">
                            <li data-value="yes">Disponibile</li>
                            <li data-value="no">Indisponible</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="plats-items">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Disponibilité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plats as $plat)
                        <tr class="plat-row" 
                            data-id="{{ $plat->id }}" data-name="{{ $plat->name }}" 
                            data-price="{{ $plat->price }}" data-state="{{ $plat->disponible }}"
                            >     
                            <td class="item-id">{{ $plat->id }}</td>           
                            <td><img src="{{ $plat->getPicture() ? $plat->getPicture()->getPictureUrl(70, 60) : "" }}" alt=""></td>           
                            <td class="item-name">{{ $plat->truncateText($plat->name, 30) }}</td>           
                            <td class="item-price">{{ $plat->price }} €</td>           
                            <td class="item-state">{{ $plat->disponible }}</td>           
                            <x-smally :element="$plat" class="btn-delete-dish" route="plat" kind="link"/>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="no-results" style="display:none;">
                <div style="text-align:center; margin-top:1em">
                    <p>Aucun element trouvé</p> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-angry-icon lucide-angry"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><path d="M7.5 8 10 9"/><path d="m14 9 2.5-1"/><path d="M9 10h.01"/><path d="M15 10h.01"/></svg>
                </div>
            </div>
        </div>
    </div>
@endsection