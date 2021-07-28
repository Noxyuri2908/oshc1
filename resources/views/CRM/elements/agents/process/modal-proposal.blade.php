<div class="modal fade user-information" id="modal_proposal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($proposal)?'Update':'Add new'}} proposal</h5>
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
                                <input class="form-control" autocomplete="off" value="{{!empty($proposal)?convert_date_form_db($proposal->processing_date):''}}" name="processing_date" id="processing_date_proposal" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Issue:</label>
                                <select class="form-control" name="issue" id="issue_proposal">
                                    <option label=""></option>
                                    @foreach(config('myconfig.issue_proposal_agent') as $key=>$value)
                                        <option value="{{$key}}" {{!empty($proposal) && $proposal->issue == $key ?'selected':''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                @if(empty($obj))
                                    <label class="control-label">Agent:</label>
                                    <select class="form-control" name="status" id="agent_follow_up">
                                        <option label=""></option>
                                        @foreach($agents as $key=>$value)
                                            <option value="{{$key}}" {{!empty($proposal) && $proposal->user_id == $key ?'selected':''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <label class="control-label">Agent:</label>
                                    <input class="form-control" id="agent_follow_up" hidden type="text" value="{{(!empty($obj)) ? $obj->id : ''}}">
                                    <input class="form-control" id="agent_follow_up_name" type="text" readonly value="{{(!empty($obj)) ? $obj->name : ''}}">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Person in charge:</label>
                            @if(empty($obj))
                                <select class="form-control" name="person_in_charge" id="person_in_charge_proposal">
                                    <option label=""></option>
                                    <option label=""></option>
                                    @foreach($admins as $keyAdmin=>$valueAdmin)
                                        <option value="{{$keyAdmin}}"
                                                @if(!empty($proposal) && $proposal->person_in_charge == $keyAdmin)
                                                selected
                                                @elseif(empty($proposal) && \Illuminate\Support\Facades\Auth::user()->id == $keyAdmin)
                                                selected
                                            @endif
                                        >{{$valueAdmin}}</option>
                                    @endforeach
                                </select>
                            @else
                                <input class="form-control" hidden value="{{(!empty($obj)) ? $obj->staff_id : ''}}" name="person_in_charge" id="person_in_charge_proposal">
                                <input class="form-control" readonly value="{{(!empty($admins) && !empty($obj)) ? $admins[$obj->staff_id] : ''}}" name="person_in_charge_name" id="person_in_charge_proposal_name">
                            @endif
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Created by:</label>
                                <select class="form-control" name="create_person" id="create_person_proposal">
                                    <option label=""></option>
                                    @foreach($admins as $keyAdmin=>$valueAdmin)
                                        <option value="{{$keyAdmin}}"
                                                @if(!empty($proposal) && $proposal->create_person == $keyAdmin)
                                                selected
                                                @elseif(empty($proposal) && \Illuminate\Support\Facades\Auth::user()->id == $keyAdmin)
                                                selected
                                            @endif
                                        >{{$valueAdmin}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Proposal:</label>
                                <textarea name="des" id="des_proposal" class="form-control my-editor" rows="5"> {{!empty($proposal)?$proposal->proposal:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(!empty($proposal))
                    @can('proposal.update')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-proposal-form" type="submit" data-url="{{!empty($proposal)?route('agent.process.proposal.update', ['agent_id'=>$obj->id, 'proposal_id' =>$proposal->id]):route('agent.process.proposal.store', ['id'=>(!empty($obj))?$obj->id:0])}}">{{!empty($proposal)?'Update':'Save'}}</button>
                    @endcan
                @else
                    @can('proposal.store')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-proposal-form" type="submit" data-url="{{!empty($proposal)?route('agent.process.proposal.update', ['agent_id'=>$obj->id, 'proposal_id' =>$proposal->id]):route('agent.process.proposal.store', ['id'=>(!empty($obj))?$obj->id:0])}}">{{!empty($proposal)?'Update':'Save'}}</button>
                    @endcan
                @endif
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
