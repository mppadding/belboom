@extends('navless')

@section('title', 'Registreren')

@section('form.title', 'Registreren')
@section('form.submit', 'Registreren')

@section('content')
    {!! Form::hidden('token', $token) !!}
    @include('polymer.paper-input', [
        'icon'  => 'social:person',
        'name'  => 'name',
        'label' => 'Naam',
        'value' => old('name')
    ])
    
    @include('polymer.paper-input', [
        'icon'  => 'communication:email',
        'name'  => 'email',
        'label' => 'E-mail',
        'value' => $email
    ])
    
    @include('polymer.paper-input', [
        'icon'  => 'communication:vpn-key',
        'name'  => 'password',
        'type'  => 'password',
        'label' => 'Wachtwoord',
        'value' => old('password')
    ])
    
    @include('polymer.paper-input', [
        'icon'  => 'communication:vpn-key',
        'name'  => 'password_confirmation',
        'type'  => 'password',
        'label' => 'Wachtwoord Bevestigen',
        'value' => old('password_confirmation')
    ])
@stop

@include('polymer.form', ['method' => 'post', 'url' => url('/auth/register')])

@if (count($errors) > 0)
    <?php
        $error = '';
        foreach( $errors->all() as $e )
        {
            $error .= $e . ' ';
        }
    ?>
    @include('polymer.paper-toast', ['message' => $error])
@endif

@include('polymer.fab', ['icon' => 'arrow-back', 'url' => url('/auth/login')])