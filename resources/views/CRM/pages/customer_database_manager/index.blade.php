@extends('CRM.layouts.default')

@section('title')
    Customer database manager
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
                <h5>Customer database manager</h5>
                <div class="d-flex justify-content-end">
                    @can('customerManager.store')
                        <a href="#" class="btn btn-success " id="btn_add_customer"><i class="fas fa-plus"></i></a>
                    @endcan
                        <a href="#" class="btn btn-primary ml-2 delete-filter">Delete Filter</a>
                    <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#importModal">
                        <i class="fas fa-file-import"></i>
                    </button>
                    <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form id="modal-form-import" action="{{route('customer_database_manager.importExcel')}}"
                                  method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn nhập vào hệ
                                            thống!</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span class="font-weight-light" aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input class="form-control-file" name="file" id="file" type="file"
                                                   required="">
                                        </div>
                                        <input class="form-control-file" name="tmp" value="111" type="hidden">
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-customer table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            <th class="width-200">Type of customer</th>
                            <th class="width-200">Full name</th>
                            <th class="width-200">Resource</th>
                            <th class="width-200">Agent</th>
                            <th class="width-200">English center</th>
                            <th class="width-200">Event</th>
                            <th class="width-200">Identification</th>
                            <th class="width-200">Gender</th>
                            <th class="width-200">DOB</th>
                            <th class="width-200">Email</th>
                            <th class="width-200">Phone number</th>
                            <th class="width-200">Social link</th>
                            <th class="width-200">Country</th>
                            <th class="width-200">City</th>
                            <th class="width-200">School</th>
                            <th class="width-200">Study tour</th>
                            <th class="width-200">Departure date</th>
                            <th class="width-200">Destination to study</th>
                            <th class="width-200">Potentiality</th>
                            <th class="width-200">Potential service</th>
                            <th class="width-200">Email status</th>
                            <th class="width-200">Note</th>
                        </tr>
                        @include('CRM.pages.customer_database_manager.filter')
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
        'type_of_customer_id',
        'full_name',
        'source_id',
        'agent_id',
        'english_center_id',
        'event_id',
        'identification',
        'gender',
        'date_of_birth',
        'mail',
        'phone_number',
        'social_link',
        'country_id',
        'city_name',
        'school_name',
        'study_tour',
        'departure_date',
        'destination_to_study',
        'potentiality',
        'potential_service',
        'email_status',
        'note'
    ],
    'urlGetData'=>route('customer_database_manager.getData'),
    'elementIdTableData'=>'customer-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_customer_form',
    'elementIdEachData'=>'customer_data',
    'elementIdModalForm'=>'modal_customer_list',
    'elementIdCreateForm'=>'btn_add_customer',
    'urlCreateForm'=>route('customer_database_manager.create'),
    'elementIdRenderModalForm'=>'modal_customer_form',
    'elementClassEditForm'=>'edit_customer',
    'elementClassDeleteForm'=>'delete_customer',
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
@endpush
