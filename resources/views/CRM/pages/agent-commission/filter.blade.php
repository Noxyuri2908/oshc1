<tr class="last-row">
    <th></th>
    <th></th>
    <th>
        <select name="" id="country_filter" class="form-control">
            <option value=""></option>
            @if(!empty($countries))
                @foreach($countries as $keyCountry=>$country)
                    <option value="{{$keyCountry}}">{{$country}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th class="user_id_filter_select2">
        <select class="form-control" name="user_id" id="user_id_filter" onmouseover="hoverToLoadSelectAgentContactFilter()">

        </select>
    </th>
    <th>
        <select id="service_id_filter" name="service_id" class="form-control">
            <option label=""></option>
            @if(!empty($dichvus))
                @foreach($dichvus as $dichvu)
                    <option value="{{$dichvu->id}}" {{!empty($commData) && $commData->service_id == $dichvu->id?'selected':''}}>{{$dichvu->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="provider_id" id="provider_id_filter">

        </select>
    </th>
    <th>
        <select class="form-control" id="policy_filter" name="policy">
            <option value=""></option>
            @foreach($typePolicyConfig as $key=>$value)
                <option value="{{$key}}" {{!empty($commData) && $commData->policy == $key?'selected':''}}>{{$value}}</option>
            @endforeach
        </select>
    </th>
    <th>

    </th>
    <th>

    </th>
    <th>

    </th>
    <th>
        <select class="form-control" name="type_payment" id="type_payment_filter">
            <option value=""></option>
            @if(!empty($typePaymentConfig))
                @foreach($typePaymentConfig as $keyPaymnet=>$valuePayment)
                    <option value="{{$keyPaymnet}}" {{!empty($commData) && $commData->type_payment == $keyPaymnet?'selected':''}}>{{$valuePayment}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="gst" id="gst_filter">
            <option value=""></option>
            @if(!empty($typeGstConfig))
                @foreach($typeGstConfig as $keyGst=>$valueGst)
                    <option value="{{$keyGst}}" {{!empty($commData) && $commData->gst == $keyGst?'selected':''}}>{{$valueGst}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="status" id="status_filter" required>
            <option value=""></option>
            <option value="1"> Active</option>
            <option value="2"> Inactive</option>
        </select>
    </th>
</tr>
@push('scripts')
    @include('CRM.partials.script-call-agent',[
            'nameFunction'=>'hoverToLoadSelectAgentContactFilter',
        'elementIdSelect2'=>'user_id_filter',
        'elementParentIdSelect2'=>'user_id_filter_select2'
    ])
    <script>
        $(document).on('change', '#service_id_filter', function (e) {
            var id = $(this).val()
            $.get('{{route('com.getProvider')}}', { id: id }, function (data) {
                $('#provider_id_filter').html(data)
            })
        })
    </script>
@endpush
