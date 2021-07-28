<tr class="last-row">
    <th></th>
    <th>
{{--        <input class="form-control" value="" name="start_date_filter" id="start_date_filter" type="text" required>--}}
    </th>
    <th>
{{--        <input class="form-control" value="" name="end_date_filter" id="end_date_filter" type="text" required>--}}
    </th>
    <th>
        <div>
            <select class="form-control" name="website_id_filter" id="website_id_filter">
                <option label=""></option>
                @if(!empty($webMedias))
                    @foreach($webMedias as $keyWebMedia=>$value)
                        <option data-value="{{$value->value}}" value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <input class="form-control" value="" name="campaign_filter" id="campaign_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="location_search_filter" id="location_search_filter" type="text" required>
    </th>
    <th>
        <div>
            <select class="form-control" name="language_search_filter" id="language_search_filter">
                <option label=""></option>
                @if(!empty($countries))
                    @foreach($countries as $keyCountry=>$value)
                        <option value="{{$keyCountry}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->language_search_filter == $keyCountry ?'selected':''}}>{{$value}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </th>
    <th>
        <input class="form-control" value="" name="type_campaign_filter" id="type_campaign_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="bid_price_filter" id="bid_price_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="keyword_filter" id="keyword_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="title_1_filter" id="title_1_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="title_2_filter" id="title_2_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="title_3_filter" id="title_3_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="describe_filter" id="describe_filter" type="text" required>
    </th>
    <th>
        <input class="form-control" value="" name="link_post_filter" id="link_post_filter" type="text" required>
    </th>
    <th>
    </th>
    <th>
        <input class="form-control" value="" name="budget_filter" id="budget_filter" type="text" required>
    </th>
    <th>
    </th>
    <th></th>
    <th></th>
    <th></th>
</tr>
