@extends('admin.base')

@section('title', 'RESERVATIONS')

@section('content')
    Reservations
    <div class="all-reservation">
        @foreach ($reservations as $reservation)
            {{ $reservation }}
        @endforeach
    </div>
@endsection
    
