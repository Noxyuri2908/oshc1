@foreach($checkListDatas as $data)
    <tr id="task_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        @can('check-list.edit')
                            <a class="dropdown-item edit_check_list{{$type}}" data-id="{{$data->id}}"
                               data-url="{{route("check-list.edit",["id"=>$data->id])}}" href="#">Edit</a>
                        @endcan
                        @can('check-list.delete')
                            <a class="dropdown-item text-danger delete_check_list{{$type}}" data-id="{{$data->id}}"
                               data-url="{{route("check-list.delete",["id"=>$data->id,'group_id'=>$data->group_id])}}"
                               href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-preline-report">{{(!empty($types[$data->type_id]))?$types[$data->type_id]:''}}</td>
        <td class="white-space-preline-report">{{$webMedias->where('id',$data->website_id)->pluck('name')->first()}}</td>
        {{--        <td class="white-space-preline-report">{{$data->getCategoryName()}}</td>--}}
        <td class="white-space-preline-report">{{!empty($admins[$data->person_id])?$admins[$data->person_id]:''}}</td>
        <td class="white-space-preline-report">{{$data->problem}}</td>
        <td class="white-space-preline-report">{{convert_date_form_db($data->date_of_suggestion)}}</td>
        {{--        <td class="white-space-preline-report">{{$data->solution_text}}</td>--}}
        {{--        <td class="white-space-preline-report">{{$data->level_of_process}}</td>--}}
        <td class="white-space-preline-report">{{$data->getResult()}}</td>
        {{--        <td class="white-space-preline-report">{{convert_date_form_db($data->processing_time)}}</td>--}}
        {{--        <td class="white-space-preline-report">{{$data->budget}}</td>--}}
        <td class="white-space-preline-report">{{convert_date_form_db($data->checklist_created_at)}}</td>
    </tr>
@endforeach
