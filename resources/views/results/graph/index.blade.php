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
            "title": "Resultaten {{ $date }} (reactieaantal: {!! $total !!})",
            "subtitle": "Onderweg links, aangekomen rechts"
        }'
        data='{{ route('resultaten.json.index', ['id' => $id]) }}'>
    </google-chart>
    
    <!-- {{ route('resultaten.json', ['id' => $id]) }} -->
    
    <script>
        // Get the chart from the document
        var ids = {!! json_encode($ids) !!};
        var chart = document.querySelector('google-chart');
        // Attach an event listener to the chart, see if a column is selected
        chart.addEventListener('google-chart-select', function(e) {
            // First check if the chart has non-arrived people (the detail chart is for non-arrived people)
            var row = e.detail.selection[0].row;
            
            if(chart.dataTable.getValue(row, 2) !== 0) {
                // Set the location to {id}/graph
                // e.g. 1/graph
                window.location.href = ids[chart.dataTable.getValue(row, 0)] + '/graph';
            }
        });
    </script>
@stop

@include('polymer.fab', ['icon' => 'view-list', 'url' => route('resultaten.table', ['id' => $id])])