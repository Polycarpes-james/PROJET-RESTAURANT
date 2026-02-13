@extends('admin.base')

@section('title', 'CATEGORIES')
    
@section('content')
    <div class="presentation-categories">
        <h1>La liste les categories</h1>
        <a href="{{ route('admin.category.create') }}">Ajouter une categorie</a>
    </div>
    <div class="categories-items all-categories">
        @foreach ($categories as $category)
            <div class="category-item">
                <p>{{ $category->name }}</p>
                <div class="action-category">
                    <a href="{{ route('admin.category.edit', $category) }}">Modifier</a>
                    <form action="{{ route('admin.category.destroy', $category) }}" method="post">
                        @csrf
                        @method("delete")
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection