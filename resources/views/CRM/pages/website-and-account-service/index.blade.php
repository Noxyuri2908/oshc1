@extends('CRM.layouts.default')

@section('title')
    @php
        if(!empty($type)){
            if($type == 'website'){
                echo 'Website';
            }elseif($type == 'service'){
                 echo 'Account service';
            }
        }
    @endphp
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
                <h5>@php
                        if(!empty($type)){
                            if($type == 'website'){
                                echo 'Website';
                            }elseif($type == 'service'){
                                 echo 'Account service';
                            }
                        }
                    @endphp</h5>
                <div class="d-flex justify-content-end">
                    @if($type == 'website')
                        @can('website-account-manager.store')
                            <a href="#" class="btn btn-success " id="btn_add_new_website_and_account"><i
                                    class="fas fa-plus"></i></a>
                        @endcan
                    @elseif($type == 'service')
                        @can('serviceAccount.store')
                            <a href="#" class="btn btn-success " id="btn_add_new_website_and_account"><i
                                    class="fas fa-plus"></i></a>
                        @endcan
                    @endif
                        <a href="#" class="btn btn-primary ml-2 delete-filter">Delete Filter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-mail-and-skype table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            @php
                                if(!empty($type)){
                                    if($type == 'website'){
                                        echo '<th class="width-200">Website</th>';
                                    }elseif($type == 'service'){
                                         echo '<th class="width-200">Account service</th>';
                                    }
                                }
                            @endphp
                            <th class="width-200">Link</th>
                            <th class="width-200">ID</th>
                            <th class="width-200">Password</th>
                            <th class="width-200">Supporter</th>
                            <th class="width-200">Note</th>
                        </tr>
                        @include('CRM.pages.website-and-account-service.filter',['typeId'=>$typeId])
                        </thead>
                        <tbody id="website-service-list-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_website_and_service_form"></div>
    </div>
@endsection
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
        'expiry_date',
        'expiry_date_filter'
    ]])
    @include('CRM.partials.ajax-curd-load-more.get-data',[
    'nameAction'=>'websiteAndAccount',
    'valueNameField'=>[
        'type',
        'website',
        'service',
        'link',
        'website_and_service_id',
        'password',
        'supporter',
        'note'
    ],
    'urlGetData'=>route('website-account-manager.getData',['typeId'=>$typeId,'type'=>$type]),
    'elementIdTableData'=>'website-service-list-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_website_service_list_form',
    'elementIdEachData'=>'website_account_data',
    'elementIdModalForm'=>'modal_website_account_list',
    'elementIdCreateForm'=>'btn_add_new_website_and_account',
    'urlCreateForm'=>route('website-account-manager.create',[
        'typeId'=>$typeId
    ]),
    'elementIdRenderModalForm'=>'modal_website_and_service_form',
    'elementClassEditForm'=>'edit_website_and_account',
    'elementClassDeleteForm'=>'delete_website_and_account',
    'table_element_class_scroll'=>'table-mail-and-skype'

])
@endpush
