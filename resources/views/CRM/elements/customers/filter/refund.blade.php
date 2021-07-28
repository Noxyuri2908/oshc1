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

    <th></th>
    <th></th>
    <th>
        <div>
            <select class="form-control" name="profit_status_filter" id="profit_status_filter">
                <option label=""></option>
                @if(!empty($profit_status))
                    @foreach($profit_status as $keyProfitStatus=>$valueProfitStatus)
                        <option
                            value="{{$keyProfitStatus}}">{{$valueProfitStatus}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="commission_payment_status_filter" id="commission_payment_status_filter">
                <option label=""></option>
                @if(!empty($commission_payment_status))
                    @foreach($commission_payment_status as $keyCommissionPaymentStatus=>$valueCommissionPaymentStatus)
                        <option
                            value="{{$keyCommissionPaymentStatus}}">{{$valueCommissionPaymentStatus}}</option>
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
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="pay_agent_date_filter" id="pay_agent_date_filter">
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="gst_filter" id="gst_filter">
                <option label=""></option>
                @if(!empty($gst_status_agent_profit))
                    @foreach($gst_status_agent_profit as $keyGstStatusAgentProfit=>$valueGstStatusAgentProfit)
                        <option
                            value="{{$keyGstStatusAgentProfit}}">{{$valueGstStatusAgentProfit}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="date_of_receipt_filter" id="date_of_receipt_filter">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="note_of_receipt_filter" id="note_of_receipt_filter">
        </div>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
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
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="date_payment_filter"
                   id="date_payment_filter">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="bank_account_filter" id="bank_account_filter">
        </div>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="refund_provider_date_filter"
                   id="refund_provider_date_filter">
        </div>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="std_date_apyment_filter"
                   id="std_date_apyment_filter">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="std_note_filter"
                   id="std_note_filter">
        </div>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th>
        <div>
            <input type="text" class="form-control" name="note2_filter"
                   id="note2_filter">
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control choose-date-form" name="request_date_filter"
                   id="request_date_filter">
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="std_status_filter" id="std_status_filter">
                <option label=""></option>
                @if(!empty($std_status))
                    @foreach($std_status as $keyStdStatus=>$valueStdStatus)
                        <option
                            value="{{$keyStdStatus}}">{{$valueStdStatus}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th></th>
    <th></th>
</tr>
