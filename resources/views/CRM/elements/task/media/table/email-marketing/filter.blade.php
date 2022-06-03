<tr class="last-row">
    <th></th>
    <th>
        <div class="d-flex">
            <input type="text" autocomplete="off" class="form-control mr-2"
                   id="start_post_date_send_filter{{$typeMedia}}"
                   placeholder="Date start" auto>
            <input type="text" autocomplete="off" class="form-control"
                   id="end_post_date_send_filter{{$typeMedia}}"
                   placeholder="Date end">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input type="text" autocomplete="off" class="form-control mr-2"
                   id="schedule_post_date_start_filter{{$typeMedia}}"
                   placeholder="Date start" auto>
            <input type="text" autocomplete="off" class="form-control"
                   id="schedule_post_date_end_filter{{$typeMedia}}"
                   placeholder="Date end">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <select name="" id="category_email_marketing_filter{{$typeMedia}}" class="form-control">
                <option value=""></option>
                @if(!empty($categoryEmailMarketing))
                    @foreach($categoryEmailMarketing as $valueCategoryEmailMarketing)
                        <option value="{{$valueCategoryEmailMarketing->id}}" {{!empty($mediaPost) && $mediaPost->category_email_marketing == $valueCategoryEmailMarketing->id?'selected':''}} >{{$valueCategoryEmailMarketing->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <select name="service_id" id="service_id_filter{{$typeMedia}}" class="form-control">
            <option value=""></option>
            @foreach($services as $service)
                <option
                    value="{{$service->id}}"
                    {{!empty($mediaPost) && $mediaPost->service_id == $service->id?'selected':''}}
                >{{$service->name}}</option>
            @endforeach
        </select>
    </th>

    <th>
        <input type="text" class="form-control" id="post_title_filter{{$typeMedia}}" placeholder="TIÊU ĐỀ">
    </th>
    <th>
        <select name="object_email_marketing" class="form-control" id="object_email_marketing_filter{{$typeMedia}}">
            <option value=""></option>
            @if(!empty($objectEmailMarketing))
                @foreach($objectEmailMarketing as $valueObjectEmailMarketing)
                    <option value="{{$valueObjectEmailMarketing->id}}" {{!empty($mediaPost) && $mediaPost->object_email_marketing == $valueObjectEmailMarketing->id?'selected':''}}>{{$valueObjectEmailMarketing->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <div class="d-flex">
            <input type="number" class="form-control" id="start_number_of_selected_email_marketing_filter{{$typeMedia}}" placeholder="From">
            <input type="number" class="form-control" id="end_number_of_selected_email_marketing_filter{{$typeMedia}}" placeholder="To">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input type="number" class="form-control" id="start_number_of_clicked_link_email_marketing_filter{{$typeMedia}}" placeholder="From">
            <input type="number" class="form-control" id="end_number_of_clicked_link_email_marketing_filter{{$typeMedia}}" placeholder="To">
        </div>
    </th>
    <th>
        <select name="type_of_promotion_email_marketing" class="form-control" id="type_of_promotion_email_marketing_filter{{$typeMedia}}">
            <option value=""></option>
            @if(!empty($typeOfPromotionEmailMarketing))
                @foreach($typeOfPromotionEmailMarketing as $valueTypeOfPromotionEmailMarketing)
                    <option value="{{$valueTypeOfPromotionEmailMarketing->id}}" {{!empty($mediaPost) && $mediaPost->type_of_promotion_email_marketing == $valueTypeOfPromotionEmailMarketing->id?'selected':''}}>{{$valueTypeOfPromotionEmailMarketing->name}}</option>
                @endforeach
            @endif
        </select>
    </th>
    <th>
        <div class="d-flex">
            <input type="number" class="form-control" id="start_number_of_agent_onshore_email_marketing_filter{{$typeMedia}}" placeholder="From">
            <input type="number" class="form-control" id="end_number_of_agent_onshore_email_marketing_filter{{$typeMedia}}" placeholder="To">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input type="number" class="form-control" id="start_number_of_agent_offshore_email_marketing_filter{{$typeMedia}}" placeholder="From">
            <input type="number" class="form-control" id="end_number_of_agent_offshore_email_marketing_filter{{$typeMedia}}" placeholder="To">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input type="number" class="form-control" id="start_number_of_promotion_email_marketing_filter{{$typeMedia}}" placeholder="From">
            <input type="number" class="form-control" id="end_number_of_promotion_email_marketing_filter{{$typeMedia}}" placeholder="To">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input name="start_amount_of_money_aud_email_marketing" class="form-control" id="start_amount_of_money_aud_email_marketing_filter{{$typeMedia}}" placeholder="From">
            <input name="end_amount_of_money_aud_email_marketing" class="form-control" id="end_amount_of_money_aud_email_marketing_filter{{$typeMedia}}" placeholder="To">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input name="start_amount_of_money_vnd_email_marketing" class="form-control" id="start_amount_of_money_vnd_email_marketing_filter{{$typeMedia}}" placeholder="From">
            <input name="end_amount_of_money_vnd_email_marketing" class="form-control" id="end_amount_of_money_vnd_email_marketing_filter{{$typeMedia}}" placeholder="To">
        </div>
    </th>
    <th>
        <div class="d-flex">
            <input name="start_total_amount_of_money_email_marketing" class="form-control" id="start_total_amount_of_money_email_marketing_filter{{$typeMedia}}">
            <input name="end_total_amount_of_money_email_marketing" class="form-control" id="end_total_amount_of_money_email_marketing_filter{{$typeMedia}}">
        </div>
    </th>
    <th>
        <input name="note_email_marketing" class="form-control" id="note_email_marketing_filter{{$typeMedia}}">
    </th>
</tr>

