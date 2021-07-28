<script>
    $(document).on('mouseover','.{{$element_class_btn_row_edit}}',function (e){
        e.preventDefault();
        var element = this;
        $(element).fancybox({
            'width': 1200,
            'height': 900,
            'type': 'iframe',
            'autoScale': false,
            'autoSize': false,
            helpers: {
                title: {
                    type: 'float'
                }
            },
            afterClose: function () {
                var id = $(element).attr('data-id');
                var url = $(element).attr('data-url_edit');
                $.ajax({
                    url:url,
                    type:'get',
                    success:function (data){
                        $('#{{$element_id_row_edit}}' + data.id).replaceWith(data.view);
                    }
                })
            }
        });
    })
</script>
