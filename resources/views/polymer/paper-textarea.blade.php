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
	        <paper-autogrow-textarea maxRows='{{ $maxRows or '' }}'
	                                 rows='{{ $rows or '' }}'>
	        	<textarea name="{{ $name }}"
	        			  value="{{ $value or '' }}"></textarea>
	        </paper-autogrow-textarea>
        </paper-input-decorator>
	</div>
</div>