<th>
    <div>
        <select class="form-control" name="user_status_filter" id="user_status_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($userStatus))
                @foreach($userStatus as $keyUserStatus=>$valueUserStatus)
                    <option
                        value="{{$keyUserStatus}}">{{$valueUserStatus}}</option>
                @endforeach
            @endif
        </select>
    </div>
</th>
