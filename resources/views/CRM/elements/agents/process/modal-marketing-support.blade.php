
<div class="modal fade user-information" id="modal_marketing_support" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{!empty($marketingSupport)?'Update':'Add new'}} marketing support</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="content-information">
            <div class="row">
                @if(empty($obj))
                <div class="col-md-4 content-table fill_content">
                    <div class="form-group">
                        <label class="control-label">Agent:</label>
                        <select class="form-control" name="status" id="agent_follow_up">
                            <option label=""></option>
                            @foreach($agents as $key=>$value)
                                <option value="{{$key}}" {{!empty($follow) && $follow->user_id == $key ?'selected':''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
              <div class="col-md-4 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Processing date:</label>
                  <input class="form-control" autocomplete="off" value="{{!empty($marketingSupport)?convert_date_form_db($marketingSupport->processing_date):''}}" name="processing_date" id="processing_date_marketing_support" type="text" required>
                </div>
              </div>
              <div class="col-md-4 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Issue:</label>
                  <select class="form-control" name="issue" id="issue_marketing_support">
                    <option label=""></option>
                    @foreach($services as $key=>$value)
                      <option value="{{$key}}" {{!empty($marketingSupport) && $marketingSupport->issue == $key ?'selected':''}}>{{$value}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Person in charge:</label>
                  <select class="form-control" name="person_in_charge" id="person_in_charge_marketing_support">
                    <option label=""></option>
                    @foreach($admins as $admin)
                      <option value="{{$admin->id}}"
                              @if(!empty($marketingSupport) && $marketingSupport->person_in_charge == $admin->id)
                              selected
                              @elseif(empty($marketingSupport) && \Illuminate\Support\Facades\Auth::user()->id == $admin->id)
                              selected
                          @endif
                      >{{$admin->username}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-md-12 content-table fill_content">
                <div class="form-group">
                  <label class="control-label">Marketing Support:</label>
                  <textarea name="des" id="des_marketing_support" class="form-control my-editor" rows="5"> {{!empty($marketingSupport)?$marketingSupport->marketing_support:''}}</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success mr-1 mb-1 btn-submit-marketing-support-form" type="submit" data-url="{{!empty($marketingSupport)?route('agent.process.marketing.support.update', ['agent_id'=>$obj->id, 'marketing_support_id' =>$marketingSupport->id]):route('agent.process.marketing.support.store', ['id'=>(!empty($obj))?$obj->id:0])}}">{{!empty($marketingSupport)?'Update':'Add'}}</button>
          <button class="btn btn-info mr-1 mb-1" type="reset">Reset</button>
          <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
