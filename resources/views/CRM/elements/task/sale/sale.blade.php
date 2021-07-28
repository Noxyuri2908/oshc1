@extends('CRM.layouts.default')

@section('title')
    TASKS Sale
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

        .width-140{
            width: 140px;
        }

        .white-space-break-spaces {
            text-overflow: ellipsis;
            overflow: hidden;
            color: #323338cc;
        }

        .bg-pale-gray {
            background-color: #fff;
        }

        .table-div select {
            padding: 0 20px;
        }


</style>
@stop
@section('content')
    <div id='sale_task'>
        <div class="card card-custom">
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-2">
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
                        <div class="col-md-4">
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
                                <button class="btn btn-link" type="submit" style="color: black">
                                    <span style="font-size: 1.3rem">
                                        <i class="fal fa-search"></i>
                                    </span>
                                    Search
                                </button>
                                <a href="#" class="btn btn-link ml-2 export_to_excel_many_table" style="color: black">
                                    <span style="font-size: 1.3rem">
                                        <i class="fal fa-file-export"></i>
                                    </span>
                                    Export
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @can('followUp.index')
            <div class="card card-table-follow-up-agent">
                <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                    <h5>FOLLOW UPS AGENT</h5>
                    <div class="">
                        <a href="#" class="btn btn-link" is-click='false'
                           id='delete_all_follow_ups_fillter' style="color: black">Clear filter</a>
                        @can('followUp.store')
                            <a href="#" class="btn btn btn-link" is-click='false' id='btn_add_new_follow' style="color: black">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                Add
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @include('CRM.elements.task.sale.table.follow-up-agent', ['configFollowsUpByOrder' => $configFollowsUpByOrder])
                </div>
            </div>
        @endcan
        @can('google_calendar.index')
            <div class="card mt-3 card-table-appointment">
                <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                    <h5>APPOINTMENT & VISIT AGENT</h5>
                    <div class="">
                        <a href="#" class="btn btn-link " is-click='false'
                           id='delete_all_appointment_fillter'>Clear filter</a>
                        @can('google_calendar.store')
                            <a href="{{route('event.create',['submit_form'=>'task_sale'])}}"
                               class="btn btn-link " is-click='false' id="btn_add_new_appointment">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                Add
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @include('CRM.elements.task.sale.table.appointment')
                </div>
            </div>
        @endcan
        @can('agentFeedback.index')
            <div class="card mt-3 card-table-market-feedback">
                <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                    <h5>AGENT FEEDBACK</h5>
                    <div class="">
                        <a href="#" class="btn btn-link " is-click='false'
                           id='delete_all_market_feedback_fillter'>Clear filter</a>
                        @can('agentFeedback.store')
                            <a href="#" class="btn btn-link " is-click='false'
                               id="btn_add_new_market_feedback">
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                Add
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @include('CRM.elements.task.sale.table.market-feedback-agent')
                </div>
            </div>
        @endcan
        @can('competitorUpdate.index')

            <div class="card mt-3 card-table-competitor-feedback">
                <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                    <h5>COMPETITOR UPDATE</h5>
                    <div class="">
                        <a href="#" class="btn btn-link " id='delete_all_competitor_feedback_fillter'>Clear filter
                        </a>
                        @can('competitorUpdate.store')
                            <a href="#" class="btn btn-link " id='btn_add_new_competition_feedback'>
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                Add
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @include('CRM.elements.task.sale.table.competitor-feedback-agent')
                </div>
            </div>
        @endcan
        @can('tasksAsigned.index')
            @foreach($typeSaleTask as $key=>$type)
                <div class="card mt-3 card-table-{{$type}}">
                    <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                        <h5>{{trans('lang.'.$type)}}</h5>
                        <div class="">
                            <a href="#" class="btn btn-link " is-click='false'
                               id='delete_all_{{$type}}_fillter'>Clear filter</a>
                            @can('tasksAsigned.store')
                                <a href="#" class="btn btn-link " is-click='false'
                                   id='create_{{$type}}_sale'><span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                    Add</a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        @include('CRM.elements.task.sale.table.sale_task_assign',['typeTask'=>$type,'typeTask_id'=>$key])
                    </div>
                </div>
            @endforeach
        @endcan
        @can('proposal.index')

            <div class="card mt-3 card-table-proposal">
                <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                    <h5>PROPOSAL</h5>
                    <div class="">
                        <a href="#" class="btn btn-link " id='delete_all_proposal_fillter'>Clear filter
                        </a>
                        @can('proposal.store')
                            <a href="#" class="btn btn-link " id='btn_add_new_proposal'>
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                Add</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @include('CRM.elements.task.sale.table.proposal-agent')
                </div>
            </div>
        @endcan
        @can('training.index')
            <div class="card mt-3 card-table-training">
                <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                    <h5>TRAINING</h5>
                    <div class="">
                        <a href="#" class="btn btn-link " is-click='false'
                           id='delete_all_training_fillter'>Clear filter</a>
                        @can('training.store')
                            <a href="#" class="btn btn-link " is-click='false' id='create_training_sale'>
                                <span>
                                    <i class="fal fa-plus"></i>
                                </span>
                                Add</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @include('CRM.elements.task.sale.table.training-agent')
                </div>
            </div>
        @endcan
        @can('agentReport.index')
            <div class="card mt-3 card-table-agent-report">
                <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                    <h5>AGENT REPORT</h5>
                    <div class="">
                        {{--<a href="#" class="btn btn-link " is-click='false'--}}
                        {{--   id='delete_all_agent-report_fillter'>Delete Filter</a>--}}
                        {{--<a href="#" class="btn btn-link " is-click='false' id='create_agent_report_sale'><i--}}
                        {{--        class="fas fa-plus"></i></a>--}}
                    </div>
                </div>
                <div class="card-body">
                    @include('CRM.elements.task.sale.table.agent-report')
                </div>
            </div>
        @endcan
        @can('processingFollowUp.index')
            <div class="card mt-3 card-table-invoice-report">
                <div class="card-header card-header-custom d-flex justify-content-between bg-pale-gray">
                    <h5>PENDING INVOICE/CERTIFICATE/EXTEND FOLLOW UP</h5>
                    <div class="">
                        {{--<a href="#" class="btn btn-link " is-click='false'--}}
                        {{--   id='delete_all_invoice-report_fillter'>Delete Filter</a>--}}
                        {{--<a href="#" class="btn btn-link " is-click='false' id='create_invoice_report_sale'><i--}}
                        {{--        class="fas fa-plus"></i></a>--}}
                    </div>
                </div>
                <div class="card-body">
                    @include('CRM.elements.task.sale.table.invoice-report')
                </div>
            </div>
        @endcan
    </div>
    <div id="modal_follow_ups_form"></div>
    <div id="modal_market_feedback_form"></div>
    <div id="modal_competition_feedback_form"></div>
    <div id="modal_marketing_support_form"></div>
    <div id="modal_proposal_form"></div>

    <div class="modal fade" id="exportExcelTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal table excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($tableSale as $check)
                        <div class="form-check">
                            <input type="checkbox" name="table_excel_checked[]" value="{{$check['id']}}" class="form-check-input table_excel_checked" id="{{$check['id']}}">
                            <label class="form-check-label" for="{{$check['id']}}">{{$check['name']}}</label>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-link" id="export_excel_modal">Export</button>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')

    @include('CRM.partials.choose_date',['ids'=>[
        'processing_date_training_start',
        'processing_date_training_end',
        'deadline_training_start',
        'deadline_training_end',
        'processing_date_training',
        'deadline_training',
        'process_date_follow_up',
        'processing_date_market_feedback',
        'processing_date_competition_feedback',
        'processing_date_marketing_support',
        'processing_date_proposal',
        'report_start_date',
        'report_end_date'
    ]]);
    <script>
        $(document).on('click', '.export_to_excel_many_table', function (e) {
            e.preventDefault()
            $('#exportExcelTable').modal('toggle')
        })
        $(document).on('click', '#export_excel_modal', function (e) {
            e.preventDefault()
            var arrChecked = $('input[name="table_excel_checked[]"]:checked').map(function () {
                return this.value
            }).get()
            console.log(arrChecked)

            var report_start_date = "{{(!empty(request()->get('report_start_date')))?request()->get('report_start_date'):''}}"
            var report_end_date = "{{(!empty(request()->get('report_end_date')))?request()->get('report_end_date'):''}}"
            var filter_date_option = "{{request()->get('filter_date_option')}}"
            var urlDefault = "{{route('tasks.exportExcelTaskSale',[
                'arrChecked'=>'arrCheckedData',
                'report_start_date'=>'report_start_date_data',
                'report_end_date'=>'report_end_date_data',
                'filter_date_option'=>'filter_date_option_data',
                'type_table'=>'task_asigned_by_company'
            ])}}"
            var url = urlDefault.replace('arrCheckedData', arrChecked)
            url = url.replace('report_start_date_data', report_start_date)
            url = url.replace('report_end_date_data', report_end_date)
            url = url.replace('filter_date_option_data', filter_date_option)
            url = url.replace(/amp;/g, '')
            window.location.href = url
            console.log(url)
            {{--$.ajax({--}}
            {{--    url:"{{route('tasks.exportExcelTaskSale')}}",--}}
            {{--    type:'get',--}}
            {{--    data:{--}}
            {{--        arrChecked:arrChecked,--}}
            {{--        @if(request()->get('report_end_date') && request()->get('report_start_date'))--}}
            {{--        report_start_date: "{{request()->get('report_start_date')}}",--}}
            {{--        report_end_date: "{{request()->get('report_end_date')}}",--}}
            {{--        @endif--}}
            {{--            @if(request()->get('filter_date_option'))--}}
            {{--        filter_date_option:"{{request()->get('filter_date_option')}}"--}}
            {{--        @endif--}}
            {{--    },--}}
            {{--    success:function(data){--}}
            {{--        // console.log(data);--}}
            {{--    }--}}
            {{--})--}}
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
            hoverTable = 'appointment'
        })
        @foreach($typeSaleTask as $key=>$type)
        $(document).on('mouseover', '.card-table-{{$type}}', function () {
            hoverTable = '{{$type}}'
        })
        @endforeach
    </script>
    <script>
        $.fn.select2.amd.define('CustomSelectionAdapter', [
                'select2/utils',
                'select2/selection/multiple',
                'select2/selection/placeholder',
                'select2/selection/eventRelay',
                'select2/selection/single',
            ],
            function (Utils, MultipleSelection, Placeholder, EventRelay, SingleSelection) {

                // Decorates MultipleSelection with Placeholder
                let adapter = Utils.Decorate(MultipleSelection, Placeholder)
                // Decorates adapter with EventRelay - ensures events will continue to fire
                // e.g. selected, changed
                adapter = Utils.Decorate(adapter, EventRelay)

                adapter.prototype.render = function () {
                    // Use selection-box from SingleSelection adapter
                    // This implementation overrides the default implementation
                    let $selection = SingleSelection.prototype.render.call(this)
                    return $selection
                }

                adapter.prototype.update = function (data) {
                    // copy and modify SingleSelection adapter
                    this.clear()

                    let $rendered = this.$selection.find('.select2-selection__rendered')
                    let noItemsSelected = data.length === 0
                    let formatted = ''

                    if (noItemsSelected) {
                        formatted = this.options.get('placeholder') || ''
                    } else {
                        let itemsData = {
                            selected: data || [],
                            all: this.$element.find('option') || [],
                        }
                        // Pass selected and all items to display method
                        // which calls templateSelection
                        formatted = this.display(itemsData, $rendered)
                    }

                    $rendered.empty().append(formatted)
                    $rendered.prop('title', formatted)
                }

                return adapter
            })//
        $(document).on('mouseover', '.choose_multiple_select', function () {
            let select2_class = $(this).hasClass('select2-hidden-accessible')
            if (!select2_class) {
                $(this).attr('multiple', '')
                $(this).select2({
                    closeOnSelect: false,
                    placeholder: 'Select',
                    allowClear: true,
                    allowHtml: true,
                    selectionAdapter: $.fn.select2.amd.require('CustomSelectionAdapter'),
                    templateSelection: (data) => {
                        return `Select ${data.selected.length} in ${data.all.length} item`
                    },
                })
                $(this).on('select2:close', function (e) {
                    let field = JSON.stringify($('.js-select2').select2('data'))
                    // console.log(field);
                    if (field === '[]') {
                        $('.select2-selection__rendered').removeClass('text-dark')
                    } else {
                        $('.select2-selection__rendered').addClass('text-dark')
                    }
                })
            }
        })
        // $(".choose_multiple_select").select2({
        //     closeOnSelect : false,
        //     placeholder : "Select",
        //     allowClear: true,
        //     allowHtml: true,
        //     selectionAdapter: $.fn.select2.amd.require("CustomSelectionAdapter"),
        //     templateSelection:(data) => {
        //         return`Select ${data.selected.length} in ${data.all.length} item`;
        //     }
        // });
        // $('.choose_multiple_select').on('select2:close',function(e){
        //     let field =  JSON.stringify($('.js-select2').select2('data'));
        //     // console.log(field);
        //     if(field === '[]'){
        //         $('.select2-selection__rendered').removeClass('text-dark');
        //     }else{
        //         $('.select2-selection__rendered').addClass('text-dark');
        //     }
        // });

    </script>
    <script>
        $('#processing_date_follow_ups_start').val('')
        $('#processing_date_follow_ups_end').val('')
        $('#processing_date_appointment_start').val('')
        $('#processing_date_appointment_end').val('')
        $('#processing_date_market_feedback_start').val('')
        $('#processing_date_market_feedback_end').val('')
        $('#processing_date_competitor_feedback_start').val('')
        $('#processing_date_competitor_feedback_end').val('')
        {{--        @foreach($typeSaleTask as $key=>$type)--}}
        {{--        $('#processing_date_'.$type.'_start').val('');--}}
        {{--        $('#processing_date_'.$type.'_end').val('');--}}
        {{--        @endforeach--}}
    </script>
@endpush
