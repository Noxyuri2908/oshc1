<tr class="last-row">
    <th></th>
    <th>
        <select class="form-control" name="category_id_filter" id="category_id_filter">
            <option label=""></option>
            @if(!empty($categories))
                @foreach($categories as $keyCategory=>$valueCategory)
                    <option
                        value="{{$valueCategory->id}}" {{!empty($marketingMaterialData) && $marketingMaterialData->category_id == $valueCategory->id ?'selected':''}}>{{$valueCategory->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>

    </th>
    <th>
        <select class="form-control" name="use_for_filter" id="use_for_filter">
            <option label=""></option>
            @if(!empty($use_fors))
                @foreach($use_fors as $keyUseFor=>$valueUseFor)
                    <option
                        value="{{$valueUseFor->id}}" {{!empty($marketingMaterialData) && $marketingMaterialData->use_for == $valueUseFor->id ?'selected':''}}>{{$valueUseFor->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="target_filter" id="target_filter">
            <option label=""></option>
            @if(!empty($targets))
                @foreach($targets as $keyTarget=>$valueTarget)
                    <option
                        value="{{$valueTarget->id}}" data-value="{{$valueTarget->value}}" {{!empty($marketingMaterialData) && $marketingMaterialData->target == $valueTarget->id ?'selected':''}}>{{$valueTarget->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <select class="form-control" name="sub_target_filter" id="sub_target_filter">

        </select>
    </th>
    <th>

    </th>
    <th>
{{--        <input class="form-control" value=""--}}
{{--               name="created_at_filter" id="created_at_filter" type="text" required>--}}
    </th>
</tr>
