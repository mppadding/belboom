@extends('master')

@section('title', 'Functies')

@section('content')
    @include('polymer.table', [
        'desktop' => [
            'title' => 'Functies',
            'header' => ['Functie', 'Bewerken', 'Verwijderen'],
            'content' => $content['desktop']
        ],
        'mobile' => [
            'title' => 'Functies',
            'header' => ['Functie'],
            'content' => $content['mobile']
        ]
    ])
@stop

@include('polymer.fab', ['icon' => 'add', 'url' => route('functies.create')])