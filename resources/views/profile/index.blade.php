@extends('layout.base')

@section('title', "Mon compte")
@section('main-style', 'profile-main-container')
@section('body-style', 'profile-style')

@section('background_header', 'profile-backgroud-header')

@php
    $fields = [
            [
                'name' => 'name',
                'value' => Auth::user()->name,
                'label' => 'Mon nom de profile'
            ],
            [
                'name' => 'firstname',
                'value' => Auth::user()->firstname,
                'label' => 'Mon prenom de profile'
            ],  
            [
                'name' => 'email',
                'value' => Auth::user()->email,
                'label' => 'Mon adresse email'
            ]
        ];

            $route = request()->route()->getName();
@endphp
@section('content')
    <x-show-modal-admin kind="" contentId="admin_item_delete" contentSecondClass="admin_item_content" headerClass="admin_item_header" mainClass="admin_item_main" footerClass="admin_item_footer">
        <x-formulaire action="rettine.profile.update.real" method="POST" :inputs="$fields" btnLabel="Enregistrer">
                <div class="change-password">
                    <h2>Changer de mot de passe</h2>
                    <p>Vous pouvez changer votre mot de passe actuel</p>
                </div>
                <x-form.index type="password" name="password" label="Nouveau mot de pass" placeholder="................"/>
                <x-form.index type="password" name="password_confirmation" label="Comfirmer le mot de pass" placeholder="................"/>
        </x-formulaire>
    </x-show-modal-admin>

    <div class="profile-main">
        <div class="container">
            <aside class="sidebar">
                <div class="profile-side-bar">
                    @if (Auth::user()->avatar)
                        <img id="avatarPreview" 
                        src="{{ asset('storage/' . Auth::user()->avatar)}}" 
                        alt="Avatar" 
                        class="profile-avatar">
                    @else
                        <p class="cutName" id="avatarPreview">{{ $user->cutName() }}</p>
                    @endif  
                    <div>
                        <h3>{{ $user->name }} {{ $user->firstname}}</h3>
                        <span>{{ $user->role_label }}</span>
                    </div>
                </div>
                <nav>
                    <div class="main-part">
                        <a href="{{ route('rettine.profile.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.profile')])>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard-icon lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>                    
                            Home
                        </a>
                        <a href="{{ route('admin.plat.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, 'admin.plat')])>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-template-icon lucide-layout-template"><rect width="18" height="7" x="3" y="3" rx="1"/><rect width="9" height="7" x="3" y="14" rx="1"/><rect width="5" height="7" x="16" y="14" rx="1"/></svg>
                            Favoris
                        </a>
                        <a href="{{ route('admin.category.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.category')])>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-sort-descending-icon lucide-list-sort-descending"><path d="M15 12H3"/><path d="M3 5h18"/><path d="M9 19H3"/></svg>
                            Commandes
                        </a>
                        <a href="{{ route('admin.ingredient.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.ingredient')])>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-navigation-icon lucide-navigation"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                            Informations
                        </a>
                        <a href="{{ route('admin.avis.index') }}" @class(['nav-link-admin', 'hover' => str_contains($route, '.avis')])>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cog-icon lucide-cog"><path d="M11 10.27 7 3.34"/><path d="m11 13.73-4 6.93"/><path d="M12 22v-2"/><path d="M12 2v2"/><path d="M14 12h8"/><path d="m17 20.66-1-1.73"/><path d="m17 3.34-1 1.73"/><path d="M2 12h2"/><path d="m20.66 17-1.73-1"/><path d="m20.66 7-1.73 1"/><path d="m3.34 17 1.73-1"/><path d="m3.34 7 1.73 1"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="12" r="8"/></svg>                        
                            Parametres
                        </a>
                    </div>      
                </nav>
                <x-basic-formulaire class="logout_part" action="logout" method="delete">
                    <button class="deconnexion">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                    </button>
                </x-basic-formulaire>  
            </aside>
            <main class="content">
                <div class="section-item section-big-first">
                    <div class="header-line">
                        <h1><span>Bonjour</span>, {{ $user->name }}</h1>
                        <p>Bienvenue sur votre compte</p>
                    </div>
                    <section class="profile-card">

    <div class="profile-card-header">

        <div class="profile-card-icon">
            👋
        </div>

        <div>

            <h2>Bienvenue James !</h2>

            <p>
                Complétez votre profil afin d'accéder à toutes les fonctionnalités.
            </p>

        </div>

    </div>

    <div class="progress">

        <div class="progress-bar">

            <div class="progress-fill" style="width:{{ $profile['percentage'] }}%"></div>

        </div>

        <span>55%</span>

    </div>

    <ul class="profile-checklist">

        <li class="complete">
            ✓ Nom
        </li>

        <li class="complete">
            ✓ Email
        </li>

        <li>
            ✗ Téléphone
        </li>

        <li>
            ✗ Prénom
        </li>

        <li>
            ✗ Adresse
        </li>

    </ul>

    <a href="/profile/edit" class="btn-profile">

        Compléter mon profil

    </a>

