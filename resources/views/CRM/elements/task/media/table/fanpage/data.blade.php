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
                        @can('mediaManagerFanpage.edit')
                            <a class="dropdown-item edit_media_{{$mediaPostName}}" data-id="{{$data->id}}"
                               data-url="{{route("tasks.media.editMediaPost.post",['type_media_post'=>$getMediaPost,"id"=>$data->id])}}"
                               href="#">Edit</a>
                        @endcan
                        @can('mediaManagerFanpage.delete')
                            <a class="dropdown-item text-danger delete_media_{{$mediaPostName}}" data-id="{{$data->id}}"
                               data-url="{{route("tasks.media.destroyMediaPost.post",['type_media_post'=>$getMediaPost,"id"=>$data->id])}}"
                               href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-break-spaces">{{ (!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?$webMedia->where('id',$data->typeMediaPosts->where('type_id',$getMediaPost)->first()->type_content_id)->pluck('name')->first():''}}</td>
        <td class="white-space-break-spaces">{{convert_date_form_db($data->schedule_post_date)}}</td>
        <td class="white-space-break-spaces">{{(!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?convert_date_form_db($data->typeMediaPosts->where('type_id',$getMediaPost)->first()->post_date):''}}</td>
        <td class="white-space-break-spaces">{{(!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?$data->typeMediaPosts->where('type_id',$getMediaPost)->first()->category:''}}</td>
        <td class="white-space-break-spaces">{{$data->post_title}}</td>
        <td class="white-space-break-spaces">{{$data->post_link}}</td>
        <td class="white-space-break-spaces">{{$sourcePostMedias->where('id',$data->source_post)->pluck('name')->first()}}</td>
        <td class="white-space-break-spaces">{{$services->where('id',$data->service_id)->pluck('name')->first()}}</td>
        <td class="white-space-break-spaces">{{$data->type_source}}</td>
        <td class="white-space-break-spaces">{{$data->source_pr}}</td>
        <td class="white-space-break-spaces">{{$data->react}}</td>
        <td class="white-space-break-spaces">{{$data->like}}</td>
        <td class="white-space-break-spaces">{{$data->share}}</td>
        <td class="white-space-break-spaces">{{$data->inbox}}</td>
        <td class="white-space-break-spaces">{{$data->getRate()}}</td>
        <td class="white-space-break-spaces">{{$data->note}}</td>
        <td class="white-space-break-spaces">{{$data->budget_qc}}</td>
        <td class="white-space-break-spaces">{{$data->tag}}</td>
        <td class="white-space-break-spaces">{{convert_date_form_db($data->start_date_qc)}}</td>
        <td class="white-space-break-spaces">{{$data->number_days}}</td>
        <td class="white-space-break-spaces">{{$data->total_budget}}</td>
        <td class="white-space-break-spaces">{{$data->credit_card}}</td>
    </tr>
@endforeach
