@extends('admin.base')

@section('title', "Commande")
    
@section('content')
    <h1>@yield('title')</h1>

    <div class="">
        <h2>{{ $commande->status }}</h2>
        {{-- @dump($commande) --}}
        <div>
            @foreach (($commande->invite_id ? $panierGuest : $panier->plats) as $plat)
                <p>{{ $plat->name ?? $plat->plat_name }}</p>
                <p>{{ $commande->invite_id ? $plat->quantite : $plat->pivot->quantite }}</p>
                <p>{{ $commande->invite_id ? $plat->prix_total : ($plat->price * $plat->pivot->quantite)}}</p>
                <img src="{{ $commande->invite_id ? $plat->plat->getPicture()->getPictureUrl(100, 90) : $plat->getPicture()->getPictureUrl(100, 90) }}" alt="">
            @endforeach
        </div>
    </div>
    
@endsection