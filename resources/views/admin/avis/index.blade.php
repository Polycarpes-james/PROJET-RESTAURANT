@extends('admin.base')

@section('title', 'AVIS')
    

@section('content')

    @foreach ($avis as $avi)
        <div style="background:#80808015; padding:10px; margin:10px">
            <p style="font-weight:bold">{{ $avi->user->name }}</p>
            <p style="opacity:0.8;font-weight:bold">{{ $avi->plat->name }}</p>
            <p style="opacity:0.8">{{ $avi->commentaire }}</p>
        </div>
    @endforeach

@endsection
    
