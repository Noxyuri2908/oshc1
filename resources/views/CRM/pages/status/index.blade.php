@extends('CRM.layouts.default')

@section('title')
    STATUS
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    <style>
        .table-div .form-control {
            height: 28px;
        }

        .table-div {
            max-width: 100%;
            position: relative;
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

        .list-group.list-group-root > .list-group > .list-group-item {
            padding-left: 65px;
        }

        [data-toggle="collapse"][aria-expanded="true"] > .js-rotate-if-collapsed {
            -webkit-transform: rotate(90deg);
            -moz-transform: rotate(90deg);
            -ms-transform: rotate(90deg);
            -o-transform: rotate(90deg);
            transform: rotate(90deg);
        }
        #form-status {
            position: fixed;
            right: 40px;
        }

    </style>
@stop
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh s??ch ki???u tr???ng th??i</h3>
                        <div class="card-tools">
{{--                            <form id="search-form" method="get">--}}
{{--                                <div class="input-group input-group-sm" style="width: 150px;">--}}
{{--                                    <input id="search-value" type="text" name="q" class="form-control float-right"--}}
{{--                                           placeholder="T??m ki???m" value="">--}}

{{--                                    <div class="input-group-append">--}}
{{--                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="just-padding">
                            <div class="list-group list-group-root well" id="form-data">
                                @can('status.index')
                                    @include('CRM.pages.status.data')
                                @endcan
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-5" id="form-status">
                @can('status.store')
                    @include('CRM.pages.status.status_form')
                @endcan
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click',".plus-value",function (e) {
            e.preventDefault();
            var lastField = $("#value_status_group div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"fieldwrapper row w-100 \" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $("<div class=\"col-md-11\"><input type=\"text\" class=\"form-control input_value_status\" value=\"\" name=\"value[]\" id=\"value\" placeholder=\"Nh???p gi?? tr???\" required></div>");
            var removeButton = $("<div class=\"col-md-1\"><input type=\"button\" class=\"remove btn btn-default\" value=\"-\" /></div>");
            removeButton.click(function () {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(removeButton);
            $("#value_status_group").append(fieldWrapper);
        });
    </script>
    <script>
        $(document).on('click', '.btn-delete-status', function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
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
                        url: url,
                        type: 'post',
                        data: {
                            _token: "{{csrf_token()}}"
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            if (data) {
                                window.location.reload();
                            }
                        }
                    })

                }
            })
        });
    </script>
    <script>
        $(document).on('click', '.btn-add-status', function (e) {
            e.preventDefault();
            let _url = $(this).attr('data-url');
            $.ajax({
                url: _url,
                type: 'get',
                success: function (data) {
                    $('#form-status').html(data);
                }
            })
        })
    </script>
    <script>
        $(document).on('click', '.btn-edit-status', function (e) {
            e.preventDefault();
            let _url = $(this).attr('data-url');
            $.ajax({
                url: _url,
                type: 'get',
                success: function (data) {
                    $('#form-status').html(data);
                }
            })
        })
    </script>
    <script>
        $(document).on('click', '.btn-submit-form-status', function (e) {
            e.preventDefault();
            let _url = $(this).attr('data-url');
            var _name = $('#name').val();
            var _type = $('#type').val();
            var _is_success = $('#is_success').val();
            var _valueArr =[];
            $('input[name^="value"]').each(function(){
                _valueArr.push($(this).val());
            });
            var _value = _valueArr;
            $.ajax({
                url: _url,
                type: 'post',
                data:{
                    _token: "{{csrf_token()}}",
                    name:_name,
                    type:_type,
                    value:_value,
                    is_success:_is_success
                },
                success: function (data) {
                    $('#form-data').html(data);
                }
            })
        })
    </script>
@endpush
