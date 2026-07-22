<div class="formulaire-global">
    <form action="{{ route($action) }}" method="{{ $method }}" id="profile-formulaire" enctype="multipart/form-data">
        @csrf
        @if ($method === "PUT" || $method === "put")
            @method('PUT')
        @endif
        <div class="elements_side">
            @foreach ($inputs as $input)
                <x-form.index name="{{ $input['name'] }}" :value="$input['value']" label="{{ $input['label'] }}" />
            @endforeach
        </div>
        {{ $slot }}
        <button type="submit" class="btn btn-primary">{{ $btnLabel }}</button>
    </form>
</div>
