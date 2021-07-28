@if(!empty($settingStatuses))
    @foreach($settingStatuses as $keyStatus=>$listStatus)
        <div class="list-group-item expaned">
            <a href="#{{$keyStatus}}" class="" data-toggle="collapse"
               aria-expanded="false">
                <i class="fa fa-chevron-right mr-3 js-rotate-if-collapsed"></i>{{trans('lang.'.$keyStatus)}}
            </a>
            <span class="float-right">
                <span class="prevent-expand btn btn-warning btn-sm btn-add-status"
                      data-url="{{route('checklist_setting.create',['type'=>$keyStatus])}}">Thêm</span>
            </span>
        </div>


        <div class="list-group collapse" id="{{$keyStatus}}">
            @foreach($listStatus as $status)
                <div class="list-group-item expaned">
                    <a href="#item{{$status->id}}" class="expaned" data-toggle="collapse"
                       aria-expanded="false">
                        <i class="fa fa-chevron-right mr-3 js-rotate-if-collapsed"></i>{{$status->name}}
                    </a>
                    <span class="float-right">
                        <span class="prevent-expand btn btn-warning btn-sm btn-edit-status"
                              data-url="{{route('checklist_setting.edit',['id'=>$status->id])}}">Sửa</span>
                        <span class="prevent-expand ml-1 btn btn-danger btn-sm btn-delete-status"
                              data-url="{{route('checklist_setting.delete',['id'=>$status->id])}}">Xóa</span>
                    </span>
                </div>
                <div class="list-group collapse expaned" id="item{{$status->id}}">
                    @foreach($status->children as $child)
                        <div class="list-group-item expaned">
                            <a href="#item{{$child->id}}" class="expaned" data-toggle="collapse"
                               aria-expanded="false">
                                <i class="fa fa-chevron-right mr-3 js-rotate-if-collapsed"></i>{{$child->name}}
                            </a>
                            <span class="float-right">
                                <span class="prevent-expand btn btn-warning btn-sm btn-edit-status"
                                      data-url="{{route('checklist_setting.edit',['id'=>$child->id])}}">Sửa</span>
                                <span class="prevent-expand ml-1 btn btn-danger btn-sm btn-delete-status"
                                      data-url="{{route('checklist_setting.delete',['id'=>$child->id])}}">Xóa</span>
                            </span>
                        </div>
                        <div class="list-group collapse expaned" id="item{{$child->id}}">
                            @foreach($child->children as $subchild)
                                <div class="list-group-item expaned">
                                    <a href="#item{{$subchild->id}}" class="expaned" data-toggle="collapse"
                                       aria-expanded="false">
                                        <i class="fa fa-chevron-right mr-3 js-rotate-if-collapsed"></i>{{$subchild->name}}
                                    </a>
                                    <span class="float-right">
                                        <span class="prevent-expand btn btn-warning btn-sm btn-edit-status"
                                              data-url="{{route('checklist_setting.edit',['id'=>$subchild->id])}}">Sửa</span>
                                        <span class="prevent-expand ml-1 btn btn-danger btn-sm btn-delete-status"
                                              data-url="{{route('checklist_setting.delete',['id'=>$subchild->id])}}">Xóa</span>
                                    </span>
                                </div>
                                <div class="list-group collapse expaned" id="item{{$subchild->id}}">
                                    @foreach($subchild->children as $subchild2)
                                        <div class="list-group-item expaned">
                                            <a href="#item{{$subchild2->id}}" class="expaned" data-toggle="collapse"
                                               aria-expanded="false">
                                                <i class="fa fa-chevron-right mr-3 js-rotate-if-collapsed"></i>{{$subchild2->name}}
                                            </a>
                                            <span class="float-right">
                                                <span class="prevent-expand btn btn-warning btn-sm btn-edit-status"
                                                      data-url="{{route('checklist_setting.edit',['id'=>$subchild2->id])}}">Sửa</span>
                                                <span class="prevent-expand ml-1 btn btn-danger btn-sm btn-delete-status"
                                                      data-url="{{route('checklist_setting.delete',['id'=>$subchild2->id])}}">Xóa</span>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    @endforeach
@endif
