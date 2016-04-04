@extends('master')

@section('form.title', 'Oproep')
@section('form.submit', 'Oproep Versturen')

@section('header')
    {{-- Add some stuff to our header, but don't overwrite it! --}}
    @parent
    <style>
        .group_selector {
            text-align: left;
            padding: 4px 10px 4px 10px;
        }
        .link, a.select-all {
            color: #212121;
            text-decoration: none;
        }
        .link:hover {
            color: #ffffff;
            background: #FF5722;
            font-style: italic;
        }
        .link a {
            color: inherit;
            text-decoration: inherit;
        }
    </style>
    
    <script>
        {{-- Set the selected variable to all the contacts IDs ([1: 0, 2: 0, 4: 0]) --}}
        var selected = {!! json_encode($contacts) !!};
    </script>
    
    <script src="/js/call.js"></script>
@stop

@section('content')
    {{ $credits }}
    @include('polymer.paper-textarea', [
        'icon'  => 'speaker-notes',
        'name'  => 'message',
        'label' => 'Bericht',
        'type'  => 'multi'
    ])
    <div style="margin-bottom: 10px">
        @foreach($groups as $id => $group)
            <div class="item">
                <div class="link">
                    <a class="groups" href="javascript:toggle({{ $id }})">
                        <div class="group_selector" id="group_{{ $id }}">
                            {{ $group['name'] }}
                            <span style="float: right; font-style: normal !important">
                                <span id="group_number_{{ $id }}">0/{{ sizeof($group['contacts']) }}</span>
                                <span id="group_caret_{{ $id }}">&#9660;</span>
                            </span>
                        </div>
                    </a>
                </div>
                <div style="padding: 3px; margin-left: 15px; display: none" id="group_content_{{ $id }}">
                    <a href="javascript:selectOrDeselectAll({{ $id }})" class="select-all">
                        <div id="{{ $id }}_select-all" class="item select-all">Alles Selecteren</div>
                    </a>
                	<core-selector class="selector" id="{{ $id }}_selector"
                	               valueattr="contact_id" multi>
                	    
                	    @foreach($group['contacts'] as $contact)
                	    	<div contact_id='{{ $contact->id }}'group_id="{{ $id }}" class="item">&#9658; {{ $contact->name }}</div>
                		@endforeach
                		
                	</core-selector>
                </div>
            </div>
        @endforeach
        
        <input type="hidden" name="contacts" id="contacts">
    </div>
    <div style="text-align: left;padding: 4px 10px 4px 10px;">
        <span>Kost:</span>
        <div style="float: right">
            <span id="cost">0</span>
            <span id="cred">Credits</span>
        </div>
    </div>
@stop

@include('polymer.form', ['method' => 'post', 'url' => route('oproep.send')])