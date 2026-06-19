@extends('admin.base')

@section('title', 'COMMANDES')
    
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

        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->user->name }}</td>
                        <td>{{ $commande->total_price }} €</td>
                        <td>{{ $commande->status }}</td>
                        <td class="options">
                            <form action="{{ route('admin.commande.update', $commande) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status">
                                    <option value="en_attente" @selected($commande->status == 'en_attente')>En attente</option>
                                    <option value="en_preparation" @selected($commande->status == 'en_preparation')>En préparation</option>
                                    <option value="livree" @selected($commande->status == 'livree')>Livrée</option>
                                    <option value="annulee" @selected($commande->status == 'annulee')>Annulée</option>
                                </select>
                                <button type="submit">Changer</button>
                            </form>
                            <a href="{{ route('admin.commande.show', $commande) }}">        
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- {{ $commandes->links() }}             --}}
    </div>
    <div class="commandes-guests">
        <h1>Gestion des commandes invités</h1>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandesGuests as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->total_prix }} €</td>
                        <td>{{ $item->status }} </td>
                        <td class="options">
                            <form action="{{ route('admin.commande.update', $item) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status">
                                    <option value="en_attente" @selected($item->status == 'en_attente')>En attente</option>
                                    <option value="en_preparation" @selected($item->status == 'en_preparation')>En préparation</option>
                                    <option value="livree" @selected($item->status == 'livree')>Livrée</option>
                                    <option value="annulee" @selected($item->status == 'annulee')>Annulée</option>
                                </select>
                                <button type="submit">Changer</button>
                            </form>
                            <a href="{{ route('admin.commande.showGuest', ['commande' => $item, 'invite_id' => $item->invite_id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
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
        {{-- {{ $commandesGuests->links() }}             --}}
    </div>
@endsection