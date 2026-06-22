@extends('admin.base')

@section('title', 'CATEGORIES')
    
@section('content')

    <x-items-actions :category="$category" type="category" contentId="category_modal" contentSecondClass="category_modal_item" headerClass="category_modal_header" mainClass="category_modal_main" footerClass="category_modal_footer"/>

    <div class="presentation-categories">
        <div class="item">
            <h1>La liste les categories</h1>    
            <button class="open-category-modal" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="2 1 20 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                <span class="tooltip-text">Nettoyer</span>
            </button>
        </div>
        <div class="actions-item-categories">
            <div class="item item-1">
                <label for="search-category-id">Rechercher par ID</label>
                <input type="number" name="search-category-id" class="input-search" data-target="id" id="search-category-id" placeholder="1, 89, 299, 100 ...">
            </div>
            <div class="item item-2">
                <label for="search-category-name">Rechercher par nom</label>
                <input type="search" name="search-category-name" class="input-search" data-target="name" id="search-category-name" placeholder="Dessert">
            </div>
        </div>
    </div>
    <div class="categories-items all-categories">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="category-row" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                        <td class="item-id">{{ $category->id }}</td>
                        <td class="item-name">{{ $category->name }}</td>
                        <x-smally :element="$category" class="edit-category" route="category" kind="btn"/>
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