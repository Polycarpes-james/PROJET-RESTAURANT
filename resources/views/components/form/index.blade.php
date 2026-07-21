<div class="item-input {{ $class }}">
    <label for="{{ $id ?? $name }}">{{ $label }}</label>
    <p class="paragraphe">{{ $paragraphe }}</p>
    @if ($type === "textarea")
        <textarea name="{{ $name }}" id="{{ $id ?? $name }}" cols="30" rows="10">
            {{ old($name, $value) }}
        </textarea>
    @else
        <div class="search-wrap">
            <input type="{{ $type }}" name="{{ $name }}" class="item-input-field" id="{{ $id ?? $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">
        </div> 
    @endif
    @error($name)
        <p class="error">
            {{ $message }}
        </p>
    @enderror
    <p class="error_ts" data-target="{{ $name }}"></p>
</div>  