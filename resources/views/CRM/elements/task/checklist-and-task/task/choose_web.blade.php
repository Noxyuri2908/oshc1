@if(!empty($webMedias))
    <option value=""></option>
    @foreach($webMedias as $webMedia)
        <option label="" value="{{$webMedia->id}}" {{!empty($checkListData) && $checkListData->website_id == $webMedia->id?'selected':''}}>{{$webMedia->name}}</option>
    @endforeach
@endif
