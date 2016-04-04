@extends('master')

@section('title', 'Functies')

@section('form.title', 'Functie Bewerken')
@section('form.submit', 'Bewerken')

@section('content')
    @include('polymer.paper-input', ['value' => $value, 'icon' => 'subject', 'name' => 'name', 'label' => 'Functienaam'])
@stop

@include('polymer.form', ['method' => 'patch', 'url' => route('functies.update', ['id' => $id])])