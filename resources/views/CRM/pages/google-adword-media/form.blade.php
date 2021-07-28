<div class="modal fade user-information" id="modal_google_adword_media" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($googleAdwordMediaData)?'Update':'Add new'}}
                    google adword
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
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?convert_date_form_db($googleAdwordMediaData->start_date):''}}" id="start_date" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">End date:</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?convert_date_form_db($googleAdwordMediaData->end_date):''}}" id="end_date" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Website:</label>
                                <select class="form-control" name="website_id" id="website_id">
                                    <option label=""></option>
                                    @if(!empty($webMedias))
                                        @foreach($webMedias as $value)
                                            <option
                                                value="{{$value->id}}" {{!empty($googleAdwordMediaData) && $googleAdwordMediaData->website_id == $value->id ?'selected':''}}>{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Chiến dịch:</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->campaign:''}}" name="campaign" id="campaign"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Địa điểm tìm kiếm:</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->location_search:''}}" name="location_search"
                                       id="location_search" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Ngôn ngữ tìm kiếm:</label>
                                <select name="language_search" class="form-control" id="language_search">
                                    <option value="">Select country</option>
                                    @if(!empty($countries))
                                        @foreach($countries as $keyCountries=>$value)
                                            <option
                                                value="{{$keyCountries}}" {{!empty($googleAdwordMediaData) && $googleAdwordMediaData->language_search == $keyCountries ?'selected':''}}>{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Loại chiến dịch:</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->type_campaign:''}}" name="type_campaign" id="type_campaign"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Giá đặt thầu:</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->bid_price:''}}" name="bid_price" id="bid_price"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Từ khoá :</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->keyword:''}}" name="keyword" id="keyword"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Dòng tiêu đề 1 :</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->title_1:''}}" name="title_1" id="title_1"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Dòng tiêu đề 2 :</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->title_2:''}}" name="title_2" id="title_2"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Dòng tiêu đề 3 :</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->title_3:''}}" name="title_3" id="title_3"
                                       autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Link bài :</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->link_post:''}}" name="link_post" id="link_post"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Số ngày chạy :</label>
                                <input type="number" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->number_days:''}}" name="number_days" id="number_days"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Budget (VND) :</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->budget:''}}" name="budget" id="budget"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Số lượng click dự kiến :</label>
                                <input type="number" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->number_click_expected:''}}" name="number_click_expected" id="number_click_expected"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Số lượng click thực tế :</label>
                                <input type="number" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->number_click_reality:''}}" name="number_click_reality" id="number_click_reality"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Số lần hiển thị :</label>
                                <input type="number" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->number_impression:''}}" name="number_impression" id="number_impression"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">CPC trung bình :</label>
                                <input type="text" class="form-control" value="{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->average_CPC:''}}" name="average_CPC" id="average_CPC"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-8 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Mô tả :</label>
                                <textarea class="form-control" name="describe" id="describe" cols="30" rows="10">{{!empty($googleAdwordMediaData)?$googleAdwordMediaData->describe:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_google_adword_media_form" type="submit"
                        is-click="false"
                        data-url="{{!empty($googleAdwordMediaData)?route('google-adword-media.update',['id'=>$googleAdwordMediaData->id]):route('google-adword-media.store')}}">{{!empty($googleAdwordMediaData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
