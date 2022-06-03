<th>

    <select name="" id="status_follow_ups_filter" class="form-control">
        <option value="">Status</option>
        @foreach(config('admin.status') as $key=>$status)
            <option value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</th>
