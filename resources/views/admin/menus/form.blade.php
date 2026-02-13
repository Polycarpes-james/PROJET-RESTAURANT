@extends('admin.base')

@section('title', $menu->exists ? "Modification" : "Creation")
    
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="formulaire-create-update">

        <h1>@yield('title') d'un menu</h1>

        <form action="{{ route($menu->exists ? "admin.menu.update" : "admin.menu.store", $menu) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($menu->exists ? 'PUT' : "POST")

            <x-form.index name="name" label="Entrer le nom du menu" value="{{ $menu->name }}" placeholder="Sauce de france"/>
            <x-form.index name="description" type="textarea" value="{{ $menu->description }}" label="Entrer la description du menu" placeholder="C'est un sauce special ..."/>
            <x-form.select-multiple hidden="false" headCategories="Chosis les plats pour le menu" id="select-multiple" name="plats[]" multiple="true" :value="$menu->plats()->pluck('id')" label="Trouver des plats pour le menu" :categories="$plats"/>

            <button type="submit">
                @if ($menu->exists)
                    Modification
                @else
                    Création
                @endif
                du menu
            </button>
        </form>
    </div>
@endsection