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
                  <label class="control-label">Leader</label>
                  <select class="form-control" name="leader" id="leader" required>
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
                  <label class="control-label">Status</label>
                  <select class="form-control" name="status" id="status" required>
                    <option label=""></option>
                    @foreach(config('myconfig.status_task') as $key=>$value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-9 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Content</label>
                  <textarea rows="10" class="form-control" name="content" id="content"></textarea>
                </div>
              </div>
              @if(isset($form_task) && $form_task == 1)
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Agent</label>
                  <input class="form-control" name="agent_name" type="text" value="{{$obj->name}}">
                  <input type="hidden" name="agent_id" value="{{$obj->id}}">
                </div>
              </div>
              @elseif(isset($form_task) && $form_task == 2)
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Customer</label>
                  <input class="form-control" name="customer_name" type="text" value="{{$obj->registerCus() != null ? $obj->registerCus()->first_name.' '.$obj->registerCus()->last_name : ''}}">
                  <input type="hidden" name="apply_id" value="{{$obj->id}}">
                </div>
              </div>
              @else
              <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Agent</label>
                  <select class="form-control" name="agent_id">
                  <option label=""></option>
                  @foreach($agents as $agent)
                  <option value="{{$agent->id}}">{{$agent->name}}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-9 content-table fill_content">
                <div class="form-group">
                </div>
              </div>
               <div class="col-md-3 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Apply</label>
                  <select class="form-control" name="apply_id">
                  <option label=""></option>
                  @foreach($applies as $apply)
                  <option value="{{$apply->id}}">{{$apply->ref_no}}</option>
                  @endforeach
                  </select>
                </div>
              </div>
              @endif
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