@extends('admin.base')

@section('title', 'UTILISATEURS')

@section('content')
    <div class="presentation-categories">
        <h1>La liste des Utilisateurs</h1>
        <div class="actions-item-categories">
            <input type="search" name="search-user" id="search-user" placeholder="Rechercher un utilisateur...">
        </div>
    </div>
    <div class="all-users">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ $user->getPictureUrl(40, 40) }}" style="border-radius:30px" alt=""></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->firstname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="action-item">
                            {{-- <button class="reservation_show">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
    
