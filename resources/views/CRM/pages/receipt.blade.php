@extends('CRM.layouts.default')

@section('title')
Receipt
@parent
@stop

@section('css')
@include('CRM.partials.css-list')
@stop
@section('content')
@include('CRM.elements.table-receipt')
@stop
@push('scripts')
<script>
    function getExchangeRateEditReceipt(){
        var sum_amount = parseFloat($('#phieuthu_sum_amount').val()) || 0;
        var sum_bank_fee = parseFloat($('#phieuthu_sum_bank_fee').val()) || 0;
        var net_amount = parseFloat($('#apply_net_amount').val()) || 0;
        var new_amount = parseFloat(convertStringCurrencyToNumber($('#phieuthu_amount').val().toString())) || 0;
        var new_bank_fee = parseFloat(convertStringCurrencyToNumber(parseFloat($('#phieuthu_bank_fee').val()).toString())) || 0;
        var old_amount = parseFloat($('#old_phieuthu_amount').val()) || 0;
        var old_bank_fee = parseFloat($('#old_phieuthu_bank_fee').val()) || 0;
        var receipt_net_amount = parseFloat(convertStringCurrencyToNumber($('#receipt_net_amount').val().toString()))
        let receipt_total = parseFloat(convertStringCurrencyToNumber($('#receipt_total').val().toString())) || 0;
        // var exchange_rate = parseFloat((sum_amount + new_amount - old_amount) / (net_amount + sum_bank_fee + new_bank_fee - old_bank_fee)).toFixed(2);
        var exchange_rate = new_amount / (receipt_total+new_bank_fee);
        $('#phieuthu_exchange_rate').val(exchange_rate.toFixed(2));
    }
    $(document).on('click', '.edit-receipt-customer', function (e) {
        let _receipt_id = $(this).data('id');
        var apply_id = $(this).data('apply_id');
        $.ajax({
            url: '{{route('ajax.showReceipt')}}',
            data: {
                id: _receipt_id,
                apply_id: apply_id
            },
            type: 'get',
            success: function (data) {
                console.log(data);
                $('.show-receipt').html(data);
                getExchangeRateEditReceipt();
                $("input[name='button_action']").val('edit');
            }
        });
    })
    $(document).delegate("#phieuthu_amount, #phieuthu_bank_fee", "change", function () {
        var sum_amount = parseFloat($('#phieuthu_sum_amount').val()) || 0;
        var sum_bank_fee = parseFloat($('#phieuthu_sum_bank_fee').val()) || 0;
        var net_amount = parseFloat($('#apply_net_amount').val()) || 0;
        var new_amount = parseFloat(convertStringCurrencyToNumber($('#phieuthu_amount').val().toString())) || 0;
        var new_bank_fee = parseFloat(convertStringCurrencyToNumber(parseFloat($('#phieuthu_bank_fee').val()).toString())) || 0;
        var old_amount = parseFloat($('#old_phieuthu_amount').val()) || 0;
        var old_bank_fee = parseFloat($('#old_phieuthu_bank_fee').val()) || 0;
        var receipt_net_amount = parseFloat(convertStringCurrencyToNumber($('#receipt_net_amount').val().toString()))
        // var exchange_rate = parseFloat((sum_amount + new_amount - old_amount) / (net_amount + sum_bank_fee + new_bank_fee - old_bank_fee)).toFixed(2);
        var exchange_rate = new_amount / (receipt_net_amount+new_bank_fee);
        $('#phieuthu_exchange_rate').val(exchange_rate);
    });
    $(document).on('click', '.btn-receipt', function () {
        var _get_action = $('#form-set-action').val();
        if (_get_action == 'create') {
            createReceipt();
        } else if (_get_action == 'edit') {
            editReceipt()
        }
    });
    function editReceipt() {
        _html = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
        flag = true;
        /////////////////////////////////
        _payer = $('#phieuthu_payer').val();
        _type_payment = $('#type_payment').val();
        _address = $('#phieuthu_address').val();
        _account_bank = $('#phieuthu_account_bank :selected').val()
        _note = $('#phieuthu_note').val();
        _code = $('#phieuthu_code').val();
        _amount = $('#phieuthu_amount').val();
        _current_id = $('#phieuthu_current_id').val();
        _bank_fee = $('#phieuthu_bank_fee').val();
        _type = $('#phieuthu_type').val();
        _receipt_net_amount = $('#receipt_net_amount').val();
        _date_receipt = $('#date_receipt').val();
        // console.log(_type);
        if (_amount == null || _amount == '' || parseFloat(_amount) <= 0) {
            flag = false;
            _html += "Amount of money can not blank or smaller 0 . <br/>";
            $("#myModalReceipt").animate({scrollTop: 0}, "slow");
        }
        if (_receipt_net_amount == null || _receipt_net_amount == '' || parseFloat(_receipt_net_amount) <= 0) {
            flag = false;
            _html += "Net amount can not blank or smaller 0 . <br/>";
            $("#myModalReceipt").animate({scrollTop: 0}, "slow");
        }
        if (_bank_fee == null || _bank_fee == '' || parseFloat(_bank_fee) < 0) {
            flag = false;
            _html += "Bank fee can not blank or smaller 0 . <br/>";
            $("#myModalReceipt").animate({scrollTop: 0}, "slow");
        }

        if (_payer == null || _payer == '') {
            flag = false;
            _html += "Payer can not blank . <br/>";
            $("#myModalReceipt").animate({scrollTop: 0}, "slow");
        }

        if (_type_payment == 2) {
            if (_account_bank == null || _account_bank == '') {
                flag = false;
                _html += "Acount bank can not blank . <br/>";
                $("#myModalReceipt").animate({scrollTop: 0}, "slow");
            }
        }

        _html += "</div>";
        if (!flag) {
            $('#div_phieuthu_alert').html(_html);
        } else {
            $('#div_phieuthu_alert').html("");
            _id = $('#_id').val();
            _id_phieuthu = $('#id_phieuthu').val();
            $.ajax({
                url: '{{route('ajax.saveReceipt')}}',
                type: 'get',
                data: {
                    'id': _id,
                    'payer': _payer,
                    'address': _address,
                    'account_bank': _account_bank,
                    'note': _note,
                    'code': _code,
                    'current_id': _current_id,
                    'amount': _amount,
                    'bank_fee': _bank_fee,
                    'type': _type,
                    'type_payment': _type_payment,
                    'id_phieuthu': _id_phieuthu,
                    'receipt_net_amount':_receipt_net_amount,
                    'date_receipt':_date_receipt,
                    type:'receipt_all'
                },
                success: function (data) {
                    $('.apply-receipt').html(data);
                    $('#myModalReceipt').modal('toggle');
                }
            })
        }
    }
    $(document).on('click', '.delete-receipt-customer', function (e) {
        let _receipt_id = $(this).data('id');
        var apply_id = $(this).data('apply_id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{route('ajax.deleteReceipt')}}',
                    data: {
                        id: _receipt_id,
                        apply_id: apply_id,
                        type:'receipt_all'
                    },
                    type: 'get',
                    success: function (data) {
                        $('.apply-receipt').html(data);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                });

            }
        })
        return false;
    })
</script>
@endpush
