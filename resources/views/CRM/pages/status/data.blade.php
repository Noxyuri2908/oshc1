@foreach($statuses as $keyStatus=>$listStatus)
<div class="list-group-item expaned">
    <a href="#{{$keyStatus}}" class="" data-toggle="collapse"
       aria-expanded="false">
        <i class="fa fa-chevron-right mr-3 js-rotate-if-collapsed"></i>{{trans('lang.'.$keyStatus)}}
    </a>
    <span class="float-right">
        <span class="prevent-expand btn btn-warning btn-sm btn-add-status" data-url="{{route('status.create',['type'=>$keyStatus])}}">Thêm</span>
    </span>
</div>


<div class="list-group collapse" id="{{$keyStatus}}">
    @foreach($listStatus as $status)
        <div class="list-group-item expaned">
            {{$status->name}}
            <span class="float-right">
                @can('status.update')
                    <span class="prevent-expand btn btn-warning btn-sm btn-edit-status" data-url="{{route('status.edit',['id'=>$status->id])}}">Sửa</span>
                @endcan
                @can('status.destroy')
                    <span class="prevent-expand ml-1 btn btn-danger btn-sm btn-delete-status" data-url="{{route('status.delete',['id'=>$status->id])}}">Xóa</span>
                @endcan
            </span>
        </div>
    @endforeach
</div>
@endforeach
