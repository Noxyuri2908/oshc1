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
                        @can('mediaManagerWebsite.edit')
                            <a class="dropdown-item edit_media_{{$mediaPostName}}" data-id="{{$data->id}}"
                               data-url="{{route("tasks.media.editMediaPost.post",['type_media_post'=>$getMediaPost,"id"=>$data->id])}}"
                               href="#">Edit</a>
                        @endcan
                        @can('mediaManagerWebsite.delete')
                            <a class="dropdown-item text-danger delete_media_{{$mediaPostName}}" data-id="{{$data->id}}"
                               data-url="{{route("tasks.media.destroyMediaPost.post",['type_media_post'=>$getMediaPost,"id"=>$data->id])}}"
                               href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class=" white-space-break-spaces">{{ (!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?$webMedia->where('id',$data->typeMediaPosts->where('type_id',$getMediaPost)->first()->type_content_id)->pluck('name')->first():''}}</td>
        <td class=" white-space-break-spaces">{{convert_date_form_db($data->schedule_post_date)}}</td>
        <td class=" white-space-break-spaces">{{(!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?convert_date_form_db($data->typeMediaPosts->where('type_id',$getMediaPost)->first()->post_date):''}}</td>
        <td class=" white-space-break-spaces">{{(!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?$data->typeMediaPosts->where('type_id',$getMediaPost)->first()->category:''}}</td>
        <td class=" white-space-break-spaces">{{$data->post_title}}</td>
        <td class=" white-space-break-spaces"><a href="{{$data->post_link}}">{{$data->post_link}}</a></td>
        <td class=" white-space-break-spaces">{{$sourcePostMedias->where('id',$data->source_post)->pluck('name')->first()}}</td>
        <td class=" white-space-break-spaces">{{$data->source_detail}}</td>
        <td class=" white-space-break-spaces">{{!empty($services->where('id',$data->service_id)->pluck('name')->first())?$services->where('id',$data->service_id)->pluck('name')->first():''}}</td>
        <td class=" white-space-break-spaces">{{$data->type_source}}</td>
        <td class=" white-space-break-spaces">{{$data->source_pr}}</td>
        <td class=" white-space-break-spaces">{{$data->view}}</td>
        <td class=" white-space-break-spaces">{{$data->getRate()}}</td>
        <td class=" white-space-break-spaces">{{convert_date_form_db($data->post_date_fanpage)}}</td>
        <td class=" white-space-break-spaces">{{convert_date_form_db($data->post_date_newletter)}}</td>
        <td class=" white-space-break-spaces">{{$data->getSeo()}}</td>
        <td class=" white-space-break-spaces">{{!empty($admins[$data->created_by])?$admins[$data->created_by]:''}}</td>
        <td class=" white-space-break-spaces">{{$data->note}}</td>
        <td class=" white-space-break-spaces">{{$data->is_hotnew}}</td>
        <td class=" white-space-break-spaces">{{convert_date_form_db($data->transfer_staff_date)}}</td>
        <td class=" white-space-break-spaces">{{!empty($admins[$data->translated_by])?$admins[$data->translated_by]:''}}</td>
        <td class=" white-space-break-spaces">{{convert_date_form_db($data->processing_date)}}</td>
        <td class=" white-space-break-spaces">{{convert_date_form_db($data->promote_date)}}</td>
        <td class=" white-space-break-spaces">{{!empty($typePromotion[$data->promotion_for])?$typePromotion[$data->promotion_for]['name']:''}}</td>
        <td class=" white-space-break-spaces">{{(!empty($data->user))?$data->user->name:''}}</td>
    </tr>
@endforeach
