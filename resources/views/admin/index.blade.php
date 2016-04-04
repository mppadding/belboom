@extends('master')

@section('title', 'Admins')

@section('content')
    @include('polymer.table', [
        'desktop' => [
            'title' => 'Admins',
            'header' => $header, 
            'content' => $content
        ]
    ])
@stop

@include('polymer.fab', ['icon' => 'social:person-add', 'url' => route('admin.register')])