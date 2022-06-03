<script>
    $(document).ready(function() {
        @foreach($ids as $id)
        $("#{{$id}}").fancybox({
            'width': 900,
            'height': 900,
            'type': 'iframe',
            'autoScale': false,
            'autoSize': false,
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });
        @endforeach
    });
</script>
