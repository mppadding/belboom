<div style="margin-bottom: 10px">
	<core-selector class="selector" id="{{ $name }}_selector"
	               valueattr="{{ $valueattr or 'name' }}" {{ $type or '' }} >
	    
	    @foreach($items as $key => $val)
	    	<div {{ $valueattr or 'name' }}='{{ $key }}' class="item">{{ $val }}</div>
		@endforeach
		
	</core-selector>
</div>

<input type="hidden" name="{{ $name }}" id="{{ $name }}_hidden">
	   
<script>
	var selector = document.getElementById('{{ $name }}_selector');
	
	@if(isset($value))
	    var selection = {!! json_encode($value) !!};
		selector.selected = selection;
		var hidden = document.getElementById('{{ $name }}_hidden');
		hidden.value = selection;
	@endif

    selector.addEventListener('core-activate', function() {
        var hidden = document.getElementById('{{ $name }}_hidden');
        
        console.log(selector.selected);
        
        hidden.value = selector.selected;
    });
</script>