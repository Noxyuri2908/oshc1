@foreach($archiveMediaLinkDatas as $data)
    <tr id="archive_media_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        <a class="dropdown-item edit_archive_media_link" data-id="{{$data->id}}" data-url="{{route("archive-media-link.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        <a class="dropdown-item text-danger delete_archive_media_link" data-id="{{$data->id}}" data-url="{{route("archive-media-link.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{$sourceStatuses->where('id',$data->source_id)->pluck('name')->first()}}</td>
{{--        <td class="white-space-preline-report">{{$data->getFromName()}}</td>--}}
        <td class="white-space-preline-report">{{$data->name}}</td>
        <td class="white-space-preline-report">{{$data->getCountryName()}}</td>
{{--        <td class="white-space-preline-report">{{$data->source_id}}</td>--}}
        <td class="white-space-preline-report">{{$data->link}}</td>
        <td class="white-space-preline-report">{{$data->getTypeName()}}</td>
        <td class="white-space-preline-report">{{$data->getHotNewName()}}</td>
        <td class="white-space-preline-report">{{$data->getInformationFocusName()}}</td>
        <td class="white-space-preline-report">{{$data->admin}}</td>
        <td class="white-space-preline-report">{{$data->email_admin}}</td>
        <td class="white-space-preline-report">{{$data->telephone}}</td>
        <td class="white-space-preline-report">{{$data->note}}</td>
    </tr>
@endforeach
