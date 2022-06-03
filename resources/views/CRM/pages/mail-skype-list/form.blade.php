<div class="modal fade user-information" id="modal_mail_skype_list" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($mailSkypeData)?'Update':'Add new'}}
                    domain & hosting
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Domain:</label>
                                <select class="form-control" name="domain_id" id="domain_id">
                                    <option label=""></option>
                                    @if(!empty($domains))
                                        @foreach($domains as $keyDomain=>$valueDomain)
                                            <option
                                                value="{{$valueDomain->id}}" {{!empty($mailSkypeData) && $mailSkypeData->domain_id == $valueDomain->id ?'selected':''}}>{{$valueDomain->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="domain_id_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Email:</label>
                                <input type="text" class="form-control" value="{{!empty($mailSkypeData)?$mailSkypeData->email:''}}" id="email" autocomplete="off">
                                <small id="email_div_alert" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Person in charge:</label>
                                <select name="person_in_charge" class="form-control" id="person_in_charge">
                                    <option value="">Select</option>
                                    @if(!empty($admins))
                                        @foreach($admins as $idAdmin=>$valueAdmin)
                                            <option
                                                value="{{$idAdmin}}" {{!empty($mailSkypeData) && $mailSkypeData->person_in_charge == $idAdmin ?'selected':''}}>{{$valueAdmin}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="person_in_charge_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Password:</label>
                                <input type="text" class="form-control" value="{{!empty($mailSkypeData)?$mailSkypeData->password:''}}" id="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Skype:</label>
                                <input type="text" class="form-control" value="{{!empty($mailSkypeData)?$mailSkypeData->skype:''}}" id="skype" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">CRM:</label>
                                <input type="text" class="form-control" value="{{!empty($mailSkypeData)?$mailSkypeData->crm:''}}" id="crm" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Dropbox:</label>
                                <input type="text" class="form-control" value="{{!empty($mailSkypeData)?$mailSkypeData->dropbox:''}}" id="dropbox" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-8 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea name="" id="note" cols="20" class="form-control" rows="10">{{!empty($mailSkypeData)?$mailSkypeData->note:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_mail_skype_list_form" type="submit"
                        is-click="false"
                        data-url="{{!empty($mailSkypeData)?route('email-skype-manager.update',['id'=>$mailSkypeData->id]):route('email-skype-manager.store')}}">{{!empty($mailSkypeData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
