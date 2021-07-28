@if(!empty($commentTasks))
    @foreach($commentTasks as $cm)
        <div class="noti-comment">
            <div class="status {{setLabelFlUpStatus($cm->follow_up_status)}} color-white">
                <p>{{getValueByIndexConfig(config('myconfig.task_follow_up_status'), $cm->follow_up_status)}}</p>
            </div>
            <div class="title-task">
                <a href="#" style="color: black;text-decoration: none; width: 100%;float:left;" id="showModelcomment" data-id-agent="{{$cm->agent_id}}" data-id-follow-up="{{$cm->follow_id}}" data-id-comment="{{$cm->id}}" onclick="callModelFollowUp(this);">
                    <div class="box-staff-title">
                        <p style="font-weight: bold">{{getStaffNameById($cm->create_person)}}</p>
                        <p>&nbsp;- &nbsp;assigned an issue to you</p>
                    </div>
                    <p>{{$cm->title_task}}</p>
                    <p>Due date : {{convert_date_form_db($cm->due_date)}}</p>
                </a>
            </div>
            <div class="see" data-id="{{$cm->id}}">
                @if($cm->see != 1)
                    <i class="fas fa-circle" ></i>
                @endif
            </div>
        </div>
    @endforeach
@endif
