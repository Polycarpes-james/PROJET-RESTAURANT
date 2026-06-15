<aside id="{{ $contentId }}" class="modal" style="display: none;">
    <div class="{{ $contentSecondClass }}" id="modalContent">
        <header class="{{ $headerClass }}">
            <h3 id="modalTitle"></h3>
            <button id="closeModal" class="modal-close">×</button>
        </header>   
        <main class="{{ $mainClass }}">
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
        </main>
        <footer class="{{ $footerClass }}">
        </footer>
    </div>
</aside>