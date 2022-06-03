@extends('CRM.layouts.default')

@section('title')
    @if(!empty($obj))
        Edit invoice
    @else
        Create invoice
        @endif

    @parent
@stop

@section('css')
    <style>
        .user-information .modal-content {
            border: 2px solid #1a68d1;
            border-radius: 0;
        }


        .user-information .modal-header {
            background-color: #1a68d1;
            border-bottom: 1px solid #fff;
            border-radius: 0;
        }

        .user-information .modal-header h5,
        .user-information .modal-header .close {
            color: #fff;
        }


        .content-information h3.name {
            font-size: 24px;
            font-weight: 600;
            color: #1a68d1;
            padding-bottom: 5px;
            border-bottom: 1px solid #cadbef;
        }

        .content-information .form-group .control-label {
            width: 100%;
            float: none;
            color: #5e6e82;
            font-size: 13.33px;
        }

        .content-information .form-group input {
            width: 100%;
            border: 1px solid #d8e2ef;
            font-size: 1rem;
            font-weight: 300;
            color: #6c8bb5;
            padding: 0.2rem .5rem;
            border-radius: 0.25rem;
        }

        .delete-controlog .modal-content {
            border-radius: 5px;
        }

        .delete-controlog .modal-content .modal-body {
            text-align: center;
        }

        .delete-controlog .modal-title {
            font-size: 24px;
            font-weight: 600;
            color: #1a68d1;

        }

        .delete-controlog .comment-d {
            padding: 15px;
            width: 80%;
            margin: auto;
            background-color: #4b98ff;
            margin-top: 15px;
            margin-bottom: 15px;
            border: 1px solid #1967d1;
            border-radius: 9px;
        }

        .delete-controlog .comment-d p {
            margin-bottom: 0;
            font-size: 14px;
            color: #fff;
        }

        .delete-controlog .button-contenr .yes {
            background-color: #2c7be5;
            border-color: #2c7be5;
        }

        .delete-controlog .button-contenr .yes:hover {
            background-color: #1a68d1;
            border-color: #1862c6;
        }

        .delete-controlog .button-contenr .no {
            background-color: #f50000;
            border: 1px solid #f50000;
        }

        .delete-controlog .button-contenr .no:hover {
            background-color: #dc0000;
            border-color: #dc0000;

        }

        .delete-controlog .form-group {
            text-align: left;
        }

        .delete-controlog .form-group #email-example {
            width: 100%;
            border: 1px solid #d8e2ef;
            font-size: 1rem;
            font-weight: 300;
            color: #6c8bb5;
            padding: 0.2rem .5rem;
            border-radius: 0.25rem;
        }

        .delete-controlog .form-group #email-example option {
            font-weight: 300;
        }

        .thong-tin-user {
            position: absolute;
            left: 0;
            right: 0;
            -webkit-transform: translateY(100%);
            -ms-transform: translateY(100%);
            transform: translateY(100%);
            bottom: 0;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .thong-tin-user h2 {
            font-size: 29px;
            margin-bottom: 0;
        }

        .thong-tin-user p {
            margin: 0;
            font-size: 15px;
        }

        .chevron-down-up {
            position: relative;
        }

        .chevron-down-up .click-down {
            margin-bottom: 0px;
            position: absolute;
            right: 0;
            font-size: 11px;
            top: 0;
            /*	    color: #344050;*/
            cursor: pointer;
            padding: 2px 6px;
        }

        .dang-ky-new {
            margin-top: 10px;
        }

        .dang-ky-submit,
        .dang-ky-restart {
            font-size: 15px;
            padding: 3px 13px;
            border-radius: 5px;
            color: #fff;
            background-color: #f50000;
            border: 1px solid #f50000;
        }

        .dang-ky-submit {
            background-color: #2c7be5;
            border-color: #2c7be5;
            box-shadow: none;
        }

        .dang-ky-submit:hover {
            background-color: #1a68d1;
            border-color: #1862c6;

        }

        .dang-ky-restart:hover {
            background-color: #dc0000;
            border-color: #dc0000;
        }

        @media (max-width: 767px) {
            .card-header.position-relative {
                padding: 0;
            }

            .cover-image .rounded-soft {
                position: static;
                min-height: 210px;
            }

            .avatar-profile {
                left: 10px;
                -webkit-transform: translateY(12%);
                -ms-transform: translateY(12%);
                transform: translateY(12%);
            }

            .thong-tin-user {
                position: static;
                -webkit-transform: translateY(140%);
                -ms-transform: translateY(140%);
                transform: translateY(140%);
            }
        }

        @media (max-width: 500px) {
            .card-header.position-relative {
                margin-bottom: 165px !important;
            }
        }

        @media (min-width: 768px) {
            .thong-tin-user .offset-lg-2 {
                margin-left: 24.66667%;
            }

            .thong-tin-user .col-lg-10 {
                max-width: 75.33333%;
                flex: 0 0 75.33333%;
                -ms-flex: 0 0 75.33333%;
            }
        }

        @media (min-width: 1200px) {
            .thong-tin-user .offset-lg-2 {
                margin-left: 22.66667%;
            }

            .thong-tin-user .col-lg-10 {
                max-width: 77.33333%;
                flex: 0 0 77.33333%;
                -ms-flex: 0 0 77.33333%;
            }
        }

        @media (min-width: 1599px) {
            .thong-tin-user .offset-lg-2 {
                margin-left: 11.66667%;
            }

            .thong-tin-user .col-lg-10 {
                max-width: 88.33333%;
                flex: 0 0 88.33333%;
                -ms-flex: 0 0 88.33333%;
            }
        }
    </style>
@stop

@section('content')
    @include('CRM.elements.customers.form')
@stop

@section('js')
    <script>

        var ajax_url = $('#ajax_crm_url').val()
        var formPartner = "{{route('customer.formPartner')}}"
        var formChild = "{{route('customer.formChild')}}"
        var getRef = "{{route('customer.getRef')}}"
        var getSu = "{{route('customer.getSu')}}"
        var getComm = "{{route('customer.getComm')}}"
        var getBankFee = "{{route('ajax.customer.getBankFeeByPaymentMethod')}}"
        var gstInclude = 1;
        var gstNotInclude = 2;
        var typePaymentDeduction = 2;
        var typePaymentMonthly = 1;

        function handleGetBankFee() {
            let optionFee = $('#bank_fee option:selected');
            let feeAmount = optionFee.val();
            switch (parseInt(feeAmount)) {
                case 6 :
                    return 5
                case 7 :
                    return 3.6/100
                case 8 :
                    return 6/100
                default :
                    return parseFloat(feeAmount/100);
            }
        }

        function search(_service, _policy, myArray) {
            for (var i = 0; i < myArray.length; i++) {
                if (myArray[i].service == _service && myArray[i].policy == _policy) {
                    return myArray[i]
                }
            }
            return null
        }

        function country() {
            var optionAgent = $('#agent_id option:selected')
            countryAgent = optionAgent.data('country')
            $('#agent_country').val(countryAgent)
        }

        function promotion() {
            var optionPromotion = $('#promotion_id option:selected')
            promotionAmount = optionPromotion.data('amount')
            $('#promotion_amount').val(promotionAmount)
            totalAmount()
        }

        function calFee() {
            let bankFee = handleGetBankFee();
            let net_amount = convertStringCurrencyToNumber($('#net_amount').val())
            let extra = $('#extra').val() != '' ? convertStringCurrencyToNumber($('#extra').val()) : 0;
            let extendFee = $('#extend_fee').val();

            if (net_amount == '') {
                net_amount = 0
            }
            if (bankFee == 5) { // 5 is 5 AUD
                fee = bankFee
            } else {
                fee = parseFloat((parseFloat(net_amount) + parseFloat(extendFee)) * bankFee ).toFixed(2);
            }
            $('#fee').val(fee);
            totalAmount()
        }

        function callFeeByPayment(fee) {
            calFee();
            totalAmount()
        }

        function ajaxGetRef() {
            _country = $('#service_country').val()
            _dichvu = $('#type_service').val()
            if (_country != '' && _dichvu != '') {
                $.get(getRef, { country: _country, dichvu: _dichvu }, function (data) {
                    totalAmount()
                })
            }
        }

        function ajaxGetSu() {
            _payment = $('#payment_method').val()
            _net_amount = convertStringCurrencyToNumber($('#net_amount').val())
            if (_net_amount != '' && _payment != '') {
                $.get(getSu, { payment_method: _payment, net_amount: _net_amount }, function (data) {
                    $('#surcharge').val(data)
                    totalAmount()
                })
            }
        }

        function calcGst() {
            let gst = $('#data_gst_agent').val();
            let net_amount = convertStringCurrencyToNumber($('#net_amount').val())
            let extra = $('#extra').val() != '' ? convertStringCurrencyToNumber($('#extra').val()) : 0;
            let comm = $('#data_comm_agent').val() != '' ? convertStringCurrencyToNumber($('#data_comm_agent').val()) : 0
            var calcGstValue = 0;
            if(parseInt(gst) == 2){
                calcGstValue = (parseFloat(net_amount)-parseFloat(extra)) * (parseFloat(comm) / 100) / 11;
                $('#gst').val(calcGstValue.toFixed(2));
            }else{
                $('#gst').val(calcGstValue);
            }
        }

        $(document).on('click', '#quote-price', function (e) {
            e.preventDefault()
            let providerId = $('#provider_id option:selected').attr('data-value')
            let adult = $('#no_of_adults').val()
            let child = $('#no_of_children').val()
            let startDate = $('#start_date').val()
            let endDate = $('#end_date').val()
            if (providerId) {
                $.ajax({
                    url: '{{route('ajax.customer.getPrice')}}',
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        adults: adult,
                        childs: child,
                    },
                    success: function (data) {
                        $('#net_amount').val(data[providerId])
                        ajaxGetComm()
                        //totalAmount()
                        $('.text-validation').text('')
                    },
                    error: function (err) {
                        if (err.status == 422) {
                            if ('start_date' in err.responseJSON.errors) {
                                $('#start_date_div_alert').text(err.responseJSON.errors.start_date[0])
                            } else {
                                $('#start_date_div_alert').text('')
                            }
                            if ('end_date' in err.responseJSON.errors) {
                                $('#end_date_div_alert').text(err.responseJSON.errors.end_date[0])
                            } else {
                                $('#end_date_div_alert').text('')
                            }
                            if ('adults' in err.responseJSON.errors) {
                                $('#adults_div_alert').text(err.responseJSON.errors.adults[0])
                            } else {
                                $('#adults_div_alert').text('')
                            }
                            if ('childs' in err.responseJSON.errors) {
                                $('#childs_div_alert').text(err.responseJSON.errors.childs[0])
                            } else {
                                $('#childs_div_alert').text('')
                            }
                        }
                    },
                })
                $('#provider_id_div_alert').text('')
            } else {
                $('#provider_id_div_alert').text('The provider_id field is required.')
            }
        })

        function ajaxGetComm() {
            _agent = $('#agent_id').val()
            _provider = $('#provider_id').val()
            _policy = $('#policy').val()
            _net_amount = $('#net_amount').val()
            if (_agent != '' && _provider != '' && _policy != '' && _net_amount != '') {
                $.get(getComm, {
                    agent: _agent,
                    provider: _provider,
                    policy: _policy,
                    net_amount: _net_amount,
                }, function (data) {
                    $('#data_comm_agent').val(data['comm_agent'])
                    $('#data_unit_comm_agent').val(data['comm_donvi'])
                    $('#data_gst_agent').val(data['comm_gst']);
                    $('#data_type_payment_agent').val(data['comm_type_payment'])
                    @if(empty($obj) )
                    $('#type_payment_agent_id').val(data['comm_type_payment'])
                    @elseif(!empty($obj) && empty($obj->type_payment_agent_id))
                    $('#type_payment_agent_id').val(data['comm_type_payment'])
                    @endif
                    $('#comm_gst').val(data['text_comm_gst'])
                    $('#comm_type_payment').val(data['text_comm_type_payment'])
                    $('#comm_agent').val(data['text_comm_agent'])
                    //$('#gst').val(data['gst'])
                    //$('#comm').val(data['comm'])
                    calcCom();
                    calcGst();
                    totalAmount()
                })
            } else {
                $('#data_comm_agent').val(0)
                $('#data_unit_comm_agent').val(1)
                $('#data_gst_agent').val(0)
                $('#data_type_payment_agent').val(1)
                $('#comm_gst').val('')
                $('#comm_type_payment').val('')
                $('#comm_agent').val('')
            }
        }

        function calcCom() {
            let gst = $('#data_gst_agent').val();
            let net_amount = $('#net_amount').val() != '' ? convertStringCurrencyToNumber($('#net_amount').val()) : 0;
            let extra = $('#extra').val() != '' ? convertStringCurrencyToNumber($('#extra').val()) : 0
            let comm = $('#data_comm_agent').val() != '' ? convertStringCurrencyToNumber($('#data_comm_agent').val()) : 0;
            var comValue = 0;
            var result = ( parseFloat(net_amount) - parseFloat(extra) ) * (parseFloat(comm) / 100);

            if(gst == gstInclude){
                comValue = (result / 1.1).toFixed(2);
            }else if(gst == gstNotInclude){
                comValue = (result).toFixed(2);
            }
            $('#comm').val(comValue);
        }

        function ajaxGetBankFee() {
            let _payment_id = $('#payment_method').val()
            $.get(getBankFee, { payment_id: _payment_id }, function (data) {
                callFeeByPayment(data.bankfee)
            })
        }

        function resetData() {
            $('#data_comm_agent').val(0)
            $('#data_unit_comm_agent').val(1)
            $('#data_gst_agent').val(0)
            $('#data_type_payment_agent').val(1)
            $('#comm_gst').val('')
            $('#comm_type_payment').val('')
            $('#comm_agent').val('')
            $('#gst').val(0)
            $('#comm').val(0)
        }

        function totalAmount() {
            let type_payment = $('#type_payment_agent_id').val();
            let total = 0;
            let grossAmount = $('#net_amount').val() != '' ? convertStringCurrencyToNumber($('#net_amount').val()) : 0;
            let extendFee = $('#extend_fee').val() != '' ? convertStringCurrencyToNumber($('#extend_fee').val()) : 0;
            let bankFee = $('#fee').val() != '' ? convertStringCurrencyToNumber($('#fee').val()) : 0;
            let promotion = $('#promotion_amount').val() != '' ? convertStringCurrencyToNumber($('#promotion_amount').val()) : 0
            let discount = $('#extra').val() != '' ? convertStringCurrencyToNumber($('#extra').val()) : 0;
            let commission = $('#comm').val() != '' ? convertStringCurrencyToNumber($('#comm').val()) : 0;

            if(type_payment == typePaymentDeduction){
                total = parseFloat(parseFloat(grossAmount) + parseFloat(extendFee) + parseFloat(bankFee) - parseFloat(promotion) - parseFloat(discount) - parseFloat(commission)).toFixed(2);
            }else if(type_payment == typePaymentMonthly){
                total = parseFloat(parseFloat(grossAmount) + parseFloat(extendFee) + parseFloat(bankFee) - parseFloat(promotion) - parseFloat(discount)).toFixed(2);
            }

            if (total != 0){
                $('#total').val(total);
            }
        }

        jQuery(document).ready(function ($) {
            country();
            promotion();
            calFee();
            totalAmount();
            ajaxGetComm();
            calcGst();
            $('#agent_id, #provider_id, #policy, #net_amount').change(function () {
                ajaxGetComm();
                calcGst();
            })
            // change discount number to calc commission
            $('#extra').change(() => {
                calcCom();
            })

            $('#type_payment_agent_id').change(function () {
                totalAmount();
            })

            $('#provider_id').change(function () {
                let _provider_id = $(this).val()
                $.ajax({
                    url: '{{route('ajax.getCurrency')}}',
                    type: 'get',
                    data: {
                        provider_id: _provider_id,
                    },
                    success: function (data) {
                        $('.input-group-text').html(data)
                    },
                })
            })

            // $('#service_country').on('change',function(){
            //     let country = $(this).val();
            //     let currency = '';
            //     if(country == 'A'){
            //         currency = 'AUD'
            //     }else if(country == 'U'){
            //         currency = 'USD'
            //     }else if(country == 'N'){
            //         currency = 'NZD'
            //     }
            //     $('.input-group-text').text(currency);

            // });

            $('#service_country, #type_service').change(function () {
                ajaxGetRef()
            })

            $('#payment_method, #net_amount').change(function () {
                //ajaxGetSu();
                ajaxGetBankFee()
            })

            $('#agent_id').change(function () {
                country()
            })

            $('#promotion_id').change(function () {
                promotion()
            })

            $('#bank_fee, #net_amount, #extra, #type_extra, #extend_fee').change(function () {
                calFee()
            })

            $('#type_service').change(function (e) {
                e.preventDefault();
                let dataId = this.value
                $.get('http://oshcglobal/crm/ajax/customer/getProvider', { provider_id: dataId }, function (data) {
                    let html = '<option value=""></option>'
                    $.each(data, function (index, value) {
                        html += '<option value="' + value.id + '" data-value="' + value.slug + '" >' + value.name + '</option>'
                    })
                    $('#provider_id').html(html)
                })
            })

            $('#no_of_adults').change(function () {
                _num = $(this).val()
                $.get(formPartner, { num: _num }, function (data) {
                    $('#partner_div').html(data)
                })
            })

            $('#no_of_children').change(function () {
                _num = $(this).val()
                $.get(formChild, { num: _num }, function (data) {
                    $('#child_div').html(data)
                })
            })

            localStorage.removeItem('comms')
            $('.add_new_comm').click(function () {
                _service = $('#service').val()
                _policy = $('#policy').val()
                _commission = $('#commission').val()
                _end_date = $('#end_date').val()
                dataObject = []
                if (_commission != '' && _end_date != '') {
                    if (typeof (Storage) !== 'undefined') {
                        if (localStorage.getItem('comms') && localStorage.getItem('comms').length > 0) {
                            dataObject = JSON.parse(localStorage.getItem('comms'))
                        }
                        dataObj = {
                            'service': _service,
                            'policy': _policy,
                            'commission': _commission,
                            'end_date': _end_date,
                        }
                        obj_search = search(_service, _policy, dataObject)
                        if (obj_search == null) {
                            dataObject.push(dataObj)
                        } else {
                            obj_search['commission'] = _commission
                            obj_search['end_date'] = _end_date
                        }
                        localStorage.setItem('comms', JSON.stringify(dataObject))
                        retrivedOjects = localStorage.getItem('comms')
                        $('#experience-form').removeClass('show')
                        reset_form_add_new_comm()
                        load_data_comm()
                        console.log('retrivedOjects: ', JSON.parse(retrivedOjects))
                    } else {
                        document.write('Trình duyệt của bạn không hỗ trợ local storage')
                    }
                }
            })
            $('.add_contact').click(function () {
                $.get(createContact, {}, function (data) {
                    $('#div_modal_contact').html(data)
                    $('#modal_create_contact').modal('toggle')
                })
            })
            $('#table_contact').delegate('.edit_contact', 'click', function () {
                _id = $(this).data('id')
                $.get(editContact, { id: _id }, function (data) {
                    $('#div_modal_contact').html(data)
                    $('#modal_create_contact').modal('toggle')
                })
            })
            $('#table_contact').delegate('.del_contact', 'click', function () {
                _id = $(this).data('id')
                $.get(delContact, { id: _id }, function (data) {
                    $('#table_contact_body').html(data)
                })
            })
            $('#mainContent').delegate('.btn_create_new_contact', 'click', function () {
                _name = $('#new_name').val()
                _position = $('#new_position').val()
                _phone = $('#new_phone').val()
                _birthday = $('#new_birthday').val()
                _email = $('#new_email').val()
                _skype = $('#new_skype').val()
                _facebook = $('#new_facebook').val()
                _note = $('#new_note').val()
                _status = $('#new_status').val()
                if (_name != null && _name != '' && _phone != null && _phone != '' && _email != null && _email != '') {
                    $.get(storeContact, {
                        name: _name,
                        position: _position,
                        phone: _phone,
                        birthday: _birthday,
                        email: _email,
                        skype: _skype,
                        facebook: _facebook,
                        note: _note,
                        status: _status,
                    }, function (data) {
                        $('#table_contact_body').html(data)
                    })
                    reset_modal_create_contact()
                    $('#modal_create_contact').modal('toggle')
                }
            })
            $('#mainContent').delegate('.btn_edit_contact', 'click', function () {
                _id = $('#contact_id').val()
                _name = $('#new_name').val()
                _position = $('#new_position').val()
                _phone = $('#new_phone').val()
                _birthday = $('#new_birthday').val()
                _email = $('#new_email').val()
                _skype = $('#new_skype').val()
                _facebook = $('#new_facebook').val()
                _note = $('#new_note').val()
                _status = $('#new_status').val()
                if (_name != null && _name != '' && _phone != null && _phone != '' && _email != null && _email != '') {
                    $.get(updateContact, {
                        id: _id,
                        name: _name,
                        position: _position,
                        phone: _phone,
                        birthday: _birthday,
                        email: _email,
                        skype: _skype,
                        facebook: _facebook,
                        note: _note,
                        status: _status,
                    }, function (data) {
                        $('#table_contact_body').html(data)
                    })
                    reset_modal_create_contact()
                    $('#modal_create_contact').modal('toggle')
                }
            })

            $('#table_comm').delegate('.del_comm', 'click', function () {
                $('#table_comm').empty()
                if (typeof (Storage) !== 'undefined') {
                    if (localStorage.getItem('comms') && localStorage.getItem('comms').length > 0) {
                        dataObject = JSON.parse(localStorage.getItem('comms'))

                        id = $(this).data('id')
                        if (dataObject[id] != null) {
                            delete dataObject[id]
                        }
                        localStorage.setItem('comms', JSON.stringify(dataObject))
                        load_data_comm()
                    } else {
                        $('#table_comm').html('Not have commission')
                    }
                } else {
                    document.write('Trình duyệt của bạn không hỗ trợ local storage')
                }
            })

            function load_data_comm() {
                $('#table_comm').empty()
                if (typeof (Storage) !== 'undefined') {
                    if (localStorage.getItem('comms') && localStorage.getItem('comms').length > 0) {
                        dataObject = JSON.parse(localStorage.getItem('comms'))
                        _html = ''
                        _data_hidden = ''
                        for (i = 0; i < dataObject.length; i++) {
                            _src = $('#info_service_' + dataObject[i]['service']).data('src')
                            _name = $('#info_service_' + dataObject[i]['service']).data('name')
                            _policy = dataObject[i]['policy']
                            policy = dataObject[i]['policy']
                            _data_hidden += '<input type="hidden" name="service_id[]" value="' + dataObject[i]['service'] + '" >'
                            _data_hidden += '<input type="hidden" name="type[]" value="' + dataObject[i]['policy'] + '" >'
                            _data_hidden += '<input type="hidden" name="comm[]" value="' + dataObject[i]['commission'] + '" >'
                            _data_hidden += '<input type="hidden" name="date[]" value="' + dataObject[i]['commission'] + '" >'
                            if (_policy == 1) {
                                _policy = 'Single'
                            } else if (_policy == 2) {
                                _policy = 'Couple'
                            } else {
                                _policy = 'Family'
                            }
                            _html += '<tr class=""><td><img class="img-fluid" src="' + _src + '" alt="" width="50" /></td>'
                            _html += '<td>' + _name + '</td>'
                            _html += '<td>' + _policy + '</td>'
                            _html += '<td class="text-center">' + dataObject[i]['commission'] + '%</td>'
                            _html += '<td>' + dataObject[i]['end_date'] + '</td>'
                            _html += '<td class="del_comm" data-id="' + i + '"><span class="far fa-trash-alt"></span></td></tr>'
                        }
                        $('#table_comm').html(_html)
                        $('#data-hidden').html(_data_hidden)
                    } else {
                        $('#table_comm').html('Not have commission')
                    }
                } else {
                    document.write('Trình duyệt của bạn không hỗ trợ local storage')
                }
            }

            function reset_modal_create_contact() {
                $('#new_name').val()
                $('#new_position').val()
                $('#new_phone').val()
                $('#new_birthday').val()
                $('#new_email').val()
                $('#new_skype').val()
                $('#new_facebook').val()
                $('#new_note').val()
            }

            function reset_form_add_new_comm() {
                $('#service').val($('#service option:first').val())
                $('#policy').val($('#policy option:first').val())
                $('#commission').val('')
                $('#end_date').val('')
            }

            $('.chevron-down-up > .click-down').on('click', function () {
                id = $(this).data('id')
                check = $(this).hasClass('active')
                if (check) {
                    $(this).removeClass('active')
                } else {
                    $(this).addClass('active')
                }
                $('.card-body.bg-light').each(function () {
                    if ($(this).data('id') == id) {
                        if (check) {
                            $(this).slideUp(0)
                        } else {
                            $(this).slideDown(0)
                        }
                        return false
                    }
                })
            })
        })
    </script>
@stop
