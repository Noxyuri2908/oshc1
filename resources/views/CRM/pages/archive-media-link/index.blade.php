@extends('CRM.layouts.default')

@section('title')
    Media Link
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

        .white-space-preline-report {
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
    </style>
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-header">
                <h5>Kho link</h5>
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-success " id="btn_add_new_archive_media_link"><i class="fas fa-plus"></i></a>
                    <a href="#" class="delete-filter btn btn-primary ml-2">Delete Filter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-archive-media-link table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            <th class="width-100">Source</th>
                            <th class="width-200">Name</th>
{{--                            <th class="width-220">From</th>--}}
                            <th class="width-170">Country</th>
                            <th class="width-170">Link</th>
                            <th class="width-170">Type</th>
                            <th class="width-200">Hot news</th>
                            <th class="width-200">Information focused</th>
                            <th class="width-200">Admin</th>
                            <th class="width-200">Email admin</th>
                            <th class="width-200">Telephone</th>
                            <th class="width-500">Note</th>
                        </tr>
                        @include('CRM.pages.archive-media-link.filter')
                        </thead>
                        <tbody id="archive-media-link-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_archive_media_link_form"></div>
    </div>
@endsection
@push('scripts')
    @include('CRM.partials.ajax-curd-load-more.get-data',[
    'nameAction'=>'archiveMediaLink',
    'valueNameField'=>[
        'form_id',
        'country_id',
        'source_id',
        'link',
        'type_id',
        'is_hot_new',
        'information_focused_id',
        'note',
        'name',
        'admin',
        'email_admin',
        'telephone'
    ],
    'urlGetData'=>route('archive-media-link.getData'),
    'elementIdTableData'=>'archive-media-link-table-tbody',
    'elementClassSubmitForm'=>'btn_submit_archive_media_link_form',
    'elementIdEachData'=>'archive_media_data',
    'elementIdModalForm'=>'modal_archive_media_link',
    'elementIdCreateForm'=>'btn_add_new_archive_media_link',
    'urlCreateForm'=>route('archive-media-link.create'),
    'elementIdRenderModalForm'=>'modal_archive_media_link_form',
    'elementClassEditForm'=>'edit_archive_media_link',
    'elementClassDeleteForm'=>'delete_archive_media_link',
    'table_element_class_scroll'=>'table-archive-media-link'
])
@endpush
