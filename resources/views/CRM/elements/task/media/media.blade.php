@extends('CRM.layouts.default')
@section('title')
    Media Staff
    @parent
@stop
@section('css')
    @include('CRM.partials.css')
    @include('CRM.partials.loading-css')
    <style>
        .table-div .form-control {
            height: 28px;
        }

        .table-div {
            max-width: 100%;
            height: 20em;
            max-height: 20em;
            overflow: scroll;
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

        .width-250 {
            width: 250px;
        }

        .width-300 {
            width: 300px;
        }

        .width-350 {
            width: 350px;
        }

        .width-170 {
            width: 170px;
        }

        .width-200 {
            width: 200px;
        }

        .width-120{
            width: 120px;
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
        .white-space-preline-report{
            white-space: pre-line;
        }
        #myGroupList {
            display: inline-block;
            overflow: auto;
            overflow-y: hidden;
            max-width: 100%;
            white-space: nowrap;
        }
        #myGroupList li {
            display: inline-block;
            vertical-align: top;
        }
        .font-size-12px{
            font-size: 12px;
        }
        .user_id_filter_select2 .select2-results__option{
            color: #000;
        }
    </style>
@stop
@section('content')
    <div id="media-task">
        @include('CRM.elements.task.media.filter')
        <div class="card mt-4">
            @include('CRM.elements.task.media.table.web')
        </div>
        <div class="loading-fixed-top">Loading&#8230;</div>
    </div>
    <div id="check-list-task" class=" mt-4">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTabChecklistAndTask" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="check-list-tab" data-toggle="tab" href="#check-list-tab-content" role="tab" aria-controls="home" aria-selected="true">Checklist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="task-tab" data-toggle="tab" href="#task-tab-content" role="tab" aria-controls="profile" aria-selected="false">Task</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="check-list-tab-content" role="tabpanel" aria-labelledby="check-list-tab">
                        @include('CRM.elements.task.checklist-and-task.checklist.index',['type_tab'=>'checklist'])
                    </div>
                    <div class="tab-pane fade" id="task-tab-content" role="tabpanel" aria-labelledby="task-tab">
                        @include('CRM.elements.task.checklist-and-task.task.index',['type_tab'=>'task'])
                    </div>
                    <div id="modal_checklist_task_form"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
