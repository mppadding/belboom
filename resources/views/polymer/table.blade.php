{{-- 
    Copyright (C) Matthijs Padding - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Written by Matthijs Padding <mppadding@gmail.com>, April 2015
--}}

@section('header')
    @parent
    
    {!! HTML::style('css/table.css') !!}
@stop

@section('content')
    @parent
    
    @if(isset($desktop))
        <style>
            @media all and (max-width: 1920px) {
                .mobile {
                    display: none;
                }
                table {
                    text-align: left;
                }
                .desktop {
                    display: block;
                }
                td, th {
                	padding-left: 5%;
                }
            }
        </style>
        
        <div class="desktop">
            <paper-shadow z="1">
                <div class="table_title">
                    {{ $desktop['title'] }}
                </div>
                
                <hr />
                
                <div class="content">
                    <table>
                        <tr>
                            @foreach( $desktop['header'] as $val)
                                <th>{{ $val }}</th>
                            @endforeach
                        </tr>
                        @foreach( $desktop['content'] as $arrays )
                            <tr class="hover">
                                @foreach( $arrays as $key => $value )
                                    @if(!is_array($value))
                                        @if(is_integer($key))
                                            <?php
                                                $key = $value;
                                                $value = '';
                                            ?>
                                        @endif
                                        
                                        <td>
                                            @if($value !== '')
                                                {!! HTML::link($value, $key) !!}
                                            @else
                                                {{ $key }}
                                            @endif
                                        </td>
                                    @else
                                        @if(isset($value['type']))
                                            @if($value['type'] === 'a')
                                                <td>
                                                    <a id="{{ $value['id'] }}" href="{{ $value['url'] }}">{{ $key }}</a>
                                                </td>
                                            @endif
                                        @else
                                            <td>
                                                {!! Form::open(['url' => $value['url'],
                                                    'method' => $value['method'],
                                                    'id' => $value['method'] . '_' . $value['name']]) !!}
                                                    <input type="submit" style="display: none" value="{{ $value['method'] . '_' . $value['name'] }}">
                                                    <a href="javascript:document.getElementById('{{ $value['method'] . '_' . $value['name']}}').submit()">
                                                        {{ $key }}
                                                    </a>
                                                {!! Form::close() !!}
                                            </td>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            </paper-shadow>
        </div>
    @endif
    
    
    @if(isset($mobile))
        <style>
            @media all and (max-width: 360px) {
                table {
                    text-align: center;
                }
                .mobile {
                    display: block;
                    margin-top: 30px;
                }
                .desktop {
                    display: none;
                }
                td, th {
                	padding-left: 0;
                }
            }
        </style>
        
        <div class="mobile">
            <paper-shadow z="1">
                <div class="table_title">
                    {{ $mobile['title'] }}
                </div>
                
                <hr />
                
                <div class="content">
                    <table>
                        <tr>
                            @foreach( $mobile['header'] as $val )
                                <th>{{ $val }}</th>
                            @endforeach
                        </tr>
                        @foreach( $mobile['content'] as $arrays )
                            <tr class="hover">
                                @foreach( $arrays as $key => $value )
                                    @if(!is_array($value))
                                        @if(is_integer($key))
                                            <?php
                                                $key = $value;
                                                $value = '';
                                            ?>
                                        @endif
                                        
                                        <td>
                                            @if($value !== '')
                                                {!! HTML::link($value, $key) !!}
                                            @else
                                                {{ $key }}
                                            @endif
                                        </td>
                                    @else
                                        @if(isset($value['type']))
                                            @if($value['type'] === 'a')
                                                <a id="{{ $value['id'] }}" href="{{ $value['url'] }}">{{ $key }}</a>
                                            @endif
                                        @else
                                            <td>
                                                {!! Form::open(['url' => $value['url'],
                                                    'method' => $value['method'],
                                                    'id' => $value['method'] . '_' . $value['name']]) !!}
                                                    <input type="submit" style="display: none" value="{{ $value['method'] . '_' . $value['name'] }}">
                                                    <a href="javascript:document.getElementById('{{ $value['method'] . '_' . $value['name']}}').submit()">
                                                        {{ $key }}
                                                    </a>
                                                {!! Form::close() !!}
                                            </td>
                                        @endif
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
            </paper-shadow>
        </div>
    @endif
@stop