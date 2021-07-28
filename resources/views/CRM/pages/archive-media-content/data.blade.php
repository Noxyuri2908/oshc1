@foreach($archiveMediaContentDatas as $data)
    <tr id="archive_media_content_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        <a class="dropdown-item" data-id="{{$data->id}}" data-url="" href="{{route("archive-media-content.edit",["id"=>$data->id])}}">Edit</a>
                        <a class="dropdown-item text-danger delete_archive_media_content" data-id="{{$data->id}}" data-url="{{route("archive-media-content.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-break-spaces">{{$data->getWebsiteName($webMedia)}}</td>
        <td class="white-space-break-spaces">{{$data->getCategoryName($webMedia)}}</td>
        <td class="white-space-break-spaces">{{$data->title}}</td>
        <td class="white-space-break-spaces"><a href="#" data-url="{{route('archive-media-content.viewContentPost',['id'=>$data->id])}}" class="view_content_post">View</a></td>
        <td class="white-space-break-spaces">{{convert_date_form_db($data->date)}}</td>
        <td class="white-space-break-spaces">{{$data->getStatus()}}</td>
{{--        <td class="white-space-break-spaces">{{$data->getHotNewName()}}</td>--}}

        <td class="white-space-break-spaces">{{$data->note}}</td>
        <td class="white-space-break-spaces">{{$data->getCreateBy($admins)}}</td>
    </tr>
@endforeach
