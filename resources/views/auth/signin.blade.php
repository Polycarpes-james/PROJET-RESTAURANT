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
            <a href="{{ route('login') }}">Vous avez déjà un compte ? connectez vous</a>
            <button type="submit">
                @yield('title')
            </button>
        </form>    
    </div>    
@endsection
    