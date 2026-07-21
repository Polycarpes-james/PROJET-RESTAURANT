@extends('layout.base')

@section('title', "Mon compte")

@section('body-style', 'profile-style')

@section('background_header', 'profile-backgroud-header')
    

@section('content')

    <div class="profile-main-container">

        <div class="container">


        <aside class="sidebar">

            <div class="profile">

                <img src="#" alt="">

                <div>
                    <h3>Umaima Faisal</h3>
                    <span>Donor</span>
                </div>

            </div>

            <p class="menu-title">
                Menu
            </p>

            <nav>

                <a href="#">
                    <i class="fa-solid fa-house"></i>
                    Home
                </a>

                <a href="#">
                    <i class="fa-regular fa-file-lines"></i>
                    View Requests
                </a>

                <a href="#">
                    <i class="fa-solid fa-location-dot"></i>
                    Track Request
                </a>

                <a href="#">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    History
                </a>

                <a href="#" class="active">
                    <i class="fa-regular fa-user"></i>
                    My profile
                </a>

            </nav>

            <a href="#" class="logout">
                Logout
            </a>

        </aside>

        <!-- ================= CONTENT ================= -->

        <main class="content">

            <h1>
                Account Settings
            </h1>

            <!-- PROFILE -->

            <section class="card">

                <div class="card-header">

                    <h2>My Profile</h2>

                    {{-- <button>
                        Edit
                        <i class="fa-solid fa-pen"></i>
                    </button> --}}

                </div>

                <div class="profile-box">
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
                    <div>
                        <h3>{{ $user->firstname }}</h3>
                        <span>{{ $user->role_label }}</span>
                        <small>{{ $user->email }}</small>
                    </div>
                </div>

            </section>

            <!-- PERSONAL -->

            <section class="card">

                <div class="card-header">

                    <h2>Information personelles</h2>

                    <button>
                        Edit
                        <i class="fa-solid fa-pen"></i>
                    </button>

                </div>

                <div class="grid">

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
                        <strong>0312-4567890</strong>
                    </div>

                    <div class="item">
                        <span>Role</span>
                        <strong>{{ $user->role_label }}</strong>
                    </div>

                </div>

            </section>

            <!-- ADDRESS -->

            <section class="card">

                <div class="card-header">

                    <h2>Address</h2>

                    <button>
                        Edit
                        <i class="fa-solid fa-pen"></i>
                    </button>

                </div>

                <div class="grid">

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
                <div class="change-password">
                    <h2>Changer de mot de passe</h2>
                    <p>Vous pouvez changer votre mot de passe actuel</p>
                </div>
                <x-form.index type="password" name="password" label="Nouveau mot de pass" placeholder="................"/>
                <x-form.index type="password" name="password_confirmation" label="Comfirmer le mot de pass" placeholder="................"/>
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
        </div> --}}
    </div>

@endsection


    
