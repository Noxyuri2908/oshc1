@section('css')
    <style>
        #follow-ups-data-sale > tr > th:first-child {
            padding-top: 0;
        }

        #follow-ups-data-sale > tr > th:first-child:before {
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
@foreach($remindsFollowUps as $item)
    <tr id="follow-ups-{{$item->id}}" style="background-color : {{$item->time_no_follow_up >= 60 ? 'red' : '#fff'}}">
        <th>
            <div class="dropdown">
                <button class=" btn btn-link dropdown-toggle" type="button" id="dropdownApplyReceipt{{$item->id}}"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownApplyReceipt{{$item->id}}">
                    <div class="bg-white py-2">
                        <a class="dropdown-item text-danger delete-follow-ups-agent" data-id="{{$item->id}}"
                           {{--                           data-agent_id="{{$item->user_id}}"--}}
                           {{--                           data-url="{{route('agent.process.follow-up.delete',['agent_id'=>$item->user_id,'follow_id'=>$item->id])}}"--}}
                           href="#!">Process</a>

                    </div>
                </div>
            </div>

        </th>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}} text-center">{{$item->follows->getBranchAgent()}}</th>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}}">{{$item->follows->getAgentName()}}</th>
        <td class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}} text-center">{{!empty($item->follows) ? getStaffNameById($item->follows->getPC()) :''}}</td>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}} text-center">{{$item->follows->getCountryAgent()}}</th>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}} text-center">{{$item->follows->getRatingAgent()}}</th>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}} text-center">{{$item->follows->getStatus()}}</th>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}} text-center">{{$item->follows->getTypeAgent()}}</th>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}}">{{$item->follows->getCompanyEmail()}}</th>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}} text-center">{{convert_date_form_db($item->follows->process_date)}}</th>
        <th class="white-space-break-spaces text-overflow  {{$item->time_no_follow_up >= 60 ? 'text-white' : 'text-black'}} text-center">{{$item->time_no_follow_up}}</th>
    </tr>
@endforeach
