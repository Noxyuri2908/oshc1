<form class="btn_submit_{{$type}}_form" action="{{!empty($checkListData) ? route('check-list.update',['id'=>$checkListData->id,'group_id'=>$groupId]) : route('check-list.store',['group_id'=>$groupId])}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="modal fade user-information" id="modal_checklist_task" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{!empty($checkListData)?'Update':'Add new'}}
                        {{$type}}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                            class="font-weight-light" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="content-information">
                        <div class="row">
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Product:</label>
                                    <select class="form-control" name="type_id" id="type_id{{$type}}">
                                        <option label=""></option>
                                        @if(!empty($checklistSetting))
                                            @foreach($checklistSetting as $keyCheckList=>$typeCheckList)
                                                <option label="{{$typeCheckList->name}}" value="{{$typeCheckList->id}}" {{!empty($checkListData) && $checkListData->type_id == $typeCheckList->id?'selected':''}}>{{$typeCheckList->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Title:</label>
                                    @if(!empty($checkListData) && !empty($checkListData->type_id) && !empty($checklistSetting->where('id',$checkListData->type_id)->first()))
                                        <select class="form-control" name="website_id" id="website_id{{$type}}">
                                            @foreach($checklistSetting->where('id',$checkListData->type_id)->first()->children as $webMedia)
                                                <option label="{{$webMedia->name}}" value="{{$webMedia->id}}"
                                                        data-value="{{$webMedia->value}}"{{!empty($checkListData) && $checkListData->website_id == $webMedia->id?'selected':''}}>{{$webMedia->name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select class="form-control" name="website_id" id="website_id{{$type}}">

                                        </select>
                                    @endif
                                </div>
                            </div>

                            @if($type == 'checklist')
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Categories:</label>
                                        @if(!empty($checkListData) && !empty($checkListData->type_id) && !empty($checklistSettingType->where('id', $checkListData->website_id)->first()))
                                            <select name="category" id="category_id{{$type}}" class="form-control">
                                                <option value=""></option>
                                                @foreach($checklistSettingType->where('id', $checkListData->website_id)->first()->children as $keyCategory => $value)
                                                    <option value="{{$value->id}}" {{$checkListData->category_id == $value->id ? 'selected':''}} label="{{$value->name}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name="category" id="category_id{{$type}}" class="form-control">

                                            </select>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if($type == 'checklist')
                                <div class="col-md-4 content-table fill_content" onmouseover="hoverProposor()">
                                    <div class="form-group">
                                        <label class="control-label">Proposer :</label>
                                        <select class="form-control" name="proposer" id="proposer">
                                            @if(!empty($admins))
                                                @foreach($admins as $adminId => $adminName)

                                                    <option value="{{$adminId}}" {{!empty($checkListData) && $checkListData->proposer == $adminId ? 'selected':''}}>{{$adminName}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-4 content-table fill_content" onmouseover="hoverPerson()">
                                <div class="form-group">
                                    <label class="control-label">Person in charge:</label>
                                    <select class="form-control" name="person_id[]" id="person_id{{$type}}" multiple="multiple">
                                        @if(!empty($admins))
                                            @foreach($admins as $adminId=>$adminName)
                                                <option value="{{$adminId}}" {{!empty($checkListData) && (int)json_decode($checkListData->person_id)[0] == $adminId?'selected':''}}>{{$adminName}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Issue:</label>
                                    <textarea name="problem" id="problem{{$type}}"  cols="125" rows="3" maxlength="400" required>{{!empty($checkListData)?$checkListData->problem:''}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Detail:</label>
                                    <textarea name="detail" id="detail{{$type}}" class="details" cols="125" rows="3" maxlength="5000" required>{{!empty($checkListData)?$checkListData->detail:''}}</textarea>
                                </div>
                            </div>

                            @if($type == 'checklist')
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Processor :</label>
                                        {{--                                    <input class="form-control"--}}
                                        {{--                                           value="{{!empty($checkListData)?$checkListData->solution_text:''}}"--}}
                                        {{--                                           name="solution_text" id="solution_text{{$type}}" type="text" required>--}}
                                        <select class="form-control" name="solution_text" id="solution_text{{$type}}">
                                            <option value=""></option>
                                            @foreach($solution_it_checklist as $solution)
                                                <option value="{{$solution->id}}" {{(!empty($checkListData) && $checkListData->solution_text == $solution->id)?'selected':''}}>{{$solution->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Level of process :</label>
                                        <select class="form-control" name="level_of_process" id="level_of_process">
                                            <option value=""></option>
                                            @foreach($lvprocessor as $lv => $value)
                                                <option value="{{$lv}}" {{(!empty($checkListData) && $checkListData->level_of_process == $lv)?'selected':''}}>{{$value}}</option>
                                            @endforeach
                                        </select>
                                        {{--                                    <input class="form-control"--}}
                                        {{--                                           value="{{!empty($checkListData)?$checkListData->level_of_process:''}}"--}}
                                        {{--                                           name="level_of_process" id="level_of_process{{$type}}" type="number" required>--}}
                                    </div>
                                </div>
                            @endif


                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Result :</label>
                                    <select class="form-control" name="result_id" id="result_id{{$type}}">
                                        <option label=""></option>
                                        @if(!empty($results))
                                            @foreach($results as $resultId=>$resultName)
                                                <option label="{{$resultName}}"
                                                        value="{{$resultId}}" {{!empty($checkListData) && $checkListData->result_id == $resultId?'selected':''}}>{{$resultName}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            @if($type == 'checklist')
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Start date :</label>
                                        <input class="form-control"
                                               value="{{!empty($checkListData)?convert_date_form_db($checkListData->processing_time):''}}"
                                               name="processing_time" id="processing_time{{$type}}" type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">End date:</label>
                                        <input class="form-control"
                                               value="{{!empty($checkListData)?convert_date_form_db($checkListData->date_of_suggestion):''}}"
                                               name="date_of_suggestion" id="date_of_suggestion{{$type}}" type="text">
                                    </div>
                                </div>
                            @endif
                            @if($type == 'checklist')
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">Budget :</label>
                                        <input class="form-control"
                                               value="{{!empty($checkListData)?$checkListData->budget:''}}"
                                               name="budget" id="budget{{$type}}" type="text">
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-4 content-table fill_content">
                                <div class="form-group">
                                    <label class="control-label">Creation date :</label>
                                    <input class="form-control {{$flag == 'check-list-edit' ? 'checklist-edit' : 'checklist-create'}}"
                                           value="{{!empty($checkListData)?convert_date_form_db($checkListData->checklist_created_at):''}}"
                                           name="checklist_created_at"
                                           id="checklist_created_at{{$type}}"
                                           type="text" required>
                                </div>
                            </div>
                            @if($type == 'checklist')
                                <div class="col-md-4 content-table fill_content">
                                    <div class="form-group">
                                        <label class="control-label">File :</label>
                                        <input type="file" name="file" id="file">
                                        @if(!empty($checkListData) && $checkListData->file)
                                            <div>
                                                <a target="_blank" href="{{asset('tailieus/'.$checkListData->file)}}">{{asset('tailieus/'.$checkListData->file)}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{----}}
                                <div class="col-md-4 content-table fill_content" onmouseover="hoverPerson()">
                                    <div class="form-group">
                                        <label class="control-label">Created By :</label>
                                        <select class="form-control" name="created_by" id="created_by">
                                            @if(!empty($admins))
                                                <option value="{{\Illuminate\Support\Facades\Auth::user()->id}}">{{\Illuminate\Support\Facades\Auth::user()->admin_id}}</option>
                                            @foreach($admins as $adminId=>$adminName)
                                                <option value="{{$adminId}}" {{!empty($checkListData) && $checkListData->created_by == $adminId?'selected':''}}>{{$adminName}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success mr-1 mb-1 " type="submit" is-click="false"
                            data-url=""> {{!empty($checkListData)?'Update':'Submit'}} </button>
                    <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</form>
<script>

    var activeHover = true;
    function hoverPerson()
    {
        if (activeHover)
        {
            $('#person_idchecklist').select2({
                closeOnSelect: false
            });
            activeHover = false;
        }
    }

    var activeHoverProposor = true;
    function hoverProposor(){
        if (activeHoverProposor)
        {
            $('#proposer').select2({
                closeOnSelect: false
            });
            activeHoverProposor = false;
        }
    }

    function formatDate() {
        var d = new Date(),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [day, month, year].join('/');
    }


    $('input.checklist_create').val(formatDate()) // add default creation date = date now

</script>
