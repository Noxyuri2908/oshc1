<script>
    @if(!empty($ids))
        @foreach($ids as $id)
            $(document).on('mouseover', '#{{$id}}', function () {
                $(this).inputmask({alias: "currency", prefix: '', digits: {{ (!empty($currency) && "$currency" == 'VND') ? 0 : 2}} });
            })
        @endforeach
    @endif
</script>
