<div class="select-item">
    <label for="{{ $id ?? $name}}">{{ $label }}</label>
    <p class="paragraphe">{{ $paragraphe }}</p>
    <select name="{{ $name }}" id="{{ $id ?? $name }}" class="@error($name)border-red @enderror" {{ $multiple === "true" ? "multiple" : "" }}>
        <option value="">{{ $headCategories }}</option>
        {{-- @foreach($categories as $v) --}}
        <option @selected($menu->id) value="{{ $menu->id }}" class="categories" >{{ $menu->name }}</option>
        {{-- @endforeach --}}
    </select>
</div>
