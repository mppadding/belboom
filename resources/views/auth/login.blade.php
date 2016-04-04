@extends('navless')

@section('title', 'Inloggen')

@section('header')
    {!! HTML::style('css/form.css') !!}
    <style>
        .submit {
            margin: 0;
            margin-bottom: 10px;
        }
        .submitbutton {
            margin-right: 10px;
        }
        .pass_forgot {
            font-style: italic;
            font-size: 15px;
            color: #717171;
        }
        a {
            color: #717171;
            text-decoration: none;
        }
    </style>
@stop

@section('content')
    <!-- Login -->
    <?php
    /* Copyright (C) Matthijs Padding - All Rights Reserved
     * Unauthorized copying of this file, via any medium is strictly prohibited
     * Proprietary and confidential
     * Written by Matthijs Padding <mppadding@gmail.com>, May 2015
     */
    ?>
    
    <div class="wrapper">    
    	<div class="content">
    		<paper-shadow class="login" z="1">
    			<div class="title">Inloggen</div>
    			
    			<hr />
    			
    			<div class="input">
    			    {!! Form::open(['url' => url('/auth/login'), 'method' => 'post', 'class' => 'form', 'id'=> 'form']) !!}
    			    
    			        @include('polymer.paper-input', [
                            'icon' => 'communication:email',
                            'name' => 'email',
                            'label' => 'E-mail',
                            'value' => old('email')
                        ])
                        
                        @include('polymer.paper-input', [
                            'icon' => 'communication:vpn-key',
                            'name' => 'password',
                            'type' => 'password',
                            'label' => 'Wachtwoord'
                        ])
                        
                        @include('polymer.paper-checkbox', [
                            'name' => 'remember',
                            'label' => 'Ingelogd blijven'
                        ])
                        
                        <input type="submit" value="submit" style="display: none">
    			        
    			    {!! Form::close() !!}
    			</div>
    			
    			<div class="submit" horizontal layout>
    			    <div flex vertical layout>
    			        <div flex></div>
    			        <div class="pass_forgot">{!! HTML::link(url('/password/email'), 'Wachtwoord vergeten') !!}</div>
    			        <div flex></div>
    			    </div>
    				<div flex class="submitbutton">
    					<paper-button class="submit"
    								  onclick="document.getElementById('form').submit();"
    								  raised>Inloggen</paper-button>
    				</div>
    			</div>
    		</paper-shadow>
    	</div>
    </div>
@stop

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