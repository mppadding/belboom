@extends('master')

@section('header')
    @parent
    
    {!! HTML::style('css/color.css') !!}
@stop

@section('content')
    <div class="wrapper">    
    	<div class="content">
    		<paper-shadow style="margin-top: 50px; margin-left: 10%; width: 80%" z="1">
                <div style="height: 200px;" vertical layout>
                    <div flex horizontal layout>
                        <div flex class="dark_primary" vertical layout center-center>
                            <div>Primair Donker</div>
                        </div>
                        <div flex class="primary" vertical layout center-center>
                            <div>Primair</div>
                        </div>
                        <div flex class="light_primary" vertical layout center-center>
                            <div>Primair Licht</div>
                        </div>
                        <div flex class="icons" vertical layout center-center>
                            <div>Iconen</div>
                        </div>
                    </div>
                    
                    <div flex horizontal layout>
                        <div flex class="accent" vertical layout center-center>
                            <div>Accent</div>
                        </div>
                        <div flex class="text_primary" vertical layout center-center>
                            <div>Primair Tekst</div>
                        </div>
                        <div flex class="text_secondary" vertical layout center-center>
                            <div>Secundair Tekst</div>
                        </div>
                        <div flex class="divider" vertical layout center-center>
                            <div>Scheider</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 10px; margin-bottom: 10px; text-align: center">
                        <paper-button class="submit"
    								  onclick="document.location.href='{{ route('color.edit') }}';"
    								  raised>Bewerken</paper-button>    
                    </div>
                </div>
            </paper-shadow>
        </div>
    </div>
@stop