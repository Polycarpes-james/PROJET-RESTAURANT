@extends('admin.base')

@section('title',  $plat->name)
    
@section('content')
    <div class="plat-item">
        <div class="title-category">
            <h1>@yield('title') ({{ $plat->category->name }})</h1>
        </div>
        <div class="description">
            <p>{{ $plat->description }}</p>
        </div>
        <div class="item-picture">
            @foreach ($plat->pictures as $picture)
                <img src="{{ $picture->getPictureUrl(200, 200) }}" alt="Photo">
            @endforeach
        </div>
       <div class="ingredients-item">
            <h2>Les ingredients du plat</h2>
            @foreach ($plat->ingredients as $ingredient)
                <div class="ingredients">
                    <p>{{ $ingredient->name }}</p>
                    <p>{{ $ingredient->price }}€</p>
                </div>
            @endforeach
            <div class="total-price">
                <p>Prix Total des ingredients : </p>
                <p>{{ $plat->total_price() }}€</p>
            </div>
       </div>       
        <div class="status">
            <p>Statut </p>
            <p class="disponible {{ $style_disponible }}">{{ $disponible }}</p>
            <p>{{ $plat->raison_indisponible }}</p>
        </div>
    </div>
@endsection