<th>
    <select name="branch_remind_follow_ups_filter" id="branch_remind_follow_ups_filter" class="form-control">
        <option value=""></option>
        @foreach(config('myconfig.department') as $key => $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
    {{--    <input type="text" class="form-control" id="branch_remind_follow_ups_filter" placeholder="Branch">--}}
</th>
