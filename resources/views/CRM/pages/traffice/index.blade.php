@extends('CRM.layouts.default')

@section('title')
    Traffice
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
                <h5>Traffice</h5>
                <div class="d-flex justify-content-end">
                    @can('traffice.store')
                    <a href="#" class="btn btn-success " id="btn_add_new_traffice"><i class="fas fa-plus"></i></a>
                    @endcan
                        <a href="#" class="btn btn-primary ml-2 delete-filter">Delete Filter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-traffice table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            <th class="width-200">Start date</th>
                            <th class="width-200">End date</th>
                            <th class="width-200">Total view</th>
                            <th class="width-200">Total user</th>
                            <th class="width-200">Total like (at present)</th>
                            <th class="width-200">Total reach</th>
                            <th class="width-200">Note</th>
                        </tr>
                        @include('CRM.pages.traffice.filter')
                        </thead>
                        <tbody id="traffice-list-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_traffice_form"></div>
    </div>
@endsection
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'start_date',
        'end_date',
        'start_date_filter',
        'end_date_filter'
    ]])
    @include('CRM.partials.ajax-curd-load-more.get-data',[
    'nameAction'=>'traffice',
    'valueNameField'=>[
        'start_date',
        'end_date',
        'total_view',
        'total_user',
        'total_like',
        'total_reach',
        'note'
    ],
    'urlGetData'=>route('traffice.getData'),
    'elementIdTableData'=>'traffice-list-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_traffice_form',
    'elementIdEachData'=>'traffice_content_data',
    'elementIdModalForm'=>'modal_traffice',
    'elementIdCreateForm'=>'btn_add_new_traffice',
    'urlCreateForm'=>route('traffice.create'),
    'elementIdRenderModalForm'=>'modal_traffice_form',
    'elementClassEditForm'=>'edit_traffice',
    'elementClassDeleteForm'=>'delete_traffice',
    'table_element_class_scroll'=>'table-traffice'

])
@endpush
