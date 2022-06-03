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
                   id="schedule_post_date_start_filter{{$typeMedia}}"
                   placeholder="Date start">
            <input type="text" autocomplete="off" class="form-control"
                   id="schedule_post_date_end_filter{{$typeMedia}}"
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
        </select>
    </th>
    <th>
        <select name="" id="source_detail_filter{{$typeMedia}}" class="form-control">
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
    <th>
        <select name="" id="rate_filter{{$typeMedia}}" class="form-control">
            <option value="">Rate</option>
            @foreach($rates as $keyRate=>$rate)
                <option value="{{$keyRate}}">{{$rate}}</option>
            @endforeach
        </select>
    </th>
    <th>
        <div class="d-flex">
            <input type="text" autocomplete="off" class="form-control mr-2"
                   id="post_date_fanpage_start_filter{{$typeMedia}}"
                   placeholder="Date start">
            <input type="text" autocomplete="off" class="form-control"
                   id="post_date_fanpage_end_filter{{$typeMedia}}"
                   placeholder="Date end">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input type="text" autocomplete="off" class="form-control mr-2"
                   id="post_date_newletter_start_filter{{$typeMedia}}"
                   placeholder="Date start">
            <input type="text" autocomplete="off" class="form-control"
                   id="post_date_newletter_end_filter{{$typeMedia}}"
                   placeholder="Date end">
        </div>
    </th>
    <th>
        <select name="" id="seo_filter{{$typeMedia}}" class="form-control">
            <option value="">Seo</option>
            @foreach($seos as $keySeo=>$seo)
                <option value="{{$keySeo}}">{{$seo}}</option>
            @endforeach
        </select>
    </th>
    <th>
        <select name="" id="created_by_filter{{$typeMedia}}" class="form-control">
            <option value="">User</option>
            @foreach($admins as $keyAdmin=>$admin)
                <option value="{{$keyAdmin}}">{{$admin}}</option>
            @endforeach
        </select>
    </th>
    <th>
        <input type="text" class="form-control" id="note_filter{{$typeMedia}}" placeholder="Note">
    </th>
    <th>

    </th>
    <th>

    </th>
    <th>
        <select name="" id="translated_by_filter{{$typeMedia}}" class="form-control">
            <option value=""></option>
            @foreach($admins as $idAdmin=>$admin)
                <option value="{{$idAdmin}}" {{!empty($mediaPost) && $mediaPost->translated_by == $idAdmin?'selected':''}}>{{$admin}}</option>
            @endforeach
        </select>
    </th>
    <th>

    </th>
    <th>

    </th>
    <th>
        <select name="" id="promotion_for_filter{{$typeMedia}}" class="form-control select_promotion">
            <option value=""></option>
            @foreach($typePromotion as $keyPromotion=>$promotion)
                <option value="{{$keyPromotion}}" data-type="{{$promotion['type']}}" {{!empty($mediaPost) && $mediaPost->promotion_for == $keyPromotion?'selected':''}}>{{$promotion['name']}}</option>
            @endforeach
        </select>
    </th>
    <th class="user_id_filter_select2">
        <select name="" id="promotion_for_agent_id_filter{{$typeMedia}}" class="form-control promotion_select2" onmouseover="hoverToLoadSelectAgent()">

        </select>
    </th>
</tr>

@include('CRM.partials.script-call-agent',[
    'nameFunction'=>'hoverToLoadSelectAgent',
    'elementIdSelect2'=>'promotion_for_agent_id_filter'.$typeMedia,
    'elementParentIdSelect2'=>'user_id_filter_select2'
])

