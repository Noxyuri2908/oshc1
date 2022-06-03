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
        <td class="white-space-break-spaces">{{(!empty($data->typeMediaPosts) && $data->typeMediaPosts->count()>0)?convert_date_form_db($data->typeMediaPosts->where('type_id',$getMediaPost)->first()->post_date):''}}</td>
        <td class="white-space-break-spaces">{{convert_date_form_db($data->schedule_post_date)}}</td>
        <td class="white-space-break-spaces">{{$categoryEmailMarketing->where('id',$data->category_email_marketing)->pluck('name')->first()}}</td>
        <td class="white-space-break-spaces">{{!empty($services->where('id',$data->service_id)->pluck('name')->first())?$services->where('id',$data->service_id)->pluck('name')->first():''}}</td>
        <td class="white-space-break-spaces">{{$data->post_title}}</td>
        <td class="white-space-break-spaces">{{$objectEmailMarketing->where('id',$data->object_email_marketing)->pluck('name')->first()}}</td>
        <td class="white-space-break-spaces">{{$data->number_of_selected_email_marketing}}</td>
        <td class="white-space-break-spaces">{{$data->number_of_clicked_link_email_marketing}}</td>
        <td class="white-space-break-spaces">{{$typeOfPromotionEmailMarketing->where('id',$data->type_of_promotion_email_marketing)->pluck('name')->first()}}</td>
        <td class="white-space-break-spaces">{{$data->number_of_agent_onshore_email_marketing}}</td>
        <td class="white-space-break-spaces">{{$data->number_of_agent_offshore_email_marketing}}</td>
        <td class="white-space-break-spaces">{{$data->number_of_promotion_email_marketing}}</td>
        <td class="white-space-break-spaces">{{$data->amount_of_money_aud_email_marketing}}</td>
        <td class="white-space-break-spaces">{{$data->amount_of_money_vnd_email_marketing}}</td>
        <td class="white-space-break-spaces">{{$data->total_amount_of_money_email_marketing}}</td>
        <td class="white-space-break-spaces">{{$data->note_email_marketing}}</td>

    </tr>
@endforeach
