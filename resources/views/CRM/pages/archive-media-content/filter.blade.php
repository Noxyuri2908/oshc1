<tr class="last-row">
    <th></th>
    <th>
        <div>
            <select class="form-control" name="website_id_filter" id="website_id_filter">
                <option label=""></option>
                @if(!empty($webMedia))
                    @foreach($webMedia as $keyWebMedia=>$value)
                        <option data-value="{{$value->value}}" value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <div>
            <select class="form-control" name="category_id_filter" id="category_id_filter">
                <option label=""></option>

            </select>
        </div>
    </th>
    <th>
        <input class="form-control" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->title:''}}"
               name="title_filter" id="title_filter" type="text" required>
    </th>
    <th></th>
    <th>
        <input class="form-control" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->date:''}}"
               name="date_filter" id="date_filter" type="text" required>
    </th>
    <th>
        <div>
            <select class="form-control" name="status_filter" id="status_filter">
                <option label=""></option>
                @if(!empty($statusArchiveMediaContent))
                    @foreach($statusArchiveMediaContent as $keyStatusArchiveMediaContent=>$value)
                        <option value="{{$keyStatusArchiveMediaContent}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->country_id == $keyCountries ?'selected':''}}>{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <input class="form-control" value=""
               name="note_filter" id="note_filter" type="text" required>
    </th>
    <th>
        <div>
            <select class="form-control" name="created_by_filter" id="created_by_filter">
                <option label=""></option>
                @if(!empty($admins))
                    @foreach($admins as $keyAdmin=>$value)
                        <option value="{{$keyAdmin}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->country_id == $keyCountries ?'selected':''}}>{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
{{--    <th></th>--}}

{{--    <th>--}}
{{--        <div>--}}
{{--            <select class="form-control" name="type_id_filter" id="type_id_filter">--}}
{{--                <option label=""></option>--}}
{{--                @if(!empty($typeMediaLinks))--}}
{{--                    @foreach($typeMediaLinks as $keyTypeMediaLink=>$value)--}}
{{--                        <option value="{{$value->id}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->type_id == $value->id ?'selected':''}}>{{$value->name}}</option>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </th>--}}
{{--    <th>--}}
{{--        <div>--}}
{{--            <select class="form-control" name="is_hot_new_filter" id="is_hot_new_filter">--}}
{{--                <option label=""></option>--}}
{{--                @if(!empty($hotNews))--}}
{{--                    @foreach($hotNews as $keyHotNews=>$value)--}}
{{--                        <option value="{{$keyHotNews}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->is_hot_new == $keyHotNews ?'selected':''}}>{{$value}}</option>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </th>--}}
{{--    <th>--}}
{{--        <div>--}}
{{--            <select class="form-control" name="information_focused_id_filter" id="information_focused_id_filter">--}}
{{--                <option label=""></option>--}}
{{--                @if(!empty($informationFocusedMediaLinks))--}}
{{--                    @foreach($informationFocusedMediaLinks as $keyInformationFocusedMediaLink=>$value)--}}
{{--                        <option value="{{$value->id}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->information_focused_id == $value->id ?'selected':''}}>{{$value->name}}</option>--}}
{{--                    @endforeach--}}
{{--                @endif--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </th>--}}
{{--    <th>--}}
{{--        <input class="form-control" value="" name="note_filter" id="note_filter" type="text">--}}
{{--    </th>--}}
</tr>
