<div class="input">
	<div class="icon">
	    @if( $icon )
		<core-icon
			icon="{{ $icon }}"
			class="input_icon"></core-icon>
		@endif
	</div>
	<div class="input">
		<paper-input-decorator class="custom" style="text-align: left;" 
							   floatingLabel label="{{ $label or '' }}">
		    <input name="{{ $name }}" type="{{ $type or 'text' }}"
		    	   placeholder="{{ $placeholder or '' }}"
		           value="{{ $value or '' }}"
				   is="core-input">
		</paper-input-decorator>
	</div>
</div>