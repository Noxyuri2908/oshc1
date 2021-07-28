@foreach($mediaSettingDatas as $data)
    <tr id="media_setting_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        <a class="dropdown-item edit_media_setting_data" data-id="{{$data->id}}" data-url="{{route("task_media_status.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        <a class="dropdown-item text-danger delete_media_setting_data" data-id="{{$data->id}}" data-url="{{route("task_media_status.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{!empty($typeSetting[$data->type])?trans('lang.'.$typeSetting[$data->type]):''}}</td>
        <td class="white-space-preline-report">{{$data->name}}</td>
        <td class="white-space-preline-report">{{collect($data->category)->implode(',')}}</td>
    </tr>
@endforeach
