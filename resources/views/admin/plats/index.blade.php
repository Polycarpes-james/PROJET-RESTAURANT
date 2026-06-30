@extends('admin.base')

@section('title', 'PLATS')
    
@section('content')
@php
    $filtable = true;
    $items = ["yes" => "Disponible", "no" => "Indisponible"];
    $searchValide = true
@endphp
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
            <x-search name="global-search" targetName="name" placeholder="Rechercher Poulet Yassa ...">
                <x-select-personnalise :filtable="$filtable" target="state" searchValide="{{ $searchValide }}" :items="$items">
                </x-select-personnalise>
            </x-search>
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

data-name="{{ $plat->name }}"
data-price="{{ $plat->price }}"
data-state="{{ $plat->disponible }}"
                            data-search="
{{ $plat->id }}
{{ $plat->name }}
{{ $plat->price }}
{{ $plat->disponible }}
{{ $plat->created_at }}
"
                            >     
                            <td class="item-id">{{ $plat->id }}</td>           
                            <td><img src="{{ $plat->getPicture() ? $plat->getPicture()->getPictureUrl(70, 60) : "" }}" alt=""></td>           
                            <td class="item-name">{{ $plat->truncateText($plat->name, 30) }}</td>           
                            <td class="item-price">{{ $plat->price }} €</td>           
                            <td class="item-state">
                                <span class="badge {{ $plat->disponible === "yes" ? "livre" : "annule"}}">
                                    {{ $plat->disponible === "yes" ? $items["yes"] : $items["no"] }}
                                </span>
                            </td>           
                            <x-smally :element="$plat" class="btn-delete-dish" route="plat" kind="link"/>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-empty-box></x-empty-box>
        </div>
    </div>
@endsection