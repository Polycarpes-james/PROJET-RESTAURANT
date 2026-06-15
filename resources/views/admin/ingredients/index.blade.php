@extends('admin.base')

@section('title', 'INGREDIENTS')
    
@section('content')
    <x-items-actions :category="$ingredient" type="ingredient" contentId="category_modal" contentSecondClass="category_modal_item" headerClass="category_modal_header" mainClass="category_modal_main" footerClass="category_modal_footer"/>

    <div class="presentation-categories">
        <h1>La liste les ingredients</h1>
        <button class="open-category-modal" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            <span class="tooltip-text">Nettoyer</span>
        </button>
        <div class="actions-item-categories">
            <input type="search" name="search-ingredient" id="search-ingredient" placeholder="Rechercher une categorie...">
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
                    <tr class="ingredient-row" data-name="{{ $ingredient->name }}">
                        <td>{{$ingredient->id}}</td>
                        <td>{{$ingredient->name}}</td>
                        <td>{{$ingredient->price}} €</td>
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
    </div>
@endsection