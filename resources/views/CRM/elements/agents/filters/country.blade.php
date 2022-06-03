<th>
    <div>
        <select class="form-control" name="country_filter" id="country_filter">
            <option label=""></option>
            <option value="null">(Blank)</option>
            @if(!empty($countries))
                @foreach($countries as $keyCountry=>$valueCountry)
                    <option
                        value="{{$keyCountry}}">{{$valueCountry}}</option>
                @endforeach
            @endif
        </select>
    </div>
</th>
