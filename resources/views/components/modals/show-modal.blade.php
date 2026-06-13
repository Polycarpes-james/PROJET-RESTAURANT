<aside id="{{ $contentId }}" class="modal" style="display: none;" data-panier="{{ $panier }}">
    <div class="{{ $contentSecondClass }}" id="{{ $type === "remove" ? "" : "modalContent"}}">
        <header class="{{ $headerClass }}">
            @if($type === "remove" || $type === "multi")
                <h3 id="{{ $type === "remove" ? "suppression-title-modal" : "multi_title_modal" }}">Suppression du plat</h3>
            @else
                <h3 id="modalTitle"></h3>
                <button id="closeModal" class="modal-close">×</button>
            @endif
        </header>   
        <main class="{{ $mainClass }}">
            <p  @if ($type === "remove" || $type === "multi") class="{{ $type === "remove" ? "suppression-message" : "multi_tasks_message" }}" @endif
                @if ($type === "message")
                    id="modalMessage"
                @endif
            ></p>
        </main>
        <footer class="{{ $footerClass }}" data-invite_id="{{ Cookie::get('invite_id') }}" data-auth="{{ auth()->check() }}" >
            @if ($type === "remove" || $type === "multi")
                <button class="{{ $type === "remove" ? "btn-suppression" : "multi_vide_btn" }}">Ok</button>
                <button class="btn-modal-close">×</button>
            @endif
        </footer>
    </div>
</aside>