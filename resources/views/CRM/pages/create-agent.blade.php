@extends('CRM.layouts.default')

@section('title')
    CREATE AGENT
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
    @include('CRM.elements.form-agent')
@stop

@section('js')
    <script>
        var ajax_url = $('#ajax_crm_url').val()

        var createContact = '{{route('crm.createContact')}}'
        var delContact = '{{route('crm.delContact')}}'
        var storeContact = '{{route('crm.storeContact')}}'
        var editContact = '{{route('crm.editContact')}}'
        var updateContact = '{{route('crm.updateContact')}}'

        // var createContact = ajax_url + "ajax/createContact";
        // var delContact = ajax_url + "ajax/delContact";
        // var storeContact = ajax_url + "ajax/storeContact";
        // var editContact = ajax_url + "ajax/editContact";
        // var updateContact = ajax_url + "ajax/updateContact";


        //SEARCH COMMISSION
        function search(_service, _policy, myArray) {
            for (var i = 0; i < myArray.length; i++) {
                if (myArray[i].service == _service && myArray[i].policy == _policy) {
                    return myArray[i]
                }
            }
            return null
        }

        $(document).on('click', '.add-comm-slide-show', function (e) {
            e.preventDefault()
            $('#comm-form').slideDown()
        })

        jQuery(document).ready(function ($) {

            //////////////////////// [START COMMISION] //////////////////
            localStorage.removeItem('comms')

            $('.add_new_comm').click(function () {
                var _service = $('#service').val()
                var _policy = $('#policy').val()
                var _commission = $('#commission').val()
                var _donvi = $('#donvi_comm').val()
                var _gst = $('#gst_comm').val()
                var _end_date = $('#end_date').val()
                var _type_payment = $('#type_payment_comm').val()
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
                            'donvi': _donvi,
                            'gst': _gst,
                            'type_payment': _type_payment,
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
                        $('#comm-form').removeClass('show')
                        reset_form_add_new_comm()
                        load_data_comm()
                    } else {
                        document.write('Your browser can not support storage !')
                    }
                }
            })

            function reset_form_add_new_comm() {
                $('#service').val($('#service option:first').val())
                $('#policy').val($('#policy option:first').val())
                $('#commission').val('')
                $('#end_date').val('')
                $('#gst_comm').val($('#gst_comm option:first').val())
                $('#donvi_comm').val($('#donvi_comm option:first').val())
                $('#type_payment_comm').val($('#type_payment_comm option:first').val())
            }

            function load_data_comm() {
                $('#table_comm').empty()
                if (typeof (Storage) !== 'undefined') {
                    if (localStorage.getItem('comms') && localStorage.getItem('comms').length > 0) {

                        dataObject = JSON.parse(localStorage.getItem('comms'))
                        var _html = '<tr>'
                        var _data_hidden = ''
                        console.log(dataObject)
                        for (i = 0; i < dataObject.length; i++) {
                            _src = $('#info_service_' + dataObject[i]['service']).data('src')
                            _name = $('#info_service_' + dataObject[i]['service']).data('name')
                            _policy = dataObject[i]['policy']
                            _gst = dataObject[i]['gst']
                            _donvi = dataObject[i]['donvi']
                            _type_payment = dataObject[i]['type_payment']

                            // SET VALUE

                            _data_hidden += '<input type="hidden" name="type_service[]" value="' + dataObject[i]['service'] + '" >'
                            _data_hidden += '<input type="hidden" name="type[]" value="' + dataObject[i]['policy'] + '" >'
                            _data_hidden += '<input type="hidden" name="comm[]" value="' + dataObject[i]['commission'] + '" >'
                            _data_hidden += '<input type="hidden" name="date[]" value="' + dataObject[i]['end_date'] + '" >'
                            _data_hidden += '<input type="hidden" name="donvi[]" value="' + dataObject[i]['donvi'] + '" >'
                            _data_hidden += '<input type="hidden" name="gst[]" value="' + dataObject[i]['gst'] + '" >'
                            _data_hidden += '<input type="hidden" name="type_payment[]" value="' + dataObject[i]['type_payment'] + '" >'

                            // DISPLAY TO TABLE
                            if (_policy == 1) {
                                _policy = 'Single'
                            } else if (_policy == 2) {
                                _policy = 'Couple'
                            } else {
                                _policy = 'Family'
                            }

                            if (_gst == 1) {
                                textGST = 'Include'
                            } else {
                                textGST = 'No include'
                            }

                            if (_donvi == 1) {
                                textComm = dataObject[i]['commission'] + '%'
                            } else {
                                textComm = dataObject[i]['commission'] + '$'
                            }

                            if (_type_payment == 1) {
                                textPayment = 'Monthly'
                            } else if (_type_payment == 2) {
                                textPayment = 'Deduction com'
                            } else {
                                textPayment = ''
                            }

                            _html += '<tr>'
                            _html += '<td>' + _name + '</td>'
                            _html += '<td>' + _policy + '</td>'
                            _html += '<td class="text-center">' + textComm + '</td>'
                            _html += '<td>' + textGST + '</td>'
                            _html += '<td>' + textPayment + '</td>'
                            _html += '<td>' + dataObject[i]['end_date'] + '</td>'
                            _html += '<td class="del_comm" data-id="' + i + '"><span class="far fa-trash-alt"></span></td>'
                            _html += '</tr>'
                        }

                        console.log(_html)
                        $('#table_comm').html(_html)
                        $('#data-hidden').html(_data_hidden)
                    } else {
                        $('#table_comm').html('Not have commission')
                    }
                } else {
                    document.write('Your browser can not support storage !')
                }
            }

            $('#table_comm').delegate('.del_comm', 'click', function () {
                $('#table_comm').empty()
                if (typeof (Storage) !== 'undefined') {
                    if (localStorage.getItem('comms') && localStorage.getItem('comms').length > 0) {
                        dataObject = JSON.parse(localStorage.getItem('comms'))
                        _index = $(this).data('id')
                        dataObject.splice(_index, 1)
                        localStorage.setItem('comms', JSON.stringify(dataObject))
                        load_data_comm()
                    } else {
                        $('#table_comm').html('Not have commission')
                    }
                } else {
                    document.write('Your browser can not support storage !')
                }
            })

            //////////////////////// [END COMMISION] //////////////////

            //////////////////CONTACT/////////////////////

            localStorage.removeItem('contact')

            $(document).on('click', '.btn-submit-contact', function () {
                var _name = $('#new_name').val()
                var _position = $('#new_position').val()
                var _phone = $('#new_phone').val()
                var _birthday = $('#new_birthday').val()
                var _email = $('#new_email').val()
                var _skype = $('#new_skype').val()
                var _facebook = $('#new_facebook').val()
                var _note = $('#new_note').val()
                var _status = $('#new_status').val()
                var _is_receive_comm = $('#is_receive_comm').val()
                var _acc_name = $('#acc_name').val()
                var _bank = $('#bank').val()
                var _currency = $('#currency').val()
                var _bank_address = $('#bank_address').val()
                var _receiver_address = $('#receiver_address').val()
                var _swift_code = $('#swift_code').val()
                var _check_counsellor = $('#check_counsellor').is(':checked') ? 1 : 2;
                var _com_counsellor = $('#com_counsellor').val();

                dataObject = []
                if (typeof (Storage) !== 'undefined') {
                    if (localStorage.getItem('contact') && localStorage.getItem('contact').length > 0) {
                        dataObject = JSON.parse(localStorage.getItem('contact'))
                    }
                    dataObj = {
                        'name': _name,
                        'position': _position,
                        'phone': _phone,
                        'birthday': _birthday,
                        'email': _email,
                        'skype': _skype,
                        'facebook': _facebook,
                        'note': _note,
                        'status': _status,
                        'is_receive_comm': _is_receive_comm,
                        'acc_name': _acc_name,
                        'bank': _bank,
                        'currency': _currency,
                        'bank_address': _bank_address,
                        'receiver_address': _receiver_address,
                        'swift_code': _swift_code,
                        'is_counsellor': _check_counsellor,
                        'com_counsellor': _com_counsellor,
                    }
                    dataObject.push(dataObj)
                    localStorage.setItem('contact', JSON.stringify(dataObject))
                    retrivedOjects = localStorage.getItem('contact')
                    $('#modal_create_contact').modal('hide')
                    reset_modal_create_contact()
                    load_data_contact()
                } else {
                    document.write('Your browser can not support storage !')
                }
            })

            function load_data_contact() {
                $('#table_contact_body').empty()
                if (typeof (Storage) !== 'undefined') {
                    if (localStorage.getItem('contact') && localStorage.getItem('contact').length > 0) {
                        dataObject = JSON.parse(localStorage.getItem('contact'))
                        var _html = '<tr>'
                        var _data_hidden = ''
                        console.log(dataObject)
                        for (i = 0; i < dataObject.length; i++) {

                            // SET VALUE

                            _data_hidden += '<input type="hidden" name="type_service[]" value="' + dataObject[i]['service'] + '" >'
                            _data_hidden += '<input type="hidden" name="type[]" value="' + dataObject[i]['policy'] + '" >'
                            _data_hidden += '<input type="hidden" name="comm[]" value="' + dataObject[i]['commission'] + '" >'
                            _data_hidden += '<input type="hidden" name="date[]" value="' + dataObject[i]['end_date'] + '" >'
                            _data_hidden += '<input type="hidden" name="donvi[]" value="' + dataObject[i]['donvi'] + '" >'
                            _data_hidden += '<input type="hidden" name="gst[]" value="' + dataObject[i]['gst'] + '" >'
                            _data_hidden += '<input type="hidden" name="type_payment[]" value="' + dataObject[i]['type_payment'] + '" >'

                            _html += '<th scope="row">' + i + '</th>'
                            _html += '<td class="c_name">' + dataObject[i]['name'] + '</td>'
                            _html += '<td class="c_position">' + dataObject[i]['position'] + '</td>'
                            _html += '<td class="c_phone">' + dataObject[i]['phone'] + '</td>'
                            _html += '<td class="c_birthday">' + dataObject[i]['birthday'] + '</td>'
                            _html += '<td class="c_email">' + dataObject[i]['email'] + '</td>'
                            _html += '<td class="c_skype">' + dataObject[i]['skype'] + '</td>'
                            _html += '<td class="c_facebook">' + dataObject[i]['facebook'] + '</td>'
                            _html += '<td class="c_note">' + dataObject[i]['note'] + '</td>'
                            _html += '<td class="c_is_receive_comm">' + dataObject[i]['is_receive_comm'] + '</td>'
                            _html += '<td class="c_acc_name">' + dataObject[i]['acc_name'] + '</td>'
                            _html += '<td class="c_bank">' + dataObject[i]['bank'] + '</td>'
                            _html += '<td class="c_receiver_address">' + dataObject[i]['receiver_address'] + '</td>'
                            _html += '<td class="c_currency">' + dataObject[i]['currency'] + '</td>'
                            _html += '<td class="c_bank_address">' + dataObject[i]['bank_address'] + '</td>'
                            _html += '<td class="c_swift_code">' + dataObject[i]['swift_code'] + '</td>'

                            _html += '<td>'
                            _html += '<a class="del_contact" href="#!" data-id="' + i + '"><span class="far fa-trash-alt "></span></a>'
                            _html += '</td>'
                            _html += '<input type="hidden" name="contact_name[]" value="' + dataObject[i]['name'] + '">'
                            _html += '<input type="hidden" name="contact_position[]" value="' + dataObject[i]['position'] + '">'
                            _html += '<input type="hidden" name="contact_phone[]" value="' + dataObject[i]['phone'] + '">'
                            _html += '<input type="hidden" name="contact_birthday[]" value="' + dataObject[i]['birthday'] + '">'
                            _html += '<input type="hidden" name="contact_email[]" value="' + dataObject[i]['email'] + '">'
                            _html += '<input type="hidden" name="contact_skype[]" value="' + dataObject[i]['skype'] + '">'
                            _html += '<input type="hidden" name="contact_facebook[]" value="' + dataObject[i]['facebook'] + '">'
                            _html += '<input type="hidden" name="contact_note[]" value="' + dataObject[i]['note'] + '">'
                            _html += '<input type="hidden" name="contact_is_receive_comm[]" value="' + dataObject[i]['is_receive_comm'] + '">'
                            _html += '<input type="hidden" name="contact_acc_name[]" value="' + dataObject[i]['acc_name'] + '">'
                            _html += '<input type="hidden" name="contact_bank[]" value="' + dataObject[i]['bank'] + '">'
                            _html += '<input type="hidden" name="contact_receiver_address[]" value="' + dataObject[i]['receiver_address'] + '">'
                            _html += '<input type="hidden" name="contact_currency[]" value="' + dataObject[i]['currency'] + '">'
                            _html += '<input type="hidden" name="contact_bank_address[]" value="' + dataObject[i]['bank_address'] + '">'
                            _html += '<input type="hidden" name="contact_swift_code[]" value="' + dataObject[i]['swift_code'] + '">'
                            _html += '<input type="hidden" name="contact_is_counsellor[]" class="contact_is_counsellor" value="' + dataObject[i]['is_counsellor'] + '">'
                            _html += '<input type="hidden" name="contact_com_counsellor[]" class="contact_com_counsellor" value="' + dataObject[i]['com_counsellor'] + '">'

                            _html += '<tr>'
                        }
                        $('#table_contact_body').html(_html)
                    } else {
                        $('#table_contact_body').html('Not have contact')
                    }
                } else {
                    document.write('Your browser can not support storage !')
                }
            }

            $(document).delegate('.del_contact', 'click', function () {
                $('#table_contact_body').empty()
                if (typeof (Storage) !== 'undefined') {
                    if (localStorage.getItem('contact') && localStorage.getItem('contact').length > 0) {
                        dataObject = JSON.parse(localStorage.getItem('contact'))
                        _index = $(this).data('id')
                        dataObject.splice(_index, 1)
                        localStorage.setItem('contact', JSON.stringify(dataObject))
                        load_data_contact()
                    } else {
                        $('#table_contact_body').html('Not have contact')
                    }
                } else {
                    document.write('Your browser can not support storage !')
                }
            })

            ////////////////////////////////////////////////

            $('.add_contact').click(function () {
                $.get(createContact, {}, function (data) {
                    $('#div_modal_contact').html(data)
                    $('#modal_create_contact').modal('toggle')
                })
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
                _is_receive_comm = $('#is_receive_comm').val()
                _acc_name = $('#acc_name').val()
                _bank = $('#bank').val()
                _currency = $('#currency').val()
                _bank_address = $('#bank_address').val()
                _receiver_address = $('#receiver_address').val()
                _swift_code = $('#swift_code').val()
                _check_counsellor = $('#check_counsellor').is(':checked') ? 1 : 2;
                _com_counsellor = $('#com_counsellor').val();
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
                    is_receive_comm: _is_receive_comm,
                    acc_name: _acc_name,
                    bank: _bank,
                    currency: _currency,
                    bank_address: _bank_address,
                    receiver_address: _receiver_address,
                    swift_code: _swift_code,
                    is_counsellor: _check_counsellor,
                    com_counsellor: _com_counsellor
                }, function (data) {
                    $('#table_contact_body').html(data)
                })
                reset_modal_create_contact()
                $('#modal_create_contact').modal('toggle')
            })

            function reset_modal_create_contact() {
                $('#new_name').val('')
                $('#new_position').val('')
                $('#new_phone').val('')
                $('#new_birthday').val('')
                $('#new_email').val('')
                $('#new_skype').val('')
                $('#new_facebook').val('')
                $('#new_note').val('')
                $('#is_receive_comm').val('')
                $('#acc_name').val('')
                $('#bank').val('')
                $('#currency').val('')
                $('#bank_address').val('')
                $('#receiver_address').val('')
                $('#swift_code').val('')
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
    @include('CRM.elements.agents.partials.js.popup_form_commission')
@stop
