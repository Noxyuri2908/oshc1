@extends('CRM.layouts.default')
@section('title')
    It checklist
    @parent
@stop
@section('css')
    @include('CRM.partials.css')
    <style>
        .table-div .form-control {
            height: 28px;
        }

        .details{
            border: 1px solid #d8e2ef;
        }

        .table-div {
            max-width: 100%;
            height: 75%;
            max-height: 75%;
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

        .cardchecklist{
            height: 75%;
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

        .bg-pink{
            background-color: #ef4b88 !important;
        }

        .width-125{
            width: 125px;
        }

        .width-50{
            width: 50px;
        }
    </style>
@stop
@section('content')
    <div>
        @include('CRM.elements.it-checklist.tab-it-system')
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
    </div>
    @endsection
