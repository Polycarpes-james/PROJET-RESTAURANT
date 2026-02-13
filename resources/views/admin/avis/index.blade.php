@extends('admin.base')

@section('title', 'AVIS')
    

@section('content')

    @foreach ($avis as $avi)
        <p>{{ $avi->commentaire }}</p>
        <p>{{ $avi->user->name }}</p>
    @endforeach

@endsection
    
