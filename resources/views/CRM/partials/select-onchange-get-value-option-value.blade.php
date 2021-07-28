<script>
    $(document).on('change', '#{{$id}}', function (e) {
        var value = $(this).find(":selected").attr('data-value');
        var arrValue;
        if (value) {
            arrValue = JSON.parse(value);
        } else {
            arrValue = [];
        }
        html = '<option value=""></option>';
        $.each(arrValue, function (index, value) {
            html += '<option value="' + value + '">' + value + '</option>';
        });
        $('#{{$subId}}').html(html);
    })
</script>
