@if(!empty($options))
    <option value=""></option>
    @foreach($options as $option)
        <option label="{{$option->name}}" value="{{$option->id}}" {{!empty($checkListData) && $checkListData->website_id == $option->id?'selected':''}}>{{$option->name}}</option>
    @endforeach
@endif
