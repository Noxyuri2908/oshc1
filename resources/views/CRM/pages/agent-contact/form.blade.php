<div class="modal fade user-information" id="modal_agent_contact_list" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($agentContactData)?'Update':'Add new'}}
                    contact
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information" onmouseover="hoverToLoadSelectAgentContact()">
                    <div class="row">
                        @if(!empty($agent_id))
                            <input type="hidden" id="user_id" value="{{$agent_id}}">
                        @else
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group user_id_select2">
                                    <label class="control-label">Agent :</label>
                                    <select name="" class="form-control" id="user_id">
                                    </select>
                                    <small id="user_id_div_alert" class="form-text text-danger"></small>
                                </div>
                            </div>

                        @endif
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Name :</label>
                                <input type="text" id="name" class="form-control"
                                       value="{{!empty($agentContactData)?$agentContactData->name:''}}">
                                <small id="name_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Position :</label>
                                <input type="text" id="position" class="form-control"
                                       value="{{!empty($agentContactData)?$agentContactData->position:''}}">
                                <small id="position_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Phone :</label>
                                <input type="text" id="phone" class="form-control"
                                       value="{{!empty($agentContactData)?$agentContactData->phone:''}}">
                                <small id="phone_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Birthday :</label>
                                <input type="text" id="birthday" class="form-control"
                                       value="{{!empty($agentContactData)?$agentContactData->birthday:''}}">
                                <small id="birthday_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Email :</label>
                                <input type="text" id="email" class="form-control"
                                       value="{{!empty($agentContactData)?$agentContactData->email:''}}">
                                <small id="email_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Skype :</label>
                                <input type="text" id="skype" class="form-control"
                                       value="{{!empty($agentContactData)?$agentContactData->skype:''}}">
                                <small id="skype_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Facebook :</label>
                                <input type="text" id="facebook" class="form-control"
                                       value="{{!empty($agentContactData)?$agentContactData->facebook:''}}">
                                <small id="facebook_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-8 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note :</label>
                                <textarea name="" class="form-control" id="note" cols="30"
                                          rows="10">{{!empty($agentContactData)?$agentContactData->note:''}}</textarea>
                                <small id="note_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_receive_comm" {{!empty($agentContactData) && $agentContactData->is_receive_comm == 'on'?'checked':''}}>
                                <label class="form-check-label" for="is_receive_comm">Receive Commission</label>
                            </div>
                        </div>
                        <div style="{{!empty($agentContactData) && $agentContactData->is_receive_comm == 'on'?'display:block;':'display:none;'}}" class="col-lg-12 info_bank">
                            <div class="row">
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Acc Name :</label>
                                        <input type="text" id="acc_name" class="form-control"
                                               value="{{!empty($agentContactData)?$agentContactData->acc_name:''}}">
                                        <small id="acc_name_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Bank :</label>
                                        <input type="text" id="bank" class="form-control"
                                               value="{{!empty($agentContactData)?$agentContactData->bank:''}}">
                                        <small id="bank_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Bank account :</label>
                                        <input type="text" id="receiver_address" class="form-control"
                                               value="{{!empty($agentContactData)?$agentContactData->receiver_address:''}}">
                                        <small id="receiver_address_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Currency :</label>
                                        <select name="" id="currency" class="form-control">
                                            @foreach($currency as $keyCurrency=>$one)
                                                <option value="{{$one}}" {{!empty($agentContactData) && $agentContactData->currency == $one?'selected':''}}>{{$one}}</option>
                                            @endforeach
                                        </select>
                                        <small id="currency_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Bank address :</label>
                                        <input type="text" id="bank_address" class="form-control"
                                               value="{{!empty($agentContactData)?$agentContactData->bank_address:''}}">
                                        <small id="bank_address_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>

                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Swift code :</label>
                                        <input type="text" id="swift_code" class="form-control"
                                               value="{{!empty($agentContactData)?$agentContactData->swift_code:''}}">
                                        <small id="swift_code_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_agent_contact_form" type="submit"
                        is-click="false"
                        data-url="{{!empty($agentContactData)?route('agent.contact.update',['id'=>$agentContactData->id]):route('agent.contact.store')}}">{{!empty($agentContactData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@include('CRM.partials.script-call-agent',[
    'nameFunction'=>'hoverToLoadSelectAgentContact',
    'elementIdSelect2'=>'user_id',
    'elementParentIdSelect2'=>'user_id_select2',
    'data'=>(!empty($agentContactData))?$agentContactData:null,
    'dataName'=>(!empty($agentContactData) && !empty($agentContactData->agent))?$agentContactData->agent->name:'',
    'dataId'=>(!empty($agentContactData) && !empty($agentContactData->agent))?$agentContactData->user_id:''
])
