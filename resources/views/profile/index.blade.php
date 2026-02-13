@extends('layout.base')

@section('title', "Mon compte")

@section('body-style', 'profile-style')
    

@section('content')

    <div class="profile-main-container">
        <div class="profile-items">
            <div>
                <p id="compte">Mon compte</p>
                <h1>{{ $user->firstname }} {{ $user->name }}</h1>
            </div>
            <p id="email">{{ $user->email }}</p>
        </div>
        <div class="picture-profile">
            <form action="{{ route('rettine.profile.update.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                @csrf
                <input type="file" id="avatarInput" name="avatar" accept="image/*" hidden>
                
                @if (Auth::user()->avatar)
                    <img id="avatarPreview" 
                    src="{{ asset('storage/' . Auth::user()->avatar)}}" 
                    alt="Avatar" 
                    class="profile-avatar">
                @else
                    <p class="cutName" id="avatarPreview">{{ $user->cutName() }}</p>
                @endif
                
                <div id="avatarLoader" class="hidden">
                    <p>CHANGER</p>
                </div>
            </form>
        </div>
    </div>
    <div class="profile-container-form">
        <div class="formulaire">
            <h2>Modifier votre profile actuel</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-form.index name="name" :value="Auth::user()->name" label="Mon nom de profile"/>
                <x-form.index name="firstname" :value="Auth::user()->firstname" label="Mon prenom de profile"/>
                <x-form.index type="email" name="email" :value="Auth::user()->email" label="Mon adresse email"/>
                <div class="change-password">
                    <h2>Changer de mot de passe</h2>
                    <p>Vous pouvez changer votre mot de passe actuel</p>
                </div>
                <x-form.index type="password" name="password" label="Nouveau mot de pass" placeholder="................"/>
                <x-form.index type="password" name="password" label="Comfirmer le mot de pass" placeholder="................"/>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
        <div class="delete-account">
            <h2>Supprimer votre compte</h2>
            <div class="raisons">
                <p>Voulez vous supprimer votre compte pour toujours</p>
                <ul>
                    <li>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non suscipit nobis vitae, culpa error nemo dolorem quas explicabo saepe accusamus tempore ullam quasi quibusdam atque sed distinctio, quia quae cumque.
                    </li>
                    <li>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non suscipit nobis vitae, culpa error nemo dolorem quas explicabo saepe accusamus tempore ullam quasi quibusdam atque sed distinctio, quia quae cumque.
                    </li>
                    <li>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non suscipit nobis vitae, culpa error nemo dolorem quas explicabo saepe accusamus tempore ullam quasi quibusdam atque sed distinctio, quia quae cumque.
                    </li>
                    <li>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Non suscipit nobis vitae, culpa error nemo dolorem quas explicabo saepe accusamus tempore ullam quasi quibusdam atque sed distinctio, quia quae cumque.
                    </li>
                </ul>
            </div>
            <form action="" method="post">
                <button>Supprimer</button>
            </form>
        </div>
    </div>

@endsection


    
