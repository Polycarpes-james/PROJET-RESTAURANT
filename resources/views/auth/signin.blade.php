@extends('auth.base')

@section('title', "S'inscrire")

@section('content')
    <h1>Inscription</h1>
    <div class="connexion-container">
        <form action="{{ route('signin') }}" method="post">
            @csrf
            <x-form.index id="name" label='Entrer votre nom' name='name' placeholder="De la sante" />
            <x-form.index id="firstname" label='Entrer votre prenom' name='firstname' placeholder="Bill" />
            <x-form.index type="email" id="email" label='Entrer votre adresse email' name='email' placeholder="billnganvala@gmail.com" />
            <x-form.index type="password" id="password" label='Entrer votre mot de pass' name='password' placeholder="............" />
             <p class="sub">Choisissez Google pour une connexion rapide, ou utilisez votre email.</p>

            <a class="btn btn-google" href="{{ route('google.login') }}" aria-label="Se connecter avec Google">
            <!-- Icône Google SVG -->
            <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">
                <path fill="#FFC107" d="M43.6,20.5H42V20H24v8h11.3C33.7,31.9,29.3,35,24,35c-6.6,0-12-5.4-12-12S17.4,11,24,11c3,0,5.7,1.1,7.8,3l5.7-5.7 C34.6,5.1,29.6,3,24,3C12.9,3,4,11.9,4,23s8.9,20,20,20s19-9,19-20C43.9,23.3,43.8,21.8,43.6,20.5z"/>
                <path fill="#FF3D00" d="M6.3,14.7l6.6,4.8C14.3,16.2,18.8,13,24,13c3,0,5.7,1.1,7.8,3l5.7-5.7C34.6,5.1,29.6,3,24,3 C16.1,3,9.4,7.5,6.3,14.7z"/>
                <path fill="#4CAF50" d="M24,43c5.2,0,10-2,13.5-5.5l-6.2-5c-2,1.3-4.6,2.1-7.3,2.1c-5.2,0-9.6-3.3-11.2-7.9l-6.6,5.1 C8.7,38.9,15.8,43,24,43z"/>
                <path fill="#1976D2" d="M43.6,20.5H42V20H24v8h11.3c-1.1,3.1-3.4,5.6-6.3,7.1l0,0l6.2,5C38.5,37.6,44,32,44,23 C44,21.7,43.9,21.1,43.6,20.5z"/>
            </svg>
            Se connecter avec Google
            </a>
            <a class="btn btn-facebook" href="#" aria-label="Se connecter avec Facebook">
            <!-- Icône Google SVG -->
            <svg class="facebook-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">
                <path fill="#1877F2" d="M24,4C12.95,4,4,12.95,4,24s8.95,20,20,20s20-8.95,20-20S35.05,4,24,4z"/>
                <path fill="#FFF" d="M27.2,24H30l0.4-4h-3.2v-2c0-1.2,0.3-2,2-2H30v-3.5c-0.5-0.1-1.5-0.2-2.8-0.2c-2.8,0-4.7,1.7-4.7,4.9V20h-3v4h3v10h4.7V24z"/>
            </svg>
            Se connecter avec Facebook
            </a>
            <a class="btn btn-gmail" href="#" aria-label="Se connecter avec Gmail">
            <!-- Icône Google SVG -->
            <svg class="gmail-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" aria-hidden="true">
                <path fill="#EA4335" d="M24 24L6 11v26h6V22l12 9 12-9v15h6V11z"/>
                <path fill="#FBBC04" d="M42 11v26h-6V22z"/>
                <path fill="#34A853" d="M6 11v26h6V22z"/>
                <path fill="#4285F4" d="M6 11l18 13 18-13v-2a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2z"/>
            </svg>
            Se connecter avec Gmail
            </a>
            <a href="{{ route('login') }}">Vous avez déjà un compte ? connectez vous</a>
            <button type="submit">
                @yield('title')
            </button>
        </form>    
    </div>    
@endsection
    