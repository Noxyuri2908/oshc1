@foreach($marketingMaterialDatas as $data)
    <tr id="marketing_material_content_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        <a class="dropdown-item edit_marketing_material" data-id="{{$data->id}}" data-url="{{route("marketing-material.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        <a class="dropdown-item text-danger delete_marketing_material" data-id="{{$data->id}}" data-url="{{route("marketing-material.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{!empty($data->getCategory())?$data->getCategory():''}}</td>
        <td class="white-space-preline-report">{{!empty($data->content)?$data->content:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->getUseFor())?$data->getUseFor():''}}</td>
        <td class="white-space-preline-report">{{!empty($data->getTarget())?$data->getTarget():''}}</td>
        <td class="white-space-preline-report">{{!empty($data->target)?$data->getSubTargetName():''}}</td>
        <td class="white-space-preline-report">
            <a href="{{!empty($data->link_download())?$data->link_download():''}}">{{$data->file_attachment}}</a>
        </td>
        <td>{{!empty($data->created_at)?\Carbon\Carbon::parse($data->created_at)->format('d/m/Y'):''}}</td>
    </tr>
@endforeach
