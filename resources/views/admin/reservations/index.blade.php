@extends('admin.base')

@section('title', 'RESERVATIONS')

@section('content')
    <div id="container-user-reservation" style="display: none">

    </div>
    <div class="presentation-categories">
        <h1>La liste des reservations</h1>
        <div class="actions-item-categories">
            <input type="search" name="search-reservation" id="search-reservation" placeholder="Rechercher une reservation...">
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
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->name }}</td>
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
    </div>
@endsection
    
