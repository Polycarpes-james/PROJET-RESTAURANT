@extends('admin.base')

@section('title', 'PLATS')
    
@section('content')
    <div class="container-items-admin">
        <div class="presentation-categories presentation-plats">
            <h1>La liste les plats</h1>
            <a href="{{ route('admin.plat.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="35" viewBox="2 1 20 22" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-plus-icon lucide-square-plus"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M8 12h8"/><path d="M12 8v8"/></svg>
            </a>
            <div class="actions-item-categories">
                <input type="search" name="search-plat" id="search-plat" placeholder="Rechercher un plat...">
            </div>
        </div>
        <div class="plats-items">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Disponibilité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plats as $plat)
                        <tr class="plat-item">     
                            <td>{{ $plat->id }}</td>           
                            <td><img src="{{ $plat->getPicture()->getPictureUrl(70, 60) }}" alt=""></td>           
                            <td>{{ $plat->truncateText($plat->name, 30) }}</td>           
                            <td>{{ $plat->price }} €</td>           
                            <td><p class="{{ $plat->disponible === "yes" ? "valide-plat" : "invalide-plat" }}">{{ $plat->disponible }}</p></td>           
                            <td class="action-item">
                                <div class="action-category">
                                    <a href="{{ route('admin.plat.show', $plat) }}" id="show">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
                                    </a>
                                    <a href="{{ route('admin.plat.edit', $plat) }}" id="show">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.ingredient.destroy', $plat) }}" id="ingredient-form" method="post">
                                        @csrf
                                        @method("delete")
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2"><path d="M10 11v6"/><path d="M14 11v6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M3 6h18"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection