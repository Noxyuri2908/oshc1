@foreach($checkListDatas as $data)
    <tr id="check_list_data_{{$data->id}}">
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
        <td class="white-space-preline-report">{{$checklistSettingType->where('id',$data->type_id)->pluck('name')->first()}}</td>
        <td class="white-space-preline-report">{{(!empty($data->type_id))?$checklistSettingType->where('id',$data->website_id)->pluck('name')->first():''}}</td>
        <td class="white-space-preline-report">{{(!empty($data->website_id))?$checklistSettingType->where('id',$data->category_id)->pluck('name')->first():''}}</td>
        <td class="white-space-preline-report">{{convert_id_to_name_person_in_charge($admins, $data->proposer)}}</td>
        <td class="white-space-preline-report">{{convert_id_to_name_person_in_charge($admins, $data->person_id)}}</td>
        <td class="white-space-preline-report">{{$data->problem}}</td>
        <td class="white-space-preline-report">
            <a href="#view-detail-{{$data->id}}" class="show-view-detail">{{($data->detail) ? 'View' : ''}}</a>
            <div style="display: none;width: auto;height: auto;" id="view-detail-{{$data->id}}">
                <pre >{{$data->detail}}</pre>
            </div>
        </td>
        <td class="white-space-preline-report">{{convert_date_form_db($data->date_of_suggestion)}}</td>
        <td class="white-space-preline-report">{{$solution_it_checklist->where('id', $data->solution_text)->pluck('name')->first()}}</td>
        <td class="white-space-preline-report">{{getValueByIndexConfig(\App\Admin\CheckList::$LVPROCESSOR, $data->level_of_process)}}</td>
        <td class="white-space-preline-report">{{$data->getResult()}}</td>
        <td class="white-space-preline-report">{{convert_date_form_db($data->processing_time)}}</td>
        <td class="white-space-preline-report">{{$data->budget}}</td>
        <td class="white-space-preline-report">{{convert_date_form_db($data->checklist_created_at)}}</td>
        <td class="white-space-preline-report">
            <a target="_blank" href="{{asset('tailieus').'/'.$data->file}}">{{$data->file}}</a>
        </td>
        <td class="white-space-preline-report">{{convert_id_to_name_person_in_charge($admins, $data->created_by)}}</td>
    </tr>
@endforeach
