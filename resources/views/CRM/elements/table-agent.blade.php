@if(session('error-list-agent'))
    <div class="alert alert-danger">
        <strong>{{session('error-list-agent')}}</strong>
    </div>
@endif
@if(session('success-list-agent'))
    <div class="alert alert-success">
        <strong>{{session('success-list-agent')}}</strong>
    </div>
@endif
@include('CRM.elements.agents.fillter')
{{--@include('CRM.elements.agents.search-form')--}}
@can('agent.index')
    <div class="card mb-3 py-2">
        <div class="card-header py-1">
            <div class="row align-items-center">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fs-0 mb-0 font-size-14px">AGENTS</h5>
                        <div>
                            @can('agent.store')
                                <a class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px"
                                   href="{{route('agent.create')}}" title="Add "><i class="fas fa-plus"></i> Add</a>
                            @endcan
                            <a href="#"
                               class="delete-filter btn  btn-falcon-default btn-sm font-weight-normal font-size-12px"
                               title="Delete Filter">
                                <img style="width: 15px"
                                     src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHhtbG5zOnN2Z2pzPSJodHRwOi8vc3ZnanMuY29tL3N2Z2pzIiB3aWR0aD0iNTEyIiBoZWlnaHQ9IjUxMiIgeD0iMCIgeT0iMCIgdmlld0JveD0iMCAwIDM5Ni44MTcgMzk2LjgxNyIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNTEyIDUxMiIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgY2xhc3M9IiI+PGc+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+Cgk8Zz4KCQk8Zz4KCQkJPHJlY3QgeD0iMCIgeT0iMzAuNDQxIiB3aWR0aD0iMzEzLjQ2OSIgaGVpZ2h0PSIyNi4xMjIiIGZpbGw9IiMwMDAwMDAiIGRhdGEtb3JpZ2luYWw9IiMwMDAwMDAiIHN0eWxlPSIiIGNsYXNzPSIiPjwvcmVjdD4KCQkJPHBhdGggZD0iTTYuMjY5LDcyLjIzN0wxMjYuOTU1LDE5NC40OWMxLjU2NywxLjU2NywzLjY1NywzLjY1NywzLjY1Nyw1Ljc0N3YxNjYuMTM5bDUyLjI0NS0yOC4yMTJWMjAwLjIzNyAgICAgYzAtMi4wOSwyLjA5LTQuMTgsMy42NTctNS43NDdMMzA3LjIsNzIuMjM3SDYuMjY5eiIgZmlsbD0iIzAwMDAwMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiIgY2xhc3M9IiI+PC9wYXRoPgoJCQk8cGF0aCBkPSJNMzc3LjczMSwyMDIuMzI3Yy0yOS4yNzgtMjYuOTg4LTc0Ljg5LTI1LjEzMS0xMDEuODc4LDQuMTQ3Yy0yNS40NDgsMjcuNjA3LTI1LjQ0OCw3MC4xMjQsMCw5Ny43MzEgICAgIGMyOS4yNzgsMjYuOTg4LDc0Ljg5LDI1LjEzMSwxMDEuODc4LTQuMTQ3QzQwMy4xNzgsMjcyLjQ1LDQwMy4xNzgsMjI5LjkzNCwzNzcuNzMxLDIwMi4zMjd6IE0zNjUuNzE0LDI4MS4yMTYgICAgIGMzLjAzLDIuNjcyLDMuMzIsNy4yOTQsMC42NDgsMTAuMzI0Yy0wLjIwMiwwLjIyOS0wLjQxOSwwLjQ0Ni0wLjY0OCwwLjY0OGMtMS41NTQsMS40NDYtMy42MjcsMi4yLTUuNzQ3LDIuMDkgICAgIGMtMS45NjIsMC4wOTEtMy44NjctMC42NzEtNS4yMjQtMi4wOWwtMjcuNjktMjcuNjlsLTI3LjY5LDI3LjY5Yy0zLjMxNSwyLjgxMy04LjE3OSwyLjgxMy0xMS40OTQsMCAgICAgYy0yLjUyOS0zLjIyLTIuNTI5LTcuNzUxLDAtMTAuOTcxbDI3LjY5LTI3LjY5bC0yNy42OS0yNy42OWMtMi41MjktMy4yMi0yLjUyOS03Ljc1MSwwLTEwLjk3MWMzLjIyNC0zLjA1Miw4LjI3LTMuMDUyLDExLjQ5NCwwICAgICBsMjcuNjksMjcuNjlsMjcuNjktMjcuNjljMi41OTctMy40NjMsNy41MDktNC4xNjQsMTAuOTcxLTEuNTY3YzMuNDYzLDIuNTk3LDQuMTY0LDcuNTA5LDEuNTY3LDEwLjk3MSAgICAgYy0wLjQ0NSwwLjU5NC0wLjk3MywxLjEyMi0xLjU2NywxLjU2N2wtMjcuNjksMjcuNjlMMzY1LjcxNCwyODEuMjE2eiIgZmlsbD0iIzAwMDAwMCIgZGF0YS1vcmlnaW5hbD0iIzAwMDAwMCIgc3R5bGU9IiIgY2xhc3M9IiI+PC9wYXRoPgoJCTwvZz4KCTwvZz4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8L2c+CjxnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjwvZz4KPGcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPC9nPgo8L2c+PC9zdmc+"/>
                                Clear Filter
                            </a>
                            <a href="{{route('queue_error_log.index',['model'=>\App\User::class])}}"
                               class="btn btn-falcon-default btn-sm font-weight-normal font-size-12px"
                               id="btn-show-error-log" title="Show error import"><i
                                    class="fas fa-exclamation-circle"></i>Show error import</a>
                            <a class="btn btn-falcon-default btn-sm btn_export font-weight-normal font-size-12px"
                               href="javascript:void(0);" id="agentExportExcel" title="Export"><i
                                    class="fas fa-file-export"></i>Export</a>
                            @can('agent.store')
                                <a class="btn btn-falcon-default btn-sm btn_export font-weight-normal font-size-12px"
                                   href="{{route('agent.importTypeOfAgent')}}" data-toggle="modal"
                                   data-target="#importtypeofagent" title="Import Type Of Agent"><i
                                        class="fas fa-file-export"></i>Import Type Of Agent</a>
                                <div class="modal fade" id="importtypeofagent" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form id="modal-form-import"
                                              action="{{route('agent.importTypeOfAgent')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn
                                                        nhập vào hệ
                                                        thống!</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span class="font-weight-light" aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input class="form-control-file" name="file" id="file"
                                                               type="file" required="" accept=".xlsx,.csv,.xls">
                                                    </div>
                                                    <input class="form-control-file" name="tmp" value="111"
                                                           type="hidden">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <a class="btn btn-falcon-default btn-sm btn_export font-weight-normal font-size-12px"
                                   href="{{route('agent.importAgentCode')}}" data-toggle="modal"
                                   data-target="#importAgentCode" title="Import"><i class="fas fa-file-import"></i>Import
                                    Agent Code</a>
                                <div class="modal fade" id="importAgentCode" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form id="modal-form-import"
                                              action="{{route('agent.importAgentCode')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn
                                                        nhập vào hệ
                                                        thống!</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span class="font-weight-light" aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input class="form-control-file" name="file" id="file"
                                                               type="file" required="" accept=".xlsx,.csv,.xls">
                                                    </div>
                                                    <input class="form-control-file" name="tmp" value="111"
                                                           type="hidden">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <a class="btn btn-falcon-default btn-sm btn_import font-weight-normal font-size-12px"
                                   data-toggle="modal" data-target="#importModal" title="Import"><i
                                        class="fas fa-file-import"></i>Import</a>
                                <div class="modal fade" id="importModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form id="modal-form-import"
                                              action="{{route('agent.importExcel')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tải file bạn muốn
                                                        nhập vào hệ
                                                        thống!</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span class="font-weight-light" aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input class="form-control-file" name="file" id="file"
                                                               type="file" required="" accept=".xlsx,.csv,.xls">
                                                    </div>
                                                    <input class="form-control-file" name="tmp" value="111"
                                                           type="hidden">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div id="multi_action" style="display: none" class="ml-5 mb-3">
                @can('agent.sendEmail')
                    <a class="btn btn-default send_email" type="button">
                        <span><i class="fas fa-envelope"></i></span>
                    </a>
                @endcan
                @can('agent.delete')
                    <a data-url="{{route("agent.multiDelete")}}" href="#" class="btn btn-default delete_row_data"><i
                            class="fas fa-trash-alt"></i></a>
                @endcan
                @can('agent.update')
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalAgentPersonCharge">Person
                        in charge</a>
                @endcan
            </div>
            <div class="table-div table-main-agent">
                <table>
                    <thead class="agent-thead">
                    <tr class="first-row">
                        <th class="width-40">
                            <input id="master" class="ml-3" type="checkbox" aria-label="Checkbox for this table"/>
                        </th>
                        <th class="width-40"></th>
                        @foreach($configAgentByOrder as $key)
                            <th class="text-center {{$key['class']}}">{{$key['value']}}</th>
                        @endforeach
                    </tr>
                    @include('CRM.elements.agents.filter')
                    </thead>
                    <tbody id="table_agent_body">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer border-top" style="padding: 0rem 1.23rem">
            <p class="mb-0 font-size-12px"><span id="count-checked">0</span>/<span id="total-row-data" class=""></span>
            </p>
        </div>
    </div>
