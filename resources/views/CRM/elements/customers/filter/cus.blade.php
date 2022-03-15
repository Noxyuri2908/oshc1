<tr class="last-row">
    <th></th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control" name="ref_no_filter" id="ref_no_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="created_at_filter" id="created_at_filter" autocomplete="off">
        </div>
    </th>
    <th>
        <div class="agent_id_filter_select2" onmouseover="hoverToLoadSelectAgentCustomer()">
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
            <input type="text" class="form-control" name="email_filter" id="email_filter">
        </div>
    </th>
    <th>
        <div class="master_agent_filter_select2" onmouseover="hoverToLoadSelectMasterAgentCustomer()">
            <select class="form-control" name="master_agent_filter" id="master_agent_filter">
                {{--<option label=""></option>--}}
                {{--@if(!empty($agents))--}}
                {{--    @foreach($agents as $keyAgent=>$valueAgent)--}}
                {{--        <option--}}
                {{--            value="{{$keyAgent}}">{{$valueAgent}}</option>--}}
                {{--    @endforeach--}}
                {{--@endif--}}
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
            <select class="form-control" name="type_invoice_filter" id="type_invoice_filter">
                <option label=""></option>
                @if(!empty($type_invoices))
                    @foreach($type_invoices as $keyTypeInvoice=>$valueTypeInvoice)
                        <option
                            value="{{$keyTypeInvoice}}">{{$valueTypeInvoice}}</option>
                    @endforeach
                @endif
            </select>
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
    <th></th>
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

    <th></th>
    <th></th>
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
            <input type="text" class="form-control" name="net_amount_filter" id="net_amount_filter">
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="promotion_id_filter" id="promotion_id_filter">
                <option label=""></option>
                @if(!empty($promotions))
                    @foreach($promotions as $keyPromotion=>$valuePromotion)
                        <option
                            value="{{$keyPromotion}}">{{$valuePromotion}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th>

    </th>
    <th>
        <div>
            <select class="form-control" name="payment_method_filter" id="payment_method_filter">
                <option label=""></option>
                @if(!empty($type_payment))
                    @foreach($type_payment as $keyPayment=>$valuePayment)
                        <option
                            value="{{$keyPayment}}">{{$valuePayment}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>

    <th>
        <input class="form-control" value=""
               name="policy_number_filter" id="policy_number_filter" type="text" required>
    </th>
    <th>
        <input class="form-control choose-date-form" value=""
               name="issue_date_filter" id="issue_date_filter" type="text" required>
    </th>
    <th>
        <div>
            <select class="form-control" name="payment_note_filter" id="payment_note_filter">
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
    <th></th>
    <th>
        <input type="text" class="form-control" name="month_filter" id="month_filter" autocomplete="off">
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
        <input class="form-control" value="" name="note_filter" id="note_filter" type="text">
    </th>
    <th>
        <div>
            <select class="form-control" name="location_australia_filter" id="location_australia_filter">
                <option label=""></option>
                @if(!empty($location_australia))
                    @foreach($location_australia as $keyLocationAustralia=>$valueLocationAustralia)
                        <option
                            value="{{$keyLocationAustralia}}">{{$valueLocationAustralia}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="destination_filter" id="destination_filter">
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
            <select class="form-control" name="s_live_in_AS_filter" id="s_live_in_AS_filter">
                <option value=""></option>
                @foreach($configLivingInA as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
    </th>
    <th></th>
</tr>
@include('CRM.partials.script-call-agent',[
           'nameFunction'=>'hoverToLoadSelectAgentCustomer',
       'elementIdSelect2'=>'agent_id_filter',
       'elementParentIdSelect2'=>'agent_id_filter_select2'
   ])
@include('CRM.partials.script-call-agent',[
           'nameFunction'=>'hoverToLoadSelectMasterAgentCustomer',
       'elementIdSelect2'=>'master_agent_filter',
       'elementParentIdSelect2'=>'master_agent_filter_select2'
   ])
@push('scripts')
    <script>
        $('#country_id_filter').select2();
    </script>
    @endpush

