<div class="card mb-3 mt-3">
    <div class="contenr-header">
        <div class="card-header py-3">
            <div class="row row-blof">
                <div class="col-lg-8 col-left nth-ofe">
                    <div class="select-box mb-2">
                        <div class="form-row">
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <select class="form-control" id="f_period" name="f_period" title="Period">
                                    <option value="all">Period</option>
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
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <input class="form-control datetimepicker" id="f_time_start"
                                       data-options='{"dateFormat":"d/m/Y"}' name="f_time_start"
                                       value="{{!empty(request()->get('f_time_start'))?request()->get('f_time_start'):''}}" placeholder="From Date " title="From Date ">
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <input class="form-control datetimepicker" id="f_time_end"
                                       data-options='{"dateFormat":"d/m/Y"}' name="f_time_end"
                                       value="{{!empty(request()->get('f_time_end'))?request()->get('f_time_end'):''}}" placeholder="To Date " title="To Date ">
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6">
                                <select class="form-control " name="f_department" id="f_department" title="Department">
                                    <option label="">Department</option>
                                    @if(!empty(config('myconfig.department')))
                                        @foreach(config('myconfig.department') as $keyDepartment=>$valueDepartment)
                                            <option
                                                value="{{$keyDepartment}}">{{$valueDepartment}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-left nth-ofe">
                    <div class="agent-header-filter d-flex justify-content-start">
                        <a class="btn btn-falcon-info btn-sm sxme btn_status mr-3 font-size-12px"
                           data-value='all' href="#!">
                            All
                            <sup style="color: red" id="count_all_agent_filter"></sup>
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- end -->
    </div>
</div>

@push('scripts')
    @include('CRM.partials.fancybox-link-popup',[
    'ids'=>[
        'btn-show-error-log'
]
])
@endpush

