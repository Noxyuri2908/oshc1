@extends('CRM.layouts.default')

@section('title')
    EDIT AGENT
    @parent
@stop

@section('css')
    <style>

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
    @include('CRM.partials.css-table-filter')
@stop

@section('content')

    @include('CRM.elements.form-agent')
@stop

@push('scripts')
    <script>

        var createContact = ''
        var delContact = '{{route('crm.delContact')}}'
        var storeContact = '{{route('crm.storeContact')}}'
        var editContact = '{{route('crm.editContact')}}'
        var updateContact = '{{route('crm.updateContact')}}'

        // $('').click(function () {
        //     $.get(createContact, {}, function (data) {
        //
        //     });
        // });
        $(document).on('click', '.add_contact', function (e) {
            e.preventDefault()
            var _url = $(this).attr('data-url')
            $.ajax({
                url: _url,
                type: 'get',
                success: function (data) {
                    $('#div_modal_contact').html(data)
                    $('#modal_create_contact').modal('toggle')
                },
                error: function (xhr) {
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText)
                },
            })
        })
        // $("#table_contact").delegate(".edit_contact", "click", function(){
        //     _id = $(this).data('id');
        //     $.get(editContact, {id: _id}, function (data) {
        //         $('#div_modal_contact').html(data);
        //         $('#modal_create_contact').modal('toggle');
        //     });
        // });
        $('#table_contact').delegate('.del_contact', 'click', function () {
            _id = $(this).data('id')
            $.get(delContact, {id: _id}, function (data) {
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
            _is_receive_comm = $('#is_receive_comm').val()
            _acc_name = $('#acc_name').val()
            _bank = $('#bank').val()
            _currency = $('#currency').val()
            _bank_address = $('#bank_address').val()
            _receiver_address = $('#receiver_address').val()
            _swift_code = $('#swift_code').val()
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

        function getDataContact() {
            $.ajax({
                url: '{{route('agent.getDataContactList',['id'=>$obj->id])}}',
                type: 'get',
                success: function (data) {
                    $('#table_contact_body').html(data)
                },
                error: function (xhr) {
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText)
                },
            })
        }

        getDataContact()
        $(document).on('click', '.edit_contact', function (e) {
            e.preventDefault()
            // _url = $(this).attr('data-url');
            _id = $(this).attr('data-id')
            _name = $('#data-agent-contact_' + _id + ' .c_name').text()
            _position = $('#data-agent-contact_' + _id + ' .c_position').text()
            _phone = $('#data-agent-contact_' + _id + ' .c_phone').text()
            _birthday = $('#data-agent-contact_' + _id + ' .c_birthday').text()
            _email = $('#data-agent-contact_' + _id + ' .c_email').text()
            _skype = $('#data-agent-contact_' + _id + ' .c_skype').text()
            _facebook = $('#data-agent-contact_' + _id + ' .c_facebook').text()
            _note = $('#data-agent-contact_' + _id + ' .c_note').text()
            _is_receive_comm = $('#data-agent-contact_' + _id + ' .c_is_receive_comm').text()
            _acc_name = $('#data-agent-contact_' + _id + ' .c_acc_name').text()
            _bank = $('#data-agent-contact_' + _id + ' .c_bank').text()
            _currency = $('#data-agent-contact_' + _id + ' .c_currency').text()
            _bank_address = $('#data-agent-contact_' + _id + ' .c_bank_address').text()
            _receiver_address = $('#data-agent-contact_' + _id + ' .c_receiver_address').text()
            _swift_code = $('#data-agent-contact_' + _id + ' .c_swift_code').text()

            $.ajax({
                url: '{{route('agent.getModalFormContact')}}',
                data: {
                    id: _id,
                    name: _name,
                    position: _position,
                    phone: _phone,
                    birthday: _birthday,
                    email: _email,
                    skype: _skype,
                    facebook: _facebook,
                    note: _note,
                    is_receive_comm: _is_receive_comm,
                    acc_name: _acc_name,
                    bank: _bank,
                    currency: _currency,
                    bank_address: _bank_address,
                    receiver_address: _receiver_address,
                    swift_code: _swift_code,
                },
                type: 'get',
                success: function (data) {
                    $('#div_modal_contact').html(data)
                    $('#modal_create_contact').modal('toggle')
                },
            })
        })

        $(document).on('click', '.btn-submit-contact', function (e) {
            e.preventDefault()
            // _id = $(this).attr('data-id');
            _url = $(this).attr('data-url')
            _name = $('#new_name').val()
            _position = $('#new_position').val()
            _phone = $('#new_phone').val()
            _birthday = $('#new_birthday').val()
            _email = $('#new_email').val()
            _skype = $('#new_skype').val()
            _facebook = $('#new_facebook').val()
            _note = $('#new_note').val()
            _status = $('#new_status').val()
            _is_receive_comm = $('#is_receive_comm:checked').val() ?? null;
            _acc_name = $('#acc_name').val()
            _bank = $('#bank').val()
            _currency = $('#currency').val()
            _bank_address = $('#bank_address').val()
            _receiver_address = $('#receiver_address').val()
            _swift_code = $('#swift_code').val()
            $.ajax({
                url: _url,
                type: 'post',
                data: {
                    name: _name,
                    position: _position,
                    phone: _phone,
                    birthday: _birthday,
                    email: _email,
                    skype: _skype,
                    facebook: _facebook,
                    note: _note,
                    status: _status,
                    _token: '{{csrf_token()}}',
                    is_receive_comm: _is_receive_comm,
                    acc_name: _acc_name,
                    bank: _bank,
                    currency: _currency,
                    bank_address: _bank_address,
                    receiver_address: _receiver_address,
                    swift_code: _swift_code,
                },
                success: function (data) {
                    if (data.type == 'update') {
                        $('#data-agent-contact_' + data.id).replaceWith(data.view)
                    } else if (data.type == 'create') {
                        $('#table_contact_body').html(data.view)
                    }
                    $('#new_name').val('')
                    $('#new_position').val('')
                    $('#new_phone').val('')
                    $('#new_birthday').val('')
                    $('#new_email').val('')
                    $('#new_skype').val('')
                    $('#new_facebook').val('')
                    $('#new_note').val('')
                    $('#modal_create_contact').modal('hide')
                    $('#is_receive_comm').val('')
                    $('#acc_name').val('')
                    $('#bank').val('')
                    $('#currency').val('')
                    $('#bank_address').val('')
                    $('#receiver_address').val('')
                    $('#swift_code').val('')
                },
                error: function (xhr) {
                    alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText)
                },
            })
        })
        $(document).on('click', '.del_contact', function (e) {
            e.preventDefault()
            var _url = $(this).attr('data-url')
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
                        url: _url,
                        type: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success',
                            )
                            $('#data-agent-contact_' + data.id).remove()
                        },
                        error: function (xhr) {
                            alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText)
                        },
                    })
                }
            })
        })
        // $("#mainContent").delegate(".btn-submit-contact", "click", function(){
        //     _id = $(this).attr('data-id');
        //     _name = $('#new_name').val();
        //     _position = $('#new_position').val();
        //     _phone = $('#new_phone').val();
        //     _birthday = $('#new_birthday').val();
        //     _email = $('#new_email').val();
        //     _skype = $('#new_skype').val();
        //     _facebook = $('#new_facebook').val();
        //     _note = $('#new_note').val();
        //     _status = $('#new_status').val();
        //     if(_name != null && _name != "" && _phone != null && _phone != "" && _email != null && _email != ""){
        //         $.get(storeContact, {
        //             id:_id,
        //             name: _name,
        //             position: _position,
        //             phone: _phone,
        //             birthday: _birthday,
        //             email: _email,
        //             skype: _skype,
        //             facebook: _facebook,
        //             note: _note,
        //             status: _status
        //         }, function (data) {
        //             if(_id){
        //                 $('#data-agent-contact_'+_id).html(data);
        //             }else{
        //                 $('#table_contact_body').append(data);
        //             }

        //         });
        //         $('#modal_create_contact').modal('toggle');
        //     }
        // });
        // //

        $(document).on('click', '.del_comm', function (e) {
            e.preventDefault()
            let _id_comm = $(this).data('id')
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
                        url: "{{route('ajax.ajaxDeleteCommAgent')}}",
                        type: 'post',
                        data: {
                            id: _id_comm,
                            _token: "{{csrf_token()}}",
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your data has been deleted.',
                                'success',
                            )
                            $('.validate-form-agent-error').html(data.error)
                            $('.validate-form-agent-success').html('')
                            $('.validate-form-agent-error').html('')
                            $('.validate-form-agent-success').html('Update success')
                            $('#table_comm').html(data)
                        },
                    })
                }
            })

        })
        $(document).on('click', '.add-comm-slide-show', function (e) {
            e.preventDefault()
            $('#service option').each(function () {
                $(this).removeAttr('selected')
            })
            $('#policy option').each(function () {
                $(this).removeAttr('selected')
            })
            $('#donvi_comm option').each(function () {
                $(this).removeAttr('selected')
            })
            // $('#gst_comm option').each(function () {
            //     $(this).removeAttr('selected')
            // })
            $('#type_payment_comm option').each(function () {
                $(this).removeAttr('selected')
            })
            $('#commission').val('')
            $('#end_date').val('')
            $('.add_new_comm').text('Create')
            $('.add_new_comm').attr('data-action', 'create')
            $('.add_new_comm').removeAttr('data-id_comm')
            $('.validate-form-agent-success').html('')
            $('.validate-form-agent-error').html('')
            $('#comm-form').slideDown()
        })

        $(document).on('click', '#add_new_comm', function (e) {
            var me = $(this)
            if (me.data('requestRunning')) {
                return
            }
            me.data('requestRunning', true)

            var _user_id = "{{$obj->id}}"
            var _service = $('#service').val()
            var _policy = $('#policy').val()
            var _commission = $('#commission').val()
            var _donvi_comm = $('#donvi_comm').val()
            var _gst_comm = $('#gst_comm').val()
            var _type_payment_comm = $('#type_payment_comm').val()
            var _end_date = $('#end_date').val()
            var _html = ''
            var _id_comm = $(this).data('id_comm')
            var _action = $(this).text()
            if (_commission == null || _commission == '') {
                _html += '<div>Commission number can not blank</div>'
            }
            if (_end_date == null || _end_date == '') {
                _html += '<div>Validity date can not blank</div>'
            }
            if (_html == null || _html == '') {
                if (_action == 'Save') {
                    $.ajax({
                        url: "{{route('ajax.ajaxUpdateCommAgent')}}",
                        type: 'post',
                        data: {
                            provider_id: _service,
                            policy: _policy,
                            comm: _commission,
                            donvi: _donvi_comm,
                            type_payment: _type_payment_comm,
                            validity_start_date: _end_date,
                            gst: _gst_comm,
                            type_store: 'ajax',
                            user_id: _user_id,
                            _token: "{{csrf_token()}}",
                            status: 1,
                            id: _id_comm,
                        },
                        success: function (data) {
                            me.data('requestRunning', false)
                            if (typeof data == 'object') {
                                $('.validate-form-agent-error').html(data.error)
                                $('.validate-form-agent-success').html('')
                            } else if (typeof data == 'string') {
                                $('#table_comm').html(data)
                                $('.validate-form-agent-error').html('')
                                $('.validate-form-agent-success').html('Update success')
                            }
                        },
                    })
                } else if (_action == 'Create') {
                    $.ajax({
                        url: '{{route('com.store')}}',
                        type: 'post',
                        data: {
                            provider_id: _service,
                            policy: _policy,
                            comm: _commission,
                            donvi: _donvi_comm,
                            type_payment: _type_payment_comm,
                            validity_start_date: _end_date,
                            gst: _gst_comm,
                            type_store: 'ajax',
                            user_id: _user_id,
                            _token: "{{csrf_token()}}",
                            status: 1,
                        },
                        success: function (data) {
                            me.data('requestRunning', false)
                            if (typeof data == 'object') {
                                $('.validate-form-agent-error').html(data.error)
                                $('.validate-form-agent-success').html('')
                            } else if (typeof data == 'string') {
                                $('#table_comm').html(data)
                                $('.validate-form-agent-error').html('')
                                $('.validate-form-agent-success').html('Success')
                            }
                        },
                    })
                }
            } else {
                $('.validate-form-agent-error').html(_html)
            }
        })

        $(document).on('click', '.edit_comm', function (e) {
            var me = $(this)
            if (me.data('requestRunning')) {
                return
            }
            me.data('requestRunning', true)

            e.preventDefault()
            let _id_comm = $(this).data('id')
            $.ajax({
                url: "{{route('ajax.editComAgent')}}",
                type: 'get',
                data: {
                    id: _id_comm,
                },
                success: function (data) {
                    $('#service').val(data.comm.service.id);
                    $('#policy').val(data.comm.policy)

                    $('#donvi_comm option').each(function () {
                        if ($(this).val() == data.comm.donvi) {
                            $(this).attr('selected', 'selected')
                        }
                    })
                    $('#gst_comm option').each(function () {
                        if ($(this).val() == data.comm.gst) {
                            $(this).attr('selected', 'selected')
                        }
                    })
                    $('#type_payment_comm option').each(function () {
                        if ($(this).val() == data.comm.type_payment) {
                            $(this).attr('selected', 'selected')
                        }
                    })
                    console.log(data.comm.validity_start_date)
                    $('#commission').val(data.comm.comm)
                    $('#end_date').val(data.comm.validity_start_date)
                    $('.add_new_comm').text('Save')
                    $('#add_new_comm').attr('data-action', 'edit')
                    $('#add_new_comm').attr('data-id_comm', data.comm.id)
                    $('.validate-form-agent-success').html('')
                    $('.validate-form-agent-error').html('')
                    $('#comm-form').slideDown()
                    me.data('requestRunning', false)
                },
            })
        })
    </script>
    @include('CRM.elements.agents.partials.js.popup_form_commission')
@endpush