</section>
                    <section class="card card-profile">
                        <div class="card-header">
                            <h2>Mon profile</h2>
                        </div>
                        <div class="profile-box">
                            <div class="picture-profile">
                                <form action="{{ route('rettine.profile.update.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                                    @csrf
                                    <input type="file" id="avatarInput" name="avatar" accept="image/*" hidden>
                                    @if (Auth::user()->avatar)
                                        <img id="avatarPreview" 
                                        src="{{ asset(Auth::user()->avatar)}}" 
                                        alt="Avatar" 
                                        class="profile-avatar">
                                    @else
                                        <p class="cutName" id="avatarPreview">{{ $user->cutName() }}</p>
                                    @endif                            
                                    <div id="avatarLoader" class="hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                    </div>
                                </form>
                            </div>                    
                            <div>
                                <h3>{{ $user->firstname }}</h3>
                                <span>{{ $user->role_label }}</span>
                                <small>{{ $user->email }}</small>
                            </div>
                        </div>
                    </section>
                    <section class="card">
                        <div class="card-header">
                            <h2>Information personelles</h2>
                            <button class="edit-profile-btn btn-edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg></button>
                        </div>
                        <div class="grille-infos">
                            <div class="item">
                                <span>Nom</span>
                                <strong>{{ $user->name }}</strong>
                            </div>
                            <div class="item">
                                <span>Prenom</span>
                                <strong>{{ $user->firstname }}</strong>
                            </div>
                            <div class="item">
                                <span>Address Email</span>
                                <strong>{{ $user->email }}</strong>
                            </div>
                            <div class="item">
                                <span>Phone</span>
                                <strong>{{ $user->phone }}</strong>
                            </div>
                            <div class="item">
                                <span>Role</span>
                                <strong>{{ $user->role_label }}</strong>
                            </div>
                        </div>
                    </section>
                    <section class="card">
                        <div class="card-header">
                            <h2>Address</h2>
                            <button class="btn-edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg></button>
                        </div>
                        <div class="grille-infos">
                            <div class="item">
                                <span>Country</span>
                                <strong>Pakistan</strong>
                            </div>
                            <div class="item">
                                <span>City</span>
                                <strong>Lahore</strong>
                            </div>
                            <div class="item">
                                <span>State</span>
                                <strong>Punjab</strong>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="section-item section-small">
                    <div class="panier-user">
                        <div class="header-line">
                            <span>Votre Panier</span>
                            <div class="panier-icon"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                <span class="total-number-plats">{{ $total }}</span>  
                            </div> 
                            <div class="panier-plats">
                                @if ($panier !== [])
                                    @foreach ($panier->plats as $plat)
                                        <div class="plat-item">
                                            <p class="name">{{ $plat->name }}</p>
                                            <p>{{ $plat->panierPlats->first()->prix_total }}€</p>
                                            <div class="quantite-total">
                                                <p>{{ $plat->panierPlats->first()->quantite }}*{{ $plat->price }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        {{-- <div class="profile-items">
            <div>
                <p id="compte">Mon compte</p>
                <h1 class="profile-user-info">{{ $user->firstname }} {{ $user->name }}</h1>
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
    <div class="belongToUser">
        <h1>{{ $total }}</h1>
        @forelse ($platsCommande as $plat)
            <p>{{ $plat->name }}</p>
        @empty
            <p>Pas de commande !</p>
        @endforelse

        @forelse ($user->avis as $avi)
            <p>{{ $avi->note }}</p>
            <p>{{ $avi->plat->name }}</p>
            <p>{{ $avi->commentaire }}</p>
            <p>{{ format_date($avi->updated_at, 'relative')  }}</p>
        @empty
            <p>Pas de commande !</p>
        @endforelse
    </div>
    <div class="profile-container-form">
        <div class="formulaire">
            <h2>Modifier votre profile actuel</h2>
            <form action="{{ route('rettine.profile.update') }}" method="POST" id="profile-formulaire" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-form.index name="name" :value="Auth::user()->name" label="Mon nom de profile"/>
                <x-form.index name="firstname" :value="Auth::user()->firstname" label="Mon prenom de profile"/>
                <x-form.index type="email" name="email" :value="Auth::user()->email" label="Mon adresse email"/>
                <button type="submit" class="btn btn-primary" class="submit-btn">Enregistrer</button>
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
        </div> --}}
    </div>

@endsection


    
