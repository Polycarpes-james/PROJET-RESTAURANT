@extends('admin.base')

@section('title',  $menu->name)
    
@section('content')
    <div class="plat-item plat-item-menu">
        <div class="title-category">
            <h1>@yield('title')</h1>
            <a href="{{ route('admin.menu.plat.create', ['menu' => $menu, 'slug' => $menu->getSlug()]) }}">Ajouter un plat au menu</a>
        </div>
        <div class="description">
            <p>{{ $menu->description }}</p>
        </div>
        <div class="menu-plats">
            <div class="first">
                <h2>La liste des plats du menu</h2>
                <p>{{ $menu->sumPlats() > 1 ? $menu->sumPlats() . " plats" : $menu->sumPlats(). ' plat' }}</p>
            </div>
            <div class="plats-items">
                @foreach ($menu->plats as $plat)
                   <div class="items">
                        <a href="{{ route('admin.plat.show', $plat) }}">
                            <span id="title">{{ $plat->name }}</span>
                            <p>{{ $plat->price }} € | <strong>{{ $plat->category->name }}</strong> | <span style="color: {{ $plat->platValide()[1] === "yes" ? '#5078c9' : '#c95050' }}">{{ $plat->platValide()[0] }}</span></p>
                        </a>
                   </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection