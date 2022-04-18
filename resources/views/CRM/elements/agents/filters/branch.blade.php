<th>
    <div>
        <select class="form-control" name="department_filter" id="department_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($departments))
                @foreach($departments as $keyDepartment => $valueDepartment)
                    <option
                        value="{{$keyDepartment}}">{{$valueDepartment}}</option>
                @endforeach
            @endif
        </select>
    </div>
</th>
