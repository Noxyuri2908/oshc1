@foreach($getAgentReport as $report)
    <tr>
        <td class="white-space-preline-report">{{$report['date']}}</td>
        <td class="white-space-break-spaces ">
            @if(!empty($report['new_contract']))
                <a href="javascript:void(0)" data-content="{{$report['new_contract']}}" id="content_new_contract" onclick="showModel(this);">
                @foreach($report['new_contract'] as $contact)
                    {{$contact}}
                @endforeach
                </a>
            @endif
{{--            {{$report['new_contract']}}--}}
        </td>
        <td class="white-space-break-spaces text-left ">
            @if(!empty($report['first_case']))
                <a href="javascript:void(0)" data-content="{{$report['first_case']}}" id="content_first_case" onclick="showModel(this);">
                    @foreach($report['first_case'] as $contact)
                        {{$contact}}
                    @endforeach
                </a>
            @endif
{{--            {{$report['first_case']}}--}}
        </td>
        <td class="white-space-break-spaces text-left ">
            @if(!empty($report['new_agent']))
                <a href="javascript:void(0)" data-content="{{$report['new_agent']}}" id="content_new_agent" onclick="showModel(this);">
                    @foreach($report['new_agent'] as $contact)
                        {{$contact}}
                    @endforeach
                </a>
            @endif
{{--            {{$report['new_agent']}}--}}
        </td>
        <td class="white-space-break-spaces text-left ">
            @if(!empty($report['note_new_agent']))
                <a href="javascript:void(0)" data-content="{{$report['note_new_agent']}}" id="content_note_new_agent" onclick="showModel(this);">
                    @foreach($report['note_new_agent'] as $user=>$note)
                        {{$user}}:<br>{{$note}}
                    @endforeach
                </a>
            @endif
        </td>
    </tr>
@endforeach
