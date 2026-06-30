@extends('admin.base')

@section('title', 'COMMANDES')
    
@php
    $items = ["en_attente" => "En attente", "en_preparation" => "En préparation", "livree" => "Livrée", "annulee" => "Annulée"];
    $items2 = ["ID", "CLIENT", "PRIx", "sTatus", "actions"];
    $filtable = true;
    $searchValide = true
@endphp
@section('content')
    <div class="presentation-categories">
        <h1>La liste des commandes</h1>
    </div>
    <div class="cards">
        <h3>Bilan global sur les commandes</h3>
        <div class="item">
            <div class="card">
                <h3>Commandes</h3>
                <p>120</p>
            </div>

            <div class="card">
                <h3>Revenus</h3>
                <p>2450 €</p>
            </div>

            <div class="card">
                <h3>Plats</h3>
                <p>35</p>
            </div>
        </div>
    </div>
    <div class="commandes-users">
        <h1>Gestion des commandes users</h1>
        <x-table :items="$items2" :model="$commandes" routeUpdate="admin.commande.update" routeShow="admin.commande.show" target="commande">
            <x-select-personnalise :filtable="!$filtable" target="status" searchValide="{{ $searchValide }}" :items="$items"></x-select-personnalise>
        </x-table>
    </div>
    <div class="commandes-guests">
        <h1>Gestion des commandes invités</h1>
        <x-table :items="$items2" :model="$commandesGuests" routeUpdate="admin.invite.commande.update" routeShow="admin.commande.showGuest" target="guest">
            <x-select-personnalise :filtable="!$filtable" target="status" searchValide="{{ $searchValide }}" :items="$items"></x-select-personnalise>
        </x-table>
        <div id="no-results" style="display:none;">
            <div style="text-align:center; margin-top:1em">
                <p>Aucun element trouvé</p> 
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-angry-icon lucide-angry"><circle cx="12" cy="12" r="10"/><path d="M16 16s-1.5-2-4-2-4 2-4 2"/><path d="M7.5 8 10 9"/><path d="m14 9 2.5-1"/><path d="M9 10h.01"/><path d="M15 10h.01"/></svg>
            </div>
        </div>
        {{-- {{ $commandesGuests->links() }}             --}}
    </div>
@endsection