<div class="modal fade user-information" id="modal_media_setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($mediaSettingData)?'Update':'Add new'}} media setting</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
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
                                    @if(!empty($typeSetting))
                                        @foreach($typeSetting as $key=>$value)
                                            <option value="{{$key}}" {{!empty($mediaSettingData) && $mediaSettingData->type == $key ?'selected':''}}>{{trans('lang.'.$value)}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <small id="#type_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Name:</label>
                                <input type="text" name="name" autocomplete="off" class="form-control" id="name" value="{{!empty($mediaSettingData)?$mediaSettingData->name:''}}">
                                <small id="#name_div_alert" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group" id="category_list">
                                <label class="control-label">Category Name:</label>
                                @if(!empty($mediaSettingData->category))
                                    @foreach($mediaSettingData->category as $statusValue)
                                        @if($loop->index == 0)
                                            <div class="">
                                                <input type="text" id="category" autocomplete="off" name="value[]" value="{{$statusValue}}" class="form-control input_value_status"
                                                       placeholder="Nhập giá trị">
                                                <small id="category{{$loop->index}}_div_alert" class="text-danger"></small>
                                            </div>
                                        @else
                                            <div class="fieldwrapper row w-100" id="field{{$loop->index}}">
                                                <div class="col-md-11">
                                                    <input type="text" class="form-control input_value_status"
                                                                              value="{{$statusValue}}"
                                                                              name="value[]" placeholder="Nhập giá trị"
                                                                              id="category{{$loop->index}}"
                                                                              required="">
                                                    <small id="category{{$loop->index}}_div_alert" class="text-danger"></small>
                                                </div>
                                                <div class="col-md-1"><input type="button" onclick="$(this).parent().parent().remove();" class="remove btn btn-default"
                                                                             value="-"></div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="">
                                        <input type="text" id="category" autocomplete="off" name="value[]" value="" class="form-control input_value_status"
                                               placeholder="Nhập giá trị">
                                        <small id="category0_div_alert" class="text-danger"></small>
                                    </div>
                                @endif
                                {{--<input type="text" name="category" autocomplete="off" class="form-control" id="category" value="{{!empty($mediaSettingData)?$mediaSettingData->category:''}}">--}}
                                {{--<small id="#category_div_alert" class="text-danger"></small>--}}
                            </div>
                            <a href="#" class="plus-value" onclick="plusValue()">Thêm giá trị</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_media_setting_form" type="submit" is-click="false" data-url="{{!empty($mediaSettingData)?route('task_media_status.update',['id'=>$mediaSettingData->id]):route('task_media_status.store')}}">{{!empty($mediaSettingData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function plusValue(e) {
        var lastField = $('#category_list div:last');
        var intId = (lastField && lastField.length && lastField.data('idx') + 1) || 1;
        var fieldWrapper = $('<div class="fieldwrapper row w-100 " id="field' + intId + '"/>')
        fieldWrapper.data('idx', intId)
        var fName = $('<div class="col-md-11"><input type="text" autocomplete="off" class="form-control input_value_status" value="" name="value[]" id="category" placeholder="Nhập giá trị" required><small id="#category_div_alert" class="text-danger"></small>\n</div>')
        var removeButton = $('<div class="col-md-1"><input type="button" class="remove btn btn-default" value="-" /></div>')
        removeButton.click(function () {
            $(this).parent().remove()
        })
        fieldWrapper.append(fName)
        fieldWrapper.append(removeButton)
        $('#category_list').append(fieldWrapper)
    }
</script>
