<script>
    @foreach($classElements as $class)
    @if(!empty($class))
    $(document).on('mouseover', '.{{$class}}', function (e) {
        e.preventDefault()
        var element = this
        $(element).fancybox({
            'width': '90%',
            'height': 900,
            'type': 'iframe',
            'autoScale': false,
            'autoSize': false,
            helpers: {
                title: {
                    type: 'float',
                },
            },
        })
    })
    @endif
    @endforeach
</script>
