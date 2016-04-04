@extends('navless')

@section('title', 'Wachtwoord wijzigen')

@section('form.title', 'Wachtwoord wijzigen')
@section('form.submit', 'Wijzigen')

@section('content')
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="token" value="{{ $token }}">
    @include('polymer.paper-input', [
        'icon'  => 'communication:email',
        'name'  => 'email',
        'label' => 'E-mail',
        'value' => old('email')
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

@include('polymer.form', ['method' => 'post', 'url' => url('/password/reset')])

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