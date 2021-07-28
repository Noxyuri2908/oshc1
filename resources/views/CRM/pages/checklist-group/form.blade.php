
<div class="modal fade user-information" id="modal_check_list_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($groupData)?'Update':'Add new'}} group</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">

                        <div class="col-md-8 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Name:</label>
                                <input class="form-control" autocomplete="off" value="{{!empty($groupData)?$groupData->group_name:''}}" name="group_name" id="group_name" type="text" required>
                            </div>
                        </div>
{{--                        <div class="col-md-4 content-table fill_content">--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="control-label">Type:</label>--}}
{{--                                <select class="form-control" name="type_id" id="type_id">--}}
{{--                                    <option label=""></option>--}}
{{--                                    @if(!empty($typeMediaLinks))--}}
{{--                                        @foreach($typeMediaLinks as $keyTypeMediaLink=>$value)--}}
{{--                                            <option value="{{$value->id}}" {{!empty($groupData) && $groupData->type_id == $value->id ?'selected':''}}>{{$value->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success mr-1 mb-1 btn_submit_check_list_group_form" type="submit" is-click="false" data-url="{{!empty($groupData)?route('check-list-group.update',['id'=>$groupData->id]):route('check-list-group.store')}}">{{!empty($groupData)?'Update':'Submit'}}</button>
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
