{{-- @dd($events) --}}
    @foreach($events as $item)
        <tr id="appointments-{{$item->id}}">
            <td>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownApplyReceipt{{$item->id}}"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-ellipsis-h fs--1"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownApplyReceipt{{$item->id}}">
                        <div class="bg-white py-2">
                            <a class="dropdown-item edit-appointment-agent" data-id="{{$item->id}}" data-agent_id="{{$item->id}}" href="{{route('event.edit',['event_id'=>$item->id,'submit_form'=>'task_sale'])}}">Edit</a>
                            <a class="dropdown-item text-danger delete-appointment-agent" data-id="{{$item->id}}" data-agent_id="{{$item->id}}" data-url="{{route('event.delete',['agent_id'=>$item->id,'appointment_id'=>$item->id])}}" href="#!">Delete</a>
                        </div>
                    </div>
                </div>
            </td>
            <td class="white-space-break-spaces text-overflow">{{(!empty($item->extendedProperties) && !empty($item->extendedProperties->private) && !empty($item->extendedProperties->private['agent_id']))?getAgentName($item->extendedProperties->private['agent_id']):''}}</td>
            <td class="white-space-break-spaces text-overflow">{{(!empty($item->start))?Carbon::parse($item->start->dateTime)->setTimezone('UTC'):''}} {{(!empty($item->end))?Carbon::parse($item->end->dateTime)->setTimezone('UTC'):''}}</td>
{{--            <td class="white-space-break-spaces text-overflow">{{getColorGoogle($item->colorId)}}</td>--}}
            <td class="white-space-break-spaces text-overflow">{{$item->location}}</td>
            <td class="white-space-break-spaces text-overflow" id="attendees" >
                @if(!empty($item->attendees))
                    <a href="javascript:void(0)" onclick="showModelAttendees(this);">
                        @foreach($item->attendees as $attendees)
                            {{$attendees->email}}
                        @endforeach
                    </a>
                @endif
            </td>
            <td class="white-space-break-spaces text-overflow text-left">{{$item->description}}</td>
        </tr>
    @endforeach
