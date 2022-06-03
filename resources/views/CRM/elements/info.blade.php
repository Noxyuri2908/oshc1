<div class="sticky-top sticky-sidebar  sidebar-left">
    <div class="card mb-3 mb-lg-0">
        <div class="card-body bg-light">
            <h6><b>SERVICE DETAIL</b></h6>
            <div class="pat-sidebar">
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio4">
                        <strong>Agent</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj->agent))?$obj->agent->name:''}}</small>
                </div>
            </div>

            <div class="pat-sidebar">
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio4">
                        <strong>Country</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj->agent))?$obj->agent->country():''}}</small>
                </div>
            </div>
            <div class="pat-sidebar">
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio4">
                        <strong>Ref No / Status</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{$obj->ref_no}} / {{$obj->statusText()}}</small>
                </div>
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio4">
                        <strong>Full Name</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj->registerCus()))?$obj->registerCus()->first_name.' '.$obj->registerCus()->last_name:''}}</small>
                </div>

                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio5">
                        <strong>Service / Provider</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{(!empty($obj->service))?$obj->service->name:''}} / {{(!empty($obj->provider))?$obj->provider->name:''}}</small>
                </div>
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio5">
                        <strong>No adults / children</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{$obj->no_of_adults}} / {{$obj->no_of_children}}</small>
                </div>
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio5">
                        <strong>Start date/ End date</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{convert_date_form_db($obj->start_date)}} / {{convert_date_form_db($obj->end_date)}}</small>
                </div>
            </div>
            <!-- <hr class="border-dashed border-bottom-0"> -->
            <h6><b>PAYMENT DETAIL</b></h6>
            <div class="pat-sidebar">
                <div class="form-group custom-control custom-radio">
                    {{--         @dd($obj->net_amount);--}}

                    {{--         {{dd($obj->provider)}}--}}
                    <label class="custom-control-label" for="customRadio4"> <strong>Net amount / Total</strong></label>
                    <small class="form-text mt-0" style="color: #01A9DB">
                        {{$obj->net_amount.' '.(!empty($obj->provider)?$obj->provider->currency():'')}} / {{$obj->total." ".(!empty($obj->provider)?$obj->provider->currency():'')}}
                    </small>
                </div>
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio5">
                        <strong>Staff</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{$obj->staff != null ? $obj->staff->admin_id : ''}}</small>
                </div>
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio5">
                        <strong>Creation date</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{convert_date_form_db($obj->created_at)}}</small>
                </div>
                <div class="form-group custom-control custom-radio">
                    <label class="custom-control-label" for="customRadio5"> <strong>Issue date of certificate:</strong></label><small class="form-text mt-0" style="color: #01A9DB">{{$obj->hoahong != null ? convert_date_form_db($obj->hoahong->issue_date) : ''}}</small>
                </div>
            </div>


        </div>
    </div>
</div>
