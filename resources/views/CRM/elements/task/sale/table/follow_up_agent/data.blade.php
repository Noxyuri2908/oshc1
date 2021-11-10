@section('css')
    <style>
        #follow-ups-data-sale>tr>th:first-child{
            padding-top: 0;
        }

        #follow-ups-data-sale>tr>th:first-child:before{
            content: "";
            position: absolute;
            left: 1px;
            width: 6px;
            height: 2.5rem;
            background: rgb(87, 155, 252);
            color: rgb(87, 155, 252);
            overflow: hidden;
        }
    </style>
@stop
@foreach($followUps as $item)
    <tr id="follow-ups-{{$item->id}}">
        <th>
            <div class="dropdown">
                <button class=" btn btn-link dropdown-toggle" type="button" id="dropdownApplyReceipt{{$item->id}}"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownApplyReceipt{{$item->id}}">
                    <div class="bg-white py-2">
                        @can('followUp.edit')
                            <a class="dropdown-item edit-follow-ups-agent" data-id="{{$item->id}}" data-agent_id="{{$item->user_id}}" href="#">Edit</a>
                        @endcan
                        @can('followUp.delete')
                            <a class="dropdown-item text-danger delete-follow-ups-agent" data-id="{{$item->id}}" data-agent_id="{{$item->user_id}}" data-url="{{route('agent.process.follow-up.delete',['agent_id'=>$item->user_id,'follow_id'=>$item->id])}}" href="#!">Delete</a>
                        @endcan

                    </div>
                </div>
            </div>

        </th>
        <th class="white-space-break-spaces text-overflow text-left">{{$item->getAgentName()}}</th>
        <td class="white-space-break-spaces text-overflow text-center">{{!empty($admins[$item->person_in_charge])?$admins[$item->person_in_charge]:''}}</td>
        <td class="white-space-break-spaces text-overflow text-center">{{getColorByDate(Carbon::parse($item->process_date)->dayOfWeek).' '.convert_date_form_db($item->process_date)}}</td>
        <td class="white-space-break-spaces text-overflow">{{$item->getContact()}}</td>
        <td class="white-space-break-spaces text-overflow " id="modelsFL"><a href="javascript:void(0)" onclick="showModelDes(this)">{{$item->des}}</a></td>

        <td class="white-space-break-spaces text-overflow color-white {{setLabelFlUpStatus($item->follow_up_status)}}" style="white-space: pre-line">{{getValueByIndexConfig($fl_up_status, $item->follow_up_status)}}</td>
        <td class="white-space-break-spaces text-overflow text-center" style="white-space: pre-line">@if($item->hot_issue == 1)<i class="fas fa-check"></i>@elseif($item->hot_issue == 0)<i class="fas fa-times"></i>@endif</td>
        <td class="white-space-break-spaces text-overflow text-center">{{!empty($admins[$item->create_person])?$admins[$item->create_person]:''}}</td>
        <td class="white-space-break-spaces text-overflow text-center" style="white-space: pre-line">{{getStaffNameById($item->assigned_person)}}</td>
        <td class="white-space-break-spaces text-overflow " style="white-space: pre-line">{{$item->title_task}}</td>
        <td class="white-space-break-spaces text-overflow " id="modelsFL"><a href="javascript:void(0)" onclick="showModelDes(this)">{{$item->task_description}}</a></td>
        <td class="white-space-break-spaces text-overflow text-center" style="white-space: pre-line">{{convert_date_form_db($item->due_date)}}</td>
        <td class="white-space-break-spaces text-overflow text-center" style="white-space: pre-line">{{!empty($item->estimate) ? "$item->estimate days" : ''}}</td>
        <td class="white-space-break-spaces text-overflow {{setLabelStatus($item->status)}}">{{$item->getStatus()}}</td>
        <td class="white-space-break-spaces text-overflow">{{$item->getPotentialService($dichvu)}}</td>
        <td class="white-space-break-spaces text-overflow">{{!empty($item->agent)?$item->agent->rating:''}}</td>
        <td class="white-space-break-spaces text-overflow " style="white-space: pre-line"></td>
    </tr>
@endforeach
