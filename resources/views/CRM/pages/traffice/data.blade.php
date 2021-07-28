@foreach($trafficeDatas as $data)
    <tr id="traffice_content_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @can('traffice.edit')
                        <a class="dropdown-item edit_traffice" data-id="{{$data->id}}" data-url="{{route("traffice.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        @endcan
                        @can('traffice.delete')
                            <a class="dropdown-item text-danger delete_traffice" data-id="{{$data->id}}" data-url="{{route("traffice.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{!empty($data->start_date)?convert_date_form_db($data->start_date):''}}</td>
        <td class="white-space-preline-report">{{!empty($data->end_date)?convert_date_form_db($data->end_date):''}}</td>
        <td class="white-space-preline-report">{{!empty($data->total_view)?$data->total_view:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->total_user)?$data->total_user:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->total_like)?$data->total_like:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->total_reach)?$data->total_reach:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->note)?$data->note:''}}</td>
    </tr>
@endforeach
