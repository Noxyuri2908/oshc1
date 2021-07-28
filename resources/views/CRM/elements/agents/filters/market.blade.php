<th>
    <div>
        <select class="form-control" name="market_id_filter" id="market_id_filter" multiple>
            <option label="" value="null">(Blank)</option>
            @if(!empty($infoMarket))
                @foreach($infoMarket as $keyInfoMarket=>$valueInfoMarket)
                    <option
                        value="{{$keyInfoMarket}}">{{$valueInfoMarket}}</option>
                @endforeach
            @endif
        </select>
    </div>
</th>
