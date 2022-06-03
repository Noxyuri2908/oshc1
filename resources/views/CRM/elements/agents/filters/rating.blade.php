<th>
    <div>
        <select class="form-control" name="rating_filter" id="rating_filter">
            <option value=""></option>
            <option label="" value="null">(Blank)</option>
            @if(!empty($configRating))
                @foreach($configRating as $keyRating=>$rating)
                    <option value="{{$keyRating}}">{{$rating}}</option>
                @endforeach
            @endif
        </select>
    </div>
</th>
