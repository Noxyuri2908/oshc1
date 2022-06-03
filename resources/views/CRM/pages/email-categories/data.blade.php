@if(!empty($emailCategories))
    @foreach($emailCategories as $key => $item)
        <tr class="tr-content {{$loop->iteration / 2 != 0 ? 'odd' : ''}}"
            id="cat-{{$item->id}}">
            <td class="text-center">{{$item->id}}</td>
            <td id="cat-name">{{$item->name}}</td>
            <td class="text-center"><span
                    class="badge badge-pill {{$item->status == 1 ? 'badge-success' : 'badge-danger'}} "
                    id="cat-status">{{$item->status == 1 ? 'Active' : 'Deactive'}}</span>
            </td>
            <td>
                <div class="d-flex justify-content-around">
                    <a href="javascript:void(0)"
                       class="btn btn-sm btn-primary" id="btn-edit" data-id="{{$item->id}}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-danger" id="destroy" data-id="{{$item->id}}">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td>no data</td>
    </tr>
@endif
