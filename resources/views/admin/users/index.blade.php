@extends('admin.base')

@section('title', 'UTILISATEURS')

@section('content')
    <x-show-modal-admin kind="btn-delete-user" contentId="admin_plat_delete" contentSecondClass="admin_plat_content" headerClass="admin_plat_header" mainClass="admin_plat_main" footerClass="admin_plat_footer"/>
    <div class="presentation-categories">
        <div class="item">
            <h1>La liste les utilisateurs</h1>   
        </div>
        <div class="actions-item-categories">
            <div class="item item-1">
                <label for="search-reservation">Rechercher par ID</label>
                <input type="number" name="search-reservation-id" data-target="id" class="input-search" id="search-reservation-id" placeholder="1, 89, 299, 100 ...">
            </div>
            <div class="item item-2">
                <label for="search-user-name">Rechercher par nom</label>
                <input type="search" name="search-user-name" data-target="name" class="input-search" id="search-user-name" placeholder="Sate, Neron">
            </div>
            <div class="item item-2">
                <label for="search-user-email">Rechercher par email</label>
                <input type="search" name="search-category-name" data-target="email" class="input-search" id="search-user-email" placeholder="example@no.fr">
            </div>
            {{-- <div class="item item-2">
                <label for="search-user-name">Rechercher par role</label>
                <div class="item-select">
                    <button class="item-btn-select user-filter" data-target="state" data-value="">Choisir un rôle</button>
                    <ul class="item-options" data-target="role">
                        <li data-value="user">User</li>
                        <li data-value="admin">Admin</li>
                        <li data-value="super_admin">Super Admin</li>
                    </ul>
                </div>


            </div> --}}
            <div class="item item-2">

<label>
Rechercher par rôle
</label>


<select 
    id="role-select"
    class="input-search"
    data-target="role"
>

    <option value="">
        Tous les rôles
    </option>


    <option value="user">
        👤 User
    </option>


    <option value="admin">
        🛠 Admin
    </option>


    <option value="super_admin">
        👑 Super Admin
    </option>


</select>


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
                    @if (Auth::user()->role !== 'admin')
                        <th>Action</th>
                    @endif
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
                        @can('update', $user)
                            <x-smally :element="$user" class="btn-delete-user-admin" route="user" kind="link">
                                <div class="change-role">
                                    <form action="{{ route('admin.user.update', $user) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select id="role-select" name="role">
                                            <option value="user" @selected($user->role == 'user')>User</option>
                                            <option value="admin" @selected($user->role == 'admin')>Admin</option>
                                            <option value="super_admin" @selected($user->role == 'super_admin')>Super Admin</option>
                                        </select>
                                        <button type="submit">Changer</button>
                                    </form>
                                </div>                                
                            </x-smally> 
                        @endcan
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
    
