<script>
    $(document).on('change', '#{{$id}}', function (e) {
        var value = $(this).find(":selected").attr('data-value');
        var arrValue;
        if (value) {
            arrValue = JSON.parse(value);
        } else {
            arrValue = [];
        }
        html = '';
        $.each(arrValue, function (index, value) {
            html += '<option value="' + parseInt(index+1) + '">' + value + '</option>';
        });
        $('#{{$subId}}').html(html);
    })
</script>
