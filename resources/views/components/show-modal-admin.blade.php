<aside id="{{ $contentId }}" class="modal" style="display: none;">
    <div class="{{ $contentSecondClass }}" id="modalContentAdmin">
        <header class="{{ $headerClass }}">
            <h3 id="item-font"></h3>
            <button id="closeModalAdmin" class="modal-close-admin">
                <svg width="25px" height="25px" viewBox="0 0 24 20" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </header>   
        <main class="{{ $mainClass }}">
            <p class="paragraphe_message"></p>
        </main>
        <footer class="{{ $footerClass }}">
            <button type="submit" class="{{ $kind }}">Ok</button>
        </footer>
    </div>
</aside>