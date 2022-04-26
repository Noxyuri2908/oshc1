<th>
    <select name="pc_remind_follow_ups_filter" id="pc_remind_follow_ups_filter" class="form-control">
        <option value=""></option>
        @foreach($admins as $key => $item)
            <option value="{{$key}}">{{$item}}</option>
        @endforeach
    </select>
</th>
