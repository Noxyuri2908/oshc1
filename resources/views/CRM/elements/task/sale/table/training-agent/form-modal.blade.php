<div class="modal fade user-information" id="modal_training" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{!empty($training)?'Update':'Add new'}} training</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span class="font-weight-light" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-information">
                    <div class="row">
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Processing date:</label>
                                <input class="form-control" value="{{!empty($training)?convert_date_form_db($training->processing_date):''}}" name="processing_date" id="processing_date_training" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Type:</label>
                                <select class="form-control" name="type" id="type_training">
                                    <option label=""></option>
                                    @if(!empty(config('myconfig.type_training_task_sale')))
                                        @foreach(config('myconfig.type_training_task_sale') as $key=>$value)
                                            <option value="{{$key}}" {{!empty($training) && $training->type == $key ?'selected':''}}>{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Deadline:</label>
                                <input class="form-control" value="{{!empty($training)?convert_date_form_db($training->deadline):''}}" name="deadline" id="deadline_training" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-4 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Result:</label>
                                <select class="form-control" name="result" id="result_training">
                                    <option label=""></option>
                                    @if(!empty(config('myconfig.result_training_task_sale')))
                                        @foreach(config('myconfig.result_training_task_sale') as $key=>$value)
                                            <option value="{{$key}}" {{!empty($training) && $training->type == $key ?'selected':''}}>{{$value}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Item:</label>
                                <textarea name="des" id="des_item_training" class="form-control my-editor" rows="5"> {{!empty($training)?$training->item:''}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 content-table fill_content">
                            <div class="form-group">
                                <label class="control-label">Note:</label>
                                <textarea name="des" id="des_note_training" class="form-control my-editor" rows="5"> {{!empty($training)?$training->note:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                @if(!empty($training))
                    @can('training.update')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-training-form" type="submit" is-click="false" data-url="{{!empty($training)?route('tasks.updateTraining',['id'=>$training->id]):route('tasks.storeTraining')}}">{{!empty($training)?'Update':'Save'}}</button>
                    @endcan
                @else
                    @can('training.store')
                        <button class="btn btn-success mr-1 mb-1 btn-submit-training-form" type="submit" is-click="false" data-url="{{!empty($training)?route('tasks.updateTraining',['id'=>$training->id]):route('tasks.storeTraining')}}">{{!empty($training)?'Update':'Save'}}</button>
                    @endcan
                @endif
                <button class="btn btn-danger mr-1 mb-1" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
