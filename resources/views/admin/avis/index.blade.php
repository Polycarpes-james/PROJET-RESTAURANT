@extends('admin.base')

@section('title', 'AVIS')

@section('content')
@php
    $isViewlable = true;
    $linkBtn = true;
    $delete = true;
@endphp 
    <x-items-actions type="category" contentId="category_modal" contentSecondClass="category_modal_item" headerClass="category_modal_header" mainClass="category_modal_main" footerClass="category_modal_footer"/>
    <x-show-modal-admin kind="btn-delete-admin" contentId="showUpDish" contentSecondClass="admin_plat_content" headerClass="admin_plat_header" mainClass="admin_plat_main" footerClass="admin_plat_footer"/>

    <div class="presentation-categories">
        <div class="item">
            <h1>La liste des avis sur les plats</h1>    
            <button class="open-category-modal" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="2 1 20 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                <span class="tooltip-text">Nettoyer</span>
            </button>
        </div>
        <x-search name="search-avis-name" targetName="name" placeholder="Rechercher Jean Pierre ..."></x-search>
    </div>

    <div class="categories-items all-categories">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Nombre de commantaires</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plats as $plat)
                    <tr class="avi-row" data-id="{{ $plat->id }}" data-name="{{ $plat->name }}">
                        <td class="item-id"><span class="classIdChange">#{{ $plat->id }}</span></td>
                        <td class="item-name">{{ $plat->name }}</td>
                        <td class="item-comment">{{ $plat->avis->count() }}</td>
                        <x-smally :element="$plat" class="edit-plat" route="plat" delete="" kind="btn" linkBtn="{{ $linkBtn }}" isViewlable="{{ $isViewlable }}"></x-smally> 
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-empty-box></x-empty-box>
    </div>
@endsection
    
