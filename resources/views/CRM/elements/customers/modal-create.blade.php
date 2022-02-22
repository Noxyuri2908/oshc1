
{{--agent info--}}
<div class="row">
    @if(!isset($obj))
        <form action="{{route('customer.store')}}" method="POST" role="form">
    @else
                <form action="{{route('customer.update',['id' => $obj->id])}}" method="POST" role="form">
                    {{ method_field('PUT') }}
    @endif
        @csrf
{{--        @include('CRM.elements.customers.header-form')--}}
        @if(session('error-create-customer'))
            <div class="alert alert-danger">
                <strong>{{session('error-create-customer')}}</strong>
            </div>
        @endif
        @if(session('success-create-customer'))
            <div class="alert alert-success">
                <strong>{{session('success-create-customer')}}</strong>
            </div>
        @endif
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">{{ $error }}</li>
                @endforeach
            </ul>
        @endif

            <div class="col-md-12">
                @include('CRM.elements.customers.form-agent')
            </div>
            <div class="col-md-12">
                @include('CRM.elements.customers.form-service')
            </div>
            <div class="col-md-12">
                @include('CRM.elements.customers.form-customer-info')
            </div>
            <div class="col-md-12">
                @include('CRM.elements.customers.form-partner')
            </div>
            <div class="col-md-12">
                @include('CRM.elements.customers.form-child')
            </div>
            <div class="col-md-12">
                @include('CRM.elements.customers.form-payment')
            </div>

            <div class="col-md-12 d-flex justify-content-center align-items-center">
                @if (!isset($obj))
                    <button type="submit" class="dang-ky-submit btn btn-primary">Submit</button>
                    <a href="{{route('customer.index',['page'=>(!empty(request()->get('page'))?request()->get('page'):1)])}}" data-dismiss="modal" class="text-decoration-none dang-ky-restart btn btn-secondary" >Close</a>
                @else
                    <button type="submit" class="dang-ky-submit btn btn-primary">Update</button>
                    <a href="{{route('customer.index',['page'=>(!empty(request()->get('page'))?request()->get('page'):1)])}}" data-dismiss="modal" class="text-decoration-none dang-ky-restart btn btn-secondary" >Close</a>
                @endif
            </div>
        <br>
        <br>
    </form>
</div>

@push('scripts')
    <script>
        var ajax_url = $('#ajax_crm_url').val()
        var formPartner = "{{route('customer.formPartner')}}"
        var formChild = "{{route('customer.formChild')}}"
        var getRef = "{{route('customer.getRef')}}"
        var getSu = "{{route('customer.getSu')}}"
        var getComm = "{{route('customer.getComm')}}"
        var getBankFee = "{{route('ajax.customer.getBankFeeByPaymentMethod')}}";
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

        $(document).on('mouseover', '.open-jquery-date', function () {
            let start_date_class = $(this).hasClass('flatpickr-input');
            if (!start_date_class) {
                $(this).flatpickr({
                    dateFormat: "d/m/Y",
                    allowInput:true
                });
            }
        });

        $(document).on('click', 'select', () => {
            $('select').next('.text-danger').text('');
        })

        $(document).on('click', 'input', () => {
            $('input').next('.text-danger').text('');
        })

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
            // let optionFee = $('#bank_fee option:selected')
            // let feeAmount = optionFee.val()
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
                //fee = parseFloat(feeAmount * net_amount / 100).toFixed(2)
                // fee = parseFloat((net_amount - extra) * feeAmount /100).toFixed(2);
                fee = parseFloat((parseFloat(net_amount) + parseFloat(extendFee)) * bankFee ).toFixed(2);
            }
            // 12,345.67
            // .replace(/\d(?=(\d{3})+\.)/g, '$&,')
            $('#fee').val(fee);
            totalAmount()
        }

        function callFeeByPayment() {
            calFee();
            totalAmount();
        }

        function ajaxGetRef() {
            _country = $('#service_country').val()
            _dichvu = $('#type_service').val()
            if (_country != '' && _dichvu != '') {
                $.get(getRef, { country: _country, dichvu: _dichvu }, function (data) {
                    // $('#ref_no').val(data);
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
            console.log('get Com');
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
                    console.log(data['text_comm_agent']);
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
            // if(gst == 1){
            //     comValue = (result).toFixed(2);
            // }else if(gst == 2){
            //     comValue = (result / 1.1).toFixed(2);
            // }
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
            $(document).on('change','#agent_id, #provider_id, #policy, #net_amount',() => {
                ajaxGetComm();
                calcGst();
            })
            $(document).on('change','#type_payment_agent_id',() => {
                totalAmount();
            })

            $(document).on('change','#provider_id',() => {

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

            $(document).on('change','#provider_id',() => {
                ajaxGetRef()
            })

            $(document).on('change','#payment_method, #net_amount',() => {
                //ajaxGetSu();
                ajaxGetBankFee()
            })

            $(document).on('change','#agent_id',() => {
                country()
            })

            $(document).on('change','#promotion_id',() => {
                promotion()
            })

            $(document).on('change','#bank_fee, #net_amount, #extra, #type_extra, #extend_fee',() => {
                calFee()
            })

            $(document).on('change','#type_service',() => {
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

            $(document).on('change','#no_of_adults',() => {
                _num = $(this).val()
                $.get(formPartner, { num: _num }, function (data) {
                    $('#partner_div').html(data)
                })
            })
            $(document).on('change','#no_of_children',() => {
                _num = $(this).val()
                $.get(formChild, { num: _num }, function (data) {
                    $('#child_div').html(data)
                })
            })

            localStorage.removeItem('comms')

            $(document).on('change','.add_new_comm',() => {
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

            $(document).on('change','.add_contact',() => {
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

        function ajaxGetComm() {
            console.log('get Com');
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
                    console.log(data['text_comm_agent']);
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
    </script>
@endpush
