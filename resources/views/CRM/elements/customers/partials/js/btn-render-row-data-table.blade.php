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
            actionBtnDelete(apply_id);
            actionCom(apply_id);
            actionProfit(apply_id);
            actionrRefund(apply_id);

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
                var url = `${window.location.origin}/crm/customer/${apply_id}/edit?page=1`;
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

    function actionBtnDelete(apply_id)
    {
        $(document).on('click', '.delete-cus', () => {
            let action_url = `${window.location.origin}/crm/customer/${apply_id}`;
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: action_url,
                        type: 'post',
                        data: {
                            '_token': '{{csrf_token()}}',
                            '_method': 'delete',
                        },
                        success: function (data) {
                            $(`#data-customer_${apply_id}`).remove()
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success',
                            )
                        },
                    })
                }
            })
        })
    }

    function actionCom(apply_id)
    {
        $('.process-item-cus-com').attr('href', `${window.location.origin}/crm/customer/process/${apply_id}/3?tab_link=3`);
        $('.process-item-cus-com').fancybox({
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
    }

    function actionProfit(apply_id)
    {
        $('.process-item-cus-profit').attr('href', `${window.location.origin}/crm/customer/process/${apply_id}/4?tab_link=4`);
        $('.process-item-cus-profit').fancybox({
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
    }

    function actionrRefund(apply_id)
    {
        $('.process-item-cus-refund').attr('href', `${window.location.origin}/crm/customer/process/${apply_id}/5?tab_link=5`);
        $('.process-item-cus-refund').fancybox({
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
    }
</script>
