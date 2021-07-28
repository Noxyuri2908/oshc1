@foreach($groupDatas as $data)
    <tr id="check_list_group_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @can('check-list-group.edit')
                            <a class="dropdown-item edit_check_list_group" data-id="{{$data->id}}"
                               data-url="{{route("check-list-group.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        @endcan
                        @can('check-list-group.delete')
                            <a class="dropdown-item text-danger delete_check_list_group" data-id="{{$data->id}}"
                               data-url="{{route("check-list-group.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{$data->group_name}}</td>
        <td class="white-space-preline-report">{{$data->getCreateBy()}}</td>
    </tr>
@endforeach

