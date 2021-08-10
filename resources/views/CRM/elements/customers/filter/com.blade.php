<tr class="last-row">
    <th></th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control" name="ref_no_filter" id="ref_no_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div class="agent_id_filter_select2" onmouseover="hoverToLoadSelectMasterAgentCustomer()">
            <select class="form-control" name="agent_id_filter" id="agent_id_filter">
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
                            value="{{$keyCountries}}" >{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>



    <th>
        <div>
            <input type="text" class="form-control" name="register_filter" id="register_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="net_amount_filter" id="net_amount_filter" autocomplete="off">
        </div>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
{{--    <th></th>--}}
    <th></th>
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
            <select class="form-control" name="service_country_filter" id="service_country_filter">
                <option label=""></option>
                @if(!empty($service_countries))
                    @foreach($service_countries as $keyServiceCountry=>$valueServiceCountry)
                        <option
                            value="{{$keyServiceCountry}}">{{$valueServiceCountry}}</option>
                    @endforeach
                @endif
            </select>
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
            <input type="text" class="form-control" name="hoahong_month_filter" id="hoahong_month_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="hoahong_year_filter" id="hoahong_year_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="date_payment_provider_filter" id="date_payment_provider_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="account_bank_filter" id="account_bank_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="date_payment_agent_filter" id="date_payment_agent_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="policy_no_filter" id="policy_no_filter" autocomplete="off">
        </div>
    </th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="issue_date_filter" id="issue_date_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="policy_status_filter" id="policy_status_filter">
                <option label=""></option>
                @if(!empty($policy_status))
                    @foreach($policy_status as $keyPolicyStatus=>$valuePolicyStatus)
                        <option
                            value="{{$keyPolicyStatus}}">{{$valuePolicyStatus}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="payment_note_provider_filter" id="payment_note_provider_filter">
                <option label=""></option>
                @if(!empty($type_payment_note))
                    @foreach($type_payment_note as $keyPaymentNote=>$valuePaymentNote)
                        <option
                            value="{{$keyPaymentNote}}">{{$valuePaymentNote}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
{{--    <th></th>--}}
{{--    <th></th>--}}
    <th></th>
    <th>
        <input class="form-control" value="" name="note_filter" id="note_filter" type="text" autocomplete="off">
    </th>
    <th>
        <div>
            <select class="form-control" name="staff_id_filter" id="staff_id_filter">
                <option label=""></option>
                @if(!empty($users))
                    @foreach($users as $keyUser=>$valueUser)
                        <option
                            value="{{$keyUser}}">{{$valueUser}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="created_at_filter" id="created_at_filter" autocomplete="off">
        </div>
    </th>
</tr>
@include('CRM.partials.script-call-agent',[
           'nameFunction'=>'hoverToLoadSelectMasterAgentCustomer',
       'elementIdSelect2'=>'agent_id_filter',
       'elementParentIdSelect2'=>'agent_id_filter_select2'
   ])
