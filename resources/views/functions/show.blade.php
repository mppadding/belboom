@extends('master')

@section('title', 'Functies')

@section('content')
    @include('polymer.table', [
        'mobile' => [
            'title' => 'Functies',
            'header' => $title,
            'content' => $content
        ]
    ])
@stop

@include('polymer.fab', ['icon' => 'arrow-back', 'url' => route('functies.index')])