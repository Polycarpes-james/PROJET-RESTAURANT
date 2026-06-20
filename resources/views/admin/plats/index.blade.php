@extends('admin.base')

@section('title', 'PLATS')
    
@section('content')
    <x-show-modal-admin contentId="admin_plat_delete" contentSecondClass="admin_plat_content" headerClass="admin_plat_header" mainClass="admin_plat_main" footerClass="admin_plat_footer"/>

    <div class="container-items-admin">
        <div class="presentation-categories">
            <div class="item">
                <h1>La liste les plats</h1>    
                <a href="{{ route('admin.plat.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="2 1 20 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
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
                            <td><img src="{{ $plat->getPicture()->getPictureUrl(70, 60) }}" alt=""></td>           
                            <td class="item-name">{{ $plat->truncateText($plat->name, 30) }}</td>           
                            <td class="item-price">{{ $plat->price }} €</td>           
                            <td class="item-state">{{ $plat->disponible }}</td>           
                            <td class="action-item">
                                <div class="action-category">
                                    <a href="{{ route('admin.plat.show', $plat) }}" id="show">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>
                                    <a href="{{ route('admin.plat.edit', $plat) }}" id="show">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                    </a>
                                     <button class="btn-delete-dish" data-id="{{ $plat->id }}" data-name="{{ $plat->name }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </div>
                            </td>
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