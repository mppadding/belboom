@extends('master')

@section('title', 'Contacten')

@section('form.title', 'Contact Toevoegen')
@section('form.submit', 'Toevoegen')

@section('content')
    @include('polymer.paper-input', [
        'icon' => 'social:person-add',
        'name' => 'name',
        'label' => 'Naam'
    ])
    
    @include('polymer.paper-input', [
        'icon' => 'hardware:smartphone',
        'name' => 'number',
        'label' => 'Telefoonnummer',
        'placeholder' => '31612345678'
    ])
    
    @include('polymer.paper-selector', [
        'valueattr' => '_id',
        'name' => 'role_id',
        'items' => $roles
    ])
@stop

@include('polymer.form', ['method' => 'post', 'url' => route('contacten.store')])