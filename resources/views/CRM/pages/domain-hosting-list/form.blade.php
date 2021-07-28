<div class="modal fade user-information" id="modal_domain_hosting_list" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($domainHostingData)?'Update':'Add new'}}
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
                                <label class="control-label">Type:</label>
                                <select class="form-control" name="type" id="type">
                                    <option label=""></option>
                                    @if(!empty($types))
                                        @foreach($types as $keyType=>$type)
                                            <option
                                                value="{{$type->id}}" {{!empty($domainHostingData) && $domainHostingData->type == $type->id ?'selected':''}}>{{$type->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="type_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Name:</label>
                                <input type="text" class="form-control" value="{{!empty($domainHostingData)?$domainHostingData->name:''}}" id="name" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Link:</label>
                                <input type="text" class="form-control" value="{{!empty($domainHostingData)?$domainHostingData->link:''}}" id="link" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">User:</label>
                                <input type="text" class="form-control" value="{{!empty($domainHostingData)?$domainHostingData->user:''}}" id="user" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Password:</label>
                                <input type="text" class="form-control" value="{{!empty($domainHostingData)?$domainHostingData->password:''}}" id="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Provider:</label>
                                <input type="text" class="form-control" value="{{!empty($domainHostingData)?$domainHostingData->provider:''}}" id="provider" autocomplete="off">
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
                                                value="{{$idAdmin}}" {{!empty($domainHostingData) && $domainHostingData->person_in_charge == $idAdmin ?'selected':''}}>{{$valueAdmin}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="person_in_charge_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Email in charge:</label>
                                <input type="email" class="form-control" value="{{!empty($domainHostingData)?$domainHostingData->email_in_charge:''}}" id="email_in_charge" autocomplete="off">
                                <small id="email_in_charge_div_alert" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Expiry date:</label>
                                <input type="text" class="form-control" value="{{!empty($domainHostingData)?convert_date_form_db($domainHostingData->expiry_date):''}}" id="expiry_date" autocomplete="off">
                                <small id="expiry_date_div_alert" class="form-text text-danger"></small>

                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Fee:</label>
                                <input type="text" class="form-control" value="{{!empty($domainHostingData)?$domainHostingData->fee:''}}" id="fee" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-8 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea name="" id="note" cols="20" class="form-control" rows="10">{{!empty($domainHostingData)?$domainHostingData->note:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_domain_hosting_list_form" type="submit"
                        is-click="false"
                        data-url="{{!empty($domainHostingData)?route('domain-hosting-manager.update',['id'=>$domainHostingData->id]):route('domain-hosting-manager.store')}}">{{!empty($domainHostingData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
