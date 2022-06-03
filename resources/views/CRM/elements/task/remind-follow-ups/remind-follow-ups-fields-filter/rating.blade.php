<th>
    <select name="rating_remind_follow_ups_filter" id="rating_remind_follow_ups_filter" class="form-control">
        <option value=""></option>
        @foreach(config('myconfig.rating') as $key => $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
    {{--    <input type="text" class="form-control" id="rating_remind_follow_ups_filter" placeholder="Rating">--}}
</th>
