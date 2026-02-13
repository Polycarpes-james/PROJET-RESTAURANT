<div class="item-input {{ $class }}">
    <label for="{{ $id ?? $name }}">{{ $label }}</label>
    <p class="paragraphe">{{ $paragraphe }}</p>
    @if ($type === "textarea")
        <textarea name="{{ $name }}" id="{{ $id ?? $name }}" cols="30" rows="10">
            {{ old($name, $value) }}
        </textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id ?? $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}">
    @endif
    @error($name)
        <p class="error">
            {{ $message }}
        </p>
    @enderror
</div>  