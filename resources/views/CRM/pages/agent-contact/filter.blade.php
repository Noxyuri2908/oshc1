<tr class="last-row">
    <th></th>
    <th>
        <select class="form-control" name="department_filter" id="department_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($departments))
                @foreach($departments as $keyDepartment=>$valueDepartment)
                    <option
                        value="{{$keyDepartment}}">{{$valueDepartment}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th class="user_id_filter_select2">
        <select class="form-control" name="user_id" id="user_id_filter" onmouseover="hoverToLoadSelectAgentContactFilter()">

        </select>
    </th>
    <th class="">
        <select class="form-control" name="country" id="country_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($countries))
                @foreach($countries as $keyCountry=>$valueCountry)
                    <option
                        value="{{$keyCountry}}">{{$valueCountry}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th class="">
        <select class="form-control" name="status" id="status_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($status))
                @foreach($status as $keyUserStatus=>$valueUserStatus)
                    <option
                        value="{{$keyUserStatus}}">{{$valueUserStatus}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th class="">
        <select class="form-control" name="type_id" id="type_id_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($typeAgent))
                @foreach($typeAgent as $keyTypeAgent=>$valueTypeAgent)
                    <option
                        value="{{$keyTypeAgent}}">{{$valueTypeAgent}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($agentContactData)?$agentContactData->name:''}}"
               id="name_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($agentContactData)?$agentContactData->position:''}}"
               id="position_filter" autocomplete="off">
    </th>
    <th>
        <select class="form-control" name="staff_id_filter" id="staff_id_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($admins))
                @foreach($admins as $keyAdmin=>$valueAdmin)
                    <option
                        value="{{$keyAdmin}}">{{$valueAdmin}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($agentContactData)?$agentContactData->phone:''}}"
               id="phone_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($agentContactData)?$agentContactData->birthday:''}}"
               id="birthday_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($agentContactData)?$agentContactData->email:''}}"
               id="email_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($agentContactData)?$agentContactData->skype:''}}"
               id="skype_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($agentContactData)?$agentContactData->facebook:''}}"
               id="facebook_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="{{!empty($agentContactData)?$agentContactData->note:''}}"
               id="note_filter" autocomplete="off">
    </th>
    <th></th>
    <th>
        <input type="text" class="form-control" value="" id="acc_name_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="" id="bank_filter" autocomplete="off">
    </th>
    <th>
        <select name="" id="currency_filter" class="form-control">
            @foreach($currency as $keyCurrency=>$one)
                <option value="{{$one}}">{{$one}}</option>
            @endforeach
        </select>
    </th>
    <th>
        <input type="text" class="form-control" value="" id="bank_address_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="" id="receiver_address_filter" autocomplete="off">
    </th>
    <th>
        <input type="text" class="form-control" value="" id="swift_code_filter" autocomplete="off">
    </th>
</tr>
@push('scripts')
@include('CRM.partials.script-call-agent',[
        'nameFunction'=>'hoverToLoadSelectAgentContactFilter',
    'elementIdSelect2'=>'user_id_filter',
    'elementParentIdSelect2'=>'user_id_filter_select2'
])
@endpush
