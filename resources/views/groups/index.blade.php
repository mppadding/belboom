@extends('master')

@section('title', 'Groepen')

@section('content')
    @include('polymer.table', [
        'desktop' => [
            'title' => 'Groepen',
            'header' => ['Groepsnaam', 'Bewerken', 'Verwijderen'],
            'content' => $content['desktop']
        ],
        'mobile' => [
            'title' => 'Groepen',
            'header' => ['Groepsnaam'],
            'content' => $content['mobile']
        ]
    ])
@stop

@include('polymer.fab', ['icon' => 'add', 'url' => route('groepen.create')])