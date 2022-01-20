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
        <td class="white-space-preline-report">{{!empty($data->getType())?$data->getType():''}}</td>
        <td class="white-space-preline-report">{{!empty($data->content)?$data->content:''}}</td>
        <td class="white-space-preline-report">{{!empty($data->getUseFor())?$data->getUseFor():''}}</td>
        <td class="white-space-preline-report">{{!empty($data->getTarget())?$data->getTarget():''}}</td>
        <td class="white-space-preline-report">{{!empty($data->target)?$data->getSubTargetName():''}}</td>
        <td class="white-space-preline-report">
            <a href="" data-toggle="modal" data-target="#modal-{{$data->id}}">{{getFileAttachById($data->id)}}</a>
            <div class="modal fade" id="modal-{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal-{{$data->id}}">Link</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{decode_html(getFileAttachById($data->id), 'array')}}
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td>{{!empty($data->created_at)?\Carbon\Carbon::parse($data->created_at)->format('d/m/Y'):''}}</td>
        <td>{{!empty($data->note) ? $data->note : ''}}</td>
    </tr>
@endforeach

