<div class="item-input">
    <input type="file" name="{{ $name }}" accept="{{ $accepte }}" id="{{ $id ?? $name }}" multiple hidden>
    <label class="custom-btn">{{ $label }}</label>
    <p class="paragraphe">{{ $paragraphe }}</p>
    <div class="action-picture">
        <label for="images" class="custom-btn">Allez sur les fichiers</label>
        <span id="fileName">{{ $span }}</span>
    </div>
</div>