@extends('master')

@section('title', 'Resultaten')

@section('content')
    @include('polymer.table', [
        'mobile' => [
            'title'     => 'Resultaten',
            'header'    => ['Naam', 'Aankomst'],
            'content'   => $content
        ]
    ])
@stop

@include('polymer.fab', ['icon' => 'arrow-back', 'url' => route('resultaten.index')])