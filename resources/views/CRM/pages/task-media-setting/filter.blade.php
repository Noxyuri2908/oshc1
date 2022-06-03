<tr class="last-row">
    <th></th>
    <th>
        <div>
            <select class="form-control" name="type" id="type_filter">
                <option label=""></option>
                @if(!empty($typeSetting))
                    @foreach($typeSetting as $key=>$value)
                        <option value="{{$key}}" {{!empty($mediaSettingData) && $mediaSettingData->type == $key ?'selected':''}}>{{trans('lang.'.$value)}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <input type="text" name="name_filter" id="name_filter" class="form-control">
    </th>
    <th>
        <input type="text" name="category_filter" id="category_filter" class="form-control">
    </th>
</tr>
