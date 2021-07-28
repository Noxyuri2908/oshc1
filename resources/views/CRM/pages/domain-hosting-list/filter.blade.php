<tr class="last-row">
    <th></th>
    <th>
        <select class="form-control" name="type" id="type_filter">
            <option label=""></option>
            @if(!empty($types))
                @foreach($types as $keyType=>$type)
                    <option
                        value="{{$type->id}}" {{!empty($domainHostingData) && $domainHostingData->type == $type->id ?'selected':''}}>{{$type->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input class="form-control" value="" name="name_filter" id="name_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="link_filter" id="link_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="user_filter" id="user_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="password_filter" id="password_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="provider_filter" id="provider_filter" type="text" required>
    </th>
    <th>
        <div>
            <select name="person_in_charge_filter" class="form-control" id="person_in_charge_filter">
                <option value="">Select</option>
                @if(!empty($admins))
                    @foreach($admins as $idAdmin=>$valueAdmin)
                        <option
                            value="{{$idAdmin}}" {{!empty($domainHostingData) && $domainHostingData->person_in_charge == $idAdmin ?'selected':''}}>{{$valueAdmin}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>

    <th>
        <input class="form-control" value="" name="email_in_charge_filter" id="email_in_charge_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="expiry_date_filter" id="expiry_date_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="fee_filter" id="fee_filter" type="text" required>
    </th>
    <th></th>
</tr>
