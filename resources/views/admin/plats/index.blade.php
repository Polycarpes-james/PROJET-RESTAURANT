@extends('admin.base')

@section('title', 'PLATS')
    
@section('content')
    <div class="container-items-admin">
        <div class="presentation-categories presentation-plats">
            <h1>La liste les plats</h1>
            <a href="{{ route('admin.plat.create') }}">Ajouter un plat</a>
        </div>
        <div class="plats-items">
            @foreach ($plats as $plat)
                <div class="plat-item">                
                    <article class="action-plat">
                        <div class="show-name-description">
                            <a href="{{ route('admin.plat.show', $plat) }}" id="show">{{ $plat->truncateText($plat->name, 15) }}
                                <span class="show"></span>
                            </a>
                        </div>
                        <p>{{ $plat->truncateText($plat->description, 100) }}</p>
                        <div class="actions">
                            <a href="{{ route('admin.plat.edit', $plat) }}">Modifier</a>
                            <form action="{{ route('admin.plat.destroy', $plat) }}" method="post">
                                @csrf
                                @method("delete")
                                <button type="submit">Supprimer</button>
                            </form>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
@endsection