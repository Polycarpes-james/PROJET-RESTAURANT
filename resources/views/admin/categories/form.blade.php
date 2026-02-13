@extends('admin.base')

@section('title', $category->exists ? "Modification" : "Creation")
    
@section('content')
    <div class="formulaire-create-update">

        <h1>@yield('title') d'une categorie</h1>

        <form action="{{ route($category->exists ? "admin.category.update" : "admin.category.store", $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($category->exists ? 'PUT' : "POST")

            <x-form.index name="name" label="Entrer le nom du category" value="{{ $category->name }}" placeholder="Entrée ..."/>
            <button type="submit">
                @if ($category->exists)
                    Modification
                @else
                    Création
                @endif
                du category
            </button>
        </form>
    </div>
@endsection