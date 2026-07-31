@extends('layout.base')

@section('title', "Mon compte")
@section('main-style', 'profile-main-container')
@section('body-style', 'profile-style')

@section('background_header', 'profile-backgroud-header')

@php
    $fields = [
            [
                'name' => 'name',
                'value' => Auth::user()->name,
                'label' => 'Mon nom de profile'
            ],
            [
                'name' => 'firstname',
                'value' => Auth::user()->firstname,
                'label' => 'Mon prenom de profile'
            ],  
            [
                'name' => 'email',
                'value' => Auth::user()->email,
                'label' => 'Mon adresse email'
            ],
            [
                'name' => 'phone_number',
                'value' => Auth::user()->phone_number,
                'label' => 'Mon numero de telephone'
            ]
        ];

            $route = request()->route()->getName();
@endphp

@section('content')
    <div id="app"></div>
@endsection


    
