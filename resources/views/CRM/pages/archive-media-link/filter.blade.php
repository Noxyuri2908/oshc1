<tr class="last-row">
    <th></th>
    <th>
        <div>
            <select class="form-control" name="source_id_filter" id="source_id_filter">
                <option label=""></option>
                @if(!empty($sourceStatuses))
                    @foreach($sourceStatuses as $keySourceStatuses=>$value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        {{--        <div>--}}
        {{--            <select class="form-control" name="form_id_filter" id="form_id_filter">--}}
        {{--                <option label=""></option>--}}
        {{--                @if(!empty($fromMediaLinks))--}}
        {{--                    @foreach($fromMediaLinks as $keyFromMediaLinks=>$value)--}}
        {{--                        <option value="{{$value->id}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->form_id == $value->id ?'selected':''}}>{{$value->name}}</option>--}}
        {{--                    @endforeach--}}
        {{--                @endif--}}
        {{--            </select>--}}
        {{--        </div>--}}
        <input type="text" name="name_filter" id="name_filter" class="form-control">
    </th>
    <th>
        <div>
            <select class="form-control" name="country_id_filter" id="country_id_filter">
                <option label=""></option>
                @if(!empty($countries))
                    @foreach($countries as $keyCountries=>$value)
                        <option value="{{$keyCountries}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->country_id == $keyCountries ?'selected':''}}>{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <input class="form-control" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->link:''}}" name="link_filter" id="link_filter" type="text" required>
    </th>
    <th>
        <div>
            <select class="form-control" name="type_id_filter" id="type_id_filter">
                <option label=""></option>
                @if(!empty($typeMediaLinks))
                    @foreach($typeMediaLinks as $keyTypeMediaLink=>$value)
                        <option value="{{$value->id}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->type_id == $value->id ?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="is_hot_new_filter" id="is_hot_new_filter">
                <option label=""></option>
                @if(!empty($hotNews))
                    @foreach($hotNews as $keyHotNews=>$value)
                        <option value="{{$keyHotNews}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->is_hot_new == $keyHotNews ?'selected':''}}>{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="information_focused_id_filter" id="information_focused_id_filter">
                <option label=""></option>
                @if(!empty($informationFocusedMediaLinks))
                    @foreach($informationFocusedMediaLinks as $keyInformationFocusedMediaLink=>$value)
                        <option value="{{$value->id}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->information_focused_id == $value->id ?'selected':''}}>{{$value->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <input class="form-control" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->link:''}}" name="admin_filter" id="admin_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->link:''}}" name="email_admin_filter" id="email_admin_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->link:''}}" name="telephone_filter" id="telephone_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="note_filter" id="note_filter" type="text">
    </th>
</tr>
