@foreach($agentContactDatas as $data)
    <tr id="agent_contact_data_{{$data->id}}">
        <th>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownWebsiteTask"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownWebsiteTask">
                    <div class="bg-white py-2">
                        {{--                        @can('customerManager.edit')--}}
                        <a class="dropdown-item edit_agent_contact" data-id="{{$data->id}}"
                           data-url="{{route("agent.contact.edit",["id"=>$data->id])}}"
                           href="#">Edit</a>
                        {{--                        @endcan--}}
                        {{--                        @can('customerManager.delete')--}}
                        <a class="dropdown-item text-danger delete_agent_contact" data-id="{{$data->id}}"
                           data-url="{{route("agent.contact.delete",["id"=>$data->id])}}" href="#!">Delete</a>
                        {{--                        @endcan--}}
                    </div>
                </div>
            </div>
        </th>
        <td class="white-space-break-spaces">{{getDepartmentById(!empty($data->department) ? $data->department : '')}}</td>
        <td class="white-space-break-spaces">{{!empty($data->name) ? $data->agent_name:''}}</td>
        <td class="white-space-break-spaces">{{!empty($data->country) ? $countries[$data->country]:''}}</td>
        <td class="white-space-break-spaces">{{!empty($data->status) ? getValueByIndexConfig($status, $data->status):''}}</td>
        <td class="white-space-break-spaces">{{!empty($data->type_id) ? getValueByIndexConfig($typeAgent, $data->type_id):''}}</td>
        <td class="white-space-break-spaces">{{$data->name}}</td>
        <td class="white-space-break-spaces">{{$data->position}}</td>
        <td class="white-space-break-spaces">{{getStaffNameById(!empty($data->staff_id) ? $data->staff_id : '')}}</td>
        <td class="white-space-break-spaces">{{$data->phone}}</td>
        <td class="white-space-break-spaces">{{is_int($data->birthday)?Carbon::parse(Date::excelToDateTimeObject($data->birthday))->format('d/m/Y'):$data->birthday}}</td>
        <td class="white-space-break-spaces">{{$data->email}}</td>
        <td class="white-space-break-spaces">{{$data->skype}}</td>
        <td class="white-space-break-spaces">{{$data->facebook}}</td>
        <td class="white-space-break-spaces">{{$data->note}}</td>
        <td class="white-space-break-spaces text-center">{!!  $data->is_receive_comm == 'on'?'<i class="fas fa-check"></i>':''!!}</td>
        <td class="white-space-break-spaces">{{$data->acc_name}}</td>
        <td class="white-space-break-spaces">{{$data->bank}}</td>
        <td class="white-space-break-spaces">{{$data->receiver_address}}</td>
        <td class="white-space-break-spaces">{{$data->currency}}</td>
        <td class="white-space-break-spaces">{{$data->bank_address}}</td>
        <td class="white-space-break-spaces">{{$data->swift_code}}</td>
    </tr>
@endforeach
