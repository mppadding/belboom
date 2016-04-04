<?php
/* Copyright (C) Matthijs Padding - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 * Written by Matthijs Padding <mppadding@gmail.com>, May 2015
 */
    $pages = ['Oproep', 'Resultaten', 'Groepen', 'Functies', 'Contacten'];
   	$settings = [];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="mobile-web-app-capable" content="yes">
		
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>	
		<script src="/bower_components/webcomponentsjs/webcomponents.min.js"></script>
		
		@include('polymer/header')
        
        <title>Belboom</title>
        
		{!! HTML::style('css/master.css') !!}
		
		@yield('header')
		
	</head>							
	<body unresolved>
		<template is="auto-binding">
			<core-media-query query="max-width: 360px" queryMatches="@{{phone}}"></core-media-query>
			
			<template if="@{{phone}}">
				<core-drawer-panel responsiveWidth="50000px">
					<core-header-panel drawer>
					</core-header-panel>
					<core-header-panel main>
						<core-toolbar>
							<div>Belboom</div>
						</core-toolbar>
						<div>
							@yield('content', '')
							@yield('fab', '')
						</div>
					</core-header-panel>
				</core-drawer-panel>
			</template>
			
			<template if="@{{!phone}}">
				<div class="header">
					<paper-shadow class="titlebar" z="1">
						<div horizontal layout>
							<div flex></div>
							<div horizontal layout>
								Belboom
							</div>
							<div flex></div>
						</div>
					</paper-shadow>
				</div>
				<div>
					@yield('content', '')
					@yield('fab', '')
				</div>
			</template>
		</template>
		
		@if(Session::has('message'))
		    @include('polymer.paper-toast', ['message' => Session::get('message')])
		@endif
	</body>
</html>