@extends('admin.base')

@section('title', 'RESERVATIONS')

@section('content')
    <aside id="container-user-reservation" class="modal" style="display: none">
        <div class="reservation-user-main">
            <header class="reservation-header">
                <h1 id="containerUser"></h1>
                <button id="closeModal" class="modal-close">×</button>
            </header>
            <main class="reservation-main">

            </main>
            <footer class="reservation-footer">

            </footer>
        </div>
    </aside>

    <div class="presentation-categories">
        <h1>La liste des reservations</h1>
        <div class="actions-item-categories">
            <div class="item item-1">
                <label for="search-reservation">Rechercher par ID</label>
                <input type="number" name="search-reservation-id" class="input-search"id="search-reservation-id" placeholder="1, 89, 299, 100 ...">
            </div>
            <div class="item item-2">
                <label for="search-reservation-name">Rechercher par nom</label>
                <input type="search" name="search-reservation-name" class="input-search"id="search-reservation-name" placeholder="Jean Pierre">
            </div>
            <div class="item item-3">
                <label for="search-reservation-email">Rechercher par email</label>
                <input type="email" name="search-reservation-email" class="input-search"id="search-reservation-email" placeholder="example@john.map">
            </div>
            <div class="item item-4">
                <label for="search-reservation-phone">Rechercher par téléphone</label>
                <input type="phone" name="search-reservation-phone" class="input-search"id="search-reservation-phone" placeholder="06 900 60 06">
            </div>
        </div>
    </div>
    <div class="all-reservation">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Nombre de personnes</th>
                    <th>Date de reservation</th>
                    <th>Temps de reservation</th>
                    <th>Message supplementaire</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr class="reservation-row" data-name="{{ $reservation->name }}">
                        <td class="reservation-id">{{ $reservation->id }}</td>
                        <td class="item-name">{{ $reservation->name }}</td>
                        <td>{{ $reservation->phone }}</td>
                        <td>{{ $reservation->email }}</td>
                        <td>{{ $reservation->guests }}</td>
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ $reservation->reservation_time }}</td>
                        <td>{{ $reservation->truncateText($reservation->message, 60) }}</td>
                        <td class="action-item">
                            <button class="reservation_show" data-user='@json($reservation->user)'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
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
    </div>
@endsection
    
