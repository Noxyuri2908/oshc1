<th>
    <select name="status_remind_follow_ups_filter" id="status_remind_follow_ups_filter" class="form-control">
        <option value=""></option>
        @foreach(config('admin.status') as $key => $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
</th>
