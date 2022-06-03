
@foreach($invoices as $invoice)
    <tr class="data-customer" id="data-customer_{{$invoice->id}}" is-render="false" data-id="{{$invoice->id}}">
        <th class="first-col sticky-col" >
            <input class="ml-3 sub_chk" data-id="{{$invoice->id}}" data-email="{{$invoice->registerCus() != null ? $invoice->registerCus()->email:''}}" data-name="{{$invoice->registerCus() != null ? $invoice->registerCus()->first_name.' '.$invoice->registerCus()->last_name : ''}}" type="checkbox" aria-label="Checkbox for tdis row" />
        </th>
        <th class="second-col sticky-col">
            <div class="dropdown">
                <button class=" btn btn-link dropdown-toggle btn-dropdown-z-index" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="overflow: unset">
                    <div class="bg-white py-2">
                        @can('flywire.commissionAndProfit.show')
                            <a class="dropdown-item customer_data_profit" data-url_edit='{{route('ajax.flywire.showData',['id'=>$invoice->id])}}' data-id="{{$invoice->id}}" style="cursor: pointer" href="{{route('flywire.process',['id'=>$invoice->id,'tab_link'=>1])}}">Commission & Profit</a>
                        @endcan
                        @can('flywire.edit')
                            <a class="dropdown-item customer_data_edit" data-url_edit='{{route('ajax.flywire.showData',['id'=>$invoice->id])}}' data-id="{{$invoice->id}}" style="cursor: pointer" href="{{route('flywire.edit',['id'=>$invoice->id,'page'=>request()->get('page')])}}">Edit</a>
                        @endcan
                        @can('flywire.delete')
                            <a class="dropdown-item text-danger modal_delete"
                               data-action="{{route('flywire.destroy',['id'=>$invoice->id])}}" data-id="{{$invoice->id}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <th class="white-space-break-spaces third-col sticky-col">{{$invoice->ref_no}}</th>
        <th class="white-space-break-spaces fourth-col sticky-col">{{(!empty($invoice->agent))?$invoice->agent->name:''}}</th>
        <th class="white-space-break-spaces fifth-col sticky-col">{{$invoice->getFullNameCus()}}</th>
        <th class="white-space-break-spaces" class="white-space-break-spaces">{{$invoice->getEmailCus()}}</th>
        <th class="white-space-break-spaces">{{!empty($paymentStatus[$invoice->status])?$paymentStatus[$invoice->status]:''}}</th>
        <th class="white-space-break-spaces">{{$invoice->getGenderCus()}}</th>
        <th class="white-space-break-spaces">{{$invoice->getPhoneNo()}}</th>
        <th class="white-space-break-spaces">{{$invoice->getDOB()}}</th>
        <th class="white-space-break-spaces">{{( !empty($invoice->registerCus()) && !empty($schools[$invoice->registerCus()->place_study]))?$schools[$invoice->registerCus()->place_study]:''}}</th>
        <th class="white-space-break-spaces">{{$invoice->getCountry()}}</th>
        <th class="white-space-break-spaces">{{(!empty($invoice->agent))?$invoice->agent->email:''}}</th>
        <th class="white-space-break-spaces">{{(!empty($invoice))?$staffs->where('id',$invoice->staff_id)->pluck('admin_id')->first():''}}</th>
        <th class="white-space-break-spaces">{{$invoice->getPayComeFrom()}}</th>
        <th class="white-space-break-spaces">{{convert_price_float($invoice->amount_from)}}</th>
        <th class="white-space-break-spaces">{{getCurrency($invoice->amount_from_unit)}}</th>
        <th class="white-space-break-spaces">{{convert_price_float($invoice->amount_to)}}</th>
        <th class="white-space-break-spaces">{{getCurrency($invoice->amount_to_unit)}}</th>
        <th class="white-space-break-spaces">{{$invoice->getPaymentType()}}</th>
        <th class="white-space-break-spaces">{{convert_date_form_db($invoice->initiated_date)}}</th>
        <th class="white-space-break-spaces">{{convert_date_form_db($invoice->delivered_date)}}</th>
        @can('flywire.columnComAnnalink')
            <th class="white-space-break-spaces">{{(!empty($invoice->getProviderCom()))?$invoice->getProviderCom()->amount:''}}</th>
        @endcan
        @can('flywire.columnComFromProvider')
            <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_price_float($invoice->profit->first()->com_from_provider_cp):''}}</th>
        @endcan
        @can('flywire.columnUnitComFromProvider')
            <th class="white-space-break-spaces"></th>
        @endcan
        @can('flywire.columnExchangeInAudProvider')
            <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_price_float($invoice->profit->first()->exchange_in_aud_cp):''}}</th>
        @endcan
        @can('flywire.columnComInAudProvider')
            <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_price_float($invoice->profit->first()->com_in_aud_cp):''}}</th>

        @endcan
        @can('flywire.columnProviderPaidDate')
            <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_date_form_db($invoice->profit->first()->provider_paid_date_cp):''}}</th>
        @endcan
        @php
            //dd($invoice)
        @endphp
        <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?$invoice->profit->first()->com_agent_cp:''}}</th>
        <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_price_float($invoice->profit->first()->com_for_agent_aud_cp):''}}</th>
        <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_price_float($invoice->profit->first()->exchange_rate_cp):''}}</th>
        <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_price_float($invoice->profit->first()->com_for_agent_vnd_cp):''}}</th>
        <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_date_form_db($invoice->profit->first()->paid_com_date_agent_cp):''}}</th>
        <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?getComStatusFlywire($invoice->profit->first()->com_status_cp):''}}</th>
        @can('flywire.columnProfitAud')
            <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_price_float($invoice->profit->first()->profit_aud_cp):''}}</th>
        @endcan
        @can('flywire.columnProfitVnd')
            <th class="white-space-break-spaces">{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_price_float($invoice->profit->first()->profit_vnd_cp):''}}</th>
        @endcan
        <th class="white-space-break-spaces">{{(!empty($invoice))?$invoice->note:''}}</th>
        <th class="white-space-break-spaces">{{(!empty($invoice))?convert_date_form_db($invoice->created_at):''}}</th>
        <th class="white-space-break-spaces">{{$invoice->invoice_code_link}}</th>
        <th class="white-space-break-spaces">{{!empty($invoice->promotion) ? $invoice->promotion()->first()->name : ''}}</th>

        {{--        <th>{{(!empty($invoice) && !empty($invoice->profit->first()))?$invoice->profit->first()->getStaffName():''}}</th>--}}
        {{--        <th>{{(!empty($invoice) && !empty($invoice->profit->first()))?convert_date_form_db($invoice->profit->first()->created_at):''}}</th>--}}
    </tr>
@endforeach
