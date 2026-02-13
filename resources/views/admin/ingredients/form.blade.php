@extends('admin.base')

@section('title', $ingredient->exists ? "Modification" : "Creation")
    
@section('content')
    <div class="formulaire-create-update">

        <h1>@yield('title') d'une ingredient</h1>

        <form action="{{ route($ingredient->exists ? "admin.ingredient.update" : "admin.ingredient.store", $ingredient) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($ingredient->exists ? 'PUT' : "POST")

            <x-form.index name="name" label="Entrer le nom de l'ingredient" value="{{ $ingredient->name }}" placeholder="Entrée ..."/>
            <x-form.index name="price" label="Entrer le prix de l'ingredient" value="{{ $ingredient->price }}" placeholder="28.00"/>
            <button type="submit">
                @if ($ingredient->exists)
                    Modification
                @else
                    Création
                @endif
                de l'ingredient
            </button>
        </form>
    </div>
@endsection