@extends('CRM.layouts.default')

@section('title')
    CUSTOMER MANAGEMENT
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.pages.css.customer-css')
    <style>
        .table-div .form-control {
            height: 28px;
        }

        .table-div {
            max-width: 100%;
            position: relative;
            overflow: scroll;
            height: 32em;
            max-height: 32em;
        }

        .table-main-customer table {
            position: relative;
            border-collapse: collapse;
            white-space: nowrap;
            table-layout: fixed;
            width: 100%;
        }

        .table-main-customer td,
        .table-main-customer th {
            padding: 0.25em;
        }


        thead .first-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            background: #007bff;
            color: #fff;
        }

        thead.customer-thead .last-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            background: #eae7e7;
            color: #fff;
        }

        .top-80 {
            top: 25px;
        }

        .last-row th {
            top: 25px;
        }

        .table-main-customer thead.customer-thead .first-row th:first-child,
        .table-main-customer thead.customer-thead .last-row th:first-child {
            left: 0;
            z-index: 2;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(2),
        .table-main-customer thead.customer-thead .last-row th:nth-child(2) {
            left: 40px;
            z-index: 3;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(3),
        .table-main-customer thead.customer-thead .last-row th:nth-child(3) {
            left: 90px;
            z-index: 2;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(4),
        .table-main-customer thead.customer-thead .last-row th:nth-child(4) {
            left: 190px;
            z-index: 2;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(5),
        .table-main-customer thead.customer-thead .last-row th:nth-child(5) {
            left: 290px;
            z-index: 2;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(6),
        .table-main-customer thead.customer-thead .last-row th:nth-child(6) {
            left: 390px;
            z-index: 2;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(7),
        .table-main-customer thead.customer-thead .last-row th:nth-child(7) {
            left: 490px;
            z-index: 2;
        }

        .table-main-customer tbody .first-col {
            left: 0;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody .second-col {
            left: 40px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody .third-col {
            left: 90px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody .fourth-col {
            left: 190px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr td:nth-child(5) {
            left: 290px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr td:nth-child(6) {
            left: 390px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody tr td:nth-child(7) {
            left: 490px;
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody .sticky-col {
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

        .width-200 {
            width: 200px;
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

        .white-space-break-spaces {
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

        .agent_id_filter_select2 .select2-results__option, .master_agent_filter_select2 .select2-results__option {
            color: #000;
        }

        .max-width-70 {
            max-width: 70%;
        }
    </style>
    @include('CRM.partials.loading-css')

@stop
@section('content')
    @include('CRM.elements.table-customer')
    <div id="div_modal_customer_info"></div>
    <div id="div_modal_agent_info"></div>
    <div id="div_modal_invoice_info"></div>
    <div id="div_modal_edit_invoice">
        @include('CRM.elements.customers.modal-invoice')
    </div>
    @include('CRM.elements.customers.modal-export-invoice')
    <div id="loading-overlay">
        <div class="loading-icon"></div>
    </div>
@stop

@section('js')
    @include('CRM.partials.fancybox-class-popup',[
    'classElements'=>[
        'link-popup'
]
])
    <script>
        $(document).on('mouseover', '.btn-dropdown-z-index', function (e) {
            e.preventDefault()
            if (!$(this).next().hasClass('show')) {
                $('.dropdown-menu').removeClass('show')
            }
            $('td.second-col').css('z-index', '1')
            $(this).parent().parent().css('z-index', '2')
        })
    </script>
    @include('CRM.elements.customers.partials.js.docs')

    @if(\Session::has('success'))
        <script>
            toastr.success('Cập nhật dữ liệu thành công', 'Success', { timeOut: 5000 })
        </script>
    @elseif(\Session::has('error'))
        <script>
            toastr.success('Cập nhật dữ liệu thất bại', 'Error', { timeOut: 5000 })
        </script>
    @endif
    <script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('js/filemanage.js')}}"></script>
    {{--    <script type="text/javascript">--}}
    {{--    	jQuery(document).ready(function() {--}}
    {{--    		jQuery(".main-table").clone(true).appendTo('.table-wrap').addClass('clone');--}}
    {{--    	});--}}
    {{--    </script>--}}
    @include('CRM.elements.customers.partials.js.receipt')
    <script>
        var ajax_url = $('#ajax_crm_url').val()
        var getCus = ajax_url + 'ajax/getCus'
        var getAgentInfo = ajax_url + 'ajax/getAgentInfo'
        var getInvoice = ajax_url + 'ajax/getInvoice'
        var searchInvoice = ajax_url + 'ajax/searchInvoice'
        var getStatusInvoice = ajax_url + 'ajax/statusInvoice'
        var getFillterInvoice = ajax_url + 'ajax/fillterInvoice'

        function search() {
            f_agent = $('#f_agent').val()
            f_country = $('#f_country').val()
            f__master_agent = $('#f__master_agent').val()
            f_service_country = $('#f_service_country').val()
            f_dichvu = $('#f_dichvu').val()
            f_type_invoice = $('#f_type_invoice').val()
            f_providers = $('#f_providers').val()
            f_status = $('#f_status').val()
            $.get(searchInvoice, {
                agent: f_agent,
                country: f_country,
                master_agent: f__master_agent,
                service_country: f_service_country,
                type_invoice: f_type_invoice,
                dichvu: f_dichvu,
                provider: f_providers,
                status: f_status,
            }, function (data) {
                $('#tbody_invoice').html(data)
            })
        }

        jQuery(document).ready(function ($) {
            $(document).on('click', '#master', function (e) {
                if ($(this).is(':checked', true)) {
                    $('.sub_chk').prop('checked', true)
                    $('#multi_action').show()
                } else {
                    $('.sub_chk').prop('checked', false)
                    $('#multi_action').hide()
                }
            })

            //$('.btn_status').click(function () {
            //    _value = $(this).data('value')
            //    $.get(getStatusInvoice, { id: _value }, function (data) {
            //        $('#tbody_invoice').html(data)
            //    })
            //})

            $('#mainContent').delegate('.invoice_info', 'click', function () {

                _id = $(this).data('id')
                if (_id != '') {
                    $.get(getInvoice, { id: _id }, function (data) {
                        $('#div_modal_invoice_info').html(data)
                        $('#modal_invoice').modal('toggle')
                    })
                }
            })

            $('#mainContent').on('click', '.edit_invoice', function () {
                _id = $(this).data('id')
                if (_id != '') {
                    $.get('{{route('customer.getInvoice')}}', { id: _id }, function (data) {
                        // console.log(data);
                        $('#div_modal_edit_invoice').html(data)
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

            // $("#mainContent").delegate(".agent_info", "click", function () {
            //     _id = $(this).data('id');
            //     $.get(getAgentInfo, {id: _id}, function (data) {
            //         $('#div_modal_agent_info').html(data);
            //         $('#modal_agent_info').modal('show');
            //     });
            // });

            //$('.btn_status').click(function () {
            //    _value = $(this).data('value')
            //    $.get(getStatusAgent, { id: _value }, function (data) {
            //        $('#table_agent_body').html(data)
            //    })
            //})
            $('.btn_search').click(function () {
                search()
            })

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

            $('.click-on-filter').on('click', function (e) {
                $('.seach-post').slideToggle()
                $('.table-bodys').toggleClass('col-lg-8')
            })

            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $('.sub_chk').prop('checked', true)
                } else {
                    $('.sub_chk').prop('checked', false)
                }
            })

            $(document).on('click', '.sub_chk', function (e) {
                var checkBoxLength = $('.sub_chk:checked').length
                if (checkBoxLength > 0) {
                    $('#multi_action').show()
                } else if (checkBoxLength == 0) {
                    $('#multi_action').hide()
                }
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

            $('#mainContent').delegate('.agent_comm', 'click', function () {
                _id = $(this).data('id')
                $.get(getAgentComm, { id: _id }, function (data) {
                    console.log(data)
                    $('#div_modal_comm').html(data)
                    $('#modal_comm').modal('toggle')
                })
            })

            $('#mainContent').delegate('.agent_support', 'click', function () {
                _id = $(this).data('id')
                $.get(getAgentSp, { id: _id }, function (data) {
                    console.log(data)
                    $('#div_modal_support').html(data)
                    $('#modal_hisory_support').modal('toggle')
                })
            })

            $('#mainContent').delegate('.export_invoice', 'click', function () {
                _id = $(this).data('id')
                $('#apply_id_export').val(_id)
                $('#exportModalInvoice').modal('toggle')
            })

            $('#mainContent').delegate('.contact_info', 'click', function () {
                _id = $(this).data('id')
                $.get(getContactInfo, { id: _id }, function (data) {
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
                                        $('#data-customer_' + value).remove()
                                    })
                                    checkBox()
                                }
                            },
                        })
                    }
                })
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

            $(document).on('submit', '#invoice-mail-form', function (e) {
                e.preventDefault()
                var formdata = new FormData($(this)[0])
                var content = CKEDITOR.instances['content_mail'].getData()
                $.ajax({
                    url: '{{route("customer.sendEmailInvoice")}}',
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

            $('#mainContent').delegate('.modal_delete', 'click', function () {
                _url = $(this).data('action')
                $('#delete_customer').attr('action', _url)
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

        })
    </script>
    @include('CRM.elements.customers.partials.js.file-manager')
    @include('CRM.elements.customers.partials.js.get-form-create-tai-lieu')
    @include('CRM.elements.customers.partials.js.get-url-parameter')
    @include('CRM.elements.customers.partials.js.btn-render-row-data-table')
    @include('CRM.elements.customers.partials.js.remind')
@stop
