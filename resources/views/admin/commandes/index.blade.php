@extends('admin.base')

@section('title', 'COMMANDES')
    
@section('content')
    <div class="commandes-users">
        <h1>Gestion des commandes users</h1>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Id</th>
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

        {{-- {{ $commandes->links() }}             --}}
    </div>
    <div class="commandes-guests">
        <h1>Gestion des commandes invités</h1>

        <table class="styled-table">
            <thead>
                <tr>
                    <th>Id</th>
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
                        <td>
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
                            <a href="{{ route('admin.commande.showGuest', ['commande' => $item, 'invite_id' => $item->invite_id]) }}">Voir la commande</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $commandesGuests->links() }}             --}}
    </div>
@endsection