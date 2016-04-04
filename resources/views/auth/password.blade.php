@extends('navless')

@section('title', 'Password')

@section('form.title', 'Wachtwoord vergeten')
@section('form.submit', 'Versturen')

@section('content')
    @include('polymer.paper-input', [
        'icon'  => 'communication:email',
        'name'  => 'email',
        'label' => 'E-mail',
        'value' => old('email')
    ])
@stop

@include('polymer.form', ['method' => 'post', 'url' => url('/password/email')])
@include('polymer.fab', ['icon' => 'arrow-back', 'url' => url('/auth/login')])