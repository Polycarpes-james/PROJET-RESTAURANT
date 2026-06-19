@extends('admin.base')

@section('title', 'INGREDIENTS')
    
@section('content')
    <x-items-actions :category="$ingredient" type="ingredient" contentId="category_modal" contentSecondClass="category_modal_item" headerClass="category_modal_header" mainClass="category_modal_main" footerClass="category_modal_footer"/>

    <div class="presentation-categories">
        <div class="item">
            <h1>La liste les ingredients</h1>
            <button class="open-ingredient-modal" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="2 1 20 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                <span class="tooltip-text">Nettoyer</span>
            </button>
        </div>
        <div class="actions-item-categories">
            <div class="item item-1">
                <label for="search-reservation">Rechercher par ID</label>
                <input type="number" name="search-reservation-id" class="input-search"id="search-reservation-id" placeholder="1, 89, 299, 100 ...">
            </div>
            <div class="item item-2">
                <label for="search-ingredient-name">Rechercher par nom</label>
                <input type="search" name="search-ingredient-name" class="input-search"id="search-ingredient-name" placeholder="Tomate, Pomme, Poivron ...">
            </div>
            <div class="item item-3">
                <label for="search-reservation-email">Rechercher par prix</label>
                <input type="email" name="search-reservation-email" class="input-search"id="search-reservation-email" placeholder="80.00, 92.23">
            </div>
        </div>
    </div>
    <div class="categories-items all-ingredients">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom de l'ingredient</th>
                    <th>Prix de l'ingredient</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingredients as $ingredient)
                    <tr class="ingredient-row" data-id="{{ $ingredient->id }}" data-name="{{ $ingredient->name }}" data-price="{{ $ingredient->price }}">
                        <td class="item-id">{{$ingredient->id}}</td>
                        <td class="item-name"><p style="text-transform:capitalize">{{$ingredient->name}}</p></td>
                        <td class="item-price">{{$ingredient->price}} €</td>
                        <td class="action-item">
                            <div class="action-category">
                                <button class="edit-ingredient" type="submit" data-name="{{ $ingredient->name }}" data-id="{{ $ingredient->id }}" data-price="{{ $ingredient->price }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                </button>
                                <form action="{{ route('admin.ingredient.destroy', $ingredient) }}" id="ingredient-form" method="post">
                                    @csrf
                                    @method("delete")
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </form>
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
@endsection