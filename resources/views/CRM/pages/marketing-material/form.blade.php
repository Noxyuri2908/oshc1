<div class="modal fade user-information" id="modal_marketing_material" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{!empty($marketingMaterialData)?'Update':'Add new'}}
                    marketing material
                </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                        class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="marketing-material-form" action=""
                  data-url="{{!empty($marketingMaterialData)?route('marketing-material.update',['id'=>$marketingMaterialData->id]):route('marketing-material.store')}}">
                <div class="modal-body">
                    <div class="content-information">
                        <div class="row">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Category :</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option label=""></option>
                                        @if(!empty($categories))
                                            @foreach($categories as $keyCategory=>$valueCategory)
                                                <option
                                                    value="{{$valueCategory->id}}" {{!empty($marketingMaterialData) && $marketingMaterialData->category_id == $valueCategory->id ?'selected':''}}>{{$valueCategory->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="category_id_div_alert" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Type :</label>
                                    <select class="form-control" name="type" id="type">
                                        <option label=""></option>
                                        @if(!empty($type))
                                            @foreach($type as $keyType=>$valueType)
                                                <option
                                                    value="{{$valueType->id}}" {{!empty($marketingMaterialData) && $marketingMaterialData->type == $valueType->id ?'selected':''}}>{{$valueType->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="category_id_div_alert" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Use for :</label>
                                    <select class="form-control" name="use_for" id="use_for">
                                        <option label=""></option>
                                        @if(!empty($use_fors))
                                            @foreach($use_fors as $keyUseFor=>$valueUseFor)
                                                <option
                                                    value="{{$valueUseFor->id}}" {{!empty($marketingMaterialData) && $marketingMaterialData->use_for == $valueUseFor->id ?'selected':''}}>{{$valueUseFor->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="use_for_div_alert" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Target :</label>
                                    <select class="form-control" name="target" id="target">
                                        <option label=""></option>
                                        @if(!empty($targets))
                                            @foreach($targets as $keyTarget=>$valueTarget)
                                                <option
                                                    value="{{$valueTarget->id}}"
                                                    data-value="{{$valueTarget->value}}" {{!empty($marketingMaterialData) && $marketingMaterialData->target == $valueTarget->id ?'selected':''}}>{{$valueTarget->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small id="target_div_alert" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Sub target :</label>
                                    @if(!empty($marketingMaterialData))
                                        <select class="form-control" name="sub_target" id="sub_target">
                                            @if($marketingMaterialData->getSubTarget())
                                                @foreach($marketingMaterialData->getSubTarget() as $keySubTargetName=>$valueSubTargetName)
                                                    <option
                                                        value="{{$keySubTargetName+1}}" {{$marketingMaterialData->sub_target == $keySubTargetName+1 ?'selected':''}}>{{$valueSubTargetName}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @else
                                        <select class="form-control" name="sub_target" id="sub_target">

                                        </select>
                                    @endif
                                    <small id="sub_target_div_alert" class="form-text text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-12 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Content :</label>
                                    <textarea name="content" id="content" cols="20" class="form-control"
                                              rows="10">{{!empty($marketingMaterialData)?$marketingMaterialData->content:''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 content-table fill_content">
                                <div class="form-group">
                                    <label for="fileAttactment">File attachment</label>
                                    <input type="file" class="form-control-file" multiple="multiple" name="file_attachment[]"
                                           id="fileAttactment">
                                    @if(!empty($marketingMaterialData))
{{--                                        <a href="{{!empty($marketingMaterialData->link_download())?$marketingMaterialData->link_download():''}}">File: {{!empty($marketingMaterialData)?$marketingMaterialData->file_attachment:''}}</a>--}}
                                        {{decode_html(getFileAttachById($marketingMaterialData->id), 'array')}}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Note :</label>
                                    <textarea name="note"  class="form-control" id="note" cols="20" rows="10">{{!empty($marketingMaterialData->note) ? $marketingMaterialData->note : ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success mr-1 mb-1 btn_submit_marketing_material_form" type="submit"
                            is-click="false"
                    >{{!empty($marketingMaterialData)?'Update':'Submit'}}</button>
                    <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
