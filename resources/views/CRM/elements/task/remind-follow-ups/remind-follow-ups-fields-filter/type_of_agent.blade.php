<th>
    <select name="type_of_agent_remind_follow_ups_filter" id="type_of_agent_remind_follow_ups_filter"
            class="form-control">
        <option value=""></option>
        @foreach(config('admin.type_agent') as $key => $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
</th>
