<th>
    <select name="" id="assign_follow_ups_filter" class="form-control">
        <option value=""></option>
        @foreach($admins as $key=>$status)
            <option value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>
</th>
