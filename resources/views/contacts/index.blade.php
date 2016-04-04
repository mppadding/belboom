@extends('master')

@section('title', 'Contacten')

@section('content')
    @include('polymer.table', [
        'desktop' => [
            'title' => 'Contacten',
            'header' => ['Naam', 'Telefoonnummer', 'Functie', 'Bewerken', 'Verwijderen'],
            'content' => $content['desktop']
        ],
        'mobile' => [
            'title' => 'Contacten',
            'header' => ['Naam'],
            'content' => $content['mobile']
        ]
    ])
@stop

@include('polymer.fab', ['icon' => 'add', 'url' => route('contacten.create')])