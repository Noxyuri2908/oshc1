<th>
    <select name="" id="contact_by_follow_ups_filter" class="form-control">
        <option value="">Contact by</option>
        @foreach(config('myconfig.contact_by') as $key=>$status)
            <option value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</th>
