<div class="bank-choosed on-destop">
    <div class="title-bank">
        <h3>@lang('header.POLICY_SUMMARY')</h3>
    </div>
    <div class="form-choose grey">
        <div class="row-item">
            <div class="col col-md-2 pd0 flex">
                <strong>@lang('header.oshc_provider')</strong>
            </div>
            <div class="col col-md-2 pd0 flex">
                <strong>@lang('header.start_date')</strong>
            </div>
            <div class="col col-md-2 pd0 flex">
                <strong>@lang('header.end_date')</strong>
            </div>
            <div class="col col-md-2 pd0 flex">
                <strong>@lang('header.no_of_adults')</strong>
            </div>
            <div class="col col-md-2 pd0 flex">
                <strong>@lang('header.no_of_child')</strong>
            </div>
            <div class="col col-md-2 pd0 flex">
                <strong>@lang('header.price')</strong>
            </div>
        </div>
        <div class="row-item row-item-2">
            <div class="col col-md-2 pd0 flex">
                <img class="img-provider-payment" src="{{!empty($service)?$service->image:''}}">
            </div>
            <div class="col col-md-2 pd0 flex">
                <span>{{(!empty($start_date))?\Carbon::parse($start_date)->format('d/m/Y'):''}}</span>
            </div>
            <div class="col col-md-2 pd0 flex">
                <span>{{(!empty($end_date))?\Carbon::parse($end_date)->format('d/m/Y'):''}}</span>
            </div>
            <div class="col col-md-2 pd0 flex">
                <span>{{$adults}}</span>
            </div>
            <div class="col col-md-2 pd0 flex">
                <span>{{$childs}}</span>
            </div>

            <div class="col col-md-2 pd0 flex">
                <span class="price-total">{{convert_price_float($price)}}</span>
            </div>
        </div>
    </div>
</div> <!-- end bank-choosed on-destop-->

<div class="bank-choosed on-mobile">
    <div class="title-bank">
        <h3>@lang('header.POLICY_SUMMARY')</h3>
    </div>
    <div class="form-choose grey">
        <table class="table table-striped table-choose-apply">
            <tr>
                <td width="50%" style="
    vertical-align: middle;">
                    <strong>@lang('header.oshc_provider')</strong>
                </td>
                <td width="50%">
                    <img style="width: 70%;" src="{{!empty($service)?$service->image:''}}">
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <strong>@lang('header.start_date')</strong>
                </td>
                <td width="50%">
                    <span>{{(!empty($start_date))?\Carbon::parse($start_date)->format('d/m/Y'):''}}</span>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <strong>@lang('header.end_date')</strong>
                </td>
                <td width="50%">
                    <span>{{(!empty($end_date))?\Carbon::parse($end_date)->format('d/m/Y'):''}}</span>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <strong>@lang('header.no_of_adults')</strong>
                </td>
                <td width="50%">
                    <span>{{$adults}}</span>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <strong>@lang('header.no_of_child')</strong>
                </td>
                <td width="50%">
                    <span>{{$childs}}</span>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <strong>@lang('header.price')</strong>
                </td>
                <td width="50%">
                    <span class="price-total">{{convert_price_float($price)}}</span>
                </td>
            </tr>
        </table>

    </div>
</div>
