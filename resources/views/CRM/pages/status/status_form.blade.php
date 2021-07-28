{{--<form method="post" class="card card-primary card-outline card-outline-tabs"--}}
{{--      action="" enctype="multipart/form-data">--}}
<div class="card-header p-0 border-bottom-0">
    <ul class="nav nav-tabs" id="department-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="department-tabs-info-tab" data-toggle="pill"
               href="#department-tabs-info" role="tab" aria-controls="department-tabs-info"
               aria-selected="true">Thông tin</a>
        </li>
    </ul>
</div>
<div class="card-body bg-white">
    <div class="tab-content" id="department-tabs-content">
        <div class="tab-pane fade show active" id="department-tabs-info" role="tabpanel"
             aria-labelledby="department-tabs-info-tab">
            <div class="form-group">
                <label for="title">Tiêu đề</label><span class="text-danger">(*)</span>
                <input id="name" type="text" name="name" class="form-control " value="{{(!empty($status))?$status->name:''}}"
                       required="">
            </div>
            <div class="form-group">
                <label for="parent_id">Kiểu</label>
                <select id="type" name="type" class="form-control" aria-hidden="true">
                    @foreach($types as $keyType=>$type)
                        <option value="{{$type}}"
                        @if(!empty($status))
                            {{$status->type == $type?'selected':''}}
                            @elseif(!empty($typeCreate))
                            {{$typeCreate == $type?'selected':''}}
                            @endif
                        >{{trans('lang.'.$type)}}</option>
                        {{$type}}
                    @endforeach
                </select>
                <div>
                    <div class="form-group" id="value_status_group">
                        <label>Giá trị</label>
                        @if(!empty($statusValues))
                            @foreach($statusValues as $statusValue)
                                @if($loop->index == 0)
                                    <div class="">
                                        <input type="text" id="value" name="value[]" value="{{$statusValue}}" class="form-control input_value_status"
                                               placeholder="Nhập giá trị">
                                    </div>
                                @elseif($loop->index >= 1)
                                    <div class="fieldwrapper row w-100" id="field1">
                                        <div class="col-md-11"><input type="text"
                                                                      class="form-control input_value_status"
                                                                      value="{{$statusValue}}"
                                                                      name="value[]" placeholder="Nhập giá trị"
                                                                      id="value"
                                                                      required=""></div>
                                        <div class="col-md-1"><input type="button" class="remove btn btn-default"
                                                                     value="-"></div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="">
                                <input type="text" name="value[]" id="value" value="" class="form-control input_value_status"
                                       placeholder="Nhập giá trị">
                            </div>
                        @endif
                    </div>
                    <a href="#" class="plus-value">Thêm giá trị</a>
                </div>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select name="is_success" id="is_success" class="form-control">
                    <option value=""></option>
                    @foreach($typeOfStatus as $keyTypeOfStatus=>$valueTypeOfStatus)
                        <option value="{{$keyTypeOfStatus}}" {{(!empty($status)) && $status->is_success == $keyTypeOfStatus ?'selected':''}}>{{$valueTypeOfStatus}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div class="card-footer clearfix">
    <div class="float-right">
        <a href="#" class="btn btn-danger btn-sm">
            Hủy
        </a>

        <button type="submit" class="btn btn-primary btn-sm btn-submit-form-status" data-url="{{(!empty($status))?route('status.update',['id'=>$status->id]):route('status.store')}}">
            Lưu
        </button>
    </div>
</div>
{{--</form>--}}
