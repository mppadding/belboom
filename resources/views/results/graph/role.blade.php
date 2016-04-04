@extends('master')

@section('title', 'Resultaten')

@section('content')
    <?php
    /* Copyright (C) Matthijs Padding - All Rights Reserved
     * Unauthorized copying of this file, via any medium is strictly prohibited
     * Proprietary and confidential
     * Written by Matthijs Padding <mppadding@gmail.com>, May 2015
     */
     
    ?>
    
    <style>
        google-chart {
            height: 70vh;
            margin-left: 12.5%;
            margin-right: 12.5%;
            margin-top: 40px;
            width: 75%;
        }
        @media all and (max-width: 360px) {
            google-chart {
                width: initial;
            }
        }
    </style>
    
    <google-chart
        id='chart'
        type='column'
        options = '{
            "title": "Resultaten",
            "subtitle": "Onderweg links, aangekomen rechts"
        }'
        data='{{ route('resultaten.json', ['id' => $id]) }}'>
    </google-chart>
@stop

@include('polymer.fab', ['icon' => 'arrow-back', 'url' => route('resultaten.index')])