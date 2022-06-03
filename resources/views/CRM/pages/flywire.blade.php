@extends('CRM.layouts.default')

@section('title')
    FLYWIRE
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.pages.css.customer-css')
    <style>
        .select2-results__option {
            color: #000;
        }

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

        table {
            position: relative;
            border-collapse: collapse;
            white-space: nowrap;
            table-layout: fixed;
            width: 100%;
        }

        table td, table th {

        }

        td,
        th {
            padding: 0.25em;
        }


        thead .first-row th {
            position: -webkit-sticky; /* for Safari */
            position: sticky;
            top: 0;
            background: #007bff;
            color: #fff;
        }

        thead .last-row th {
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

        thead .first-row th:first-child, thead .last-row th:first-child {
            /* left: 0; */
            z-index: 1;
        }

        /* tbody th {
            position: -webkit-sticky;
            position: sticky;
            left: 0;
            background: #FFF;
            border-right: 1px solid #CCC;
        } */
        tbody th, tbody td {
            border-bottom: 1px solid #ccc;
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

        .width-130 {
            width: 130px;
        }

        .white-space-break-spaces {
            text-overflow: ellipsis;
            overflow: hidden;
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

        .table-main-customer thead.customer-thead .first-row th:first-child,
        .table-main-customer thead.customer-thead .last-row th:first-child,
        .table-main-customer thead.customer-thead .first-row th:nth-child(2),
        .table-main-customer thead.customer-thead .last-row th:nth-child(2),
        .table-main-customer thead.customer-thead .first-row th:nth-child(3),
        .table-main-customer thead.customer-thead .last-row th:nth-child(3),
        .table-main-customer thead.customer-thead .first-row th:nth-child(4),
        .table-main-customer thead.customer-thead .last-row th:nth-child(4),
        .table-main-customer thead.customer-thead .first-row th:nth-child(5),
        .table-main-customer thead.customer-thead .last-row th:nth-child(5)
        {
            z-index: 2;
        }

        .table-main-customer thead.customer-thead .first-row th:first-child,
        .table-main-customer thead.customer-thead .last-row th:first-child,
        .table-main-customer tbody tr th:nth-child(1) {
            left: 0;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(2),
        .table-main-customer thead.customer-thead .last-row th:nth-child(2),
        .table-main-customer tbody tr th:nth-child(2) {
            left: 50px;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(3),
        .table-main-customer thead.customer-thead .last-row th:nth-child(3),
        .table-main-customer tbody tr th:nth-child(3) {
            left: 130px;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(4),
        .table-main-customer thead.customer-thead .last-row th:nth-child(4),
        .table-main-customer tbody tr th:nth-child(4) {
            left: 300px;
        }

        .table-main-customer thead.customer-thead .first-row th:nth-child(5),
        .table-main-customer thead.customer-thead .last-row th:nth-child(5),
        .table-main-customer tbody tr th:nth-child(5) {
            left: 470px;
        }

        .table-main-customer tbody .first-col,
        .table-main-customer tbody .second-col,
        .table-main-customer tbody .third-col,
        .table-main-customer tbody .fourth-col,
        .table-main-customer tbody .fifth-col {
            z-index: 1;
            background-color: #fff;
        }

        .table-main-customer tbody .sticky-col {
            position: sticky;
        }
    </style>
    @include('CRM.partials.loading-css')
@stop
@section('content')
    @include('CRM.elements.flywire.index')
    <div class="loading-fixed-top">Loading&#8230;</div>
@stop
@push('scripts')
    <script>
        $(document).on('mouseover','.btn-dropdown-z-index',function(e){
            e.preventDefault();
            if(!$(this).next().hasClass('show')){
                $('.dropdown-menu').removeClass('show');
            }
            $('th.second-col').css('z-index','1');
            $(this).parent().parent().css('z-index','2');
        })
    </script>
    <script>
        $(document).on('click', '#master', function (e) {
            if ($(this).is(':checked', true)) {
                $('.sub_chk').prop('checked', true)
                $('#multi_action').show()
            } else {
                $('.sub_chk').prop('checked', false)
                $('#multi_action').hide()
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
        $(document).on('click', '.delete_row_data', function (e) {
            e.preventDefault()
            var allVals = []
            var dataType = 'cus'
            var _url = $(this).data('url')
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
                                window.location.reload()
                            }
                        },
                    })
                }
            })
        })
    </script>
@endpush
