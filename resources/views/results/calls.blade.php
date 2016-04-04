@extends('master')

@section('title', 'Resultaten')

@section('content')
    @include('polymer.table', [
        'desktop' => [
            'title' => 'Oproepen',
            'header' => ['Datum'],
            'content' => $data
        ]
    ])
@stop