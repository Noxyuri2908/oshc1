<th >
    <select name="" id="person_in_charge_follow_ups_filter" class="form-control">
        <option value="">Person in charge</option>
        @foreach($admins as $key=>$status)
            <option value="{{$key}}">{{$status}}</option>
        @endforeach
    </select>

</th>
