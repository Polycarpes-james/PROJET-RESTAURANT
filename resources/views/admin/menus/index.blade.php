@extends('admin.base')

@section('title', 'MENUS')
    
@section('content')
    <div class="presentation-categories presentation-plats presentations-menus">
        <h1>La liste les menus</h1>
        <a href="{{ route('admin.menu.create') }}">Ajouter un menu</a>
    </div>
    <div class="plats-items">
        @foreach ($menus as $menu)
            <div class="plat-item">
                <article class="action-plat">
                    <div class="show-name-description">
                        <a href="{{ route('admin.menu.show', $menu) }}" id="show" >{{ $menu->truncateText($menu->name, 16) }}
                            {{-- <span class="show"></span> --}}
                        </a>
                    </div>
                    <p>{{ $menu->truncateText($menu->description, 100) }}</p>
                    <div class="actions">
                        <a href="{{ route('admin.menu.edit', $menu) }}">Modifier</a>
                        <form action="{{ route('admin.menu.destroy', $menu) }}" method="post">
                            @csrf
                            @method("delete")
                            <button type="submit">Supprimer</button>
                        </form>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
@endsection