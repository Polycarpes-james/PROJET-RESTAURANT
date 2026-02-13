<div class="select-item">
    <label for="{{ $id ?? $name}}">{{ $label }}</label>
    <p class="paragraphe">{{ $paragraphe }}</p>
    <select name="{{ $name }}" id="{{ $id ?? $name }}" class="@error($name)border-red @enderror" {{ $multiple === "true" ? "multiple" : "" }}>
        <option value="">{{ $headCategories }}</option>
        {{-- @foreach($categories as $v)
            <option @selected($value->contains($v->id)) value="{{ $v->id }}" class="categories" >{{ $v->name }} {{ $v->price ? ": Prix ($v->price €)" : "" }} </option>
        @endforeach --}}
        @foreach($categories as $k => $v)
            <option @selected(collect(old($name, $value))->contains($k)) value="{{ $k }}" class="categories">{{ $v }}</option>
        @endforeach
    </select>
</div>