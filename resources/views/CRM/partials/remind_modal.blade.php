
<div class="modal fade" id="modalRemindStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Remind Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group row w-100">
                <label class="col-sm-2 ">Remind status</label>
                <select id='remind_status_id' class="form-control col-sm-10 ">\
                    <option value=""> Select </option>
                    @foreach(\Config::get('crm.remind_status') as $key=>$one)
                        <option value="{{$key}}" {{!empty($obj) && $obj->remind_status == $key ?'selected':'' }}>{{$one['name']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group row w-100">
                <label class="col-sm-2 ">Processing Date</label>
                <input id='remind_processing_date'  class="form-control col-sm-10 choose-date-form" value="{{!empty($obj) && !empty($obj->processing_date_remind) ? convert_date_form_db($obj->processing_date_remind):'' }}">
            </div>
            <div class="form-group row w-100">
                <label class="col-sm-2 ">Note</label>
                <textarea id='remind_status_note'  class="form-control col-sm-10 "rows="3">{{!empty($obj) ?$obj->remind_note:''}}</textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary save-remind-form">Save changes</button>
        </div>
      </div>
    </div>
  </div>
