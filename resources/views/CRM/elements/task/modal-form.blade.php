<div class="modal fade user-information" id="modal_task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="max-width: 1000px" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new task</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="{{route('task.post')}}" method="POST" id="form_task">
        @csrf
        <input type="hidden" name="task_id" id="task_id" value="0">
        <input type="hidden" name="page_id" id="page_id" value="0">
        <input type="hidden" name="action_type" id="action_type" value="0">
        <div class="modal-body">
          <div class="content-information">
            <div class="row">
              <div class="col-md-9 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Task</label>
                  <input type="text" name="task" id="task_name"  class="form-control" placeholder="Task" required>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Service</label>
                  <select class="form-control" name="service" id="service">
                    <option label=""></option>
                    @foreach(config('myconfig.type_system') as $key=>$value)
                    <option data-value="{{implode(";", $value)}}" value="{{$key}}">{{$key}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Leader</label>
                  <select class="form-control" name="leader" id="leader">
                    <option label=""></option>
                    @foreach($admins as $admin)
                    <option value="{{$admin->id}}">{{$admin->username}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Process by</label>
                  <select class="form-control" name="process_by" id="process_by" required>
                    <option label=""></option>
                    @foreach($admins as $admin)
                    <option value="{{$admin->id}}">{{$admin->username}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Person in charge</label>
                  <select class="form-control selectpicker" id="person_in_charge" multiple size="1" name="person_in_charge[]" data-options='{"placeholder":"Select Organizer..."}'>
                    <option label=""></option>
                    @foreach($admins as $admin)
                    <option value="{{$admin->id}}">{{$admin->username}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Type</label>
                  <select class="form-control" name="type_service" id="type_service">
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">From</label>
                  <input class="form-control datetimepicker" id="from_date" name="from_date" type="text" data-options='{"enableTime":true,"dateFormat":"d/m/y H:i"}' required>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">To</label>
                  <input class="form-control datetimepicker" id="to_date"  name="to_date" type="text" data-options='{"enableTime":true,"dateFormat":"d/m/y H:i"}' required>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Processing</label>
                  <input class="form-control" name="processing" id="processing" type="text">
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Type of task</label>
                  <select class="form-control" name="task_type" id="task_type" required>
                    <option label=""></option>
                    @foreach(config('myconfig.type_task') as $key=>$value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Level</label>
                  <select class="form-control" name="level" id="level" required>
                    <option label=""></option>
                    @foreach(config('myconfig.lv') as $key=>$value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Status</label>
                  <select class="form-control" name="status" id="status" required>
                    <option label=""></option>
                    @foreach(config('myconfig.status_task') as $key=>$value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Agent</label>
                  <select class="form-control" name="agent_id" id="agent_id" {{isset($agent_task) ? 'readonly' : ''}}>
{{--                  @if(!isset($agent_task))--}}
{{--                  <option label=""></option>--}}
{{--                  @foreach($agents as $_agent)--}}
{{--                  <option value="{{$_agent->id}}">{{$_agent->name}}</option>--}}
{{--                  @endforeach--}}
{{--                  @else--}}
{{--                  <option value="{{$agent_task->id}}">{{$agent_task->name}}</option>--}}
{{--                  @endif--}}
                  </select>
                </div>
              </div>
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Customer</label>
                  <select class="form-control" name="apply_id" id="apply_id" {{isset($apply) ? 'readonly' : ''}}>
                  @if(!isset($apply))
                  <option label=""></option>
                  @foreach($applies as $_apply)
                  <option value="{{$_apply->id}}">{{$_apply->registerCus() != null  ? $_apply->registerCus()->first_name.' '.$_apply->registerCus()->last_name : $_apply->ref_no}}</option>
                  @endforeach
                  @else
                  <option value="{{$apply->id}}">{{$apply->registerCus() != null ? $apply->registerCus()->first_name.' '.$apply->registerCus()->last_name : $apply->ref_no}}</option>
                  @endif
                  </select>
                </div>
              </div>
              <div class="col-md-12 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Content</label>
                  <textarea rows="10" class="form-control" name="content" id="content"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success mr-1 mb-1 bt-submit-task" type="submit">Submit</button>
          <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
          <button class="btn btn-warning mr-1 mb-1 btn-delete-task" data-id="0" type="button">Delete</button>
          <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
