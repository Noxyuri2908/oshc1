@foreach($covers as $key => $item)
    <tr class="table-cover-body">
        <td id="policy" data-policy="{{$item->policy}}">{{getValueByIndexConfig(config('myconfig.policy'),$item->policy)}}</td>
        <td id="cover">{{$item->cover}}</td>
        <td data-id="{{$item->id}}">
            <button id="click-edit" onclick="btnEdit(this)">
                <i class="fas fa-edit" ></i>
            </button>
            <button id="click-remove" onclick="btnRemove(this)">
                <i class="fas fa-trash-alt" ></i>
            </button>
        </td>
    </tr>
@endforeach
