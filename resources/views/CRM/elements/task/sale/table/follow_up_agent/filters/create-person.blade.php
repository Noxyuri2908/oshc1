<th>
    <select name="" id="create_by_follow_ups_filter" class="form-control">
        <option value=""></option>
        @foreach($admins as $key=>$status)
            <option value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</th>
