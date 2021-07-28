<tr class="last-row">
    <th></th>
    <th>
        <select name="" id="group_id_filter{{$typeMedia}}" class="form-control">
            <option value="">Group</option>
            @foreach($webMedia->where('type',$typeId) as $keyWebMedia=>$web)
                <option value="{{$web->id}}" data-value="{{json_encode($web->category)}}">{{$web->name}}</option>
            @endforeach
            {{--            @if(!empty($groupMedias))--}}
            {{--                @foreach($groupMedias as $keygroupMedia=>$groupMedia)--}}
            {{--                    <option value="{{$groupMedia->id}}" data-value="{{$groupMedia->value}}">{{$groupMedia->name}}</option>--}}
            {{--                @endforeach--}}
            {{--            @endif--}}
        </select>
    </th>
    <th>
        <div class="d-flex">
            <input type="text" autocomplete="off" class="form-control mr-2"
                   id="created_post_start_filter{{$typeMedia}}"
                   placeholder="Date start">
            <input type="text" autocomplete="off" class="form-control" id="created_post_end_filter{{$typeMedia}}"
                   placeholder="Date end">
        </div>
    </th>
    <th>
        <select name="" id="category_filter{{$typeMedia}}" class="form-control">
            <option value=""></option>
            {{--            @foreach($webMediaValue as $keyWebMediaValue=>$arrValue)--}}
            {{--                @foreach($arrValue as $keyValue=>$value)--}}
            {{--                    <option value="{{$value}}">{{$value}}</option>--}}
            {{--                @endforeach--}}
            {{--            @endforeach--}}
        </select>
    </th>

    <th>
        <input type="text" class="form-control" id="post_title_filter{{$typeMedia}}" placeholder="BÀI POST">
    </th>
    <th>
        <input type="text" class="form-control" id="post_link_filter{{$typeMedia}}" placeholder="LINK POST">
    </th>
    <th></th>
    <th>
        <select name="" id="type_source_filter{{$typeMedia}}" class="form-control">
            <option value="">Loại tin bài</option>
            @foreach($typeSourceMedia as $keySourceMedia=>$type)
                <option value="{{$type->name}}">{{$type->name}}</option>
            @endforeach
        </select>
    </th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>
        <select name="" id="rate_filter{{$typeMedia}}" class="form-control">
            <option value="">Rate</option>
            @foreach($rates as $keyRate=>$rate)
                <option value="{{$keyRate}}">{{$rate}}</option>
            @endforeach
        </select>
    </th>
    <th></th>
    <th>
        <input type="text" class="form-control" id="note_filter{{$typeMedia}}" placeholder="Note">
    </th>
</tr>
