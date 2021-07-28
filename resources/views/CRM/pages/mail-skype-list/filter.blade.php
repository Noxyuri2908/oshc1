<tr class="last-row">
    <th></th>
    <th>
        <select class="form-control" name="domain_id" id="domain_id_filter">
            <option label=""></option>
            @if(!empty($domains))
                @foreach($domains as $keyDomain=>$valueDomain)
                    <option
                        value="{{$valueDomain->id}}" {{!empty($mailSkypeData) && $mailSkypeData->domain_id == $valueDomain->id ?'selected':''}}>{{$valueDomain->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input class="form-control" value="" name="email_filter" id="email_filter" type="text" required>
    </th>
    <th>
        <select name="person_in_charge" class="form-control" id="person_in_charge_filter">
            <option value="">Select</option>
            @if(!empty($admins))
                @foreach($admins as $idAdmin=>$valueAdmin)
                    <option
                        value="{{$idAdmin}}" {{!empty($mailSkypeData) && $mailSkypeData->person_in_charge == $idAdmin ?'selected':''}}>{{$valueAdmin}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <input class="form-control" value="" name="password_filter" id="password_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="skype_filter" id="skype_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="crm_filter" id="crm_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="dropbox_filter" id="dropbox_filter" type="text" required>
    </th>
    <th></th>
</tr>
