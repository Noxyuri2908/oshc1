@if(session('error-list-customer'))
    <div class="alert alert-danger">
        <strong>{{session('error-list-customer')}}</strong>
    </div>
@endif
@if(session('success-list-customer'))
    <div class="alert alert-success">
        <strong>{{session('success-list-customer')}}</strong>
    </div>
@endif
<div class="card mb-3">
    <div class="contenr-header">
        <div class="card-header">
            <div class="row row-blof">
                <div class="col-lg-8 col-left nth-ofe">
                    <div class="select-box mb-2">
                        <div class="form-row">
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <select class="form-control form-control-sm" id="f_department" name="f_department">
                                    <option value="">Department</option>
                                    @foreach(config('myconfig.department') as $key=>$value)
                                        <option
                                            value={{$key}} {{isset($f_data) ? ($f_data['f_department'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <select class="form-control form-control-sm" id="f_period" name="f_period">
                                    <option value="">Period</option>
                                    <option
                                        value="1" {{isset($f_data) ? ($f_data['f_period'] == '1' ? 'selected' : '') : ''}}>
                                        Today
                                    </option>
                                    <option
                                        value="2" {{isset($f_data) ? ($f_data['f_period'] == '2' ? 'selected' : '') : ''}}>
                                        This week
                                    </option>
                                    <option
                                        value="3" {{isset($f_data) ? ($f_data['f_period'] == '3' ? 'selected' : '') : ''}}>
                                        This month
                                    </option>
                                    <option
                                        value="4" {{isset($f_data) ? ($f_data['f_period'] == '4' ? 'selected' : '') : ''}}>
                                        This year
                                    </option>
                                    <option
                                        value="t01" {{isset($f_data) ? ($f_data['f_period'] == 't1' ? 'selected' : '') : ''}}>
                                        January
                                    </option>
                                    <option
                                        value="t02" {{isset($f_data) ? ($f_data['f_period'] == 't2' ? 'selected' : '') : ''}}>
                                        February
                                    </option>
                                    <option
                                        value="t03" {{isset($f_data) ? ($f_data['f_period'] == 't3' ? 'selected' : '') : ''}}>
                                        March
                                    </option>
                                    <option
                                        value="t04" {{isset($f_data) ? ($f_data['f_period'] == 't4' ? 'selected' : '') : ''}}>
                                        April
                                    </option>
                                    <option
                                        value="t05" {{isset($f_data) ? ($f_data['f_period'] == 't5' ? 'selected' : '') : ''}}>
                                        May
                                    </option>
                                    <option
                                        value="t06" {{isset($f_data) ? ($f_data['f_period'] == 't6' ? 'selected' : '') : ''}}>
                                        June
                                    </option>
                                    <option
                                        value="t07" {{isset($f_data) ? ($f_data['f_period'] == 't7' ? 'selected' : '') : ''}}>
                                        July
                                    </option>
                                    <option
                                        value="t08" {{isset($f_data) ? ($f_data['f_period'] == 't8' ? 'selected' : '') : ''}}>
                                        August
                                    </option>
                                    <option
                                        value="t09" {{isset($f_data) ? ($f_data['f_period'] == 't9' ? 'selected' : '') : ''}}>
                                        September
                                    </option>
                                    <option
                                        value="t10" {{isset($f_data) ? ($f_data['f_period'] == 't10' ? 'selected' : '') : ''}}>
                                        October
                                    </option>
                                    <option
                                        value="t11" {{isset($f_data) ? ($f_data['f_period'] == 't11' ? 'selected' : '') : ''}}>
                                        November
                                    </option>
                                    <option
                                        value="t12" {{isset($f_data) ? ($f_data['f_period'] == 't12' ? 'selected' : '') : ''}}>
                                        December
                                    </option>
                                </select>
                            </div>
                            {{--                            <div class="col-md-2 col-sm-4 col-xs-6">--}}
                            {{--                                <label for="timepicker2">From/To Date</label>--}}
                            {{--                                <input class="form-control form-control-sm datetimepicker"--}}
                            {{--                                       value="{{isset($f_data) ? $f_data['f_time'] : ''}}" id="f_time" type="f_time"--}}
                            {{--                                       data-options='{"mode":"range","dateFormat":"Y-m-d"}'>--}}
                            {{--                            </div>--}}
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <input class="form-control form-control-sm datetimepicker" id="f_time_start" data-options='{"dateFormat":"d/m/Y"}' name="f_time[]" value="">
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <input class="form-control form-control-sm datetimepicker" id="f_time_end" data-options='{"dateFormat":"d/m/Y"}' name="f_time[]" value="">
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <select class="form-control form-control-sm" id="f_country" name="f_country">
                                    <option value=''>Select country service</option>
                                    @foreach(config('myconfig.service_country') as $key=>$value)
                                        <option
                                            value="{{$key}}" {{isset($f_data) ? ($f_data['f_country'] == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-right col-top nth-ofe ">
                    <div class="form-row">
                    </div>
                </div>
                <div class="col-lg-4 col-right col-bottom nth-ofe bt-bgr">
                    <div class="bottom-text">
                        <div class="form-row">
                            @can('customer.index')
                                <div class="col-lg-2 col-md-3 col-sm-6 col-com">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme d-flex justify-content-center align-items-center"
                                       href="{{route('customer.index')}}"><span class="white-space-pre-text">Cus</span></a>
                                </div>
                            @endcan
                            @can('commissionInvoice.index')
                                <div class="col-lg-2 col-md-3 col-sm-6 col-com">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme d-flex justify-content-center align-items-center"
                                       href="{{route('customer.getCommAplly', ['tab'=>'com'])}}"><span
                                            class="white-space-pre-text">Com</span></a>
                                </div>
                            @endcan
                            @can('profitInvoice.index')
                                <div class="col-lg-2 col-md-3 col-sm-6 col-profit">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme d-flex justify-content-center align-items-center"
                                       href="{{route('customer.getCommAplly', ['tab'=>'profit'])}}"><span
                                            class="white-space-pre-text">Profit</span></a>
                                </div>
                            @endcan
                            @can('refundInvoice.index')
                                <div class="col-lg-3 col-md-3 col-sm-6 col-refund">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme d-flex justify-content-center align-items-center"
                                       href="{{route('customer.getCommAplly', ['tab'=>'refund'])}}"><span
                                            class="white-space-pre-text">Refund</span></a>
                                </div>
                            @endcan
                            @can('extendInvoice.index')
                                <div class="col-lg-3 col-md-3 col-sm-6 col-extend">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme d-flex justify-content-center align-items-center"
                                       href="{{route('customer.getCommAplly', ['tab'=>'extend'])}}"><span
                                            class="white-space-pre-text">Extend</span></a>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-left nth-ofe">
                    <div class="agent-create-a">
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-falcon-info btn-sm btn_status mr-3 font-size-12px border border-radius-20px"
                               data-value='' href="#">
                                All
                                <sup id="count_total_filter" style="color: red"></sup>
                            </a>
                            <div id="customer_filter_box">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--@include('CRM.elements.customers.fillter')--}}

<!-- CONTENT -->
<div id="customer_content">
    @include('CRM.elements.customers.content')
    <div class="loading-fixed-top">Loading&#8230;</div>
</div>

<div id="customer_detail">
    <div class="card mb-3">
        <div class="fancy-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @can('customerReceipt.index')
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-receipt" role="tab"
                                            aria-controls="tab-receipt" aria-selected="true">Receipt</a></li>
                @endcan
                @can('customerDoc.index')
                    <li class="nav-item"><a
                            class="nav-link {{!auth()->user()->can('customerReceipt.index')?'active':''}}"
                            data-toggle="tab" href="#tab-docs" role="tab"
                            aria-controls="tab-docs" aria-selected="false">Docs</a></li>
                @endcan
            </ul>
            <div class="tab-content border-x border-bottom p-3" id="myTabContent">
                @can('customerReceipt.index')
                    <div class="tab-pane fade show active" id="tab-receipt" role="tabpanel" aria-labelledby="home-tab">
                        <div class="alert-modal-receipt"></div>
                        <div class="d-flex">
                            @can('customerReceipt.store')
                                <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme create-receipt-customer"
                                   href="#" style="font-size: 13px;"><span class="fas fa-plus mr-1"
                                                                           data-fa-transform="shrink-3"></span>
                                    <span>New</span></a>
                            @endcan
                            <div class="total-receipt-amount">
                                Total amount : 0
                            </div>
                            <div class="pl-2">
                                | Total exchange rate: <span class="total-receipt-exchange-rate">0</span>
                            </div>
                                <div class="pl-2">
                                    | Total : <span class="total-apply">0</span>
                                </div>
                        </div>

                        {{--                    data-toggle="modal" data-target="#myModalReceipt"--}}
                        <div class="table-responsive apply-receipt">
                            @include('CRM.elements.customer-process.table-receipt')
                        </div>
                        <div class="modal fade bd-example-modal-lg" id="myModalReceipt" role="dialog">
                            <div class="modal-dialog max-width-70">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body show-receipt">
                                        @include('CRM.partials.receipt_form')
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        @can('customerReceipt.update')
                                            <button type="button" class="btn btn-primary btn-receipt" id="btn-receipt">
                                                Submit
                                            </button>
                                        @endcan
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endcan
                @can('customerDoc.index')
                    <div
                        class="tab-pane fade {{!auth()->user()->can('customerReceipt.index') && auth()->user()->can('customerDoc.index')?'show active':''}}"
                        id="tab-docs" role="tabpanel" aria-labelledby="docs-tab">
                        <div class="alert-modal-receipt"></div>
                        <div class="form-submit clearfix tab-form-1">
                            <div class="bottom-submit">
                                @can('customerDoc.store')
                                    <button class="btn btn-falcon-default btn-sm mr-1 mb-1" type="button" data-type=2
                                            id="btn_add_doc">
                                        <span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> Add
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive" id="div_table_doc_receipt">
                            @include('CRM.elements.customer-process.table-doc')
                        </div>
                        <div id="div_modal_doc">

                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <!-- CONTENT -->
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

@include('CRM.elements.customers.modal-delete'){{--
  @include('CRM.elements.agents.modal_attach')
  @include('CRM.elements.agents.modal-support') --}}

<!--  modal hiển thị cột  Delete -->


    <!--  modal hiển email -->

    @push('scripts')
        <script>
            $(document).on('mouseover', '.choose-date-form', function () {
                let start_date_class = $(this).hasClass('flatpickr-input')
                if (!start_date_class) {
                    $(this).flatpickr({
                        dateFormat: 'd/m/Y',
                        allowInput: true,
                    })
                }
            })
        </script>
@endpush




