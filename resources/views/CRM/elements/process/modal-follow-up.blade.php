@php
    $agent = $follow->agent->first();
@endphp
<div class="modal fade user-information" id="modal_follow_up" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel">{{!empty($follow)?"Update follow up agent : $agent->name":'Add new follow up'}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information" onmouseover="hoverToLoadSelectFollowUp()"
                     style="max-height: 500px;overflow: scroll">
                    <div class="row">
                        @if(empty($obj))
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group agent_follow_up_select2">
                                    <label class="control-label">Agent:</label>
                                    <select class="form-control" name="status" id="agent_follow_up">
                                        {{--<option label=""></option>--}}
                                        {{--@foreach($agents as $key=>$value)--}}
                                        {{--    <option value="{{$key}}" {{!empty($follow) && $follow->user_id == $key ?'selected':''}}>{{$value}}</option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                    <small id="user_id_alert" class="text-danger"></small>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Processing date:</label>
                                <input class="form-control" autocomplete="off"
                                       value="{{!empty($follow)?convert_date_form_db($follow->process_date):''}}"
                                       name="process_date" id="process_date_follow_up" type="text" required>
                                <small id="process_date_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Status:</label>
                                <select class="form-control" name="status" id="status_follow_up">
                                    <option label=""></option>
                                    @foreach(config('admin.status') as $key=>$value)
                                        <option
                                            value="{{$key}}" {{!empty($follow) && $follow->status == $key ?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                                <small id="status_alert" class="text-danger"></small>

                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Rating:</label>
                                <p>{{!empty($obj) && !empty($obj->info)?$obj->info->rating:''}}</p>
                                {{--<select class="form-control" name="rating" id="rating_follow_up">--}}
                                {{--  <option label=""></option>--}}
                                {{--  @foreach(config('myconfig.rating') as $key=>$value)--}}
                                {{--    <option value="{{$key}}" {{!empty($follow) && $follow->rating == $key ?'selected':''}}>{{$value}}</option>--}}
                                {{--  @endforeach--}}
                                {{--</select>--}}
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Contact by:</label>
                                <select class="form-control" name="contact_by" id="contact_by_follow_up" multiple>
                                    <option label=""></option>
                                    @foreach(config('myconfig.contact_by') as $key=>$value)
                                        <option
                                            value="{{$key}}" {{!empty($follow) && !empty($follow->contact_by) && is_array($follow->contact_by) && in_array($key,$follow->contact_by)?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                                <small id="contact_by_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Person in charge:</label>
                                <input class="form-control" hidden name="person_in_charge" readonly
                                       value="{{!empty($obj) ? $obj->staff_id : \Illuminate\Support\Facades\Auth::user()->id}}"
                                       id="person_in_charge_follow_up">
                                <input class="form-control" name="person_in_charge" readonly
                                       value="{{!empty($obj) ? $admins[$obj->staff_id] : $admins[\Illuminate\Support\Facades\Auth::user()->id]}}"
                                       id="person_in_charge_name_follow_up">

                                {{--<select class="form-control" name="person_in_charge" id="person_in_charge_follow_up">--}}
                                {{--                                    <option label=""></option>--}}
                                {{--                                    @foreach($admins as $keyAdmin=>$valueAdmin)--}}
                                {{--                                        <option value="{{$keyAdmin}}">{{$valueAdmin}}</option>--}}
                                {{--                                    @endforeach--}}
                                {{--                                </select>--}}
                                <small id="person_in_charge_alert" class="text-danger"></small>

                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Potential Service:</label>
                                <p>{{!empty($obj)?$obj->getPotentialService($dichvus):''}}</p>

                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Created by:</label>
                                <select class="form-control" name="create_person" id="create_person_follow_up">
                                    <option label=""></option>
                                    @foreach($admins as $keyAdmin=>$valueAdmin)
                                        <option value="{{$keyAdmin}}"
                                                @if(!empty($follow) && $follow->create_person == $keyAdmin)
                                                selected
                                                @elseif(empty($follow) && \Illuminate\Support\Facades\Auth::user()->id == $keyAdmin)
                                                selected
                                            @endif
                                        >{{$valueAdmin}}</option>
                                    @endforeach
                                </select>
                                <small id="create_person_alert" class="text-danger"></small>

                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label"
                                       style="width: 100%;float: none;color: #5e6e82;font-size: 13.33px;"> </label>
                                <label class="form-check-label custom-from-check-label">Hot Issue:</label>
                                <input class="form-check-input" style="font-size: 13px"
                                       {{(!empty($follow) && $follow->hot_issue == true)?'checked':''}} type="checkbox"
                                       id="hotissue">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Follow up status:</label>
                                <select class="form-control" name="follow_up_status" id="follow_up_status_task">
                                    <option label=""></option>
                                    @foreach($fl_up_status as $key=>$value)
                                        <option
                                            value="{{$key}}" {{!empty($follow) && $follow->follow_up_status == $key ?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                                <small id="follow_up_status_task" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">FLU description:</label>
                                <textarea name="des" id="des_follow_up" class="form-control my-editor"
                                          rows="5"> {{!empty($follow)?$follow->des:''}}</textarea>
                                <small id="des_alert" class="text-danger"></small>
                            </div>
                        </div>

                        <div class="col-md-12 content-table fill_content ">
                            <div class="task box-task">
                                <p>Task</p>
                                <button class="btn btn-primary" data-toggle="collapse" data-icon="hide-minus"
                                        href="#collapseExample" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                    <i class="fas fa-plus" style="color: #000;"></i>
                                    <i class="fas fa-minus-square" style="display: none;color: #000;"></i>
                                </button>
                            </div>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body ">
                                    <div class="row">
                                        <div class="col-md-12 content-table fill_content ">
                                            <div class="form-group">
                                                <label for="titletask" class="control-label"
                                                       style="width: 100%;float: none;color: #5e6e82;font-size: 13.33px;">Task
                                                    Title</label>
                                                <input type="text" class="form-control" id="title_task"
                                                       value="{{(!empty($follow) && $follow->title_task) ?$follow->title_task: ''}}"
                                                       name="title">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 content-table fill_content">
                                            <div class="form-group">
                                                <label class="control-label">Assignee</label>
                                                <select class="form-control" name="assigned_person"
                                                        id="assigned_person_task">
                                                    <option label=""></option>
                                                    @foreach($admins as $keyAdmin=>$valueAdmin)
                                                        <option value="{{$keyAdmin}}"
                                                                @if(!empty($follow) && $follow->assigned_person == $keyAdmin)
                                                                    selected
                                                                @endif
                                                        >{{$valueAdmin}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="assigned_person_task" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 content-table fill_content">
                                            <div class="form-group">
                                                <label class="control-label">Due date:</label>
                                                <input class="form-control" autocomplete="off"
                                                       value="{{!empty($follow)?convert_date_form_db($follow->due_date):''}}"
                                                       name="due_date" id="due_date_task" type="text" required>
                                                <small id="due_date_task" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 content-table fill_content">
                                            <div class="form-group">
                                                <label class="control-label">Time estitmate:</label>
                                                <input class="form-control" autocomplete="off"
                                                       value="{{(!empty($follow) && $follow->estimate) ?"$follow->estimate days": ''}}"
                                                       name="time_estitmate" id="time_estitmate_task" type="text"
                                                       readonly required>
                                                <small id="time_estitmate_task" class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 content-table fill_content ">
                                            <div class="form-group">
                                                <label for="task_description" class="control-label">Task
                                                    description:</label>
                                                <textarea type="text" class="form-control" id="task_description_task"
                                                          name="task_description" rows="4" cols="50"
                                                >{{(!empty($follow) && $follow->task_description) ?$follow->task_description: ''}}</textarea>
                                                <small id="task_description_task_alert" class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row"
                                         style="display: {{!empty($follow) &&  \Illuminate\Support\Facades\Auth::user()->id != $follow->create_person && \Illuminate\Support\Facades\Auth::user()->id != $follow->assigned_person ? 'none' : ''}}">
                                        <div class="col-md-12 content-table fill_content">
                                            <table style="width: 100%">

                                                <thead>
                                                <tr class="title-table">
                                                    <th>Date</th>
                                                    <th>Staff</th>
                                                    <th>Comment</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if(!empty($follow))
                                                        @foreach($follow->commentsTask()->get() as $cm)
                                                            @if(!empty($cm->comment) && $cm->comment != 'Click here')
                                                                <tr tr-id="{{$cm->id}}">
                                                                    <td>
                                                                        <p style="margin-bottom: 0">{{convert_date_form_db($cm->date)}}</p>
                                                                    </td>
                                                                    <td>
                                                                        <p style="margin-bottom: 0">{{$admins[$cm->staff_create_cm]}}</p>
                                                                    </td>
                                                                    <td class="">
                                                                        <a id="comment_update"
                                                                           style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;width: 422px;"
                                                                           data-toggle="modal" data-id="{{$cm->id}}"
                                                                           data-target="">{{$cm->comment}}</a>
                                                                    </td>
                                                                    <td style="width: 132px;">
                                                                        @if(\Illuminate\Support\Facades\Auth::user()->id == $cm->staff_create_cm)
                                                                            <button class="btn btn-success mr-1 mb-1"
                                                                                    data-id="{{$cm->id}}"
                                                                                    id="btn-edit-comment"
                                                                                    onclick="eventClickSaveCommentToDB(this)"
                                                                                    type="submit"
                                                                                    style="    margin-right: 0.85em !important;">
                                                                                Edit
                                                                            </button>
                                                                            <button class="btn btn-danger mr-1 mb-1"
                                                                                    data-id="{{$cm->id}}"
                                                                                    id="btn-delete-comment"
                                                                                    onclick="eventClickSaveCommentToDB(this)"
                                                                                    type="submit">Delete
                                                                            </button>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    <tr>
                                                        <td><p id="dateComment"
                                                               style="display: none; margin-bottom: 0">{{date('d/m/Y')}}</p>
                                                        </td>
                                                        <td>
                                                            <p id="staff"
                                                               style="display: none; margin-bottom: 0">{{(\Illuminate\Support\Facades\Auth::user()->id) ? $admins[\Illuminate\Support\Facades\Auth::user()->id] : ''}}</p>
                                                            <p id="staff_create_cm"
                                                               style="display: none; margin-bottom: 0">{{\Illuminate\Support\Facades\Auth::user()->id}}</p>
                                                            <input type="hidden" name="fl_up_id" id="fl_up_id"
                                                                   value="{{!empty($follow) ? $follow->id : ''}}">
                                                        </td>
                                                        <td class="">
                                                            <a id="modalComment"
                                                               style="display: none; white-space: nowrap;text-overflow: ellipsis;overflow: hidden;width: 422px;"
                                                               href="#" data-toggle="modal"
                                                               data-target="#modalComments">Click here</a>
                                                        </td>
                                                        <td style="width: 132px;">
                                                            <button class="btn btn-success mr-1 mb-1 "
                                                                    id="btn-add-comment"
                                                                    onclick="eventClickButtonRecordCommment(this)"
                                                                    type="submit">Add
                                                            </button>
                                                            <button class="btn btn-danger mr-1 mb-1"
                                                                    id="btn-delete-new-comment" type="submit"
                                                                    style="display: none">Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>{{--end row--}}
                </div>

            </div>
            <div class="modal-footer">
                @if(!empty($follow))
                    @can('followUp.update')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-follow-up-form" type="submit"
                                data-url="{{route('agent.process.follow.update',['agent_id'=>$obj->id, 'follow_id' =>$follow->id])}}">
                            Update
                        </button>
                    @endcan
                @else
                    @can('followUp.delete')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-follow-up-form" type="submit"
                                data-url="{{route('agent.process.follow.store', ['id'=>(!empty($obj))?$obj->id:0])}}">
                            Save
                        </button>
                    @endcan
                @endif
                <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalComments" tabindex="-1" role="dialog" aria-labelledby="modalCommentsLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea type="text" class="form-control" id="comment" name="comment" rows="4" cols="50"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="eventClickSaveCommentModal(this)"
                        id="save-comment">Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    var loadJsFormFollowUp = true

    $('a[data-id]').on('click', function () {
        $('button[id="save-comment"]').attr('id', 'save-comment-edit'); // change button save to save edit
        $('button[id="save-comment-edit"]').attr('data-id', $(this).attr('data-id')); // append data-id to button save comment edit
        changeValueTag($('#comment'), $(this).text())

    })// event click modal edit comment

    $('button[aria-expanded="false"]').on('click', function () {
        $('.fa-plus').css('display', 'none');
        $('.fa-minus-square').css('display', 'block');
    })

    $('#collapseExample').on('hidden.bs.collapse', function () {
        $('.fa-plus').css('display', 'block');
        $('.fa-minus-square').css('display', 'none');
    }) // close modal

    $('#btn-delete-new-comment').on('click', function () {
        $('#dateComment, #staff, #modalComment').css('display', 'none');
        changeValueTag($('#modalComment'), 'Click here');
        changeValueTag($('#btn-save-comment'), 'Add');

        $('#btn-save-comment').removeAttr('disabled');
        $('#btn-save-comment').attr('id', 'btn-add-comment');

        $('#btn-delete-new-comment').css('display', 'none');
    }) // event click delete new comment

    $('#due_date_task').on('change', function () {
        var due_date = $(this).val();
        var pro_date = $('#process_date_follow_up').val()
        if (due_date != null) {
            due_date = changePositionDateValue(due_date);
            pro_date = changePositionDateValue(pro_date);

            var end_date = new Date(due_date);
            var start_date = new Date(pro_date);

            var time = end_date.getTime() - start_date.getTime();
            var days = time / (1000 * 3600 * 24);

            $('#time_estitmate_task').val(days);
        }
    })

    function eventClickButtonRecordCommment(elm) {
        if (elm.getAttribute('id') === 'btn-add-comment') {
            $('#dateComment, #staff, #modalComment').css('display', 'block');
            changeValueTag(elm, 'Save', 'DOM');
            elm.setAttribute('id', 'btn-save-comment');
            $('#btn-delete-new-comment').css('display', 'inline-block');
        } else if (elm.getAttribute('id') === 'btn-save-comment') {
            elm.setAttribute('disabled', 'disabled');
        }

    }

    function eventClickSaveCommentToDB(elm) {
        var id = elm.getAttribute('data-id');
        var comment = $('a[data-id="' + id + '"]').text();

        if (elm.getAttribute('id') === 'btn-edit-comment') {
            $('a[data-id="' + id + '"]').attr('href', '#');
            $('a[data-id="' + id + '"]').attr('data-target', '#modalComments');
            elm.setAttribute('id', 'btn-save-comment');
            changeValueTag(elm, 'Save', 'DOM');
        } else if (elm.getAttribute('id') === 'btn-save-comment') {
            $.ajax({
                url: "{{route('updateCommentTasks')}}",
                type: 'post',
                data: {
                    comment,
                    id,
                    _token: "{{csrf_token()}}",
                },
                success: function () {
                    toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                },
                complete: function () {
                    changeValueTag(elm, 'Edit', 'DOM');
                    $('a[data-id="' + id + '"]').removeAttr('href');
                    $('a[data-id="' + id + '"]').removeAttr('data-target');
                },
            })
        } else if (elm.getAttribute('id') === 'btn-delete-comment') {
            $.ajax({
                url: "{{route('deleteCommentTasks')}}",
                type: 'post',
                data: {
                    id,
                    _token: "{{csrf_token()}}",
                },
                success: function () {
                    toastr.success('Cập nhật dữ liệu thành công', 'Success', {timeOut: 5000});
                },
                complete: function () {
                    $('tr[tr-id="' + id + '"]').css('display', 'none');
                },
            })
        }
    }

    function eventClickSaveCommentModal(elm) {
        if (elm.getAttribute('id') === 'save-comment') {
            hideModal();
            $('#modalComment').text($('#comment').val());
            deleteContentFromModalToComment()
        } else if (elm.getAttribute('id') === 'save-comment-edit') {
            hideModal();
            $('a[data-id="' + elm.getAttribute('data-id') + '"]').text($('#comment').val());
            $('button[id="save-comment-edit"]').attr('id', 'save-comment');
            deleteContentFromModalToComment();
        }
    }

    function hideModal() {
        $('#modalComments').modal('hide');
    }

    function deleteContentFromModalToComment() {
        $('#comment').val('');
    }

    function changeValueTag(elm, value, dom = null) {
        if (dom) {
            return elm.innerText = value;
        }
        elm.text(value);
    }


    function changePositionDateValue(date) {
        var value = date.split('/');
        var result = value[1] + '/' + value[0] + '/' + value[2];
        return result;
    }

    function hoverToLoadSelectFollowUp() {
        if (loadJsFormFollowUp) {
            $('#agent_follow_up').select2({
                dropdownParent: $('.agent_follow_up_select2'),
                ajax: {
                    url: '{{route('agent.getAgentSelect')}}',
                    type: 'GET',
                    quietMillis: 10000,
                    dataType: 'json',
                    data: function (term) {
                        var query = {
                            name: term.term,
                        }
                        return query
                    },
                    processResults: function (data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'

                        var results = []
                        data.forEach(e => {
                            results.push({
                                id: e.id,
                                text: e.name,
                            })
                        })
                        return {
                            results: results,
                        }
                    },
                },
            })
            @if(!empty($obj))
            var option = new Option('{{$obj->name}}', '{{$obj->id}}', true, true)
            $('#agent_follow_up').append(option).trigger('change')
            @endif
            $('#contact_by_follow_up').select2({
                closeOnSelect: false,
            })
            loadJsFormFollowUp = false
        }
    }

</script>
`
