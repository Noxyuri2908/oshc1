@extends('CRM.layouts.default')

@section('title')
    Tasks Sale Report
    @parent
@stop

@section('css')
    @include('CRM.partials.css')
    <style>
        .table-div .form-control {
            height: 28px;
        }

        .table-div {
            max-width: 100%;
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

        thead th {
            font-size: 0.83rem;
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

        .table-div thead th input, .table-div thead th select, .table-div tbody th, .table-div tbody td {
            font-size: 0.83rem;
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
            white-space: pre-line;
        }
    </style>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>WEEKLY (MONTHLY) PLAN & REPORT</h3>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Filter date</label>
                                    <select class="form-control mb-4" name="filter_date_option" id="filter_date_option">
                                        <option value="">Select</option>
                                        <option
                                            value="week" {{request()->get('filter_date_option') == 'week'?'selected':''}}>
                                            This week
                                        </option>
                                        <option
                                            value="month" {{request()->get('filter_date_option') == 'month'?'selected':''}}>
                                            This month
                                        </option>
                                        <option
                                            value="year" {{request()->get('filter_date_option') == 'year'?'selected':''}}>
                                            This year
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Choose date</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" autocomplete="off" class="form-control mr-2"
                                                   id="report_start_date"
                                                   name="report_start_date"
                                                   value="{{request()->get('report_start_date')}}"
                                                   placeholder="Date start">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" autocomplete="off" class="form-control"
                                                   id="report_end_date"
                                                   name="report_end_date"
                                                   value="{{request()->get('report_end_date')}}"
                                                   placeholder="Date end">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex align-items-center h-100">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <div>
                        <p class="h6">AGENT REPORT </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-div">
                                    <table class="">
                                        <thead class="">
                                        <tr class="first-row">
                                            <th class="width-200">Processing date</th>
                                            <th class="width-200">Have signed contract</th>
                                            <th class="width-220">New agent- 1st case done</th>
                                        </tr>
                                        </thead>
                                        <tbody id="">
                                        @foreach($getAgentReport as $report)
                                            <tr>
                                                <td class="white-space-preline-report">{{$report['date']}}</td>
                                                <td class="white-space-preline-report">{{$report['new_contract']}}</td>
                                                <td class="white-space-preline-report">{{$report['first_case']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-div">
                                    <table class="">
                                        <thead class="">
                                        <tr class="first-row">
                                            <th class="width-200">Processing date</th>
                                            <th class="width-300">New Agents have been found</th>
                                            <th class="width-500">Note- New Agent</th>
                                        </tr>
                                        </thead>
                                        <tbody id="">
                                        @foreach($getUserCooperatingByDate as $key=>$reportUsers)
                                            <tr>
                                                <td>{{$key}}</td>
                                                <td class="white-space-preline-report">
                                                    @foreach($reportUsers as $user)
                                                        {{$user->name}}{{($loop->index+1 == count($reportUsers))?'':','}}
                                                    @endforeach
                                                </td>
                                                <td class="white-space-preline-report">
                                                    @foreach($reportUsers as $user)
                                                        {{$user->name}}:{{$user->getNote()}}
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <p class="h6"> PENDING INVOICE/ CERTIFICATE/ /EXTEND FOLLOW UP</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-div">
                                    <table class="">
                                        <thead class="">
                                        <tr class="first-row">
                                            <th class="width-100">Service</th>
                                            <th class="width-200">Pending invoice</th>
                                            <th class="width-220">CERTIFICATE/CASE</th>
                                            <th class="width-200">EXTEND REMIND</th>
                                            <th class="width-220">Extend successfully</th>
                                        </tr>
                                        </thead>
                                        <tbody id="">
                                        @foreach($getDataOshcOvhcHcc as $keyOshcOvhcHcc=>$dataOshcOvhcHcc)
                                            <tr>
                                                <td class="white-space-preline-report">{{$keyOshcOvhcHcc}}</td>
                                                <td class="white-space-preline-report">{{$dataOshcOvhcHcc['pendingInvoice']}}</td>
                                                <td class="white-space-preline-report">{{$dataOshcOvhcHcc['certificase']}}</td>
                                                <td class="white-space-preline-report">{{$dataOshcOvhcHcc['extendRemind']}}</td>
                                                <td class="white-space-preline-report">{{$dataOshcOvhcHcc['extendSuccessfully']}}</td>
                                            </tr>
                                        @endforeach
                                        @foreach($getDataFlywire as $keyFlywire=>$dataFlywire)
                                            <tr>
                                                <td class="white-space-preline-report">{{$keyFlywire}}</td>
                                                <td class="white-space-preline-report">{{$dataFlywire['pendingInvoice']}}</td>
                                                <td class="white-space-preline-report">{{$dataFlywire['certificase']}}</td>
                                                <td class="white-space-preline-report">{{$dataFlywire['extendRemind']}}</td>
                                                <td class="white-space-preline-report">{{$dataFlywire['extendSuccessfully']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <p class="h6">FOLLOW UP</p>
                        @include('CRM.elements.task.sale.table.follow-up-agent')
                    </div>
                    <div class="mt-5">
                        <p class="h6">APPOINTMENT & VISIT AGENT</p>
                        @include('CRM.elements.task.sale.table.appointment')
                    </div>
                    <div class="mt-5">
                        <p class="h6">MARKET FEEDBACK</p>
                        @include('CRM.elements.task.sale.table.market-feedback-agent')
                    </div>
                    <div class="mt-5">
                        <p class="h6">COMPETITOR FEEDBACK</p>
                        @include('CRM.elements.task.sale.table.competitor-feedback-agent')
                    </div>
                    <div class="mt-5">
                        @foreach($typeSaleTask as $key=>$type)
                            <p class="h6">{{trans('lang.'.$type)}}</p>
                            @include('CRM.elements.task.sale.table.sale_task_assign',['typeTask'=>$type,'typeTask_id'=>$key])
                        @endforeach
                    </div>
                    <div class="mt-5">
                        <p class="h6">PROPOSAL</p>
                        @include('CRM.elements.task.sale.table.proposal-agent')
                    </div>
                    <div class=mt-5">
                        <p class="h6">TRAINING</p>
                        @include('CRM.elements.task.sale.table.training-agent')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
           'report_start_date',
           'report_end_date',
       ]]);
@endpush
