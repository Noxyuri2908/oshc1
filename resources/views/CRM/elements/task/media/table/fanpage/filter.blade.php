<tr class="last-row">
    <th></th>
    <th>
        <select name="" id="post_place_id_filter{{$typeMedia}}" class="form-control">
            <option value=""></option>
            @foreach($webMedia->where('type',$typeId) as $keyWebMedia=>$web)
                <option value="{{$web->id}}" data-value="{{json_encode($web->category)}}">{{$web->name}}</option>
            @endforeach
        </select>
    </th>
    <th>
        <div class="d-flex">
            <input type="text" autocomplete="off" class="form-control mr-2"
                   id="schedule_post_date_start{{$typeMedia}}"
                   placeholder="Date start">
            <input type="text" autocomplete="off" class="form-control"
                   id="schedule_post_date_end{{$typeMedia}}"
                   placeholder="Date end">
        </div>
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
    <th>
        <select name="" id="source_post_filter{{$typeMedia}}" class="form-control">
            <option value=""></option>
            @foreach($sourcePostMedias as $key=>$source)
                <option value="{{$source['id']}}" data-value="{{$source['value']}}">{{$source['name']}}</option>
            @endforeach
            {{--            @foreach($sourcePostMedias as $key=>$source)--}}
            {{--                <option value="{{$source->id}}">{{$source->name}}</option>--}}
            {{--            @endforeach--}}
        </select>
    </th>
    <th>
        <select name="" id="service_id_filter{{$typeMedia}}" class="form-control">
            <option value="">Loại bài DV</option>
            @foreach($services as $key=>$service)
                <option value="{{$service->id}}">{{$service->name}}</option>
            @endforeach
        </select>
    </th>
    <th>
        <select name="" id="type_source_filter{{$typeMedia}}" class="form-control">
            <option value="">Loại tin bài</option>
            @foreach($typeSourceMedia as $keySourceMedia=>$type)
                <option value="{{$type->name}}">{{$type->name}}</option>
            @endforeach
        </select>
    </th>
    <th>
        <input type="text" class="form-control" id="source_pr_filter{{$typeMedia}}"
               placeholder="Nguồn bài PR">
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
    <th>
        <input type="text" class="form-control" id="note_filter{{$typeMedia}}" placeholder="Note">
    </th>
    <th>
        <input type="text" class="form-control" id="budget_qc_filter{{$typeMedia}}" placeholder="Budget QC/ngày">
    </th>
    <th>
        <input type="text" class="form-control" id="tag_filter{{$typeMedia}}" placeholder="Đối tượng QC">
    </th>
    <th>
        <input type="text" autocomplete="off" class="form-control mr-2"
               id="start_date_qc_filter{{$typeMedia}}"
               placeholder="Date start">
    </th>
    <th>
        <input type="text" autocomplete="off" class="form-control mr-2"
               id="number_days_filter{{$typeMedia}}"
               placeholder="Number Days">
    </th>
    <th>
        <input type="text" autocomplete="off" class="form-control mr-2"
               id="total_budget_filter{{$typeMedia}}"
               placeholder="Total budget">
    </th>
    <th>
        <input type="text" autocomplete="off" class="form-control mr-2"
               id="credit_card_filter{{$typeMedia}}"
               placeholder="Credit card">
    </th>
</tr>
