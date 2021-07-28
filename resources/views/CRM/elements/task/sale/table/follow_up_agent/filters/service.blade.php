<th>
    <select name="" id="potential_service_follow_ups_filter" class="form-control choose_multiple_select" multiple>
        <option value="">Select</option>
        @foreach($dichvus as $key=>$status)
            <option value="{{$status->id}}">{{$status->name}}</option>
        @endforeach
    </select>

</th>
