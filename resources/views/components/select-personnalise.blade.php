<div class="item-select" data-filtable="{{ !$filtable }}">
    <span class="item-btn-select user-filter" data-target="state" data-value="">Choisir un élément
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down"><path d="m6 9 6 6 6-6"/></svg>
    </span>
    @if ($searchValide)
        <input type="hidden" name="{{ $target }}" id="hidden-input">    
    @endif
    <ul class="item-options" data-target="{{ $target }}">
        @foreach ($items as $key => $item)
            <li data-value="{{ $key }}">{{ $item }}</li>
        @endforeach
    </ul>
</div> 