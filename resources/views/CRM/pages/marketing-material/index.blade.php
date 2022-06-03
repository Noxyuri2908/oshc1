@extends('CRM.layouts.default')

@section('title')
    Marketing material
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
                <h5>Marketing material</h5>
                <div class="d-flex justify-content-end">
                    <a href="#" class="btn btn-success " id="btn_add_new_marketing_material"><i class="fas fa-plus"></i></a>
                    <a href="#" class="btn btn-primary ml-2 delete-filter">Delete Filter</a>

                </div>
            </div>
            <div class="card-body">
                <div class="table-marketing-material-list table-div">
                    <table class="">
                        <thead class="">
                        <tr class="first-row">
                            <th class="width-80">Action</th>
                            <th class="width-200">Category</th>
                            <th class="width-200">Type</th>
                            <th class="width-200">Content</th>
                            <th class="width-200">Use for</th>
                            <th class="width-200">Target</th>
                            <th class="width-200">Sub target</th>
                            <th class="width-200">File attachment</th>
                            <th class="width-200">Created at</th>
                            <th class="width-200">Note</th>
                        </tr>
                        @include('CRM.pages.marketing-material.filter')
                        </thead>
                        <tbody id="marketing-material-list-table-tbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="modal_marketing_material_form"></div>
    </div>
@endsection
@push('scripts')
    @include('CRM.partials.select-onchange-get-value',[
        'id'=>'target_filter',
        'subId'=>'sub_target_filter'
    ])
    <script>
        $(document).on('change', '#target', function (e) {
            var value = $(this).find(":selected").attr('data-value');
            var arrValue;
            if (value) {
                arrValue = JSON.parse(value);
            } else {
                arrValue = [];
            }
            html = '';
            $.each(arrValue, function (index, value) {
                html += '<option value="' + parseInt(index+1) + '">' + value + '</option>';
            });
            $('#sub_target').html(html);
        })
    </script>
    @include('CRM.partials.choose_date',['ids'=>[
        'expiry_date',
        'expiry_date_filter'
    ]])
    @include('CRM.partials.ajax-curd-load-more.get-data-with-upload-file',[
    'nameAction'=>'marketingMaterial',
    'valueNameField'=>[
        'category_id',
        'content',
        'use_for',
        'target',
        'file_attachment',
        'sub_target'
    ],
    'urlGetData'=>route('marketing-material.getData'),
    'elementIdTableData'=>'marketing-material-list-table-tbody',
    'elementIdEachData'=>'marketing_material_content_data',
    'elementIdModalForm'=>'modal_marketing_material',
    'elementIdCreateForm'=>'btn_add_new_marketing_material',
    'urlCreateForm'=>route('marketing-material.create'),
    'elementIdRenderModalForm'=>'modal_marketing_material_form',
    'elementClassEditForm'=>'edit_marketing_material',
    'elementClassDeleteForm'=>'delete_marketing_material',
    'elementIdForm'=>'marketing-material-form'
])
@endpush
