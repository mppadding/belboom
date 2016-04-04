@extends('master')

@section('title', 'Contacten')

@section('content')
    @include('polymer.table', [
        'mobile' => [
            'title' => 'Contacten',
            'header' => $title,
            'content' => $content
        ]
    ])
@stop