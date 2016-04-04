<paper-checkbox label="{{ $label }}" id="{{ $name }}"></paper-checkbox>
<input type="checkbox" name="{{ $name }}" style="display:none"></input>

<script>
    document.getElementById('{{ $name }}').addEventListener('core-change', function(e) {
        var remember = document.getElementsByName('{{ $name }}')[0];
        remember.checked = !remember.checked;
    });
</script>