{{-- 
    Copyright (C) Matthijs Padding - All Rights Reserved
    Unauthorized copying of this file, via any medium is strictly prohibited
    Proprietary and confidential
    Written by Matthijs Padding <mppadding@gmail.com>, April 2015
--}}

@section('fab')
    <paper-fab 
        class="fab"
        icon="{{ $icon }}" 
        onclick='window.location.href="{{ $url }}"'>
    </paper-fab>
@stop