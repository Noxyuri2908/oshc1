<th>
    <div>
        <select class="form-control" name="potential_service_filter" id="potential_service_filter" multiple>
            <option label="" value="null">(Blank)</option>
            @if(!empty($dichvus))
                @foreach($dichvus as $keyService=>$service)
                    <option value="{{$service->id}}" {{!empty($obj) && !empty($obj->potential_service) && in_array($service->id,json_decode($obj->potential_service,true)) ?'selected="selected"':''}}>{{$service->name}}</option>
                @endforeach
            @endif
        </select>
    </div>
</th>
