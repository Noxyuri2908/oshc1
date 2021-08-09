<script>
    var getParams = function (url) {
        var params = {}
        var parser = document.createElement('a')
        parser.href = url
        var query = parser.search.substring(1)
        var vars = query.split('&')
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split('=')
            params[pair[0]] = decodeURIComponent(pair[1])
        }
        return params
    }

    var param_url = getParams(window.location.href)
    let page = param_url.page

    var ajax_url = $('#ajax_crm_url').val()

    var changeInvoiceStatus = "{{route('crm.changeInvoiceStatus')}}"
    var getCus = "{{route('customer.getCus')}}"
        {{--var getAgentInfo = "{{route('crm.getAgentInfo')}}";--}}
    var getInvoice = "{{route('customer.getInvoice')}}"
    var getBtnReceipt = "{{route('crm.getBtnReceipt')}}"
    var saveReceipt = "{{route('ajax.saveReceipt')}}"
    var editReceipt = "{{route('ajax.editReceipt')}}"

    var getBtnHH = "{{route('crm.getBtnHH')}}"
    var saveHH = "{{route('ajax.saveHH')}}"
    var editHH = "{{route('ajax.editHH')}}"

    var getBtnProfit = "{{route('crm.getBtnProfit')}}"
    var saveProfit = "{{route('ajax.saveProfit')}}"
    var editProfit = "{{route('ajax.editProfit')}}"

    var getBtnRefund = "{{route('crm.getBtnRefund')}}"
    var saveRefund = "{{route('ajax.saveRefund')}}"
    var editRefund = "{{route('ajax.saveRefund')}}"

    function setDataTask(data) {
        $('#task_name').val(data['task'])
        $('#task_type').val(data['task_type'])
        $('#leader').val(data['leader'])
        $('#process_by').val(data['process_by'])
        var values = data['person_in_charge']
        $('#person_in_charge').val(values.split(';')).trigger('change')
        $('#level').val(data['level'])
        $('#service').val(data['service'])
        $('#type_service').html(data['opt'])
        $('#from_date').val(data['from_date'])
        $('#to_date').val(data['to_date'])
        $('#processing').val(data['processing'])
        $('#status').val(data['status'])
        $('#content').html(data['content'])
        $('#agent_id').val(data['agent_id'])
        $('#content').html(data['content'])
        $('#task_id').val(data['id'])
        $('.btn-delete-task').css('display', 'block')
        $('#page_id').val(2)
    }

    function resetDataTask() {
        $('#task_name').val('')
        $('#task_type').val('')
        $('#leader').val('')
        $('#process_by').val('')
        var values = ';'
        $.each(values.split(';'), function (i, e) {
            $('#person_in_charge option[value=\'' + e + '\']').prop('selected', true)
        })
        $('#level').val('')
        $('#from_date').val('')
        $('#to_date').val('')
        $('#processing').val('')
        $('#status').val('')
        $('#content').val('')
        $('#task_id').html('')
        $('#agent_id').val()
        $('#service').val('')
        $('#type_service').html('')
        $('.btn-delete-task').css('display', 'none')
        $('#page_id').val(2)
    }

    function refundAmountVND() {
        _amount = parseFloat(convertStringCurrencyToNumber($('#refund_provider_amount').val())) || 0
        _exchange_rate = parseFloat(convertStringCurrencyToNumber($('#refund_provider_exchange_rate').val())) || 0
        _amount_VND = parseFloat(_amount * _exchange_rate)
        $('#refund_provider_amount_VND').val(_amount_VND)
    }

    function loadRefund() {
        refundAmountVND();
        loadBalance();
        loadProfit$();
        loadProfitVND();
        loadTotalAmount$();
        loadAmountVND();
    }

    function loadBalance(){
        var refund_provider_exchange_rate = parseFloat(convertStringCurrencyToNumber($('#refund_provider_exchange_rate').val()))
        var std_exchange_rate = parseFloat(convertStringCurrencyToNumber($('#std_exchange_rate').val()))
        var std_amount = parseFloat(convertStringCurrencyToNumber($('#std_amount').val()))
        var balance = (refund_provider_exchange_rate - std_exchange_rate) * std_amount;
        $('#balance_refund').val(balance);
    }

    function loadProfit$(){
        var commission_refund = parseFloat(convertStringCurrencyToNumber($('#commission_refund').val()))
        var refund_amount_com_agent_gbcfa = parseFloat(convertStringCurrencyToNumber($('#refund_amount_com_agent_gbcfa').val()))
        var profit = (commission_refund - refund_amount_com_agent_gbcfa) * (-1);
        $('#refund_profit_2').val(profit);
    }

    function loadProfitVND(){
        var refund_profit_2 = parseFloat(convertStringCurrencyToNumber($('#refund_profit_2').val()))
        var refund_exchange_rate_agent = parseFloat(convertStringCurrencyToNumber($('#refund_exchange_rate_agent').val()))
        var extra_fee_refund = parseFloat(convertStringCurrencyToNumber($('#extra_fee_refund').val()))
        var std_exchange_rate = parseFloat(convertStringCurrencyToNumber($('#std_exchange_rate').val()))
        var balance_refund = parseFloat(convertStringCurrencyToNumber($('#balance_refund').val()))
        var profitVND = (refund_profit_2 * refund_exchange_rate_agent) + (extra_fee_refund * std_exchange_rate) + balance_refund;

        $('#refund_profit_2_VN').val(profitVND);

    }

    function loadTotalAmount$(){
        var std_amount = parseFloat(convertStringCurrencyToNumber($('#std_amount').val()))
        var std_deduction = parseFloat(convertStringCurrencyToNumber($('#std_deduction').val()))
        var bank_fee_refund = parseFloat(convertStringCurrencyToNumber($('#bank_fee_refund').val()))
        var totalAmount = std_amount - std_deduction - bank_fee_refund;

        $('#total_amount_pay_back_student_refund').val(totalAmount);
    }

    function loadAmountVND(){
        var total_amount_pay_back_student_refund = parseFloat(convertStringCurrencyToNumber($('#total_amount_pay_back_student_refund').val()))
        var std_exchange_rate = parseFloat(convertStringCurrencyToNumber($('#std_exchange_rate').val()))
        var amountVND = total_amount_pay_back_student_refund * std_exchange_rate;

        $('#std_refund_VND').val(amountVND);
    }

    function getNumber(str) {
        if (str != null && str != '') {
            var res = str.split(' ')
            if (res.length > 0) {
                number = res[0].replace(',', '')
                return parseFloat(number)
            } else {
                return 0
            }
        } else {
            return 0
        }

    }

    function calExchangeRate() {
        _amount_of_money = $('#amount').val() != '' ? parseFloat($('#amount').val()) : 0
        _net_amout = $('#net_amount').val() != '' ? parseFloat($('#net_amount').val()) : 0
        _bank_fee = $('#bank_fee').val() != '' ? parseFloat($('#bank_fee').val()) : 0
        if (_net_amout + _bank_fee > 0) {
            $('#exchange_rate').val((_amount_of_money / (_net_amout + _bank_fee)).toFixed(2))
        } else {
            $('#exchange_rate').val('')
        }
    }

    function calReAmountVN() {
        _tmp = getNumber($('#re_total_amount').val())
        _net_amount = parseFloat(_tmp)
        _exchange_rate = parseFloat(convertStringCurrencyToNumber($('#exchange_rate_re_provider').val()))
        _total_VN = _net_amount * _exchange_rate
        $('#re_total_amount_vn').val(convertNumberToCurrency(parseInt(_total_VN)))
    }

    function loadPayProvider() {
        _paid = parseFloat($('#pay_provider_paid').val());
        _bank_fee = parseFloat($('#pay_provider_bank_fee').val())
        _net_amount = convertStringCurrencyToNumber($('#gross-amount').val());
        _exchange_rate = parseFloat(convertStringCurrencyToNumber($('#pay_provider_exchange_rate').val())) || 0
        _total_VN_receipt = parseFloat(getNumber($('#re_total_amount_vn').val()))
        _currency = "{{$obj->provider != null ? $obj->provider->currency() : ''}}"
        _payment_note = $('#_payment_note').val()
        _total_amount_annalink_received = convertStringCurrencyToNumber($('#total-amount-annalink-received').val())
        _amount = _net_amount * (_paid / 100);

        _total_amount = _amount + (_amount * _bank_fee / 100)
        _total_amount_VN = _total_amount * _exchange_rate
        _balancer_1 = parseInt(_total_amount_annalink_received) - parseInt(_total_amount_VN)
        $('#pay_provider_amount').val(parseFloat(_amount))
        $('#pay_provider_total_VN').val(parseInt(_total_amount_VN))
        $('#pay_provider_total_amount').val(parseFloat(_total_amount).toFixed(2))

        $('#pay_provider_balancer_1').val(convertNumberToCurrency(parseInt(_balancer_1)))
        if (_payment_note != 1) {
            _comm = 100 - _paid
            _exchange_rate_re = parseFloat(convertStringCurrencyToNumber($('#exchange_rate_re_provider').val()))
            // $('#comm_re').val(_comm + '%')
            $('#re_total_amount').val(convertNumberToCurrency(_net_amount * _comm / 100))
            $('#re_total_amount_vn')
                .val(convertNumberToCurrency(parseInt(_net_amount * _comm * _exchange_rate_re / 100)))
        }
    }

    function loadPayAgent() {

        _comm = parseFloat({{$obj->getCom() != null ? $obj->getCom()->comm : 0}})
        _gst = $('#gst_status_agent_profit').val()
        // _gst = {{$obj->agent != null ? ($obj->agent->gst == 1 ? 1 : 0) : 0}};
        _comm = _comm / 100
        _bonus = parseFloat($('#pay_agent_bonus').val()) / 100 || 0
        _deducation = parseFloat($('#pay_agent_deduction').val())
        _exchange_rate = parseFloat(convertStringCurrencyToNumber($('#pay_agent_exchange_rate').val())) || 0
        _currency = "{{$obj->provider != null ? $obj->provider->currency() : ''}}"
        // _net_amout = parseFloat({{floatval($obj->net_amount) - floatval($obj->promotion_amount) - floatval($obj->extra)}})*(_comm + _bonus);

        _net_amout = parseFloat({{floatval($obj->net_amount)}}) * (_comm + _bonus)
        if (_gst == 2) {
            _net_amout = _net_amout / 1.1
        }
        // _amount = _net_amout - (_deducation*_exchange_rate);
        _amount = _net_amout * _exchange_rate
        let totalAmount = $('#pay_agent_total_amount').val() || 0
        let exchangeRate = $('#pay_agent_exchange_rate').val() || 0
        let amountTotalVND = parseFloat(convertStringCurrencyToNumber(totalAmount)) * parseFloat(convertStringCurrencyToNumber(exchangeRate))
        $('#pay_agent_amount_VN').val(parseInt(amountTotalVND).toFixed(0))

        // $('#pay_agent_amount_comm').val(parseFloat(_net_amout).toFixed(2) + " " + _currency);
        //$('#pay_agent_amount_comm').val(parseFloat(_net_amout).toFixed(2));

        $('#pay_agent_amount_VN').val(convertNumberToCurrency(parseInt(_amount).toFixed(2)))
    }

    function loadPayProfit() {
        _net_amount_annalink_receipt = parseFloat({{floatval($obj->net_amount)}})
        _net_amout = parseFloat(getNumber($('#re_total_amount').val()))
        _discount_annalink_receipt = parseFloat(convertStringCurrencyToNumber($('#discount_annalink_receipt').val()));
        _total_amount_com = parseFloat(convertStringCurrencyToNumber($('#pay_agent_total_amount').val()));
        _promotion_annalink_receipt = parseFloat(convertStringCurrencyToNumber($('#promotion_annalink_receipt').val()));
        _pay_provider = parseFloat(getNumber($('#pay_provider_total_amount').val()))
        _pay_agent = parseFloat(getNumber($('#pay_agent_amount_comm').val()))
        _exchange_fee = parseFloat(convertStringCurrencyToNumber($('#profit_extra_money').val())) || 0
        _exchange_rate = parseFloat(convertStringCurrencyToNumber($('#profit_exchange_rate').val())) || 0
        _currency_receipt = $('#profit1_currency_receipt').val();
        _profit = _net_amout - _total_amount_com - _discount_annalink_receipt - _promotion_annalink_receipt;
        $('#profit_money').val(parseFloat(_profit).toFixed(2))
        // $('#profit_money').val(parseFloat(_profit).toFixed(2) + " " + _currency);
    }

    function postReceipt() {
        _html = '<div class=\'alert alert-danger alert-dismissible fade show\' role=\'alert\'>'
        flag = true
        /////////////////////////////////
        _payer = $('#phieuthu_payer').val()
        _type_payment = $('#type_payment').val()
        _address = $('#phieuthu_address').val()
        _account_bank = $('#phieuthu_account_bank :selected').val()
        _note = $('#phieuthu_note').val()
        _code = $('#phieuthu_code').val()
        _amount = $('#phieuthu_amount').val()
        _current_id = $('#phieuthu_current_id').val()
        _bank_fee = $('#phieuthu_bank_fee').val()
        _type = $('#phieuthu_type').val()
        _phieuthu_net_amount = $('#receipt_net_amount').val()
        _date_receipt = $('#date-receipt').val()

        if (_amount == null || _amount == '') {
            flag = false
            _html += 'Amount of money can not blank or equal 0 . <br/>'
        }

        if (_phieuthu_net_amount == null || _phieuthu_net_amount == '' || parseFloat(_phieuthu_net_amount) == 0) {
            flag = false
            _html += 'Net amount can not blank or equal 0 . <br/>'
        }

        if (_bank_fee == null || _bank_fee == '' || parseFloat(_bank_fee) == 0) {
            flag = false
            _html += 'Bank fee can not blank or equal 0 . <br/>'
        }

        if (_payer == null || _payer == '') {
            flag = false
            _html += 'Payer can not blank . <br/>'
        }

        if (_type_payment == 2) {
            if (_account_bank == null || _account_bank == '') {
                flag = false
                _html += 'Acount bank can not blank . <br/>'
            }
        }

        _html += '</div>'

        if (!flag) {
            $('#div_phieuthu_alert').html(_html)
        } else {
            $('#div_phieuthu_alert').html('')
            _id = $('#_id').val()
            _id_phieuthu = $('#id_phieuthu').val()
            $.get(saveReceipt, {
                date_receipt: _date_receipt,
                receipt_net_amount: _phieuthu_net_amount,
                id: _id,
                id_phieuthu: _id_phieuthu,
                payer: _payer,
                type_payment: _type_payment,
                address: _address,
                account_bank: _account_bank,
                note: _note,
                code: _code,
                amount: _amount,
                current_id: _current_id,
                bank_fee: _bank_fee,
                type: _type,
            }, function (data) {
                window.location.href = '{{config('admin.ajax_crm_url')}}customer/process/' + _id + '/2?tab_link=2'
                $('#div_table_receipt').html(data)
                $.get(getBtnReceipt, { type: 1, id: _id }, function (data2) {
                    $('#div_btn_receipt').html(data2)
                })
            })
        }
    }

    function postHH() {
        _html = '<div class=\'alert alert-danger alert-dismissible fade show\' role=\'alert\'>'
        flag = true
        /////////////////////////////////
        _visa_status = $('#visa_status').val()
        _hoahong_month = $('#hoahong_month').val()
        _hoahong_year = $('#hoahong_year').val()
        _date_payment_provider = $('#date_payment_provider').val()
        _account_bank = $('#account_bank_hh').val()
        _note = $('#note').val()
        _date_payment_agent = $('#date_payment_agent').val()
        _policy_no = $('#policy_no').val()
        _issue_date = $('#issue_date').val()
        _policy_status = $('#policy_status').val()
        _payment_note_provider = $('#payment_note_provider').val()
        _extra_money = $('#extra_money').val()
        _unit_money = $('#unit_money').val()
        _extra_time = $('#extra_time').val()
        _com_payment_method = $('#com_payment_method').val()

        if (_policy_no == null || _policy_no == '') {
            flag = false
            _html += 'Policy number can not blank . <br/>'
        }

        if (_account_bank == null || _account_bank == '') {
            flag = false
            _html += 'Acount bank can not blank . <br/>'
        }

        _html += '</div>'
        if (!flag) {
            $('#div_hh_alert').html(_html)
        } else {
            $('#div_hh_alert').html('')
            _id = $('#_id').val()
            _id_hh = $('#id_hh').val()
            $.post(saveHH, {
                com_payment_method: _com_payment_method,
                page: page,
                id: _id,
                id_hh: _id_hh,
                visa_status: _visa_status,
                hoahong_month: _hoahong_month,
                hoahong_year: _hoahong_year,
                date_payment_provider: _date_payment_provider,
                account_bank: _account_bank,
                note: _note,
                date_payment_agent: _date_payment_agent,
                policy_no: _policy_no,
                issue_date: _issue_date,
                policy_status: _policy_status,
                payment_note_provider: _payment_note_provider,
                extra_money: _extra_money,
                unit_money: _unit_money,
                extra_time: _extra_time,
                _token: "{{csrf_token()}}",
            }, function (data) {
                //console.log(data);
                window.location.href = data
            })
        }
    }

    function postProfit() {
        _html = '<div class=\'alert alert-danger alert-dismissible fade show\' role=\'alert\'>'
        flag = true
        /////////////////////////////////
        exchange_rate_re_provider = convertStringCurrencyToNumber($('#exchange_rate_re_provider').val())
        date_of_receipt = $('#date_of_receipt').val()
        note_of_receipt = $('#note_of_receipt').val()
        pay_provider_exchange_rate = convertStringCurrencyToNumber($('#pay_provider_exchange_rate').val())
        pay_provider_paid = $('#pay_provider_paid').val() || 0
        pay_provider_date = $('#pay_provider_date').val()
        pay_provider_bank_account = $('#pay_provider_bank_account').val()
        pay_provider_bank_fee = $('#pay_provider_bank_fee').val()
        pay_agent_bonus = $('#pay_agent_bonus').val() || 0
        pay_agent_deduction = $('#pay_agent_deduction').val()
        pay_agent_exchange_rate = convertStringCurrencyToNumber($('#pay_agent_exchange_rate').val()) || 0
        pay_agent_date = $('#pay_agent_date').val()
        note_cp = $('#note_cp').val()
        profit_extra_money = convertStringCurrencyToNumber($('#profit_extra_money').val())
        profit_exchange_rate = convertStringCurrencyToNumber($('#profit_exchange_rate').val())

        profit_status = $('#profit_status').val()
        comm_status = $('#comm_status').val()
        visa_status = $('#visa_status_profit').val()
        visa_month = $('#visa_month').val()
        visa_year = $('#visa_year').val()
        pay_provider_amount = $('#pay_provider_amount').val()
        pay_provider_total_amount = $('#pay_provider_total_amount').val()
        pay_provider_total_VN = $('#pay_provider_total_VN').val()
        pay_provider_balancer_1 = $('#pay_provider_balancer_1').val()
        profit_payment_note_provider = $('#profit_payment_note_provider').val()
        profit_money = $('#profit_money').val()
        profit_money_VND = $('#profit_money_VND').val()
        comm_re = $('#comm_re').val()
        re_total_amount = $('#re_total_amount').val()
        re_total_amount_vn = $('#re_total_amount_vn').val()
        comm_rate_agent_profit = $('#comm_rate_agent_profit').val()
        pay_agent_amount_comm = $('#pay_agent_amount_comm').val()
        pay_agent_amount_VN = $('#pay_agent_amount_VN').val()
        gst_status_agent_profit = $('#gst_status_agent_profit').val()
        issue_date_com_agent_profit = $('#issue_date_com_agent_profit').val()
        pay_agent_extra = $('#pay_agent_extra').val()
        difference = $('#difference-annalink-received').val()
        vnd = $('#vnd').val()
        console.log(vnd)

        if (!flag) {
            $('#div_profit_alert').html(_html)
        } else {
            $('#div_profit_alert').html('')
            id = $('#_id').val()
            id_profit = $('#id_profit').val()
            // saveProfit
            $.get('{{route('ajax.saveProfit')}}', {
                page,
                id,
                id_profit,
                exchange_rate_re_provider,
                date_of_receipt,
                note_of_receipt,
                pay_provider_exchange_rate,
                pay_provider_paid,
                pay_provider_date,
                pay_provider_bank_account,
                pay_provider_bank_fee,
                pay_agent_bonus,
                pay_agent_deduction,
                pay_agent_exchange_rate,
                pay_agent_date,
                note_cp,
                profit_extra_money,
                profit_exchange_rate,
                profit_status,
                comm_status,
                visa_status,
                visa_month,
                visa_year,
                pay_provider_amount,
                pay_provider_total_amount,
                pay_provider_total_VN,
                pay_provider_balancer_1,
                profit_payment_note_provider,
                profit_money,
                profit_money_VND,
                comm_re,
                re_total_amount,
                re_total_amount_vn,
                comm_rate_agent_profit,
                pay_agent_amount_comm,
                pay_agent_amount_VN,
                gst_status_agent_profit,
                issue_date_com_agent_profit,
                pay_agent_extra,
                difference,
                vnd
            }, function (data) {
                window.location.reload()
            })
        }
    }

    function postRefund() {
        _html = '<div class=\'alert alert-danger alert-dismissible fade show\' role=\'alert\'>'
        flag = true
        /////////////////////////////////
        _refund_provider_amount = convertStringCurrencyToNumber($('#refund_provider_amount').val()) || 0
        _request_date = $('#request_date').val()
        _refund_provider_date = $('#refund_provider_date').val()
        _std_deduction = convertStringCurrencyToNumber($('#std_deduction').val())
        _refund_provider_exchange_rate = convertStringCurrencyToNumber($('#refund_provider_exchange_rate').val()) || 0
        _std_date_apyment = $('#std_date_apyment').val()
        _std_status = $('#std_status').val()
        _std_amount = convertStringCurrencyToNumber($('#std_amount').val())
        _std_exchange_rate = convertStringCurrencyToNumber($('#std_exchange_rate').val()) || 0
        _std_note = $('#std_note').val()
        _note2 = $('#note2').val()
        _refund_profit_2 = $('#refund_profit_2').val()
        _refund_profit_2_VN = $('#refund_profit_2_VN').val()
        _refund_amount_com_agent_gbcfa = $('#refund_amount_com_agent_gbcfa').val()
        _refund_exchange_rate_agent = $('#refund_exchange_rate_agent').val()
        _refund_agent_vnd = $('#refund_agent_vnd').val()
        _refund_situation_pp = $('#refund_situation_pp').val()
        _refund_type_of_refund_pp = $('#refund_type_of_refund_pp').val();
        _refund_bank_pp = $('#refund_bank_pp :selected').val();
        _commission_refund = $('#commission_refund').val();
        _extra_fee_refund = $('#extra_fee_refund').val();
        _bank_fee_refund = $('#bank_fee_refund').val();
        _balance_refund = $('#balance_refund').val();
        _status = $('#status :selected').val();
        _html += '</div>';
        if (!flag) {
            $('#div_refund_alert').html(_html);
        } else {
            $('#div_refund_alert').html('');
            _id = $('#_id').val()
            _id_refund = $('#id_refund').val()
            // saveRefund
            $.get('{{route('ajax.saveRefund')}}', {
                page: page,
                id: _id,
                id_refund: _id_refund,
                refund_provider_amount: _refund_provider_amount,
                request_date: _request_date,
                refund_provider_date: _refund_provider_date,
                std_deduction: _std_deduction,
                refund_provider_exchange_rate: _refund_provider_exchange_rate,
                std_date_apyment: _std_date_apyment,
                std_status: _std_status,
                std_amount: _std_amount,
                std_exchange_rate: _std_exchange_rate,
                std_note: _std_note,
                note2: _note2,
                refund_profit_2: _refund_profit_2,
                refund_profit_2_VN: _refund_profit_2_VN,
                refund_amount_com_agent_gbcfa: _refund_amount_com_agent_gbcfa,
                refund_exchange_rate_agent: _refund_exchange_rate_agent,
                refund_agent_vnd: _refund_agent_vnd,
                refund_situation_pp:_refund_situation_pp,
                refund_type_of_refund_pp:_refund_type_of_refund_pp,
                refund_bank_pp:_refund_bank_pp,
                commission : _commission_refund,
                extra_fee: _extra_fee_refund,
                bank_fee : _bank_fee_refund,
                balance : _balance_refund,
                status : _status
            }, function (data) {
                window.location.reload();
            })
        }
    }

    function callTotalAmountVnd(){
        let totalAmount = $('#pay_agent_total_amount').val() || 0;
        let exchangeRate = $('#pay_agent_exchange_rate').val() || 0;
        var vnd = (parseFloat(convertStringCurrencyToNumber($('#vnd').val())));
        let amountTotalVND = (parseFloat(convertStringCurrencyToNumber(totalAmount))*parseFloat(convertStringCurrencyToNumber(exchangeRate))) + vnd;
        $('#pay_agent_amount_VN').val(amountTotalVND);
    }
    function callTotalAmount(){
        let amountCom = convertStringCurrencyToNumber($('#pay_agent_amount_comm').val()) || 0;
        let extra = convertStringCurrencyToNumber($('#pay_agent_extra').val()) || 0;
        //console.log('amount '+amountCom);
        //console.log('extra '+extra);
        let totalAmount = parseFloat(amountCom) + parseFloat(extra);
        //console.log(totalAmount);
        $('#pay_agent_total_amount').val(convertNumberToCurrency(totalAmount));
    }

    function calReAmountVNAgent() {
        _tmp = getNumber($('#pay_agent_amount_comm').val())
        _net_amount = parseFloat(_tmp)
        _exchange_rate = $('#pay_agent_exchange_rate').val()
        _exchange_rate = _exchange_rate.replace(/,/g, '')
        _total_VN = _net_amount * _exchange_rate
        $('#pay_agent_amount_VN').val(convertNumberToCurrency(parseInt(_total_VN)))
    }
    $(document).on('change','#pay_agent_extra, #pay_agent_exchange_rate',function (e) {
        callTotalAmount();
        callTotalAmountVnd();
    })


    var gstInclude = 1;
    var gstNotInclude = 2;
    $(document).on('change','#pay_agent_bonus ,#gst_status_agent_profit',function(e){
        loadComAgent();
    });
    function loadProfit() {
        calReAmountVN()
        loadPayProvider()
        //loadPayAgent();

    }
    function loadComAgent(){
        let gstStatus = $('#gst_status_agent_profit').val();
        let net_amount = parseFloat($('#apply_net_amount').val()) || 0;
        let discount = parseFloat($('#discount_annalink_receipt').val()) || 0;
        let comRate = $('#comm_rate_agent_profit').attr('data-com') || 0;
        let bonus = $('#pay_agent_bonus').val() || 0;
        let amountCom ;
        if(typeof gstStatus == 'undefined'){
            return;
        }
        if(gstStatus == gstInclude){
            // amountCom = (net_amount-discount) *(comRate/100+bonus/100);
            amountCom = ( net_amount - discount ) * (comRate / 100);
        }else if (gstStatus == gstNotInclude){
            // amountCom = ((net_amount-discount) *(comRate/100+bonus/100))/1.1;
            amountCom = (( net_amount - discount ) * (comRate / 100) / 1.1);
        }
        $('#pay_agent_amount_comm').val(amountCom.toFixed(2)); //
        loadProfit();
        callTotalAmount();
        callTotalAmountVnd();
        loadPayProfit();
    }
    function calsTotalProfit1(){
        let profit = parseFloat(convertStringCurrencyToNumber($("#profit_money").val()));
        let profit_extra_money = parseFloat(convertStringCurrencyToNumber($('#profit_extra_money').val()));
        let totat_profit1 = profit + profit_extra_money;
        let net_amount = parseFloat($('#apply_net_amount').val());
        let exchangeRateInvoice = parseFloat(convertStringCurrencyToNumber($('#exchange_rate_annalink_receipt').val()));
        let exchangeRatePayForProvider = parseFloat(convertStringCurrencyToNumber($('#pay_provider_exchange_rate').val()));


        let _promotion_annalink_receipt = parseFloat(convertStringCurrencyToNumber($('#promotion_annalink_receipt').val()));
        let _discount_annalink_receipt = parseFloat(convertStringCurrencyToNumber($('#discount_annalink_receipt').val()));
        let _currency_receipt = $('#profit1_currency_receipt').val();
        var provider_pay = $('#provider_pay').val();
        var surchagefee =  parseFloat(convertNumberToCurrency($('#bankfee_annalink_receipt').val()));
        var payprovider_vnd =  parseFloat(convertNumberToCurrency($('#pay_provider_total_VN').val()));
        let revenueExRate;
        if(_currency_receipt == 'VND'){
            if (provider_pay === 'HCC Student Secure' || provider_pay === 'HCC Atlas'){
                revenueExRate = (net_amount + surchagefee) * (exchangeRateInvoice - payprovider_vnd);
            }else{
                revenueExRate = net_amount * (exchangeRateInvoice - exchangeRatePayForProvider);
            }
        }else{
            revenueExRate = 0;
        }
        let _bankfee_annalink_receipt = parseFloat(convertStringCurrencyToNumber($('#bankfee_annalink_receipt').val()));
        let _bankfee_profit = _bankfee_annalink_receipt * exchangeRateInvoice;

        $('#profit_total').val(totat_profit1 / 1.1);

        var  profit_total = parseFloat(convertStringCurrencyToNumber($('#profit_total').val()));
        var vnd = parseFloat(convertStringCurrencyToNumber($('#vnd').val()));
        var pay_provider_exchange_rate = parseFloat(convertStringCurrencyToNumber($('#pay_provider_exchange_rate').val()));


        _profit_VN = (profit_total * pay_provider_exchange_rate) - (vnd);

        var gst = $('#profit_total').val() * (10 / 100);
        $('#gst').val(gst.toFixed(2));
        $('#profit_exchange_rate').val(revenueExRate.toFixed(2));
        $('#profit_money_VND').val(convertNumberToCurrency(parseInt(_profit_VN).toFixed(2)));
        $('#profit_bankfee_VND').val(convertNumberToCurrency(_bankfee_profit));
    }
    function calcAmountComFormGetBackComFromAgent(){
        let refund_provider_amount = convertStringCurrencyToNumber($('#refund_provider_amount').val());
        let refund_percent_com_agent = convertStringCurrencyToNumber($('#refund_percent_com_agent').attr('data-value'));
        let amount_com = refund_provider_amount * refund_percent_com_agent / 100;
        $('#refund_amount_com_agent_gbcfa').val(convertNumberToCurrency(parseInt(amount_com).toFixed(2)));
    }

    function getProfitLink(){
        let typeOfRefundStatusFullRefund = 1;
        let typeOfRefundStatusPartialRefund = 2;
        let refund_type_of_refund_pp = $('#refund_type_of_refund_pp').val();
        if(refund_type_of_refund_pp == typeOfRefundStatusFullRefund){
            let pay_agent_amount_comm = convertStringCurrencyToNumber($('#pay_agent_amount_comm').val());
            let pay_agent_amount_VN = convertStringCurrencyToNumber($('#pay_agent_amount_VN').val());
            $('#refund_amount_com_agent_gbcfa').val(pay_agent_amount_comm);
            $('#refund_agent_vnd').val(pay_agent_amount_VN);
        }
    }
    jQuery(document).ready(function () {
        loadProfit()
        loadRefund();
        loadComAgent();
        calsTotalProfit1();
        //callTotalAmount();
        //callTotalAmountVnd();
        $(document).on('change','#refund_type_of_refund_pp',function(e){
            getProfitLink();
        })
        $(document).on('change','#std_amount, #std_deduction',function(e){
            calcTotalAmountPayBackStudentRefund();
        });
        $(document).on('change','#profit_extra_money, #profit_exchange_rate',function(e){
            calsTotalProfit1();
        });
        $(document).on('change','#refund_provider_amount',function(e){
            calcAmountComFormGetBackComFromAgent();
        })
        $('.btn-delete-task').click(function () {
            $('#action_type').val(1)
            $('#form_task').submit()
        })

        $('#btn_add_new_task').click(function () {
            resetDataTask()
            $('#modal_task').modal('toggle')
        })

        $('.data_task').click(function () {
            var id = $(this).data('id')
            var agent = "<?php echo $obj->id ?>"
            var url = "<?php echo route('task.edit'); ?>"
            $.get(url, { task_id: id, agent_id: agent }, function (data) {
                if (data['status'] == 1) {
                    res = data['content']
                    setDataTask(res)
                    $('#modal_task').modal('toggle')
                } else {
                    alert('Can not find data')
                }
            })
        })
        $('#tab-receipt').delegate('#phieuthu_amount, #phieuthu_bank_fee', 'change', function () {
            var sum_amount = parseFloat($('#phieuthu_sum_amount').val()) || 0
            var sum_bank_fee = parseFloat($('#phieuthu_sum_bank_fee').val()) || 0
            var net_amount = parseFloat($('#apply_net_amount').val()) || 0
            var new_amount = parseFloat($('#phieuthu_amount').val()) || 0
            var new_bank_fee = parseFloat($('#phieuthu_bank_fee').val()) || 0
            var old_amount = parseFloat($('#old_phieuthu_amount').val()) || 0
            var old_bank_fee = parseFloat($('#old_phieuthu_bank_fee').val()) || 0
            var exchange_rate = parseFloat((sum_amount + new_amount - old_amount) / (net_amount + sum_bank_fee + new_bank_fee - old_bank_fee))
                .toFixed(2)
            $('#phieuthu_exchange_rate').val(exchange_rate)
        })
        $(document).on('change', '#refund_exchange_rate_agent, #refund_amount_com_agent_gbcfa', function (e) {
            var refund_exchange_rate_agent = convertStringCurrencyToNumber($('#refund_exchange_rate_agent').val())
            var refund_amount_com_agent_gbcfa = convertStringCurrencyToNumber($('#refund_amount_com_agent_gbcfa').val())
            var refund_agent_vnd = refund_exchange_rate_agent * refund_amount_com_agent_gbcfa
            $('#refund_agent_vnd').val(convertNumberToCurrency(parseInt(refund_agent_vnd)))
        })

        $('#div_btn_receipt').delegate('#btn_add_receipt', 'click', function () {
            var _type = $(this).data('type')
            var _id = $('#_id').val()
            if (_type != '') {
                $.get(getBtnReceipt, { type: _type, id: _id }, function (data) {
                    $('#div_btn_receipt').html(data)
                    $('#receipt_net_amount').val('{{$obj->net_amount}}')
                })
            }
        })
        $('#div_btn_receipt').delegate('.btn-del-phieuthu', 'click', function () {
            var _id_phieuthu = $('#id_phieuthu').val()
            var _id = $('#_id').val()
            var url = '{{route("phieuthu.del")}}'
            $.get(url, { id_phieuthu: _id_phieuthu, id: _id }, function (data) {
                window.location.href = '{{config('admin.ajax_crm_url')}}customer/process/' + _id + '/2'
            })
        })

        $('#tab-doc').delegate('#btn_add_doc', 'click', function () {
            _id = '{{$obj->id}}'
            _url = "{{route('ajax.getFormCreateTailieu')}}"
            $.get(_url, { id: _id }, function (data) {
                $('#div_modal_doc').html(data)
                $('#tailieuModal').modal('toggle')
            })
        })
        $('#tab-doc').delegate('.edit_doc', 'click', function () {
            _id = '{{$obj->id}}'
            _tailieu_id = $(this).data('id')
            _url = "{{route('ajax.getFormEditTailieu')}}"
            $.get(_url, { id: _id, tailieu_id: _tailieu_id }, function (data) {
                $('#div_modal_doc').html(data)
                $('#tailieuModal').modal('toggle')
            })
        })

        $('#tab-doc').delegate('.delete_doc', 'click', function () {
            _url = $(this).data('url')
            _tailieu_id = $(this).data('id')
            $('#form-delete-modal').attr('action', _url)
            $('#data-del').val(_tailieu_id)
            $('#crm-deleteModal').modal('toggle')
        })

        // $("#div_btn_hh").delegate("#btn_add_hh", "click", function(){
        // 	_type = $(this).data('type');
        // 	_id = $('#_id').val();
        // 	if(_type != ''){
        // 		$.get(getBtnHH, {type: _type, id: _id}, function (data) {
        // 			$('#div_btn_hh').html(data);
        // 		});
        // 	}
        // });

        // $("#div_btn_profit").delegate("#btn_add_profit", "click", function(){
        // 	_type = $(this).data('type');
        // 	_id = $('#_id').val();
        // 	if(_type != ''){
        // 		$.get(getBtnProfit, {type: _type, id: _id}, function (data) {
        // 			$('#div_btn_profit').html(data);
        // 			loadProfit();
        // 		});
        // 	}
        // });
        $('#div_btn_refund')
            .delegate('#refund_provider_amount, #refund_provider_exchange_rate, #std_amount, #std_exchange_rate, #std_deduction', 'change', function () {
                loadRefund()
            })

        $('#div_btn_profit').delegate('#exchange_rate_re_provider, #re_total_amount', 'change', function () {
            loadProfit()
        })

        $('#div_btn_profit')
            .delegate('#pay_provider_paid, #pay_provider_bank_fee, #pay_provider_exchange_rate, #re_total_amount_vn', 'change', function () {
                loadProfit();
                calsTotalProfit1();
            })

        $('#div_btn_profit')
            .delegate('#gst_status_agent_profit ,#pay_agent_bonus, #pay_agent_deduction, #pay_agent_amount_comm, #profit_exchange_rate', 'change', function () {
                loadProfit()
            })

        $('#div_btn_profit')
            .delegate('#re_total_amount, #pay_provider_total_amount, #pay_agent_exchange_rate', 'change', function () {
                loadProfit()
            })

        $('#div_btn_receipt').delegate('#btn_close_receipt', 'click', function () {
            _id = $('#_id').val()
            $.get(getBtnReceipt, { type: 1, id: _id }, function (data) {
                $('#div_btn_receipt').html(data)

            })
        })

        // $("#div_btn_hh").delegate("#btn_close_hh", "click", function(){
        // 	_id = $('#_id').val();
        // 	$.get(getBtnHH, {type: 1, id: _id}, function (data) {
        // 		$('#div_btn_hh').html(data);
        // 	});
        // });

        // $("#div_btn_profit").delegate("#btn_close_profit", "click", function(){
        // 	_id = $('#_id').val();
        // 	$.get(getBtnProfit, {type: 1, id: _id}, function (data) {
        // 		$('#div_btn_profit').html(data);
        // 	});
        // });

        $('#div_table_receipt').delegate('.edit_phieuthu', 'click', function () {
            _id_phieuthu = $(this).data('id')
            _id = $('#_id').val()
            $.get(editReceipt, { id_phieuthu: _id_phieuthu, id: _id }, function (data) {
                $('#div_btn_receipt').html(data)
            })
        })

        // $("#div_table_hh").delegate(".edit_hh", "click", function(){
        // 	_id_hh = $(this).data('id');
        // 	_id = $('#_id').val();
        // 	$.get(editHH, {id_hh: _id_hh, id: _id}, function (data) {
        // 		$('#div_btn_hh').html(data);
        // 	});
        // });

        // $("#div_table_profit").delegate(".edit_profit", "click", function(){
        // 	_id_profit = $(this).data('id');
        // 	_id = $('#_id').val();
        // 	$.get(editProfit, {id_profit: _id_profit, id: _id}, function (data) {
        // 		$('#div_btn_profit').html(data);
        // 	});
        // });

        $('#div_btn_receipt').delegate('#btn_save_receipt', 'click', function () {
            postReceipt()
        })

        $('#div_btn_profit').delegate('#btn_save_profit', 'click', function () {
            postProfit()
        })

        $('#div_btn_refund').delegate('#btn_save_refund', 'click', function () {
            postRefund()
        })

        $(document).on('click', '#btn_save_hh', function () {
            postHH()
        })

        $('#div_btn_receipt').delegate('#amount, #net_amount, #bank_fee', 'change', function () {
            calExchangeRate()
        })

        $('#div_btn_receipt').delegate('#account_bank', 'change', function () {
            _selected = $('#account_bank option:selected')
            _name = _selected.data('name')
            _brand = _selected.data('brand')
            _bank = _selected.data('bank')
            _code = _selected.data('code')
            if (_name != null && _name != '') {
                _info = _name + ' - ' + _bank + '( ' + _code + ' )' + ' - ' + _brand

            } else {
                _info = ''
            }
            $('#bank_info').val(_info)
        })

        $('.c_status').click(function () {
            $('.c_status').checked = false
            $(this).checked = true
            _value = $(this).val()
            _id = $('#_id').val()
            _text = $(this).data('text')
            $('#td_invoice_status').html(_text)
            $.get(changeInvoiceStatus, { id: _id, value: _value }, function (data) {
                $('#div_alert').html(data)
            })
        })
        $('#mainContent').delegate('.invoice_info', 'click', function () {

            _id = $(this).data('id')
            if (_id != '') {
                $.get(getInvoice, { id: _id }, function (data) {
                    $('#div_modal_invoice_info').html(data)
                    $('#modal_invoice').modal('toggle')
                })
            }
        })

        $('#mainContent').delegate('.customer_info', 'click', function () {

            _id = $(this).data('id')
            if (_id != '') {
                $.get(getCus, { id: _id }, function (data) {
                    $('#div_modal_customer_info').html(data)
                    $('#modal_customer').modal('toggle')
                })
            }
        })

        $('#mainContent').delegate('.agent_info', 'click', function () {

            _id = $(this).data('id')
            $.get(getAgentInfo, { id: _id }, function (data) {
                $('#div_modal_agent_info').html(data);
                $('#modal_agent_info').modal('show');
            });
        });

    });
</script>
