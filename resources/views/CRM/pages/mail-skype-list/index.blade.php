@extends('CRM.layouts.default')

@section('title')
    Mail and Skype
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
                <h5>Mail And Skype</h5>
                <div class="d-flex justify-content-end">
                    @can('email-skype-manager.store')
                    <a href="#" class="btn btn-success " id="btn_add_new_mail_and_skype"><i class="fas fa-plus"></i></a>
                    @endcan
                        <a href="#" class="btn btn-primary ml-2 delete-filter">Delete Filter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-mail-and-skype table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            <th class="width-200">Domain</th>
                            <th class="width-200">Email</th>
                            <th class="width-200">Person in charge</th>
                            <th class="width-200">Password</th>
                            <th class="width-200">Skype</th>
                            <th class="width-200">CRM</th>
                            <th class="width-200">Dropbox</th>
                            <th class="width-200">Note</th>
                        </tr>
                        @include('CRM.pages.mail-skype-list.filter')
                        </thead>
                        <tbody id="mail-skype-list-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_mail_and_skype_form"></div>
    </div>
@endsection
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'expiry_date',
        'expiry_date_filter'
    ]])
    @include('CRM.partials.ajax-curd-load-more.get-data',[
    'nameAction'=>'mailAndSkype',
    'valueNameField'=>[
        'domain_id',
        'email',
        'person_in_charge',
        'password',
        'skype',
        'crm',
        'dropbox',
        'note'
    ],
    'urlGetData'=>route('email-skype-manager.getData'),
    'elementIdTableData'=>'mail-skype-list-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_mail_skype_list_form',
    'elementIdEachData'=>'mail_and_skype_content_data',
    'elementIdModalForm'=>'modal_mail_skype_list',
    'elementIdCreateForm'=>'btn_add_new_mail_and_skype',
    'urlCreateForm'=>route('email-skype-manager.create'),
    'elementIdRenderModalForm'=>'modal_mail_and_skype_form',
    'elementClassEditForm'=>'edit_mail_and_skype',
    'elementClassDeleteForm'=>'delete_mail_and_skype',
    'table_element_class_scroll'=>'table-mail-and-skype'
])
@endpush
