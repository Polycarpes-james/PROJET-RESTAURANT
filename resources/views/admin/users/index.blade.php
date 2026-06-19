@extends('admin.base')

@section('title', 'UTILISATEURS')

@section('content')
      <div class="presentation-categories">
            <div class="item">
                <h1>La liste les utilisateurs</h1>    
                {{-- <a href="{{ route('admin.plat.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="2 1 20 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
                </a> --}}
            </div>
            <div class="actions-item-categories">
                <div class="item item-1">
                    <label for="search-reservation">Rechercher par ID</label>
                    <input type="number" name="search-reservation-id" class="input-search" id="search-reservation-id" placeholder="1, 89, 299, 100 ...">
                </div>
                <div class="item item-2">
                    <label for="search-user-name">Rechercher par nom</label>
                    <input type="search" name="search-user-name" class="input-search" id="search-user-name" placeholder="Poulet Yassa">
                </div>
                <div class="item item-2">
                    <label for="search-reservation-name">Rechercher par email</label>
                    <input type="search" name="search-category-name" class="input-search" id="search-category-name" placeholder="Dessert">
                </div>
                <div class="item item-2">
                    <label for="search-reservation-name">Rechercher par role</label>
                   <div class="role-select">

<button 
class="role-button user-filter"
data-target="role"
data-value="">
Choisir un rôle
</button>


<ul class="role-options">

<li data-value="user">
👤 User
</li>


<li data-value="admin">
🛠 Admin
</li>


<li data-value="super_admin">
👑 Super Admin
</li>

</ul>

</div>
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
                    <tr class="user-row" 
                        data-id="{{ $user->id }}" data-name="{{ $user->name }}" 
                        data-email="{{ $user->email }}" data-role="{{ $user->role }}"
                        data-price="{{ $user->price }}" data-phone="{{ $user->phone }}"
                        >
                        <td class="item-id">{{ $user->id }}</td>
                        <td><img src="{{ $user->getPictureUrl(40, 40) }}" style="border-radius:30px" alt=""></td>
                        <td class="item-name">{{ $user->name }}</td>
                        <td>{{ $user->firstname }}</td>
                        <td class="item-email">{{ $user->email }}</td>
                        <td class="item-role">{{ $user->role }}</td>
                        <td class="action-item">
                            {{-- <button class="reservation_show">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                            </button> --}}
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
    
