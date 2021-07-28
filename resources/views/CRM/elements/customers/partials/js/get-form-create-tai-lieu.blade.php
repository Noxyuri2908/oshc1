<script>
    function getFormCreateTailieu(apply_id) {
        $.ajax({
            url: '{{route('ajax.getFormCreateTailieu')}}',
            data: {
                id: apply_id
            },
            type: 'get',
            success: function (data) {
                $('.div_modal_doc').html(data);
            },
            beforeSend: function () {
                $('.div_modal_doc').text('loading..');
            }
        })
    }
</script>
