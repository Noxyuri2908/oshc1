<script>
    $(document).on('click','.data-customer, .data-profit, .data-refund', function () {
        if($(this).attr('is-render') == 'false'){
            $('.data-commission td').css('background-color','');
            $('.data-customer td').css('background-color','');
            $('.data-profit td').css('background-color','');
            $('.data-refund td').css('background-color','');

            $('.data-commission').removeClass('selected_row');
            $('.data-customer').removeClass('selected_row');
            $('.data-profit').removeClass('selected_row');
            $('.data-refund').removeClass('selected_row');

            $('.data-commission').attr('is-render',false);
            $('.data-customer').attr('is-render',false);
            $('.data-profit').attr('is-render',false);
            $('.data-refund').attr('is-render',false);
            $(this).attr('is-render',true);
            $(this).children('td').css('background-color','#ccc');
            $(this).addClass('selected_row');
            $('.alert-modal-receipt').html('');
            var apply_id = $(this).attr('data-id');

            $('#btn-action').css('display', 'block');
            actionBtnEdit(apply_id);

            $('.remind-extend-invoice').attr('data-id',apply_id);
            $('.remind-invoice').attr('data-id',apply_id);
            $('.remind-email-invoice').attr('data-id',apply_id);
            getFormCreateTailieu(apply_id);
            $.ajax({
                url: '{{route('ajax.getReceipt')}}',
                data: {
                    apply_id: apply_id
                },
                type: 'get',
                success: function (data) {
                    $('.total-receipt-amount').text('Total amount :'+ convertNumberToCurrency(data.sum_amount_receipt));
                    $('.total-receipt-exchange-rate').text(convertNumberToCurrency(data.sum_exchange_rate_receipt));
                    $('.apply-receipt').html(data.view);
                    $('.total-apply').text(convertNumberToCurrency(data.total));
                },
                beforeSend: function () {
                    $('.apply-receipt').text('loading..');
                }
            });
            $.ajax({
                url: '{{route('ajax.createReceipt')}}',
                data: {
                    apply_id: apply_id
                },
                type: 'get',
                success: function (data) {
                    $('.show-receipt').html(data);
                    $('.create-receipt-customer').attr('data-id',apply_id);
                }
            });
            $.ajax({
                url: '{{route('ajax.showDocsAndRemindForm')}}',
                data: {
                    apply_id: apply_id
                },
                type: 'get',
                success: function (data) {
                    $('#div_table_doc_receipt').html(data.view);
                    $('#remind-form').html(data.remind_form);
                    $('.save-remind-form').attr('data-id',apply_id);
                    $('.remind-extend-invoice').attr('href',data.urlExtend);
                    $('#btn_add_doc').attr('data-id',apply_id);
                },
                beforeSend: function () {
                    $('#div_table_doc_receipt').text('loading..');
                }
            });
        }
    })

    function actionBtnEdit(apply_id)
    {
        $('#edit-cus').attr('href', `${window.location.href}/${apply_id}/edit?page=1`)
        $('#edit-cus').fancybox({
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
                var id = apply_id;
                var url = `${window.location.href}/${apply_id}/edit?page=1`;
                $.ajax({
                    url:url,
                    type:'get',
                    success:function (data){
                        $('#edit-cus_' + data.id).replaceWith(data.view);
                    }
                })
            }
        });
    }
</script>
