@extends('master')

@section('title', 'Functies')

@section('content')
    @include('polymer.table', [
        'desktop' => [
            'title' => $name,
            'header' => ['Naam', 'Functie', 'Nummer'],
            'content' => $content['desktop']
        ],
        'mobile' => [
            'title' => $name,
            'header' => ['Naam'],
            'content' => $content['mobile']
        ]
    ])
@stop

@include('polymer.fab', ['icon' => 'arrow-back', 'url' => route('groepen.index')])