@extends('master')

@section('title', 'Contacten')

@section('form.title', 'Contact Bewerken')
@section('form.submit', 'Bewerken')

@section('content')
    @include('polymer.paper-input', [
        'icon' => 'social:person-add',
        'name' => 'name',
        'label' => 'Naam',
        'value' => $name
    ])
    
    @include('polymer.paper-input', [
        'icon' => 'hardware:smartphone',
        'name' => 'number',
        'label' => 'Telefoonnummer',
        'placeholder' => '31612345678',
        'value' => $number
    ])
    
    @include('polymer.paper-selector', [
        'valueattr' => '_id',
        'name' => 'role_id',
        'items' => $roles,
        'value' => $role_id
    ])
@stop

@include('polymer.form', ['method' => 'patch', 'url' => route('contacten.update', ['id' => $id])])