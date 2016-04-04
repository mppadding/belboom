@extends('master')

@section('title', 'Functies')

@section('form.title', 'Oproep')
@section('form.submit', 'Oproep Versturen')

@section('content')
    {{ $credits }}
    @include('polymer.paper-textarea', [
        'icon'  => 'speaker-notes',
        'name'  => 'message',
        'label' => 'Bericht',
        'type'  => 'multi'
    ])
    @include('polymer.paper-selector', [
        'valueattr' => 'group',
        'name'      => 'groups',
        'items'     => $groups,
        'type'      => 'multi'
    ])
@stop

@include('polymer.form', ['method' => 'post', 'url' => route('oproep.send')])