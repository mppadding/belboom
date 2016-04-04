@extends('master')

@section('title', 'Functies')

@section('form.title', 'Functie Toevoegen')
@section('form.submit', 'Toevoegen')

@section('content')
    @include('polymer.paper-input', ['icon' => 'subject', 'name' => 'name', 'label' => 'Functienaam'])
@stop

@include('polymer.form', ['method' => 'post', 'url' => route('functies.store')])