@extends('admin.base')

@section('title', 'COMMANDES')
    
@section('content')
<h1>Gestion des commandes</h1>

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
                <td>
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
                    <a href="{{ route('admin.commande.show', $commande) }}">Voir la commande</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $commandes->links() }}

    
@endsection