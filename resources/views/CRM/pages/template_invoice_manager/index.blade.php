@extends('CRM.layouts.default')

@section('title')
    Template invoice manager
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

        .white-space-preline-report {
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Template invoice manager</h5>
                <div class="d-flex justify-content-end">
{{--                    @can('customerManager.store')--}}
{{--                        <a href="{{route('template_invoice_manager.create')}}" class="btn btn-success "><i class="fas fa-plus"></i></a>--}}
{{--                    @endcan--}}
                    <a href="#" class="btn btn-primary ml-2 delete-filter">Delete Filter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-customer table-div">
                    <table class="">
                        <thead class="">
                            <tr class="first-row">
                                <th class="width-80">Action</th>
                                <th class="width-200">Template</th>
                                <th class="width-200">Company Address</th>
                                <th class="width-200">Logo</th>
                                <th class="width-200">Company Name</th>
                            </tr>
                            @include('CRM.pages.template_invoice_manager.filter')
                        </thead>
                        <tbody id="customer-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_customer_form"></div>
    </div>
@endsection
@push('scripts')

    @include('CRM.partials.ajax-curd-load-more.get-data',[
    'nameAction'=>'customerManager',
    'valueNameField'=>[
        'name',
        'template_name',
        'extended_properties',
        'company_name',
        'company_address',
        'logo',
        'content',
        'company_phone',
        'company_website'
    ],
    'urlGetData'=>route('template_invoice_manager.getData'),
    'elementIdTableData'=>'customer-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_customer_form',
    'elementIdEachData'=>'customer_data',
    'elementIdModalForm'=>'modal_customer_list',
    'elementIdCreateForm'=>'btn_add_customer',
    'urlCreateForm'=>route('template_invoice_manager.create'),
    'elementIdRenderModalForm'=>'modal_customer_form',
    'elementClassEditForm'=>'edit_customer',
    'elementClassDeleteForm'=>'delete_archive_media_link',
    'table_element_class_scroll'=>'table-customer'
])
    @include('CRM.partials.choose_date',['ids'=>[
        'date_of_birth',
        'departure_date',
        'date_of_birth_filter',
        'departure_date_filter'
    ]])
    @include('CRM.partials.choose_date_onchange_call_function',[
    'idElementInputFlatpick'=>[
        'date_of_birth_filter'
],
'functionNameCall'=>'debounceAjax'
])
    <script>
        $(document).on('mouseover','.show-template-btn',function (e) {
            e.preventDefault();
            var element = this;
            $(element).fancybox({
                'width': 700,
                'height': 900,
                'type': 'iframe',
                'autoScale': false,
                'autoSize': false,
                padding: [30, 68, 30, 68],
                helpers: {
                    title: {
                        type: 'float'
                    }
                }
            });
        });
    </script>
@endpush
