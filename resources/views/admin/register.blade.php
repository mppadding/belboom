@extends('master')

@section('title', 'Admins')

@section('form.title', 'Admin Toevoegen')
@section('form.submit', 'Toevoegen')

@section('content')
    @include('polymer.paper-input', ['icon' => 'communication:email', 'name' => 'email', 'label' => 'E-mail'])
@stop

@include('polymer.form', ['method' => 'post', 'url' => route('admin.store')])