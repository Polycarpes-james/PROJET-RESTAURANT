<div class="item-input input-radios">
    <label>{{ $label }}</label>
    <p class="paragraphe">{{ $paragraphe }}</p>
   <div class="items">
        <div>
            <label for="yes-input" class="radio-label">Disponible</label>
            <input type="radio" name="{{ $name }}" id="yes-input" value="yes" class="radio-input" {{ old($name, $selected ?? 'yes') === 'yes' ? 'checked' : '' }} >
        </div>
        <div>
            <label for="no-input" class="radio-label">Non disponible</label>
            <input type="radio" name="{{ $name }}" id="no-input" value="no" class="radio-input" {{ old($name, $selected ?? 'no') === 'no' ? 'checked' : '' }}>
        </div>
   </div>
</div>