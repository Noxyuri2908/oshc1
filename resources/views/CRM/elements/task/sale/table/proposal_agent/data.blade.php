@foreach($proposals as $item)
    <tr id="proposals-{{$item->id}}">
        <td>
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownApplyReceipt{{$item->id}}"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-ellipsis-h fs--1"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownApplyReceipt{{$item->id}}">
                    <div class="bg-white py-2">
                        @can('proposal.edit')
                            <a class="dropdown-item edit-proposal-agent" data-id="{{$item->id}}" data-agent_id="{{$item->user_id}}" href="#">Edit</a>
                        @endcan
                        @can('proposal.delete')
                            <a class="dropdown-item text-danger delete-proposal-agent" data-id="{{$item->id}}" data-agent_id="{{$item->user_id}}" data-url="{{route('agent.process.proposal.delete',['agent_id'=>$item->user_id,'proposal_id'=>$item->id])}}" href="#!">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
        </td>
        <td class="white-space-break-spaces text-overflow">{{$item->getAgentName()}}</td>
        <td class="white-space-break-spaces text-overflow">{{convert_date_form_db($item->processing_date)}}</td>
        <td class="white-space-break-spaces text-overflow">{{$item->getIssue()}}</td>
        <td class="white-space-break-spaces text-overflow">{{!empty($admins[$item->person_in_charge])?$admins[$item->person_in_charge]:''}}</td>
        <td class="white-space-break-spaces text-overflow">{{!empty($admins[$item->create_person])?$admins[$item->create_person]:''}}</td>
        <td class="white-space-break-spaces text-overflow text-left">{{$item->proposal}}</td>
    </tr>
@endforeach
