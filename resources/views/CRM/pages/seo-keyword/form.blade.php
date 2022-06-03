<div class="modal fade user-information" id="modal_seo_keyword_list" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($seoKeywordData)?'Update':'Add new'}}
                    seo-keyword
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
                                <label class="control-label">Destination target:</label>
                                <input type="text" class="form-control" value="{{!empty($seoKeywordData)?$seoKeywordData->destination_target:''}}" id="destination_target" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Keyword:</label>
                                <input type="text" class="form-control" value="{{!empty($seoKeywordData)?$seoKeywordData->keyword:''}}" id="keyword" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Relevant info:</label>
                                <input type="text" class="form-control" value="{{!empty($seoKeywordData)?$seoKeywordData->relevant_info:''}}" id="relevant_info" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">GG ad:</label>
                                <input type="text" class="form-control" value="{{!empty($seoKeywordData)?$seoKeywordData->gg_ad:''}}" id="gg_ad" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Ranking:</label>
                                <input type="number" class="form-control" value="{{!empty($seoKeywordData)?$seoKeywordData->ranking:''}}" id="ranking" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Link:</label>
                                <input type="text" class="form-control" value="{{!empty($seoKeywordData)?$seoKeywordData->link:''}}" id="link" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Title:</label>
                                <input type="text" class="form-control" value="{{!empty($seoKeywordData)?$seoKeywordData->title:''}}" id="title" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Description:</label>
                                <input type="text" class="form-control" value="{{!empty($seoKeywordData)?$seoKeywordData->description:''}}" id="description" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea name="" id="note" cols="20" class="form-control" rows="10">{{!empty($seoKeywordData)?$seoKeywordData->note:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_domain_hosting_list_form" type="submit"
                        is-click="false"
                        data-url="{{!empty($seoKeywordData)?route('seo-keyword.update',['id'=>$seoKeywordData->id]):route('seo-keyword.store')}}">{{!empty($seoKeywordData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
