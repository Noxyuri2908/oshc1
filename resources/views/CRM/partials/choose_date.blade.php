<script>
@if(!empty($ids))
    @foreach($ids as $id)
        $(document).on('mouseover', '#{{$id}}', function () {
            let start_date_class = $(this).hasClass('flatpickr-input');
            if (!start_date_class) {
                $(this).flatpickr({
                    dateFormat: "d/m/Y",
                    allowInput:true
                });
            }
        })
    @endforeach
@endif
</script>
