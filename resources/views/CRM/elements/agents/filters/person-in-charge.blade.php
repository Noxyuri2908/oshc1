<th>
    <div>
        <select class="form-control" name="staff_id_filter" id="staff_id_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($admins))
                @foreach($admins as $keyAdmin=>$valueAdmin)
                    <option
                        value="{{$keyAdmin}}">{{$valueAdmin}}</option>
                @endforeach
            @endif
        </select>
    </div>
</th>
