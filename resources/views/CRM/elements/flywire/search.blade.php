<div class="card mb-3">
    <div class="contenr-header">
        <div class="card-header">
            <div class="row row-blof">
                <form action="">
                    <div class="col-lg-12 col-left nth-ofe">
                        <div class="select-box">
                            <div class="form-row">
                                <div class="col-md-2 col-sm-4 col-xs-6">
                                    <label for="event-type">Department Agent</label>
                                    <select class="form-control form-control-sm" id="f_department" name="f_department">
                                        <option value="">all</option>
                                        @foreach(config('myconfig.department') as $key=>$value)
                                            <option
                                                value={{$key}} {{request()->get('f_department') ? (request()->get('f_department') == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6">
                                    <label for="event-type">Period</label>
                                    <select class="form-control form-control-sm" id="f_period" name="f_period">
                                        <option value="">all</option>
                                        <option
                                            value="1" {{request()->get('f_period') ? (request()->get('f_period') == '1' ? 'selected' : '') : ''}}>
                                            Today
                                        </option>
                                        <option
                                            value="2" {{request()->get('f_period') ? (request()->get('f_period') == '2' ? 'selected' : '') : ''}}>
                                            This week
                                        </option>
                                        <option
                                            value="3" {{request()->get('f_period') ? (request()->get('f_period') == '3' ? 'selected' : '') : ''}}>
                                            This month
                                        </option>
                                        <option
                                            value="4" {{request()->get('f_period') ? (request()->get('f_period') == '4' ? 'selected' : '') : ''}}>
                                            This year
                                        </option>
                                        <option
                                            value="t01" {{request()->get('f_period') ? (request()->get('f_period') == 't01' ? 'selected' : '') : ''}}>
                                            January
                                        </option>
                                        <option
                                            value="t02" {{request()->get('f_period') ? (request()->get('f_period') == 't02' ? 'selected' : '') : ''}}>
                                            February
                                        </option>
                                        <option
                                            value="t03" {{request()->get('f_period') ? (request()->get('f_period') == 't03' ? 'selected' : '') : ''}}>
                                            March
                                        </option>
                                        <option
                                            value="t04" {{request()->get('f_period') ? (request()->get('f_period') == 't04' ? 'selected' : '') : ''}}>
                                            April
                                        </option>
                                        <option
                                            value="t05" {{request()->get('f_period') ? (request()->get('f_period') == 't05' ? 'selected' : '') : ''}}>
                                            May
                                        </option>
                                        <option
                                            value="t06" {{request()->get('f_period') ? (request()->get('f_period') == 't06' ? 'selected' : '') : ''}}>
                                            June
                                        </option>
                                        <option
                                            value="t07" {{request()->get('f_period') ? (request()->get('f_period') == 't07' ? 'selected' : '') : ''}}>
                                            July
                                        </option>
                                        <option
                                            value="t08" {{request()->get('f_period') ? (request()->get('f_period') == 't08' ? 'selected' : '') : ''}}>
                                            August
                                        </option>
                                        <option
                                            value="t09" {{request()->get('f_period') ? (request()->get('f_period') == 't09' ? 'selected' : '') : ''}}>
                                            September
                                        </option>
                                        <option
                                            value="t10" {{request()->get('f_period') ? (request()->get('f_period') == 't10' ? 'selected' : '') : ''}}>
                                            October
                                        </option>
                                        <option
                                            value="t11" {{request()->get('f_period') ? (request()->get('f_period') == 't11' ? 'selected' : '') : ''}}>
                                            November
                                        </option>
                                        <option
                                            value="t12" {{request()->get('f_period') ? (request()->get('f_period') == 't12' ? 'selected' : '') : ''}}>
                                            December
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6">
                                    <label for="timepicker2">From Date Initiated</label>
                                    <input class="form-control form-control-sm datetimepicker" id="f_time_start" data-options='{"dateFormat":"d/m/Y"}' name="f_time_start" value="{{!empty(request()->get('f_time_start'))?request()->get('f_time_start'):''}}">
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6">
                                    <label for="timepicker2">To Date Initiated</label>
                                    <input class="form-control form-control-sm datetimepicker" id="f_time_end" data-options='{"dateFormat":"d/m/Y"}' name="f_time_end" value="{{!empty(request()->get('f_time_end'))?request()->get('f_time_end'):''}}">
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6">
                                    <label for="event-type">Payment come from</label>
                                    <select class="form-control form-control-sm" id="f_country" name="f_country">
                                        <option value=''>all</option>
                                        @foreach(config('country.list') as $key=>$value)
                                            <option
                                                value={{$key}} {{request()->get('f_country') ? (request()->get('f_country') == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="col-md-2 col-sm-4 col-xs-6">--}}
                                {{--    <label for="event-type">Status</label>--}}
                                {{--    <select class="form-control form-control-sm" id="f_status" name="f_status">--}}
                                {{--        <option value=''>all</option>--}}
                                {{--        @foreach(config('myconfig.payment_status') as $key=>$value)--}}
                                {{--            <option--}}
                                {{--                value={{$key}}>{{$value}}</option>--}}
                                {{--        @endforeach--}}
                                {{--    </select>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-4 col-right col-top nth-ofe ">
                        <div class="form-row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-new">
                                <label for=""></label>
                                <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"
                                href="{{route('flywire.create')}}" style="font-size: 13px;"><span class="fas fa-plus mr-1" data-fa-transform="shrink-3"></span> <span>New</span></a>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-6 col-send-email">
                                <label for=""></label>
                                <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme send_email"
                                type="button"><span class="far fa-envelope" data-fa-transform="shrink-3"></span>
                                    <span>Send email</span>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-fillter">
                                <label for=""></label>
                                <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme cutum-frm-hide"
                                type="button"><span class="far fa-search" data-fa-transform="shrink-3"></span>
                                    <span>Fillter</span>
                                </a>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg-4 col-right col-bottom nth-ofe bt-bgr">
                        <div class="bottom-text">

                            <div class="form-row">
                                <div class="col-lg-2 col-md-3 col-sm-6 col-com">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"
                                    href="{{route('customer.index')}}"><span>Cus</span></a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-com">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"
                                    href="{{route('customer.getCommAplly', ['tab'=>'com'])}}"><span>Com</span></a>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-profit">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"
                                    href="{{route('customer.getCommAplly', ['tab'=>'profit'])}}"><span>Profit</span></a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-refund">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"
                                    href="{{route('customer.getCommAplly', ['tab'=>'refund'])}}"><span>Refund</span></a>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-extend">
                                    <a class="form-control form-control-sm btn btn-falcon-default btn-sm sxme"
                                    href="{{route('customer.getCommAplly', ['tab'=>'extend'])}}"><span>Extend</span></a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12 col-left nth-ofe">
                        <div class="agent-create-a">
                            <div class="d-flex flywire-header-filter">
                                <div class="">
                                    <a class="btn btn-falcon-info btn-sm mr-3 font-size-12px border border-radius-20px btn_status"
                                    data-value='' href="#!">
                                        All
                                        <sup style="color: red" id="total_flywire_filter"></sup>
                                    </a>
                                </div>

{{--                                @foreach(config('myconfig.flywire_status') as $key=>$value)--}}
{{--                                    <div class="">--}}
{{--                                        <a class="btn btn-falcon-info btn-sm btn_status mr-3 font-size-12px border border-radius-20px"--}}
{{--                                        data-value='{{$key}}' href="?f_status={{$key}}">--}}
{{--                                            {{$value}}--}}
{{--                                            <sup style="color: red">({{(!empty($invoiceCount))?$invoiceCount->where('status', $key)->count():''}})</sup>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
{{--                        <button type="submit" class="btn btn-primary">Search</button>--}}
{{--                        <a href="{{route('flywire.index')}}" class="btn btn-danger">Reset</a>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
