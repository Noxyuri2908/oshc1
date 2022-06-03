
<div class="modal fade user-information" id="modal_archive_media_link" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($archiveMediaLinkData)?'Update':'Add new'}} media link</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Source:</label>
                                <select class="form-control" name="source_id" id="source_id">
                                    <option label=""></option>
                                    @if(!empty($sourceStatuses))
                                        @foreach($sourceStatuses as $key=>$value)
                                            <option value="{{$value->id}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->source_id == $value->id ?'selected':''}}>{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Country:</label>
                                <select class="form-control" name="country_id" id="country_id">
                                    <option label=""></option>
                                    @if(!empty($countries))
                                        @foreach($countries as $keyCountries=>$value)
                                            <option value="{{$keyCountries}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->country_id == $keyCountries ?'selected':''}}>{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Name:</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->name:''}}">
                            </div>
                        </div>
                        <div class="col-md-8 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Link:</label>
                                <input class="form-control" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->link:''}}" name="link" id="link" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Type:</label>
                                <select class="form-control" name="type_id" id="type_id">
                                    <option label=""></option>
                                    @if(!empty($typeMediaLinks))
                                        @foreach($typeMediaLinks as $keyTypeMediaLink=>$value)
                                            <option value="{{$value->id}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->type_id == $value->id ?'selected':''}}>{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Hot news:</label>
                                <select class="form-control" name="is_hot_new" id="is_hot_new">
                                    <option label=""></option>
                                    @if(!empty($hotNews))
                                        @foreach($hotNews as $keyHotNews=>$value)
                                            <option value="{{$keyHotNews}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->is_hot_new == $keyHotNews ?'selected':''}}>{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Information focused:</label>
                                <select class="form-control" name="information_focused_id" id="information_focused_id">
                                    <option label=""></option>
                                    @if(!empty($informationFocusedMediaLinks))
                                        @foreach($informationFocusedMediaLinks as $keyInformationFocusedMediaLink=>$value)
                                            <option value="{{$value->id}}" {{!empty($archiveMediaLinkData) && $archiveMediaLinkData->information_focused_id == $value->id ?'selected':''}}>{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Admin:</label>
                                <input type="text" name="admin" class="form-control" id="admin" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->admin:''}}">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Email Admin:</label>
                                <input type="text" name="email_admin" class="form-control" id="email_admin" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->email_admin:''}}">
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Telephone:</label>
                                <input type="text" name="telephone" class="form-control" id="telephone" value="{{!empty($archiveMediaLinkData)?$archiveMediaLinkData->telephone:''}}">
                            </div>
                        </div>
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea name="des" id="note" class="form-control my-editor" rows="5"> {{!empty($archiveMediaLinkData)?$archiveMediaLinkData->note:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_archive_media_link_form" type="submit" is-click="false" data-url="{{!empty($archiveMediaLinkData)?route('archive-media-link.update',['id'=>$archiveMediaLinkData->id]):route('archive-media-link.store')}}">{{!empty($archiveMediaLinkData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
