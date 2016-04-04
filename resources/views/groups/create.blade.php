@extends('master')

@section('title', 'Groepen')

@section('form.title', 'Groep Toevoegen')
@section('form.submit', 'Toevoegen')

@section('content')
    @include('polymer.paper-input', ['icon' => 'subject', 'name' => 'name', 'label' => 'Groepsnaam'])
    @include('polymer.paper-selector', [
        'name'      => 'contacts',
        'items'     => $contacts,
        'type'      => 'multi',
        'valueattr' => '_id'
    ])
@stop

@include('polymer.form', ['method' => 'post', 'url' => route('groepen.store')])
@include('polymer.fab', ['icon' => 'arrow-back', 'url' => route('groepen.index')])