@extends('master')

@section('title', 'Groepen')

@section('form.title', 'Groep Bewerken')
@section('form.submit', 'Bewerken')

@section('content')
    @include('polymer.paper-input', [
        'icon' => 'subject',
        'name' => 'name',
        'label' => 'Groepsnaam',
        'value' => $name
    ])
    @include('polymer.paper-selector', [
        'name'      => 'contacts',
        'items'     => $contacts,
        'type'      => 'multi',
        'valueattr' => '_id',
        'value'     => $selected
    ])
@stop

@include('polymer.form', ['method' => 'patch', 'url' => route('groepen.update', ['id' => $id])])
@include('polymer.fab', ['icon' => 'arrow-back', 'url' => route('groepen.index')])