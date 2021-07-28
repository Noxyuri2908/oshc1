<div class="modal fade user-information" id="modal_create_contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail of Contact Person</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <h3 class="name">
                        {{!empty($data)?'Update':'Create'}} contact
                    </h3>
                    <input type="hidden" id="contact_id" value="{{(!empty($data) && !empty($data['id']) )?$data['id']:''}}">
                    <div class="row">
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Name:</label>
                                <input type="text" class="form-control" id="new_name" value="{{(!empty($data) && !empty($data['name']))?$data['name']:''}}">
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Position:</label>
                                <input type="text" class="form-control" id="new_position" value="{{(!empty($data) && !empty($data['position']))?$data['position']:''}}">
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Phone:</label>
                                <input type="text" class="form-control" id="new_phone" value="{{(!empty($data) && !empty($data['phone']))?$data['phone']:''}}">
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Birthday:</label>
                                <input onmouseover="onLoadChooseDate()" autocomplete="off" type="text" class="form-control" id="new_birthday" value="{{(!empty($data) && !empty($data['birthday']))?$data['birthday']:''}}" placeholder="dd-mm-yyyy">
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Email:</label>
                                <input type="email" class="form-control" id="new_email" value="{{(!empty($data) && !empty($data['email']))?$data['email']:''}}">
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Skype:</label>
                                <input type="text" class="form-control" id="new_skype" value="{{(!empty($data) && !empty($data['skype']))?$data['skype']:''}}">
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Facebook:</label>
                                <input type="text" class="form-control" id="new_facebook" value="{{(!empty($data) && !empty($data['facebook']))?$data['facebook']:''}}">
                            </div>
                        </div>
                        <div class="col-md-6 content-table">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea type="text" class="form-control" id="new_note">{{(!empty($data) && !empty($data['note']))?$data['note']:''}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_receive_comm" {{!empty($data) && (!empty($data['is_receive_comm'])) && $data['is_receive_comm'] == 'on'?'checked':''}}>
                                <label class="form-check-label" for="is_receive_comm">Receive Commission</label>
                            </div>
                        </div>
                        <div style="{{!empty($data) && (!empty($data['is_receive_comm'])) && $data['is_receive_comm'] == 'on'?'display:block;':'display:none;'}}" class="col-lg-12 info_bank">
                            <div class="row">
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Acc Name :</label>
                                        <input type="text" id="acc_name" class="form-control"
                                               value="{{!empty($data) && !empty($data['acc_name'])?$data['acc_name']:''}}">
                                        <small id="acc_name_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Bank :</label>
                                        <input type="text" id="bank" class="form-control"
                                               value="{{!empty($data) && !empty($data['bank'])?$data['bank']:''}}">
                                        <small id="bank_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Bank account :</label>
                                        <input type="text" id="receiver_address" class="form-control"
                                               value="{{!empty($data) && !empty($data['receiver_address'])?$data['receiver_address']:''}}">
                                        <small id="receiver_address_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Currency :</label>
                                        <select name="" id="currency" class="form-control">
                                            @if(!empty($currency))
                                                @foreach($currency as $keyCurrency=>$one)
                                                    <option value="{{$one}}" {{!empty($data) && !empty($data['currency']) && $data['currency'] == $one?'selected':''}}>{{$one}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small id="currency_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Bank address :</label>
                                        <input type="text" id="bank_address" class="form-control"
                                               value="{{!empty($data) && !empty($data['bank_address'])?$data['bank_address']:''}}">
                                        <small id="bank_address_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>

                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Swift code :</label>
                                        <input type="text" id="swift_code" class="form-control"
                                               value="{{!empty($data) && !empty($data['swift_code'])?$data['swift_code']:''}}">
                                        <small id="swift_code_div_alert" class="form-text text-danger"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(empty($is_show))
                    <button class="btn btn-success btn-sm btn-submit-contact" type="button" data-id="{{!empty($data) && !empty($data['id'])?$data['id']:''}}" data-url="{{!empty($data)?route('agent.updateContactAgent',['id'=>$data['id']]):route('agent.storeContactAgent',['id'=>(!empty($id))?$id:''])}}">{{!empty($data)?'Update':'Create'}}</button>
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
                @endif
            </div>
        </div>
    </div>
    <script>
        function onLoadChooseDate() {
            let date_class = $('#new_birthday').hasClass('flatpickr-input')
            if (!date_class) {
                $('#new_birthday').flatpickr({
                    dateFormat: 'd/m/Y',
                    allowInput: true,
                })
            }
        }
    </script>
