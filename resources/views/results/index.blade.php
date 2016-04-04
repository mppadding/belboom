@extends('master')

@section('title', 'Resultaten')

@section('content')
    @include('polymer.table', [
        'desktop' => [
            'title' => 'Resultaten',
            'header' => ['Naam', 'Functie', 'Bericht', 'Aankomst', 'Verwijderen', 'Arriveren'],
            'content' => $content['desktop']
        ],
        'mobile' => [
            'title'     => 'Resultaten',
            'header'    => ['Functie'],
            'content'   => $content['mobile']
        ]
    ])
@stop

@section('content')
    <div horizontal layout>
        <div flex></div>
        <div>
            <paper-button class="submit"
                  style="margin-top:5px;margin-bottom:5px;"
						  onclick="window.location.href='{{ route('resultaten.calls') }}'"
						  raised>Vorige oproepen</paper-button>
		</div>
        <div flex></div>
    </div>
@append


@include('polymer.fab', ['icon' => 'av:equalizer', 'url' => route('resultaten.graph', ['id' => $last_id])])