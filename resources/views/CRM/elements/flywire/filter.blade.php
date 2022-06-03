<tr class="last-row">
    <th></th>
    <th></th>
    <th>
        <input type="text" autocomplete="off" id="ref_no_filter" class="form-control" name="ref_no"
               value="{{(!empty($obj))?$obj->ref_no:''}}" required>
    </th>

    <th>
        <div class="agent_id_filter_select2">
            <select class="form-control" id="agent_id_filter" name="agent_id" required>
            </select>
        </div>
    </th>
    <th>
        <div>
            <input type="text" class="form-control" name="full_name" id="full_name_filter"
                   value="{{(!empty($obj))?$obj->getFullNameCus():''}}" required>
        </div>
    </th>
    <th>
        <div>
            <input type="email" id="email_filter" class="form-control" name="email"
                   value="{{(!empty($obj))?$obj->getEmailCus():''}}" required>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" id="status_filter" name="status" required>
                <option label=""></option>
                @foreach($paymentStatus as $key=>$value)
                    @if(!isset($obj))
                        <option value="{{$key}}" {{old('status') == $key ? 'selected' : ''}}>{{$value}}</option>
                    @else
                        <option value="{{$key}}" {{$obj->status == $key ? 'selected' : ''}}>{{$value}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" id="gender_filter" name="gender">
                <option value=""></option>
                @foreach($typeGender as $key=>$value)
                    @if(!isset($cus))
                        <option
                            value="{{$key}}" {{request()->get('gender') == $key ? 'selected' : ''}}>{{$value}}</option>
                    @else
                        <option value="{{$key}}" {{$cus->gender == $key ? 'selected' : ''}}>{{$value}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </th>
    <th>
        <div>
            <input class="form-control" id="phone_filter" name="phone"
                   value="{{(!empty($obj) && !empty($obj->registerCus()))?$obj->registerCus()->phone:''}}" type="text"
                   placeholder="" required>
        </div>
    </th>
    <th>
        <div>
            <input autocomplete="off" class="form-control open-jquery-date" id="birth_of_date_filter"
                   name="birth_of_date"
                   value="{{(!empty($obj) && !empty($obj->registerCus()))?convert_date_form_db( $obj->registerCus()->birth_of_date):''}}"
                   data-options='{"dateFormat":"d/m/Y"}'>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="school_id" id="school_id_filter" required>
                <option value="">Select</option>
                @foreach($schools as $key=>$school)
                    <option
                        value="{{$key}}" {{(!empty($cus)) && $cus->place_study == $key?'selected':''}}>{{$school}}
                    </option>
                @endforeach
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" id="country_filter" name="country" required>
                <option value=""></option>
                @foreach($countries as $key=>$value)
                    @if(!isset($obj))
                        <option
                            value="{{$key}}" {{request()->get('country') == $key ? 'selected' : ''}}>{{$value}}</option>
                    @else
                        <option
                            value="{{$key}}" {{!empty($obj->registerCus()) && $obj->registerCus()->country == $key ? 'selected' : ''}}>{{$value}}</option>
                    @endif
                @endforeach
            </select>

        </div>
    </th>
    <th>
        <input class="form-control" id="agent_email_filter" name="email"
               value="" type="text"
               placeholder="" required>
    </th>
    <th>
        <div>
            <select class="form-control" name="staff_id_filter" id="staff_id_filter" required>
                <option value="">Select</option>
                @foreach($staffs as $staff)
                    <option
                        value="{{$staff->id}}" {{(!empty($obj->staff_id) && $obj->staff_id == $staff->id)?'selected':''}}>{{$staff->admin_id}}</option>
                @endforeach
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" id="payment_come_from_filter" name="payment_come_from" required>
                <option value=""></option>
                @foreach($countries as $key=>$value)
                    @if(!isset($obj))
                        <option
                            value="{{$key}}" {{request()->get('payment_come_from') == $key ? 'selected' : ''}}>{{$value}}</option>
                    @else
                        <option
                            value="{{$key}}" {{$obj->payment_come_from == $key ? 'selected' : ''}}>{{$value}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </th>

    <th>

    </th>

    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>
        <div>
            <select class="form-control" name="payment_type" id="payment_type_filter" required>
                <option value=""></option>
                @foreach($typePayment as $key=>$one)
                    <option
                        value="{{$key}}" {{(!empty($obj->payment_type) && $obj->payment_type == $key)?'selected':''}}>{{$one}}</option>
                @endforeach
            </select></div>
    </th>
    <th>

        <input class="form-control" id="initiated_date_filter" name="initiated_date" value="" required autocomplete="off">
    </th>
    @can('flywire.columnComAnnalink')
        <th class="d-flex">
            <input  type="text" class="form-control"  id="delivered_start_date_filter" name="delivered_start_date" value="" required>
            <input  type="text" class="form-control"  id="delivered_end_date_filter" name="delivered_end_date" value="" required autocomplete="off">
        </th>
    @endcan
    @can('flywire.columnComFromProvider')
        <th>

        </th>
    @endcan
    @can('flywire.columnUnitComFromProvider')

        <th>

        </th>
    @endcan
    @can('flywire.columnExchangeInAudProvider')
        <th>

        </th>
    @endcan
    @can('flywire.columnComInAudProvider')

        <th>

        </th>
    @endcan
    @can('flywire.columnProviderPaidDate')

        <th>

        </th>
    @endcan
    <th>
        <div>
            <input class="form-control" id="provider_paid_date_cp_filter" name="paid_com_date_agent_cp"
                   value="" required>
        </div>
    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>
        <div>
            <input class="form-control" id="paid_com_date_agent_cp_filter" name="paid_com_date_agent_cp"
                   value="" required>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="comstatus" id="comstatus_filter" required>
                <option value=""></option>
                @foreach($comstatus as $key=>$one)
                    <option
                        value="{{$key}}">{{$one}}
                    </option>
                @endforeach
            </select>
        </div>
    </th>
    @can('flywire.columnProfitAud')
        <th>

        </th>
    @endcan
    @can('flywire.columnProfitVnd')
        <th>

        </th>
    @endcan

    <th>
        <input type="text" id="note_filter" class="form-control" value="" required>
    </th>

    <th>
        <input type="text" id="created_at_filter" class="form-control" value="" required>
    </th>
    <th>
        <div>
            <input type="text" autocomplete="off" class="form-control" id="invoice_code_filter" name="invoice_code"
                   value="{{(!empty($obj))?$obj->invoice_code:''}}" required>
        </div>
    </th>
    <th></th>
</tr>
@push('scripts')
    <script>
        $('#payment_come_from_filter,#school_id_filter,#country_filter').select2()
    </script>
    @include('CRM.partials.script-call-agent',[
        'elementIdSelect2'=>'agent_id_filter',
        'elementParentIdSelect2'=>'agent_id_filter_select2'
    ])
@endpush
