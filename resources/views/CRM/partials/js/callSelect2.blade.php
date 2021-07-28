<script>
    var activeSelect2 = true
    function {{$nameFunction}}() {
        if (activeSelect2) {
            $('{{$selectElement}}').select2({
                dropdownParent: $("{{$selectElementParent}}")
            })
            activeSelect2 = false
        }
    }
</script>
