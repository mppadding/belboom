{{--
    Copyright (C) Matthijs Padding - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Written by Matthijs Padding <mppadding@gmail.com>, May 2015
--}}

@extends('master')

@section('header')
    {!! HTML::style('css/form.css') !!}
@stop

@section('mobile')
    <div class="wrapper">    
    	<div class="content">
    		<paper-shadow class="login" z="1">
    			<div class="title">Kleuren Bewerken</div>
    			
    			<hr />
    			
    			<div class="input">
    			    {!! Form::open(['url' => route('color.update'), 'method' => 'patch', 'class' => 'form', 'id'=> 'form']) !!}
    			    	<div class="input" horizontal layout style="text-align: left">
					    	<div vertical layout flex>
					    		<div horizontal layout>
					    			<div>Primair Donker:</div>
					    			<div flex></div>
					    			<div onclick="document.getElementsByName('color_dark_primary')[0].value='#0288D1'" style="cursor: pointer">Origineel</a></div>
				    			</div>
				    			<div horizontal layout>
					    			<input class="custom" name="color_dark_primary" type="color"
					    		           value="#{{ $colors['color_dark_primary'] }}"
					    				   is="core-input">
				    			</div>
				    			
				    			<div horizontal layout>
					    			<div>Primair:</div>
					    			<div flex></div>
									<div onclick="document.getElementsByName('color_primary')[0].value='#03A9F4'" style="cursor: pointer">Origineel</a></div>
				    			</div>
				    			<div horizontal layout>
					    			<input class="custom" name="color_primary" type="color"
					    		           value="#{{ $colors['color_primary'] }}"
					    				   is="core-input">
				    			</div>
				    			
				    			<div horizontal layout>
									<div>Primair Licht:</div>
					    			<div flex></div>
					    			<div onclick="document.getElementsByName('color_light_primary')[0].value='#B3E5FC'" style="cursor: pointer">Origineel</a></div>
				    			</div>
				    			<div horizontal layout>
					    			<input class="custom" name="color_light_primary" type="color"
					    		           value="#{{ $colors['color_light_primary'] }}"
					    				   is="core-input">
				    			</div>
				    			
				    			<div horizontal layout>
					    			<div>Iconen:</div>
					    			<div flex></div>
					    			<div onclick="document.getElementsByName('color_icons')[0].value='#FFFFFF'" style="cursor: pointer">Origineel</a></div>
				    			</div>
				    			<div horizontal layout>
					    			<input class="custom" name="color_icons" type="color"
					    		           value="#{{ $colors['color_icons'] }}"
					    				   is="core-input">
				    			</div>
				    			
				    			
				    			<div horizontal layout>
					    			<div>Accent:</div>
					    			<div flex></div>
					    			<div onclick="document.getElementsByName('color_accent')[0].value='#FFFFFF'" style="cursor: pointer">Origineel</a></div>
				    			</div>
				    			<div horizontal layout>
					    			<input class="custom" name="color_divider" type="color"
					    		           value="#{{ $colors['color_divider'] }}"
					    				   is="core-input">
				    			</div>
				    			
				    			<div horizontal layout>
					    			<div>Primair Tekst:</div>
					    			<div flex></div>
					    			<div onclick="document.getElementsByName('color_text_primary')[0].value='#FFFFFF'" style="cursor: pointer">Origineel</a></div>
				    			</div>
				    			<div horizontal layout>
					    			<input class="custom" name="color_text_primary" type="color"
					    		           value="#{{ $colors['color_text_primary'] }}"
					    				   is="core-input">
				    			</div>
				    			
				    			<div horizontal layout>
					    			<div>Secundair Tekst:</div>
					    			<div flex></div>
					    			<div onclick="document.getElementsByName('color_text_secondary')[0].value='#FFFFFF'" style="cursor: pointer">Origineel</a></div>
				    			</div>
				    			<div horizontal layout>
					    			<input class="custom" name="color_text_secondary" type="color"
					    		           value="#{{ $colors['color_text_secondary'] }}"
					    				   is="core-input">
				    			</div>
				    			
				    			<div horizontal layout>
					    			<div>Scheider:</div>
					    			<div flex></div>
					    			<div onclick="document.getElementsByName('color_divider')[0].value='#FFFFFF'" style="cursor: pointer">Origineel</a></div>
				    			</div>
				    			<div horizontal layout>
					    			<input class="custom" name="color_divider" type="color"
					    		           value="#{{ $colors['color_divider'] }}"
					    				   is="core-input">
				    			</div>
					    	</div>
					    	
					    </div>
    			    {!! Form::close() !!}
    			</div>
    			
    			<div class="submit">
    				<div class="submitbutton">
    					<paper-button class="submit"
    								  onclick="document.getElementById('form').submit();"
    								  raised>Bewerken</paper-button>
    				</div>
    			</div>
    		</paper-shadow>
    	</div>
    </div>
