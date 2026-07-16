@extends('admin.base')

@section('title', 'CATEGORIES')

@php
    $isViewlable = true;
    $linkBtn = true;
    $delete = true
@endphp
@section('content')

    <x-items-actions type="category" contentId="category_modal" contentSecondClass="category_modal_item" headerClass="category_modal_header" mainClass="category_modal_main" footerClass="category_modal_footer"/>

    <div class="presentation-categories">
        <div class="item">
            <h1>La liste les categories</h1>    
            <button class="open-category-modal" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="2 1 20 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                <span class="tooltip-text">Nettoyer</span>
            </button>
        </div>
        <x-search name="search-category-name" targetName="name" placeholder="Rechercher Jean Pierre ..."></x-search>
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
                        <x-smally :element="$category" class="edit-category" delete="{{ $delete }}" route="category" kind="btn" linkBtn="{{ $linkBtn }}" isViewlable="{{ $isViewlable }}"/>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-empty-box></x-empty-box>
    </div>
@endsection