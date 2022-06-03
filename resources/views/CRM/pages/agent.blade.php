@extends('CRM.layouts.default')

@section('title')
    AGENT MANAGEMENT
    @parent
@stop

@section('css')
    @include('CRM.partials.loading-css')
    <style>
        *, body a, body input, body select {
            font-size: 12px;
        }

        .table-main-agent .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .table-div .form-control {
            height: 28px;
        }

        .table-div {
            max-width: 100%;
            position: relative;
            overflow: scroll;
            height: 23em;
            max-height: 23em;
        }

        .table-main-agent table, .table-div table {
            position: relative;
            border-collapse: collapse;
            white-space: nowrap;
            table-layout: fixed;
            width: 100%;
        }

        .table-main-agent td,
        .table-main-agent th,
        .table-div td,
        .table-div th {
            padding: 0.25em;
        }

        .table-main-agent thead .first-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            background: #ef4b88;
            color: #fff;
            height: 25px;
        }

        #myTabContent thead .first-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            background: #6fcbd2;
            color: #fff;
            height: 25px;
        }

        thead .last-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            background: #eae7e7;
            color: #fff;

        }

        /*thead .last-row input,thead .last-row select{*/
        /*    font-size: 12px;*/
        /*}*/

        .top-80 {
            top: 25px;
        }

        .last-row th {
            top: 25px;

        }

        .table-div thead.customer-thead th input, .table-div thead.customer-thead th select, .table-div tbody th, .table-div tbody td {
            font-size: 12px;
            padding: 0.1px;
        }

        .table-main-agent thead.customer-thead .first-row th:first-child,
        .table-main-agent thead.customer-thead .last-row th:first-child {
            left: 0;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(2),
        .table-main-agent thead.customer-thead .last-row th:nth-child(2) {
            left: 40px;
            z-index: 3;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(3),
        .table-main-agent thead.customer-thead .last-row th:nth-child(3) {
            left: 90px;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(4),
        .table-main-agent thead.customer-thead .last-row th:nth-child(4) {
            left: 190px;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(5),
        .table-main-agent thead.customer-thead .last-row th:nth-child(5) {
            left: 290px;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(6),
        .table-main-agent thead.customer-thead .last-row th:nth-child(6) {
            left: 390px;
            z-index: 2;
        }

        .table-main-agent thead.customer-thead .first-row th:nth-child(7),
        .table-main-agent thead.customer-thead .last-row th:nth-child(7) {
            left: 490px;
            z-index: 2;
        }

        .table-main-agent tbody .first-col {
            left: 0;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody .second-col {
            left: 40px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody .third-col {
            left: 90px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-agent tbody .fourth-col {
            left: 190px;
            z-index: 1;
            background-color: #fff;
        }

        /*.table-main-agent tbody tr td:nth-child(5) {*/
        /*    left: 290px;*/
        /*    z-index: 1;*/
        /*    background-color: #fff;*/
        /*}*/

        /*.table-main-agent tbody tr td:nth-child(6) {*/
        /*    left: 390px;*/
        /*    z-index: 1;*/
        /*    background-color: #fff;*/
        /*}*/

        /*.table-main-agent tbody tr td:nth-child(7) {*/
        /*    left: 490px;*/
        /*    z-index: 1;*/
        /*    background-color: #fff;*/
        /*}*/

        .table-main-agent tbody .sticky-col {
            position: sticky;
        }

        /* tbody th {*/
        /*    position: -webkit-sticky;*/
        /*    position: sticky;*/
        /*    left: 0;*/
        /*    background: #FFF;*/
        /*    border-right: 1px solid #CCC;*/
        /*}*/
        tbody th, tbody td {
            border-bottom: 1px solid #ccc;
        }

        .width-40 {
            width: 40px;
        }

        .width-50 {
            width: 50px;
        }

        .width-80 {
            width: 80px;
        }

        .width-220 {
            width: 220px;
        }

        .width-170 {
            width: 170px;
        }

        .width-150 {
            width: 150px;
        }

        .width-200 {
            width: 200px;
        }

        .width-250 {
            width: 250px;
        }

        .width-500 {
            width: 500px;
        }

        .width-300 {
            width: 300px;
        }

        .width-100 {
            width: 100px;
        }

        .width-120 {
            width: 120px;
        }

        .width-140 {
            width: 140px;
        }

        .text-overflow {
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .white-space-pre-text {
            white-space: pre;
        }

        .bg-pale-gray {
            background-color: #eae7e7
        }

        .table-div select {
            padding: 0 20px;
        }

        #sale_task .card-body {
            padding: 0.5%;
        }

        #sale_task h5 {
            font-family: 'roboto', sans-serif !important;
            font-weight: 600;
        }

        .process-hover-dropdown:hover .dropdown-menu {
            display: block;
        }

        .filter-btn-second-table {
            position: absolute;
            right: 20px;
            top: 8px;
        }

        .font-size-14px {
            font-size: 14px;
        }

        .font-size-12px {
            font-size: 12px;
        }

        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
            border-bottom: 3px solid #6fcbd2;
            background-color: transparent;
        }

        .nav-tabs .nav-link {
            border: 0px;
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }

    </style>
@stop
@section('content')
    @include('CRM.elements.table-agent')
    <div class="loading-fixed-top">Loading&#8230;</div>
@stop

@section('js')
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/filemanage.js')}}"></script>
    <script>
        var ajax_url = $('#ajax_crm_url').val()
        var getAgentInfo = '{{route('crm.ajax.getAgentInfo')}}'
        var getContactInfo = '{{route('crm.ajax.getContactInfo')}}'
        var getAgentComm = '{{route('crm.ajax.getCommInfo')}}'
        var getAgentSp = '{{route('crm.ajax.getSupport')}}'
        var getFillterAgent = '{{route('crm.ajax.fillterAgent')}}'
        var getStatusAgent = '{{route('crm.ajax.statusAgent')}}'
        var getSearchAgent = '{{route('crm.ajax.searchAgent')}}'
        var readyGetComm = true;
        jQuery(document).ready(function ($) {

            // start marketing-support
            $(document).on('click', '.delete-marketing-support-agent', function (e) {
                e.preventDefault()
                let id = $(this).attr('data-id')
                let _url = $(this).attr('data-url')
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
                                _token: "{{csrf_token()}}",
                            },
                            success: function (data) {
                                $('#marketing-support-table').html(data)
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                )
                                $('#modal_marketing_support').modal('hide')
                            },
                        })
                    }
                })
            })
            $(document).on('click', '#btn_add_new_marketing_support', function (e) {
                e.preventDefault()
                var id = $(this).attr('data-id')
                if (id != null && id != '') {
                    $.ajax({
                        url: "{{route('crm.ajax.addNewMarketingSupport')}}",
                        type: 'get',
                        data: {
                            id: id,
                        },
                        success: function (data) {
                            $('#modal_marketing_support_form').html(data)
                            $('#modal_marketing_support').modal('toggle')
                        },
                    })
                } else {
                    alert('No data selected !')
                }
            })
            $(document).on('click', '.btn-submit-marketing-support-form', function (e) {
                e.preventDefault()
                let _url = $(this).attr('data-url')
                let _processing_date = $('#processing_date_marketing_support').val()
                let _issue = $('#issue_marketing_support').val()
                let _person_in_charge = $('#person_in_charge_marketing_support').val()
                let _marketing_support = $('#des_marketing_support').val()
                $.ajax({
                    url: _url,
                    type: 'post',
                    data: {
                        _token: "{{csrf_token()}}",
                        processing_date: _processing_date,
                        issue: _issue,
                        person_in_charge: _person_in_charge,
                        marketing_support: _marketing_support,
                    },
                    success: function (data) {
                        // console.log(data);
                        $('#marketing-support-table').html(data)
                        toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000})
                        $('#modal_marketing_support').modal('hide')
                    },
                })
            })
            $(document).on('click', '.edit-marketing-support-agent', function (e) {
                e.preventDefault()
                var id = $(this).attr('data-id')
                var agent_id = $(this).attr('data-agent_id')
                $.ajax({
                    url: "{{route('crm.ajax.editMarketingSupport')}}",
                    type: 'get',
                    data: {
                        id: id,
                        agent_id: agent_id,
                    },
                    success: function (data) {
                        $('#modal_marketing_support_form').html(data)
                        $('#modal_marketing_support').modal('toggle')
                    },
                })
            })
            //end marketing-supportss

            {{--$(document).on('click','.data-agent',function(e){--}}
            {{--    if(!$(this).hasClass('selected_row')){--}}
            {{--        var user_id = $(this).data('id');--}}
            {{--        $('#btn_add_new_follow').attr('data-id',user_id);--}}
            {{--        $('#btn_add_new_market_feedback').attr('data-id',user_id);--}}
            {{--        $('#btn_add_new_competition_feedback').attr('data-id',user_id);--}}
            {{--        $('#btn_add_new_marketing_support').attr('data-id',user_id);--}}
            {{--        $('#btn_add_new_proposal').attr('data-id',user_id);--}}
            {{--        $('.data-agent td').css('background-color','');--}}
            {{--        $('.data-agent').removeClass('selected_row');--}}
            {{--        $(this).children('td').css('background-color','#ccc');--}}
            {{--        $(this).addClass('selected_row');--}}
            {{--        $.ajax({--}}
            {{--            url:"{{route('crm.ajax.getFollowAgent')}}",--}}
            {{--            data:{--}}
            {{--                _token:"{{csrf_token()}}",--}}
            {{--                user_id:user_id--}}
            {{--            },--}}
            {{--            type:'post',--}}
            {{--            success:function(data){--}}
            {{--                $('#follow-ups-table').html(data);--}}
            {{--            }--}}
            {{--        })--}}
            {{--        $.ajax({--}}
            {{--            url:"{{route('crm.ajax.getMarketFeedback')}}",--}}
            {{--            data:{--}}
            {{--                _token:"{{csrf_token()}}",--}}
            {{--                user_id:user_id--}}
            {{--            },--}}
            {{--            type:'post',--}}
            {{--            success:function(data){--}}
            {{--                $('#market-feedback-table').html(data);--}}
            {{--            }--}}
            {{--        })--}}
            {{--        $.ajax({--}}
            {{--            url:"{{route('crm.ajax.getCompetitionFeedback')}}",--}}
            {{--            data:{--}}
            {{--                _token:"{{csrf_token()}}",--}}
            {{--                user_id:user_id--}}
            {{--            },--}}
            {{--            type:'post',--}}
            {{--            success:function(data){--}}
            {{--                $('#competition-feedback-table').html(data);--}}
            {{--            }--}}
            {{--        })--}}
            {{--        $.ajax({--}}
            {{--            url:"{{route('crm.ajax.getMarketingSupport')}}",--}}
            {{--            data:{--}}
            {{--                _token:"{{csrf_token()}}",--}}
            {{--                user_id:user_id--}}
            {{--            },--}}
            {{--            type:'post',--}}
            {{--            success:function(data){--}}
            {{--                $('#marketing-support-table').html(data);--}}
            {{--            }--}}
            {{--        })--}}
            {{--        $.ajax({--}}
            {{--            url:"{{route('crm.ajax.getProposal')}}",--}}
            {{--            data:{--}}
            {{--                _token:"{{csrf_token()}}",--}}
            {{--                user_id:user_id--}}
            {{--            },--}}
            {{--            type:'post',--}}
            {{--            success:function(data){--}}
            {{--                $('#proposal-table').html(data);--}}
            {{--            }--}}
            {{--        })--}}
            {{--    }--}}
            {{--})--}}
            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $('.sub_chk').prop('checked', true)
                } else {
                    $('.sub_chk').prop('checked', false)
                }
            })

            $('.btn_search').click(function () {
                search()
            })

            //$('#f_department, #f_period, #f_time, #f_country, #f_type, #f_status').change(function(){
            //	fillter();
            //});
            //
            //function fillter(){
            //	_department = $('#f_department').val();
            //	_period = $('#f_period').val();
            //	_time = $('#f_time').val();
            //	_country = $('#f_country').val();
            //	_type = $('#f_type').val();
            //	_status = $('#f_status').val();
            //	$.get(getFillterAgent, {department: _department, period: _period, time: _time, country: _country, type: _type, status: _status}, function (data) {
            //		console.log(data);
            //		$('#table_agent_body').html(data);
            //	});
            //}

            function search() {
                _name = $('#s_name').val()
                _type = $('#s_type').val()
                _city = $('#s_city').val()
                _skype = $('#s_skype').val()
                _contact_1 = $('#s_contact_1').val()
                _contact_2 = $('#s_contact_2').val()

                _person = $('#s_person').val()
                _status = $('#s_status').val()
                _makert = $('#s_makert').val()
                _office = $('#s_office').val()
                _website = $('#s_website').val()
                _tel_1 = $('#s_tel_1').val()
                _tel_2 = $('#s_tel_2').val()
                _agent_code = $('#s_agent_code').val()
                _email = $('#s_email').val()
                _country = $('#s_country').val()
                $.get(getSearchAgent, {
                    name: _name,
                    type: _type,
                    city: _city,
                    skype: _skype,
                    contact_1: _contact_1,
                    contact_2: _contact_2,
                    person: _person,
                    status: _status,
                    makert: _makert,
                    office: _office,
                    website: _website,
                    tel_1: _tel_1,
                    tel_2: _tel_2,
                    agent_code: _agent_code,
                    email: _email,
                    country: _country,
                }, function (data) {
                    console.log(data)
                    $('#table_agent_body').html(data)
                    $('#cutum-frm').slideUp('slow')
                })
            }

            $('#master').on('click', function (e) {
                checkBox()
            })

            function checkBox() {
                var checkBoxLength = $('.sub_chk:checked').length
                $('#count-checked').html(checkBoxLength)
                if (checkBoxLength > 0) {
                    $('#multi_action').show()
                } else if (checkBoxLength == 0) {
                    $('#multi_action').hide()
                }
            }

            $(document).on('click', '.sub_chk', function (e) {
                checkBox()
                if (!$(this).is(':checked', true)) {
                    $('#master').prop('checked', false)
                }
            })

            $('.cutum-frm-hide').click(function () {
                $('#cutum-frm').slideToggle()
            })
            $('.closes').click(function () {
                $('#cutum-frm').slideUp('slow')
            })

            $('#mainContent').delegate('.agent_info', 'click', function () {

                _id = $(this).data('id')
                $.get(getAgentInfo, {id: _id}, function (data) {
                    console.log(data)
                    $('#modal_agent').html(data)
                    $('#modal_agent_info').modal('show')
                })
            })

            $('#mainContent').on('click', '.agent_comm', function (e) {
                e.preventDefault();
                _id = $(this).data('id')
                if (readyGetComm == true) {
                    readyGetComm = false;
                    $.get(getAgentComm, {id: _id}, function (data) {
                        $('#div_modal_comm').html(data)
                        $('#modal_comm').modal('toggle')
                        readyGetComm = true;
                    })
                }

            })

            $('#mainContent').delegate('.agent_support', 'click', function () {
                _id = $(this).data('id')
                $.get(getAgentSp, {id: _id}, function (data) {
                    console.log(data)
                    $('#div_modal_support').html(data)
                    $('#modal_hisory_support').modal('toggle')
                })
            })

            $('#mainContent').delegate('.contact_info', 'click', function () {
                _id = $(this).data('id')
                $.get(getContactInfo, {id: _id}, function (data) {
                    console.log(data)
                    $('#modal_contact').html(data)
                    $('#modal_contact_info').modal('show')
                })
            })

            $('#mainContent').delegate('.send_email', 'click', function () {

                var allVals = []
                var emails = []
                var names = []
                var html = ''
                $('.sub_chk:checked').each(function () {
                    allVals.push($(this).attr('data-id'))
                    emails.push($(this).attr('data-email'))
                    names.push($(this).attr('data-name'))
                })
                if (allVals.length <= 0) {
                    alert('No data selected !')
                } else {
                    $('#modal_email_form').modal('show')
                    for (var i = 0; i < allVals.length; i++) {
                        html += '<tr>'
                        html += '<th scope="row">' + i + '</th>'
                        html += '<td><input type="text" class="form-control" name="send_name_invoice[]" value="' + names[i] + '"></td>'
                        html += '<td><input type="text" class="form-control" name="send_email_invoice[]" value="' + emails[i] + '"</td>'
                        html += '<td>'
                        html += '<button type="button" class="btn btn-danger remove-email">Delete</button>'
                        html += '</td>'
                        html += '</tr>'
                    }
                    $('#send-mail-data').html(html)
                }

                // var allVals = [];
                // $(".sub_chk:checked").each(function() {
                //   allVals.push($(this).attr('data-id'));
                // });
                // if(allVals.length <= 0){
                //   alert('No data selected !');
                // }else{
                // 	$('#modal_email_form').modal('show');
                // }
            })

            $('#mainContent').delegate('#type_content', 'change', function () {
                v = $(this).val()
                if (v == 1) {
                    $('.template_mail').css('display', 'block')
                    $('.fill_content').css('display', 'none')
                } else {
                    $('.template_mail').css('display', 'none')
                    $('.fill_content').css('display', 'block')
                }
                // $.get(getContactInfo, {id: _id}, function (data) {
                // 	console.log(data);
                // 	$('#modal_contact').html(data);
                // 	$('#modal_contact_info').modal('show');
                // });
            })

            // $("#mainContent").delegate(".submit_mail", "click", function(){
            // 	type_action = $('#type_action').val();
            // 	type_content = $('#type_content').val();
            // 	template_id = $('#template_id').val();
            // 	subject = $('#subject').val();
            // 	content = $('#content').val();
            // 	$('#modal_email_form').modal('toggle');
            // 	alert('Send email successful !');
            // });

            $(document).on('submit', '#invoice-mail-form', function (e) {
                e.preventDefault()
                var formdata = new FormData($(this)[0])
                var content = CKEDITOR.instances['content_mail'].getData()
                $.ajax({
                    url: '{{route('agent.sendEmailAgent')}}',
                    type: 'post',
                    dataType: 'json',
                    data: formdata,
                    mimeType: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#modal_email_form').modal('toggle')
                        alert('Send email successful !')
                    },
                })
            })

            $(document).on('click', '.delete_row_data', function (e) {
                e.preventDefault()
                var allVals = []
                var dataType = $(this).attr('data-type')
                var _url = $(this).attr('data-url')
                $('.sub_chk:checked').each(function () {
                    allVals.push($(this).attr('data-id'))
                })
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
                            data: {
                                ids: allVals,
                                _token: "{{csrf_token()}}",
                                type: dataType,
                            },
                            type: 'post',
                            success: function (data) {
                                if (data.success == 1) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success',
                                    )
                                    $.each(data.ids, function (index, value) {
                                        $('#data-agent_' + value).remove()
                                    })
                                    checkBox()
                                }
                            },
                        })
                    }
                })
            })
            $(document).on('submit', '#form-set-person-in-charge', function (e) {
                e.preventDefault()
                var staff_id = $('#staff_id_person_in_charge').val()
                var staff_name = $('#staff_id_person_in_charge option:selected').text()
                var allVals = []
                $('.sub_chk:checked').each(function () {
                    allVals.push($(this).attr('data-id'))
                })
                $.ajax({
                    url: '{{route('agent.updatePersonInCharge')}}',
                    type: 'post',
                    data: {
                        staff_id: staff_id,
                        agent_ids: allVals,
                        _token: '{{csrf_token()}}',
                    },
                    success: function (data) {
                        $.each(data.agent_ids, function (index, value) {
                            $('#data-agent_' + value + ' .td_staff_id').text(staff_name)
                        })
                        checkBox()
                        $('#modalAgentPersonCharge').modal('hide')
                    },
                })
            })

            $(document).on('submit', '#form-set-status', function (e) {
                e.preventDefault()
                var status = $('#status_agent option:selected').val()
                var allVals = []

                $('.sub_chk:checked').each(function () {
                    allVals.push($(this).attr('data-id'))
                })
                $.ajax({
                    url: '{{route('agent.updateStatusAgent')}}',
                    type: 'post',
                    data: {
                        status,
                        agent_ids: allVals,
                        _token: '{{csrf_token()}}',
                    },
                    success: function (data) {
                        location.reload();
                    },
                })
            })

            $('#mainContent').delegate('.modal_delete', 'click', function () {
                id = $(this).data('id')
                $('#agent_id').val(id)
                $('#modal_delete').modal('toggle')
            })

            $('#mainContent').delegate('.attach', 'click', function () {
                var allVals = []
                $('.sub_chk:checked').each(function () {
                    allVals.push($(this).attr('data-id'))
                })
                if (allVals.length <= 0) {
                    alert('No data selected !')
                } else {
                    $('#data_attach').val(allVals.toString())
                    $('#modal_attach').modal('toggle')
                }
            })

            $('#mainContent').delegate('.support', 'click', function () {
                _id = $(this).data('id')
                $('#agent_id_sp').val(_id)
                $('#modal_support').modal('toggle')
            })

            CKEDITOR.replace('content', {
                filebrowserBrowseUrl: '/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                filebrowserUploadUrl: '/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                filebrowserImageBrowseUrl: '/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            })
            CKEDITOR.replace('content_sp', {
                filebrowserBrowseUrl: '/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                filebrowserUploadUrl: '/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                filebrowserImageBrowseUrl: '/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            })

        })
    </script>
@stop
