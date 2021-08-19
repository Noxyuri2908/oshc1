<tr class="last-row">
    <th></th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control" name="ref_no_filter" id="ref_no_filter">
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="agent_id_filter" id="agent_id_filter">
                <option label=""></option>
                @if(!empty($agents))
                    @foreach($agents as $keyAgent=>$valueAgent)
                        <option
                            value="{{$keyAgent}}">{{$valueAgent}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="country_id_filter" id="country_id_filter">
                <option label=""></option>
                @if(!empty($countries))
                    @foreach($countries as $keyCountries=>$value)
                        <option
                            value="{{$keyCountries}}">{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="register_filter" id="register_filter">
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="provider_id_filter" id="provider_id_filter">
                <option label=""></option>
                @if(!empty($providers))
                    @foreach($providers as $keyProvider=>$valueProvider)
                        <option
                            value="{{$keyProvider}}">{{$valueProvider}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="status_filter" id="status_filter">
                <option label=""></option>
                @if(!empty($statuses))
                    @foreach($statuses as $keyStatus=>$valueStatus)
                        <option
                            value="{{$keyStatus}}">{{$valueStatus}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="refund_type_of_refund_pp_filter" id="refund_type_of_refund_pp_filter">
                <option label=""></option>
                @if(!empty($configTypeOfRefund))
                    @foreach($configTypeOfRefund as $keyTypeOfRefund=>$valueTypeOfRefund)
                        <option
                            value="{{$keyTypeOfRefund}}">{{$valueTypeOfRefund}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="policy_no_filter" id="policy_no_filter">
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="type_service_filter" id="type_service_filter">
                <option label=""></option>
                @if(!empty($services))
                    @foreach($services as $keyService=>$valueService)
                        <option
                            value="{{$keyService}}">{{$valueService}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="type_visa_filter" id="type_visa_filter">
                <option label=""></option>
                @if(!empty($type_visas))
                    @foreach($type_visas as $keyVisa=>$valueVisa)
                        <option
                            value="{{$keyVisa}}">{{$valueVisa}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="policy_filter" id="policy_filter">
                <option label=""></option>
                @if(!empty($policies))
                    @foreach($policies as $keyPolicy=>$valuePolicy)
                        <option
                            value="{{$keyPolicy}}">{{$valuePolicy}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="start_date_filter" id="start_date_filter">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="end_date_filter" id="end_date_filter">
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="visa_status_filter" id="visa_status_filter">
                <option label=""></option>
                @if(!empty($visa_status))
                    @foreach($visa_status as $keyVisaStatus=>$valueVisaStatus)
                        <option
                            value="{{$keyVisaStatus}}">{{$valueVisaStatus}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="visa_month_filter" id="visa_month_filter">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="visa_year_filter" id="visa_year_filter">
        </div>
    </th>

    {{--  Revenue  --}}
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    {{--  Revenue  --}}

    {{--  Annalink received	  --}}
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    {{--  Annalink received	  --}}

    {{--   Commission for Agent  --}}
        <th></th>
        <th></th>
        <th></th>
        <th>
        </th>
        <th>
        </th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>
        </th>
        <th>
        </th>
        <th>
        </th>
    {{--   Commission for Agent  --}}

    {{--  Commission received from provider  --}}
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    {{-- Commission received from provider   --}}

    {{--  Pay for provider  --}}
        <th></th>
        <th></th>
        <th>
        </th>
        <th>
        </th>
        <th>
        </th>
        <th></th>
        <th></th>
        <th></th>
        <th>
        </th>
        <th></th>
    {{--  Pay for provider  --}}

    {{--   Received from provider  --}}
        <th>
            <div>
                <select class="form-control" name="refund_type_of_refund_pp_tt_filter" id="refund_type_of_refund_pp_tt_filter">
                    <option label=""></option>
                    @if(!empty($configTypeOfRefund))
                        @foreach($configTypeOfRefund as $keyTypeOfRefund=>$valueTypeOfRefund)
                            <option
                                value="{{$keyTypeOfRefund}}">{{$valueTypeOfRefund}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </th>
        <th></th>
        <th></th>
        <th></th>
        <th>
            <div>
                <input type="text" class="form-control choose-date-form" name="paid_date_filter" id="paid_date_filter">
            </div>
        </th>
        <th>
            <div>
                <select class="form-control" name="refund_bank_pp_filter" id="refund_bank_pp_filter">
                    <option label=""></option>
                        @foreach(getBank() as $key => $value)
                            <option
                                value="{{$value->id}}">{{$value->code}} {{$value->account}}</option>
                        @endforeach
                </select>
            </div>
        </th>
        <th></th>
        <th></th>
    {{--  Received from provider   --}}


    {{--  Pay to client  --}}
        <th>
        </th>
        <th>
        </th>
        <th>
        </th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    {{-- Pay to client   --}}


    {{--  Recall commission from agent  --}}
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    {{--  Recall commission from agent  --}}


    {{--  Revenue ajustment  --}}
        <th>
            <div>
                <input type="text" class="form-control choose-date-form" name="request_date_filter" id="request_date_filter" autocomplete="false">
            </div>
        </th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    {{--  Revenue ajustment  --}}

</tr>
@push('scripts')
    @include('CRM.partials.choose_date',[
    'ids'=>[
        'paid_date_filter'
]
])
