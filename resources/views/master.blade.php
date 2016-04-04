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
        
        <title>Belboom | {{ $page }}</title>
        
		{!! HTML::style('css/master.css') !!}
		
		@yield('header')
		
	</head>							
	<body unresolved>
		<template is="auto-binding">
			<core-media-query query="max-width: 360px" queryMatches="@{{phone}}"></core-media-query>
			
			<template if="@{{phone}}">
				<core-drawer-panel responsiveWidth="50000px">
					<core-header-panel drawer>
						<core-toolbar>
							<div>Navigatie</div>
						</core-toolbar>
						<div>
							<core-menu>
							    @foreach ($pages as $p)
							    	<paper-item
							    		@if($p === $page)
							    			class="core-selected"
							    		@endif
							    		
							    		onclick="location.href='{!! URL::to( strtolower( $p ) ) !!}'">{{ $p }}</paper-item>
							    @endforeach

					        </core-menu>
						</div>
					</core-header-panel>
					<core-header-panel main>
						<core-toolbar>
							<paper-icon-button icon="menu" core-drawer-toggle></paper-icon-button>
							<div>Belboom</div>
							<div flex></div>
							
							<paper-icon-button icon="image:color-lens" onclick="document.location.href='{!! route('color.index') !!}'"></paper-icon-button>
							<paper-icon-button icon="communication:vpn-key" onclick="location.href='{!! route('admin.index') !!}'"></paper-icon-button>
							<paper-icon-button icon="exit-to-app" onclick="location.href='{!! url('auth/logout') !!}'" ></paper-icon-button>
						</core-toolbar>
						<div>
							@yield('content', '')
							@yield('mobile', '')
						</div>
					</core-header-panel>
				</core-drawer-panel>
			</template>
			
			<template if="@{{!phone}}">
				<div class="header">
					<paper-shadow class="titlebar" z="1">
						<div horizontal layout>
							<div flex>
								<div vertical layout style="font-size:15px;padding:4px">
									{{ $auth->company->name }}
									@if($auth->developer or Session::has('developer'))
										<br />{{ $auth->name }}
									@endif
								</div>
							</div>
							
							<div horizontal layout>
								Belboom
							</div>
							
							<div flex>
								<div horizontal layout>
									<div flex></div>
									<div vertical layout>
										<div flex></div>
										<div horizontal layout>
											<paper-icon-button icon="image:color-lens" onclick="document.location.href='{!! route('color.index') !!}'"></paper-icon-button>
											<paper-icon-button icon="communication:vpn-key" onclick="document.location.href='{!! route('admin.index') !!}'"></paper-icon-button>
											<paper-icon-button icon="exit-to-app" onclick="document.location.href='{!! url('auth/logout') !!}'"></paper-icon-button>
										</div>
										<div flex></div>
									</div>
								</div>
							</div>
						</div>
						<div class="menu">
							<paper-tabs selected="{!! array_search($page, $pages) !!}" link>
								<paper-tab><a href="{!! URL::to('oproep') !!}" horizontal center-center layout>OPROEP</a></paper-tab>
				                <paper-tab><a href="{!! URL::to('resultaten') !!}" horizontal center-center layout>RESULTATEN</a></paper-tab>
				                <paper-tab><a href="{!! URL::to('groepen') !!}" horizontal center-center layout>GROEPEN</a></paper-tab>
				             	<paper-tab><a href="{!! URL::to('functies') !!}" horizontal center-center layout>FUNCTIES</a></paper-tab>
				              	<paper-tab><a href="{!! URL::to('contacten') !!}" horizontal center-center layout>CONTACTEN</a></paper-tab>
				            </paper-tabs>
						</div>
					</paper-shadow>
				</div>
				<div>
					@yield('content', '')
					@yield('desktop', '')
				</div>
			</template>
			
			@yield('fab', '')
			
			@if(Session::has('message'))
			    @include('polymer.paper-toast', ['message' => Session::get('message')])
			@endif
		</template>
	</body>
</html>