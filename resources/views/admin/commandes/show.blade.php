@extends('admin.base')

@section('title', "Commande")
    
@section('content')
    <h1>@yield('title')</h1>

    <div class="">
        <h2>{{ $commande->status }}</h2>
        {{-- @dump($commande) --}}
        <div>
            @foreach ($panier->plats as $plat)
                <p>{{ $plat->name }}</p>
                <p>{{ $plat->pivot->quantite }}</p>
                <p>{{ $plat->price * $plat->pivot->quantite}}</p>
                @foreach ($plat->pictures as $picture)
                    <img src="{{ $picture->getPictureUrl(350, 300) }}" alt="">
                @endforeach
            @endforeach
        </div>
    </div>
    
@endsection