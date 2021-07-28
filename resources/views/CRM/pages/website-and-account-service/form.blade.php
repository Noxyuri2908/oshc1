<div class="modal fade user-information" id="modal_website_account_list" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($websiteAndAccountData)?'Update':'Add new'}}
                    @php
                        if(!empty($typeId)){
                            if($typeId == 1){
                                echo 'website';
                            }elseif($typeId == 2){
                                 echo 'account service';
                            }
                        }
                    @endphp
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        @if($typeId == 1)
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Website:</label>
                                    <input type="text" class="form-control"
                                           value="{{!empty($websiteAndAccountData)?$websiteAndAccountData->website:''}}" id="website"
                                           autocomplete="off">
                                    <small id="website_div_alert" class="form-text text-danger"></small>
                                </div>
                            </div>
                        @elseif($typeId == 2)
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Account service:</label>
                                    <input type="text" class="form-control"
                                           value="{{!empty($websiteAndAccountData)?$websiteAndAccountData->service:''}}" id="service"
                                           autocomplete="off">
                                    <small id="service_div_alert" class="form-text text-danger"></small>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Link:</label>
                                <input type="text" class="form-control"
                                       value="{{!empty($websiteAndAccountData)?$websiteAndAccountData->link:''}}" id="link"
                                       autocomplete="off">
                                <small id="link_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Id:</label>
                                <input type="text" class="form-control"
                                       value="{{!empty($websiteAndAccountData)?$websiteAndAccountData->website_and_service_id:''}}"
                                       id="website_and_service_id" autocomplete="off">
                                <small id="website_and_service_id_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Password:</label>
                                <input type="text" class="form-control"
                                       value="{{!empty($websiteAndAccountData)?$websiteAndAccountData->password:''}}" id="password"
                                       autocomplete="off">
                                <small id="password_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-8 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Supporter:</label>
                                <input type="text" class="form-control"
                                       value="{{!empty($websiteAndAccountData)?$websiteAndAccountData->supporter:''}}" id="supporter"
                                       autocomplete="off">
                                <small id="supporter_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                            <input type="hidden" class="form-control"
                                   value="{{!empty($websiteAndAccountData)?$websiteAndAccountData->type:$typeId}}" id="type"
                                   autocomplete="off">
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea name="" id="note" cols="20" class="form-control"
                                          rows="10">{{!empty($websiteAndAccountData)?$websiteAndAccountData->note:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_website_service_list_form" type="submit"
                        is-click="false"
                        data-url="{{!empty($websiteAndAccountData)?route('website-account-manager.update',['id'=>$websiteAndAccountData->id]):route('website-account-manager.store')}}">{{!empty($websiteAndAccountData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
