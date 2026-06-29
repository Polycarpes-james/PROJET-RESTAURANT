<aside id="{{ $contentId }}" class="modal" style="display: none;">
    <div class="{{ $contentSecondClass }}" id="modalContent">
        <header class="{{ $headerClass }}">
            <h1 id="modalTitle"></h1>
            <button id="closeModal" class="modal-close">
                <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </header>   
        <main class="{{ $mainClass }}">
            <div class="formulaire-create-update">
                @if ($type === "category")
                    <form action="{{ route("admin.category.store") }}" method="POST" id="category-form" enctype="multipart/form-data">
                        @csrf
                        <x-form.index name="name" label="Entrer le nom du category" placeholder="Entrée ..."/>
                        <input type="hidden" id="category-id" name="id">
                        <button type="submit" id="btn-submit">Création du category</button>
                    </form>
                @endif
                @if ($type === "ingredient")
                    <form action="{{ route("admin.ingredient.store") }}" method="POST" id="ingredient-form" enctype="multipart/form-data">
                        @csrf
                        <x-form.index name="name" label="Entrer le nom de l'ingredient"  placeholder="Entrée ..."/>
                        <input type="hidden" id="ingredient-id" >
                        <x-form.index name="price" label="Entrer le prix de l'ingredient" placeholder="28.00"/>
                        <button type="submit" id="btn-submit">Création de l'ingredient</button>
                    </form>
                @endif
            </div>
        </main>
    </div>
</aside>