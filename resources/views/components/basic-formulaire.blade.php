<div class="{{ $class }}">
    <form action="{{ route($action) }}" method="POST">
        @method($method)
        @csrf
        {{ $slot }}
    </form>
</div>