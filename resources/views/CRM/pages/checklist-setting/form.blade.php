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
            <h4>{{(!empty($setting))?'Sửa trạng thái:'.$setting->name:'Thêm trạng thái'}}</h4>
            <div class="form-group">
                <label for="title">Tiêu đề</label><span class="text-danger">(*)</span>
                <input id="name" type="text" name="name" class="form-control " value="{{(!empty($setting))?$setting->name:''}}"
                       required="">
                <small id="name_div_alert" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="parent_id">Kiểu</label>
                <select id="type" name="type" class="form-control" aria-hidden="true">
                    <option value=""></option>
                    @if(!empty($types))
                        @foreach($types as $keyType=>$type)
                            <option value="{{$type}}"
                            @if(!empty($setting))
                                {{$setting->type == $type?'selected':''}}
                                @elseif(!empty($typeCreate))
                                {{$typeCreate == $type?'selected':''}}
                                @endif
                            >{{trans('lang.'.$type)}}</option>
                        @endforeach
                    @endif
                </select>
                <small id="type_div_alert" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="parent_id">Trạng thái cha</label>
                <select id="parent_id" name="parent_id" class="form-control" aria-hidden="true">
                    <option value="">Không có</option>
                @if(!empty($settings))
                        @foreach($settings as $keyType=>$type)
                            <option value="{{$type['id']}}"
                            @if(!empty($setting))
                                {{$setting->parent_id == $type['id']?'selected':''}}
                                @elseif(!empty($typeCreate))
                                {{$typeCreate == $type['id']?'selected':''}}
                                @endif
                            >{{$type['name']}}</option>
                        @endforeach
                    @endif
                </select>
                <small id="parent_id_div_alert" class="text-danger"></small>
            </div>
        </div>
    </div>
</div>
<div class="card-footer clearfix">
    <div class="float-right">
        <a href="#" class="btn btn-danger btn-sm">
            Hủy
        </a>

        <button type="submit" class="btn btn-primary btn-sm btn-submit-form-status" data-url="{{(!empty($setting))?route('checklist_setting.update',['id'=>$setting->id]):route('checklist_setting.store')}}">
            Lưu
        </button>
    </div>
</div>
{{--</form>--}}
