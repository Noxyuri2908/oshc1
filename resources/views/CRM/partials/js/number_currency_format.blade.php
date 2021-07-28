<script>
    let active{{$nameFunction}} = true

    function {{$nameFunction}}() {
        if (active{{$nameFunction}}) {
            @if(!empty($ids))
            @foreach($ids as $id)
            $('#{{$id}}').inputmask({ alias: 'currency', prefix: '', digits: 2 })
            @endforeach
                @endif
                active{{$nameFunction}} = false
        }
    }

</script>