@stop

@section('desktop')
    <div class="wrapper">    
    	<div class="content">
    		<paper-shadow class="login" z="1">
    			<div class="title">Kleuren Bewerken</div>
    			
    			<hr />
    			
    			<div class="input">
    			    {!! Form::open(['url' => route('color.update'), 'method' => 'patch', 'class' => 'form', 'id'=> 'form']) !!}
    			    
    			        <div class="input" style="text-align: left">
    						<div class="input" style="text-align: left" horizontal layout>
						        <div>Primair Donker:</div>
						        <div flex></div>
						        <div>
					    		    <input class="custom" name="color_dark_primary" type="color"
					    		           value="#{{ $colors['color_dark_primary'] }}"
					    				   is="core-input">
						        </div>
						        <div onclick="document.getElementsByName('color_dark_primary')[0].value='#0288D1'" style="cursor: pointer">Origineel</a></div>
					    	</div>
					    	<div class="input" style="text-align: left" horizontal layout>
						        <div>Primair:</div>
						        <div flex></div>
						        <div>
					    		    <input class="custom" name="color_primary" type="color"
					    		           value="#{{ $colors['color_primary'] }}"
					    				   is="core-input">
						        </div>
						        <div onclick="document.getElementsByName('color_primary')[0].value='#03A9F4'" style="cursor: pointer">Origineel</a></div>
					    	</div>
					    	<div class="input" style="text-align: left" horizontal layout>
						        <div>Primair Licht:</div>
						        <div flex></div>
						        <div>
					    		    <input class="custom" name="color_light_primary" type="color"
					    		           value="#{{ $colors['color_light_primary'] }}"
					    				   is="core-input">
						        </div>
						        <div onclick="document.getElementsByName('color_light_primary')[0].value='#B3E5FC'" style="cursor: pointer">Origineel</a></div>
					    	</div>
					    	<div class="input" style="text-align: left" horizontal layout>
						        <div>Iconen:</div>
						        <div flex></div>
						        <div>
					    		    <input class="custom" name="color_icons" type="color"
					    		           value="#{{ $colors['color_icons'] }}"
					    				   is="core-input">
						        </div>
						        <div onclick="document.getElementsByName('color_icons')[0].value='#FFFFFF'" style="cursor: pointer">Origineel</a></div>
					    	</div>
					    	
					    	<div class="input" style="text-align: left" horizontal layout>
						        <div>Accent:</div>
						        <div flex></div>
						        <div>
					    		    <input class="custom" name="color_accent" type="color"
					    		           value="#{{ $colors['color_accent'] }}"
					    				   is="core-input">
						        </div>
						        <div onclick="document.getElementsByName('color_accent')[0].value='#FF5722'" style="cursor: pointer">Origineel</a></div>
					    	</div>
					    	<div class="input" style="text-align: left" horizontal layout>
						        <div>Primair Tekst:</div>
						        <div flex></div>
						        <div>
					    		    <input class="custom" name="color_text_primary" type="color"
					    		           value="#{{ $colors['color_text_primary'] }}"
					    				   is="core-input">
						        </div>
						        <div onclick="document.getElementsByName('color_text_primary')[0].value='#212121'" style="cursor: pointer">Origineel</a></div>
					    	</div>
					    	<div class="input" style="text-align: left" horizontal layout>
						        <div>Secundair Tekst:</div>
						        <div flex></div>
						        <div>
					    		    <input class="custom" name="color_text_secondary" type="color"
					    		           value="#{{ $colors['color_text_secondary'] }}"
					    				   is="core-input">
						        </div>
						        <div onclick="document.getElementsByName('color_text_secondary')[0].value='#727272'" style="cursor: pointer">Origineel</a></div>
					    	</div>
					    	<div class="input" style="text-align: left" horizontal layout>
						        <div>Scheider:</div>
						        <div flex></div>
						        <div>
					    		    <input class="custom" name="color_divider" type="color"
					    		           value="#{{ $colors['color_divider'] }}"
					    				   is="core-input">
						        </div>
						        <div onclick="document.getElementsByName('color_divider')[0].value='#B6B6B6'" style="cursor: pointer">Origineel</a></div>
					    	</div>
					    </div>
    			        
    			    {!! Form::close() !!}
    			</div>
    			
    			<div class="submit">
    				<div class="submitbutton">
    					<paper-button class="submit"
    								  onclick="document.getElementById('form').submit();"
    								  raised>Bewerken</paper-button>
    				</div>
    			</div>
    		</paper-shadow>
    	</div>
    </div>
@stop