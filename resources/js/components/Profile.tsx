import React from "react";

export default function Profile() {
    return <div className="profile-main">
        <div className="container">
            <aside className="sidebar">
                <div className="profile-side-bar">
                    @if (Auth::user()->avatar)
                        <img id="avatarPreview" 
                        src="{{ image_url(Auth::user()->avatar, 300, 300) }}" 
                        alt="Avatar" 
                        className="profile-avatar"/>
                    @else
                        <p className="cutName" id="avatarPreview">{{ $user->cutName() }}</p>
                    @endif  
                    <div>
                        <h3>{{ $user->name }} {{ $user->firstname}}</h3>
                        <span>{{ $user->role_label }}</span>
                    </div>
                </div>
                
                <x-basic-formulaire className="logout_part" action="logout" method="delete">
                    <button className="deconnexion">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-log-out-icon lucide-log-out"><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/></svg>
                    </button>
                </x-basic-formulaire>  
            </aside>
            <main className="content">
                <div className="section-item section-big-first">
                    <div className="header-line">
                        <h1><span>Bonjour</span>, {{ $user->name }}</h1>
                        <p>Bienvenue sur votre compte</p>
                    </div>

                    @if (!$profile['full'])
                        <section className="profile-card">
                            <div className="profile-warning">
                                <div className="warning-icon">
                                    <i className="fa-solid fa-circle-exclamation"></i>
                                </div>
                                <div className="warning-content">
                                    <h3>Complétez votre profil La Rettine</h3>
                                    <p>
                                        Certaines informations sont encore manquantes.
                                        Complétez votre profil afin de profiter pleinement des fonctionnalités.
                                    </p>
                                    <div className="progress-bar">
                                        <div className="progress-fill" style="width: {{ $profile['percentage'] }}%"></div>
                                    </div>                                    
                                    <button className="edit-profile-btn btn-edit"><span>{{ $profile['percentage'] }}%</span> Compléter maintenant</button>
                                </div>
                            </div>
                        </section> 
                    @endif
                    <section className="card card-profile">
                        <div className="card-header">
                            <h2>Mon profile</h2>
                        </div>
                        <div className="profile-box">
                            <div className="picture-profile">
                                <form action="{{ route('rettine.profile.update.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                                    @csrf
                                    <input type="file" id="avatarInput" name="avatar" accept="image" hidden>
                                    @if (Auth::user()->avatar)
                                        <img id="avatarPreview" 
                                        src="{{ image_url(Auth::user()->avatar, 300, 300) }}" 
                                        alt="Avatar" 
                                        className="profile-avatar">
                                    @else
                                        <p className="cutName" id="avatarPreview">{{ $user->cutName() }}</p>
                                    @endif                            
                                    <div id="avatarLoader" className="hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
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
                    <section className="card">
                        <div className="card-header">
                            <h2>Information personelles</h2>
                            <button className="edit-profile-btn btn-edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg></button>
                        </div>
                        <div className="grille-infos">
                            <div className="item">
                                <span>Nom</span>
                                <strong>{{ $user->name }}</strong>
                            </div>
                            <div className="item">
                                <span>Prenom</span>
                                <strong>{{ $user->firstname }}</strong>
                            </div>
                            <div className="item">
                                <span>Address Email</span>
                                <strong>{{ $user->email }}</strong>
                            </div>
                            <div className="item">
                                <span>Phone</span>
                                <strong>{{ $user->phone_number }}</strong>
                            </div>
                            <div className="item">
                                <span>Role</span>
                                <strong>{{ $user->role_label }}</strong>
                            </div>
                        </div>
                    </section>
                    <section className="card">
                        <div className="card-header">
                            <h2>Address</h2>
                            <button className="btn-edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg></button>
                        </div>
                        <div className="grille-infos">
                            <div className="item">
                                <span>Pays</span>
                                <strong>Paistan</strong>
                            </div>
                            <div className="item">
                                <span>Ville</span>
                                <strong>Lahore</strong>
                            </div>
                            <div className="item">
                                <span>Departement</span>
                                <strong>Punjab</strong>
                            </div>
                        </div>
                    </section>
                </div>
                <div className="section-item section-small">
                    <div className="panier-user">
                        <div className="header-line">
                            <div className="panier-icon"> 
                                <span className="total-number-plats">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" className="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                                    <p>Panier</p>
                                    <small>{{ $total }}</small>
                                </span>  
                            </div> 
                            <div className="panier-plats">
                                @if ($panier !== [])
                                    @foreach ($panier->plats as $plat)
                                        <div className="plat-item">
                                            <div className="item">
                                                <div className="head">
                                                    <p className="name">{{ truncateText($plat->name, 14) }}</p>
                                                    <p className="price">{{ $plat->pivot->prix_total }}€</p>
                                                </div>
                                                <div className="quantite-total">
                                                    <p>{{ $plat->pivot->quantite }}*{{ $plat->price }}€</p>
                                                </div>
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
    </div>
}