<th>
    <div>
        <select class="form-control" name="info_type_id_filter" id="info_type_id_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($typeAgent))
                @foreach($typeAgent as $keyTypeAgent=>$valueTypeAgent)
                    <option
                        value="{{$keyTypeAgent}}">{{$valueTypeAgent}}</option>
                @endforeach
            @endif
        </select>
    </div>
</th>
