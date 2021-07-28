<th>
    <select name="" id="follow_ups_status_filter" class="form-control">
        <option value=""></option>
        @foreach(config('myconfig.task_follow_up_status') as $key=>$status)
            <option value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</th>
