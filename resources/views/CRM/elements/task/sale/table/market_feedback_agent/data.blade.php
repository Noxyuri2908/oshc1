@if(!empty($marketFeedbacks))
    @foreach($marketFeedbacks as $item)
        <tr id="market-feedback-{{$item->id}}">
            <td>
                <div class="dropdown">
                    <button class=" btn btn-link dropdown-toggle" type="button" id="dropdownApplyReceipt{{$item->id}}"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-ellipsis-h fs--1"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownApplyReceipt{{$item->id}}">
                        <div class="bg-white py-2">
                            @can('agentFeedback.index')
                                <a class="dropdown-item edit-market-feedback-agent" data-id="{{$item->id}}" data-agent_id="{{$item->user_id}}" href="#">Edit</a>
                            @endcan
                            @can('agentFeedback.delete')
                                <a class="dropdown-item text-danger delete-market-feedback-agent" data-id="{{$item->id}}" data-agent_id="{{$item->user_id}}" data-url="{{route('agent.process.market.feedback.delete',['agent_id'=>$item->user_id,'market_feedback_id'=>$item->id])}}" href="#!">Delete</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </td>
            <td class="white-space-break-spaces text-overflow">{{$item->getAgentName()}}</td>
            <td class="white-space-break-spaces text-overflow">{{convert_date_form_db($item->processing_date)}}</td>
            <td class="white-space-break-spaces text-overflow">{{$item->getIssue()}}</td>
            <td class="white-space-break-spaces text-overflow">{{!empty($admins[$item->person_in_charge])?$admins[$item->person_in_charge]:''}}</td>
            <td class="white-space-break-spaces text-overflow text-left">{{$item->market_feedback}}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td>No data selected!
        </td>
    </tr>
@endif
