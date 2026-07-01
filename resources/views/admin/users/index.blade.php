@extends('admin.base')

@section('title', 'UTILISATEURS')

@section('content')
@php
    $filtable = true;
    $items = ["user" => "User", "admin" => "Administrateur", 'super_admin' => "Super Administrateur"];
    $searchValide = true;
    $linkBtn = true;
    $isViewlable = true
@endphp
    <x-show-modal-admin kind="btn-delete-user" contentId="admin_plat_delete" contentSecondClass="admin_plat_content" headerClass="admin_plat_header" mainClass="admin_plat_main" footerClass="admin_plat_footer"/>
    <div class="presentation-categories">
        <div class="item">
            <h1>La liste les utilisateurs</h1>   
        </div>
        <x-search name="search-user-name" targetName="firstname" placeholder="Rechercher Sate, Neron">
            <x-select-personnalise target="role" :filtable="$filtable" searchValide="{{ $searchValide }}" :items="$items">
            </x-select-personnalise>
        </x-search>
    </div>
    <div class="all-users">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>particulier</th>
                    <th>Role</th>
                    @if (Auth::user()->role !== 'admin')
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="user-row" 
                        data-id="{{ $user->id }}" data-firstname="{{ $user->firstname }}" 
                        data-email="{{ $user->email }}" data-role="{{ $user->role }}"
                        data-price="{{ $user->price }}" data-phone="{{ $user->phone }}"
                        >
                        <td class="item-id">#{{ $user->id }}</td>
                        <td><img src="{{ $user->getPictureUrl(40, 40) }}" style="border-radius:30px" alt=""></td>
                        <td class="item-name">
                            <div class="user-td">
                                <p class="bold">{{ $user->name }} {{ $user->firstname }}</p>
                                <p class="fs-2">{{ $user->email }}</p>
                            </div>
                        </td>
                        <td class="item-role"><span class="badge {{ $user->role === 'user' ? "encours" : ($user->role === "admin" ? 'nouveau' : 'livre') }}" >
                            {{ $user->role === "user" ? "User" : ($user->role === "admin" ? "Administrateur" : "Super Administrateur")}}</span></td>
                        @can('update', $user)
                            <x-smally :element="$user" class="btn-delete-user-admin" route="user" linkBtn="{{ !$linkBtn }}"  isViewlable="{{ $isViewlable }}" kind="link">
                                <div class="change-role">
                                    <form action="{{ route('admin.user.update', $user) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <x-select-personnalise filtable="{{ !$filtable }}" target="role" searchValide="true" object="Choisir un role" :items="$items"></x-select-personnalise>
                                        <button type="submit">Changer</button>
                                    </form>
                                </div>            
                            </x-smally> 
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-empty-box></x-empty-box>
    </div>
@endsection
    