@endcan
<div class="card mb-3">
    <div class="card-body py-2">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item border-right">
                <a class="nav-link active font-size-14px" id="follow-ups-tab" data-toggle="tab" href="#follow-ups"
                   role="tab"
                   aria-controls="follow-ups" aria-selected="true">
                    Follow ups
                </a>
            </li>
            <li class="nav-item border-right">
                <a class="nav-link font-size-14px" id="remind-follow-ups-tab" data-toggle="tab"
                   href="#remind-follow-ups"
                   role="tab"
                   aria-controls="remind-follow-ups" aria-selected="true">
                    Remind follow ups
                </a>
            </li>
            <li class="nav-item border-right">
                <a class="nav-link font-size-14px" id="appointment-tab" data-toggle="tab" href="#appointment" role="tab"
                   aria-controls="appointment" aria-selected="false">
                    Appointment & Visit Agent
                </a>
            </li>
            <li class="nav-item border-right">
                <a class="nav-link font-size-14px" id="market-feedback-tab" data-toggle="tab" href="#market-feedback"
                   role="tab"
                   aria-controls="market-feedback" aria-selected="false">
                    Agent feedback
                </a>
            </li>
            <li class="nav-item border-right">
                <a class="nav-link font-size-14px" id="competition-feedback-tab" data-toggle="tab"
                   href="#competition-feedback"
                   role="tab" aria-controls="competition-feedback" aria-selected="false">
                    Competitor update
                </a>
            </li>
            <li class="nav-item border-right">
                <a class="nav-link font-size-14px" id="marketing-support-tab" data-toggle="tab"
                   href="#marketing-support" role="tab"
                   aria-controls="marketing-support" aria-selected="false">
                    Marketing support
                </a>
            </li>
            <li class="nav-item border-right">
                <a class="nav-link font-size-14px" id="proposal-tab" data-toggle="tab" href="#proposal" role="tab"
                   aria-controls="proposal" aria-selected="false">
                    Proposal
                </a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="follow-ups" role="tabpanel" aria-labelledby="follow-ups-tab">
                <div class="d-flex justify-content-end mt-1">
                    {{--<a--}}
                    {{--    class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"--}}
                    {{--    id="btn_add_new_follow"--}}
                    {{--    href="#"--}}
                    {{--    style="font-size: 13px;width:95px"--}}
                    {{--    data-id=""--}}
                    {{--><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>--}}
                    <a href="#"
                       class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px filter-btn-second-table"
                       id="delete_all_follow_ups_fillter" title="Delete Filter">
                        @include('CRM.partials.img-filter')
                    </a>
                </div>
                <div id="follow-ups-table" class="mt-1">
                    <div class="header-search" style="padding: 7px">
                        <a class="btn btn-falcon-info btn-sm sxme btn_status mr-3 font-size-12px" data-value="0"
                           href="#!" id="follow_status">{{$fl_up_status[0]}}
                            <sup style="color: red" id="count_{{$fl_up_status[0]}}">{{countFlStatus_zero(0)}}</sup>
                        </a>
                        <a class="btn btn-falcon-info btn-sm sxme btn_status mr-3 font-size-12px" data-value="1"
                           href="#!" id="follow_status">{{$fl_up_status[1]}}
                            <sup style="color: red" id="count_{{$fl_up_status[1]}}">{{countFlStatus_zero(1)}}</sup>
                        </a>
                        <a class="btn btn-falcon-info btn-sm sxme btn_status mr-3 font-size-12px" data-value="2"
                           href="#!" id="follow_status">{{$fl_up_status[2]}}
                            <sup style="color: red" id="count_{{$fl_up_status[2]}}">{{countFlStatus_zero(2)}}</sup>
                        </a>
                        <a class="btn btn-falcon-info btn-sm sxme btn_status mr-3 font-size-12px" data-value="3"
                           href="#!" id="follow_status">{{$fl_up_status[3]}}
                            <sup style="color: red" id="count_{{$fl_up_status[3]}}">{{countFlStatus_zero(3)}}</sup>
                        </a>

                        <a class="btn btn-falcon-info btn-sm sxme btn_status mr-3 font-size-12px"
                           href="javascript:void(0)" onclick="searchHotIssue()">Hot issue
                            <sup style="color: red" id="count_hot_issue">{{countHotIssue()}}</sup>
                        </a>

                    </div>
                    @include('CRM.elements.task.sale.table.follow-up-agent')
                </div>
            </div>

            {{--     remind follow ups       --}}
            <div class="tab-pane fade" id="remind-follow-ups" role="tabpanel"
                 aria-labelledby="remind-follow-ups">
                <div class="d-flex justify-content-end mt-1">
                    {{--<a--}}
                    {{--    class="form-control form-control-sm btn btn-falcon-default btn-sm sxme btn_add_new_appointment"--}}
                    {{--    id="btn_add_new_appointment"--}}
                    {{--    href="{{route('event.create',['submit_form'=>'task_sale'])}}"--}}
                    {{--    style="font-size: 13px;width:95px"--}}
                    {{--    data-id=""--}}
                    {{--><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>--}}
                    {{--                    <a href="#"--}}
                    {{--                       class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px filter-btn-second-table"--}}
                    {{--                       id="delete_all_appointment_fillter" title="Delete Filter">--}}
                    {{--                        @include('CRM.partials.img-filter')--}}
                    {{--                    </a>--}}
                </div>
                <div id="remind-follow-up-table" class="mt-1">
                    @include('CRM.elements.task.remind-follow-ups.index')
                </div>
            </div>
            <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">
                <div class="d-flex justify-content-end mt-1">
                    {{--<a--}}
                    {{--    class="form-control form-control-sm btn btn-falcon-default btn-sm sxme btn_add_new_appointment"--}}
                    {{--    id="btn_add_new_appointment"--}}
                    {{--    href="{{route('event.create',['submit_form'=>'task_sale'])}}"--}}
                    {{--    style="font-size: 13px;width:95px"--}}
                    {{--    data-id=""--}}
                    {{--><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>--}}
                    <a href="#"
                       class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px filter-btn-second-table"
                       id="delete_all_appointment_fillter" title="Delete Filter">
                        @include('CRM.partials.img-filter')
                    </a>
                </div>
                <div id="appointment-table" class="mt-1">
                    @include('CRM.elements.task.sale.table.appointment')
                </div>
            </div>
            <div class="tab-pane fade" id="market-feedback" role="tabpanel" aria-labelledby="market-feedback-tab">
                <div class="d-flex justify-content-end mt-1">
                    {{--<a--}}
                    {{--    class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"--}}
                    {{--    id="btn_add_new_market_feedback"--}}
                    {{--    href="#"--}}
                    {{--    style="font-size: 13px;width:95px"--}}
                    {{--    data-id=""--}}
                    {{--><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>--}}
                    <a href="#"
                       class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px filter-btn-second-table"
                       id="delete_all_market_feedback_fillter" title="Delete Filter">
                        @include('CRM.partials.img-filter')
                    </a>
                </div>
                <div id="market-feedback-table" class="mt-1">
                    @include('CRM.elements.task.sale.table.market-feedback-agent')
                </div>
            </div>
            <div class="tab-pane fade" id="competition-feedback" role="tabpanel"
                 aria-labelledby="competition-feedback-tab">
                <div class="d-flex justify-content-end mt-1">
                    {{--<a--}}
                    {{--    class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"--}}
                    {{--    id="btn_add_new_competition_feedback"--}}
                    {{--    href="#"--}}
                    {{--    style="font-size: 13px;width:95px"--}}
                    {{--    data-id=""--}}
                    {{--><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>--}}
                    <a href="#"
                       class="filter-btn-second-table btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px"
                       id="delete_all_competitor_feedback_fillter" title="Delete Filter">
                        @include('CRM.partials.img-filter')
                    </a>
                </div>
                <div id="competition-feedback-table" class="mt-1">
                    @include('CRM.elements.task.sale.table.competitor-feedback-agent')
                </div>
            </div>
            @foreach($typeSaleTask as $key=>$type)
                <div class="tab-pane fade" id="marketing-support" role="tabpanel"
                     aria-labelledby="marketing-support-tab">
                    <div class="d-flex justify-content-end mt-1">
                        {{--<a--}}
                        {{--    class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"--}}
                        {{--    id="create_{{$type}}_sale"--}}
                        {{--    href="#"--}}
                        {{--    style="font-size: 13px;width:95px"--}}
                        {{--    data-id=""--}}
                        {{--    is-click='false'--}}
                        {{--><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>--}}
                        <a href="#" is-click='false'
                           class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px filter-btn-second-table"
                           id="delete_all_{{$type}}_fillter" title="Delete Filter">
                            @include('CRM.partials.img-filter')
                        </a>
                    </div>
                    <div id="marketing-support-table" class="mt-1">
                        @include('CRM.elements.task.sale.table.sale_task_assign',['typeTask'=>$type,'typeTask_id'=>$key,'dataOnly'=>'agent'])
                    </div>
                </div>
            @endforeach
            <div class="tab-pane fade" id="proposal" role="tabpanel" aria-labelledby="proposal-tab">
                <div class="d-flex justify-content-end mt-1">
                    {{--<a--}}
                    {{--    class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"--}}
                    {{--    id="btn_add_new_proposal"--}}
                    {{--    href="#"--}}
                    {{--    style="font-size: 13px;width:95px"--}}
                    {{--    data-id=""--}}
                    {{--><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>--}}
                    <a href="#"
                       class="btn btn-falcon-default btn-sm mr-2 font-weight-normal font-size-12px filter-btn-second-table"
                       id="delete_all_proposal_fillter" title="Delete Filter">
                        @include('CRM.partials.img-filter')
                    </a>
                </div>
                <div id="proposal-table" class="mt-1">
                    @include('CRM.elements.task.sale.table.proposal-agent')
                </div>
            </div>

        </div>
    </div>
</div>
<div class="card mb-3">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="fs-0 mb-0 font-size-14px">AGENT DEFAULT</h5>
            </div>
        </div>
    </div>
    <div class="card-body py-2">
        <form action="{{route('crm.setAgentDefault')}}" method="GET">
            @csrf
            <div class="form-group agent_default_select2">
                <select name="id_agent" id="agent_default_id" class="form-control">
                    {{--                    @foreach($users as $user)--}}
                    {{--                        <option--}}
                    {{--                            value="{{$user->id}}" {{($user->is_default == 1)?'selected':''}}>{{$user->name}}</option>--}}
                    {{--                    @endforeach--}}
                </select>
            </div>
            <button type="submit" class="btn btn-dark">Save</button>
        </form>
    </div>
    <div class="card-footer border-top">

    </div>
</div>


<div id="modal_marketing_support_form"></div>
<div id="modal_agent">

</div>

<div id="modal_contact">

</div>

<div id="div_modal_comm">

</div>

<div id="div_modal_support">

</div>

<div id="modal_email">
    @include('CRM.elements.agents.modal-email')
</div>
@include('CRM.elements.agents.modal-delete')
{{--@include('CRM.elements.agents.modal_attach')--}}
@include('CRM.elements.agents.modal-support')

<div id="modal-agent-person-charge">
    @include('CRM.elements.agents.modal.modal_person_in_charge')
</div>
<div id="modal-show-contact-agent">

</div>
<!--  modal hiển thị cột  Delete -->


<!--  modal hiển email -->

<div id="modal-validation-error">
    @if(session()->has('validation_errors'))
        <div class="modal fade" id="validationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Errors</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            @foreach(session()->get('validation_errors') as $one)
                                <li>{{$one}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @push('scripts')
            @if(session()->has('validation_errors') && session()->get('validation_errors') != [])
                <script>
                    $('#agent_default_id').select2({
                        dropdownParent: $('.agent_default_select2'),
                        ajax: {
                            url: '{{route('agent.getAgentSelect')}}',
                            type: 'GET',
                            quietMillis: 10000,
                            dataType: 'json',
                            data: function (term) {
                                var query = {
                                    name: term.term,
                                }
                                return query
                            },
                            processResults: function (data) {
                                // Transforms the top-level key of the response object from 'items' to 'results'

                                var results = []
                                data.forEach(e => {
                                    results.push({
                                        id: e.id,
                                        text: e.name,
                                    })
                                })
                                return {
                                    results: results,
                                }
                            },
                        },
                    })

                    var hoverTable = ''
                    $(document).on('mouseover', '.card-table-training', function () {
                        hoverTable = 'training'
                    })
                    $(document).on('mouseover', '.card-table-proposal', function () {
                        hoverTable = 'proposal'
                    })
                    $(document).on('mouseover', '.card-table-competitor-feedback', function () {
                        hoverTable = 'competitor-feedback'
                    })
                    $(document).on('mouseover', '.card-table-market-feedback', function () {
                        hoverTable = 'market-feedback'
                    })
                    $(document).on('mouseover', '.card-table-follow-up-agent', function () {
                        hoverTable = 'follow-up-agent'
                    })
                    $(document).on('mouseover', '.card-table-appointment', function () {
                        console.log(111)
                        hoverTable = 'appointment'
                    })

                    $('#id_agent').select2()
                    $('#validationModal').modal('show')


                </script>
@endif
@include('CRM.partials.choose_date',[
'ids'=>[
    'registered_date_filter',
    'created_at_filter'
]
])
@include('CRM.elements.agents.partials.js.script-loading',[
'elementFilterIds'=>
    [
        'name',
        'agent_code',
        'info_type_id',
        'user_status',
        'market_id',
        'email',
        'tel_1',
        'tel_2',
        'website',
        'country',
        'city',
        'office',
        'department',
        'staff_id',
        'registered_date',
        'created_at',
        'note1',
        'note2',
        'potential_service',
        'rating'
    ],
    'element_class_btn_row_edit'=>'agent_data_edit',
    'element_id_row_edit'=>'data-agent']
    )

@include('CRM.partials.choose_date',['ids'=>[
    'process_date_follow_up',
    'processing_date_market_feedback',
    'processing_date_competition_feedback',
    'processing_date_marketing_support',
    'processing_date_proposal'
]])

@include('CRM.partials.fancybox-class-popup',[
'classElements'=>[
'agent_data_show',
'btn_add_new_appointment'
]
])
@endpush


