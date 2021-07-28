@foreach($mediaPosts as $data)
    <tr id="{{$mediaPostName}}_{{$data->id}}_data">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @can('mediaManagerGroup.edit')
                            <a class="dropdown-item edit_media_{{$mediaPostName}}" data-id="{{$data->id}}"
                               data-url="{{route("tasks.media.editMediaPost.post",['type_media_post'=>$getMediaPost,"id"=>$data->id])}}"
                               href="#">Edit</a>
                        @endcan
                        @can('mediaManagerGroup.delete')
                            <a class="dropdown-item text-danger delete_media_{{$mediaPostName}}" data-id="{{$data->id}}"
                               data-url="{{route("tasks.media.destroyMediaPost.post",['type_media_post'=>$getMediaPost,"id"=>$data->id])}}"
                               href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{ (!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?$webMedia->where('id',$data->typeMediaPosts->where('type_id',$getMediaPost)->first()->type_content_id)->pluck('name')->first():''}}</td>
        <td class="white-space-preline-report">{{(!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?convert_date_form_db($data->typeMediaPosts->where('type_id',$getMediaPost)->first()->post_date):''}}</td>
        <td class="white-space-preline-report">{{(!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?$data->typeMediaPosts->where('type_id',$getMediaPost)->first()->category:''}}</td>
        <td class="white-space-preline-report">{{$data->post_title}}</td>
        <td class="white-space-preline-report">{{$data->post_link}}</td>
        <td class="white-space-preline-report">{{!empty($admins[$data->created_by])?$admins[$data->created_by]:''}}</td>
        <td class="white-space-preline-report">{{$data->type_source}}</td>
        <td class="white-space-preline-report">{{$data->react}}</td>
        <td class="white-space-preline-report">{{$data->like}}</td>
        <td class="white-space-preline-report">{{$data->share}}</td>
        <td class="white-space-preline-report">{{$data->inbox}}</td>
        <td class="white-space-preline-report">{{$data->getRate()}}</td>
        <td class="white-space-preline-report">{{$sourcePostMedias->where('id',$data->source_post)->pluck('name')->first()}}</td>
        <td class="white-space-preline-report">{{$data->note}}</td>
    </tr>
@endforeach
