@extends('admin.base')

@section('title', 'INGREDIENTS')
    @php
        $isViewlable = true;
        $linkBtn = true
    @endphp
@section('content')
    <x-items-actions type="ingredient" contentId="category_modal" contentSecondClass="category_modal_item" headerClass="category_modal_header" mainClass="category_modal_main" footerClass="category_modal_footer"/>

    <div class="presentation-categories">
        <div class="item">
            <h1>La liste les ingredients</h1>
            <button class="open-ingredient-modal" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="2 1 20 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                <span class="tooltip-text">Nettoyer</span>
            </button>
        </div>
        <x-search name="search-category-name" targetName="name" placeholder="Rechercher Jean Pierre ..."></x-search>
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
                        <x-smally :element="$ingredient" class="edit-ingredient" delete="delete" linkBtn="{{ $linkBtn }}" isViewlable="{{ !$isViewlable }}" route="ingredient" kind="btn"/>
                    </tr>
                @endforeach
            </tbody>
        </table>            
        <x-empty-box></x-empty-box>
    </div>
@endsection