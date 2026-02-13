@extends('auth.base')

@section('title', 'Se connecter')

@section('content')
    <h1>Connexion</h1>
    <div class="connexion-container">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <x-form.index type="email" id="email" label='Entrer votre adresse email' name='email' placeholder="billnganvala@gmail.com" />
            <x-form.index type="password" id="password" label='Entrer votre mot de pass' name='password' placeholder="............" />
            
            <a href="{{ route('signin') }}">Vous n'avez pas de compte ? inscrivez vous !</a>
            <button type="submit">
                @yield('title')
            </button>
        </form>    
    </div>    
@endsection
    
