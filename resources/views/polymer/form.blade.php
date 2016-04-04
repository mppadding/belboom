@section('header')
    {!! HTML::style('css/form.css') !!}
@stop

@section('content')
    {{--
        Copyright (C) Matthijs Padding - All Rights Reserved
        Unauthorized copying of this file, via any medium is strictly prohibited
        Proprietary and confidential
        Written by Matthijs Padding <mppadding@gmail.com>, May 2015
    --}}
    
    <div class="wrapper">    
    	<div class="content">
    		<paper-shadow class="login" z="1">
    			<div class="title">@yield('form.title', 'Formulier')</div>
    			
    			<hr />
    			
    			<div class="input">
    			    {!! Form::open(['url' => $url, 'method' => $method, 'class' => 'form', 'id'=> 'form']) !!}
    			    
    			        @yield('content')
    			        
    			        <input type="submit" style="display: none" value="submit">
    			        
    			    {!! Form::close() !!}
    			</div>
    			
    			<div class="submit">
    				<div class="submitbutton">
        				    <paper-button class="submit"
        								  onclick="document.getElementById('form').submit();"
        								  raised>@yield('form.submit', 'Indienen')</paper-button>
    				</div>
    			</div>
    		</paper-shadow>
    	</div>
    </div>
@overwrite