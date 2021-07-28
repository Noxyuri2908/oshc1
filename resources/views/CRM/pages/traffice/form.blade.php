<div class="modal fade user-information" id="modal_traffice" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($trafficeData)?'Update':'Add new'}}
                    traffice
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
                                <label class="control-label">Start date:</label>
                                <input type="text" class="form-control" value="{{!empty($trafficeData)?convert_date_form_db($trafficeData->start_date):''}}" id="start_date" autocomplete="off">
                                <small id="start_date_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">End date:</label>
                                <input type="text" class="form-control" value="{{!empty($trafficeData)?convert_date_form_db($trafficeData->end_date):''}}" id="end_date" autocomplete="off">
                                <small id="end_date_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Total view:</label>
                                <input type="number" class="form-control" value="{{!empty($trafficeData)?$trafficeData->total_view:''}}" id="total_view" autocomplete="off">
                                <small id="total_view_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Total user:</label>
                                <input type="number" class="form-control" value="{{!empty($trafficeData)?$trafficeData->total_user:''}}" id="total_user" autocomplete="off">
                                <small id="total_user_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Total like (at present):</label>
                                <input type="number" class="form-control" value="{{!empty($trafficeData)?$trafficeData->total_like:''}}" id="total_like" autocomplete="off">
                                <small id="total_like_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Total reach:</label>
                                <input type="number" class="form-control" value="{{!empty($trafficeData)?$trafficeData->total_reach:''}}" id="total_reach" autocomplete="off">
                                <small id="total_reach_div_alert" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea name="" id="note" cols="20" class="form-control" rows="10">{{!empty($trafficeData)?$trafficeData->note:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_traffice_form" type="submit"
                        is-click="false"
                        data-url="{{!empty($trafficeData)?route('traffice.update',['id'=>$trafficeData->id]):route('traffice.store')}}">{{!empty($trafficeData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
