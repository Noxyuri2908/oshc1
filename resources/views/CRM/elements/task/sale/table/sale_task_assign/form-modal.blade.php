<div class="modal fade user-information" id="modal_{{$typeTask}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #fff">{{!empty($saleTaskAssign)?'Update':'Add new'}} {{$typeTask}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Processing date:</label>
                                <input class="form-control" autocomplete="off" value="{{!empty($saleTaskAssign)?convert_date_form_db($saleTaskAssign->processing_date):''}}" name="processing_date" id="processing_date_{{$typeTask}}" type="text" required>
                            </div>
                        </div>
                        @if(!empty($agent_id))
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Type:</label>
                                    <select class="form-control" name="type" id="type_{{$typeTask}}">
                                        @if(!empty($saleTaskAssignType))
                                            @foreach($saleTaskAssignType as $key=>$value)
                                                <option data-status="{{$value->is_success}}" value="{{$value->id}}" {{!empty($value->is_success) ?'selected':'disabled'}}>{{$value->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content d-block" id="agent_selected_by_type_{{$typeTask}}">
                                <div class="form-group">
                                    <label class="control-label">Agent:</label>
                                    <input class="form-control" name="user_id" hidden value="{{$agent_id}}" id="user_id_{{$typeTask}}">
                                    <input class="form-control" name="user_id_name" value="{{$agents[$agent_id]}}" readonly id="user_id_name">
                                    <small id="user_id_{{$typeTask}}_alert_message" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Person in charge:</label>
                                    <input class="form-control" hidden name="person_in_charge" readonly value="{{!empty($obj) ? $obj->staff_id : \Illuminate\Support\Facades\Auth::user()->id}}" id="person_in_charge">
                                    <input class="form-control" name="person_in_charge" readonly value="{{!empty($obj) && !empty($obj->staff_id) ? $admins[$obj->staff_id] : $admins[\Illuminate\Support\Facades\Auth::user()->id]}}" id="person_in_charge_name">
                                    <small id="person_in_charge_alert" class="text-danger"></small>

                                </div>
                            </div>
                        @elseif(!empty($data_type))
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Type:</label>
                                    <select class="form-control" name="type" id="type_{{$typeTask}}">
                                        @if(!empty($saleTaskAssignType))
                                            @foreach($saleTaskAssignType as $key=>$value)
                                                <option data-status="{{$value->is_success}}" value="{{$value->id}}" {{!empty($value->is_success) ?'selected':'disabled'}}>{{$value->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content d-block" id="agent_selected_by_type_{{$typeTask}}">
                                <div class="form-group">
                                    <label class="control-label">Agent:</label>
                                    <select class="form-control" name="user_id" id="user_id_{{$typeTask}}">
                                        <option label=""></option>
                                        @if(!empty($agents))
                                            @foreach($agents as $keyAgent=>$valueAgent)
                                                <option value="{{$keyAgent}}">{{$valueAgent}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="user_id_{{$typeTask}}_alert_message" class="text-danger"></small>
                                </div>
                            </div>
                        @else
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Type:</label>
                                    <select class="form-control" name="type" id="type_{{$typeTask}}">
                                        <option label=""></option>
                                        @if(!empty($saleTaskAssignType))
                                            @foreach($saleTaskAssignType as $key=>$value)
                                                <option data-status="{{$value->is_success}}" value="{{$value->id}}" {{!empty($saleTaskAssign) && $saleTaskAssign->type == $value->id ?'selected':''}}>{{$value->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content id="agent_selected_by_type_{{$typeTask}}">
                                <div class="form-group">
                                    <label class="control-label">Agent:</label>
                                    <div class="form-group agent_default_select2">
                                        <select name="user_id" id="agent_task_assign_company user_id_{{$typeTask}}" class="form-control agent_task_assign_company">

                                        </select>
                                    </div>
                                    <small id="user_id_{{$typeTask}}_alert_message" class="text-danger"></small>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Created by:</label>
                                <select class="form-control" name="result" id="asigned_{{$typeTask}}">
                                    <option label=""></option>
                                    @if(!empty($admins))
                                        @foreach($admins as $key=>$value)
                                            <option value="{{$key}}"
                                                    @if(!empty($saleTaskAssign) && $saleTaskAssign->assigned_by == $key)
                                                    selected
                                                    @elseif(empty($saleTaskAssign) && \Illuminate\Support\Facades\Auth::user()->id == $key)
                                                    selected
                                                @endif
                                            >{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label" style="width: 100%;float: none;color: #5e6e82;font-size: 13.33px;">   </label>
                                <label class="form-check-label custom-from-check-label">Hot Issue:</label>
                                <input class="form-check-input" style="font-size: 13px" {{(!empty($saleTaskAssign) && $saleTaskAssign->hot_issue == true)?'checked':''}} type="checkbox" id="hotissue">
                            </div>
                        </div>
                        <div class="col-md-12 content-table fill_content ">
                            <div class="task box-task">
                                <p>Task</p>
                            </div>
                            <div class="card-task" id="card-task-mkt-support">
                                <div class="card card-body ">
                                    <div class="row">
                                        <div class="col-md-12 content-table fill_content ">
                                            <div class="form-group">
                                                <label for="titletask" class="control-label" style="width: 100%;float: none;color: #5e6e82;font-size: 13.33px;">Title task</label>
                                                <textarea name="des" id="des_item_{{$typeTask}}" maxlength="200" class="form-control my-editor" rows="5"> {{!empty($saleTaskAssign)?$saleTaskAssign->item:''}}</textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4 content-table fill_content">
                                            <div class="form-group">
                                                <label class="control-label">Assignee:</label>
                                                <select class="form-control" name="assigned_person" id="assigned_person_task">
                                                    <option label=""></option>
                                                    @foreach($admins as $keyAdmin=>$valueAdmin)
                                                        <option value="{{$keyAdmin}}"
                                                                @if(!empty($saleTaskAssign) && $saleTaskAssign->assigned_person == $keyAdmin)
                                                                    selected
                                                                @endif>
                                                            {{$valueAdmin}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="assigned_person_task" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 content-table fill_content">
                                            <div class="form-group">
                                                <label class="control-label">Follow up status:</label>
                                                <select class="form-control" name="follow_up_status" id="follow_up_status_task">
                                                    <option label=""></option>
                                                    @foreach($fl_up_status as $key=>$value)
                                                        <option value="{{$key}}" {{!empty($saleTaskAssign) && $saleTaskAssign->follow_up_status == $key ?'selected':''}}>{{$value}}</option>
                                                    @endforeach
                                                </select>
                                                <small id="follow_up_status_task" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 content-table fill_content">
                                            <div class="form-group">
                                                <label class="control-label">Due date:</label>
                                                <input class="form-control" value="{{!empty($saleTaskAssign)?convert_date_form_db($saleTaskAssign->deadline):''}}" name="deadline" id="deadline_{{$typeTask}}" type="text" required>
                                                <small id="deadline_{{$typeTask}}" class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 content-table fill_content">
                                            <div class="form-group">
                                                <label class="control-label">Time estimate:</label>
                                                <input class="form-control" hidden  value="{{(!empty($saleTaskAssign) && $saleTaskAssign->estimate) ? $saleTaskAssign->estimate: ''}}" name="time_estitmate" id="time_estitmate_task" type="text" readonly required>
                                                <input class="form-control" value="{{(!empty($saleTaskAssign) && $saleTaskAssign->estimate) ?"$saleTaskAssign->estimate days": ''}}" name="time_estitmate_show" id="time_estitmate_task_show" type="text" readonly required>
                                                <small id="time_estitmate_task" class="text-danger"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 content-table fill_content ">
                                            <div class="form-group">
                                                <label for="task_description" class="control-label">Task description:</label>
                                                <textarea name="des" id="des_note_{{$typeTask}}" class="form-control my-editor" rows="5"> {{!empty($saleTaskAssign)?$saleTaskAssign->note:''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 content-table fill_content">
                                            <table style="width: 100%">
                                                <tr class="title-table">
                                                    <th>Date</th>
                                                    <th>Staff</th>
                                                    <th>Comment</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <td ><p id="date" style="display: none">{{date('d/m/Y')}}</p></td>
                                                    <td ><p id="staff" style="display: none">{{(\Illuminate\Support\Facades\Auth::user()->id) ? $admins[\Illuminate\Support\Facades\Auth::user()->id] : ''}}</p></td>
                                                    <td ><a id="modalComment" style="display: none" href="#" data-toggle="modal" data-target="#modalComments">click here</a></td>
                                                    <td>
                                                        <button class="btn btn-success mr-1 mb-1 " id="btn-add-comment" type="submit" >Add</button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(!empty($saleTaskAssign))
                    @can('tasksAsigned.update')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-{{$typeTask}}-form" type="submit" is-click="false" data-id="{{!empty($saleTaskAssign)?$saleTaskAssign->id:''}}" data-url="{{!empty($saleTaskAssign)?route('tasks.updateSaleTaskAssign',['id'=>$saleTaskAssign->id]):route('tasks.storeSaleTaskAssign')}}">{{!empty($saleTaskAssign)?'Update':'Save'}}</button>
                    @endcan
                @else
                    @can('tasksAsigned.store')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-{{$typeTask}}-form" type="submit" is-click="false" data-id="{{!empty($saleTaskAssign)?$saleTaskAssign->id:''}}" data-url="{{!empty($saleTaskAssign)?route('tasks.updateSaleTaskAssign',['id'=>$saleTaskAssign->id]):route('tasks.storeSaleTaskAssign')}}">{{!empty($saleTaskAssign)?'Update':'Save'}}</button>
                    @endcan
                @endif
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalComments" tabindex="-1" role="dialog" aria-labelledby="modalCommentsLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.agent_task_assign_company').select2({
        dropdownParent: $('.agent_default_select2'),
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

    $('#deadline_task_asigned_by_company').on('change',function (){
        var due_date = $(this).val();
        var pro_date = $('#processing_date_task_asigned_by_company').val()
        if (due_date != null)
        {
            due_date = changePositionDateValue(due_date);
            pro_date = changePositionDateValue(pro_date);

            var end_date = new Date(due_date);
            var start_date = new Date(pro_date);

            var time = end_date.getTime() - start_date.getTime();
            var days = time / (1000 * 3600 * 24);

            $('#time_estitmate_task_show').val(days + ' days');
            $('#time_estitmate_task').val(days);
        }
    }) // get estimate day

    $('#btn-add-comment').on('click', function (){
        $('#date, #staff, #modalComment').css('display', 'block');
        $(this).text('save');
    })

    function changePositionDateValue(date)
    {
        var value = date.split('/');
        var result = value[1]+'/'+value[0]+'/'+value[2];
        return result;
    }
</script>

