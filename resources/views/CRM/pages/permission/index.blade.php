@extends('CRM.layouts.default')

@section('title')
    Permission List
    @parent
@stop

@section('css')
    @include('CRM.partials.css-list')
    @include('CRM.pages.css.customer-css')
    <style>
    </style>
@stop
@section('content')
    <div class="card">
        <form action="{{route('permissions.update',['id'=>$rolepermissions->id])}}" method="post">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4>Permission</h4>
                    <div>
                        <a class="check-all btn btn-primary text-light" >Check All</a>
                        <a class="un-check-all btn btn-primary text-light" >Uncheck All</a>
                        <a href="{{route('roles.index')}}" class="btn btn-primary"><i
                                class="fas fa-arrow-left mr-2"></i>Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="h5">Permission access: {{$rolepermissions->name}}</p>
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row" id="accordionExample">
                    @foreach($permissions as $keyPermission=>$permission)
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" id="headingThree{{$loop->index}}">
                                    <div class="d-flex justify-content-between">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link {{$loop->index > 0?'collapsed':''}}" type="button" data-toggle="collapse" data-target="#collapseThree{{$loop->index}}" aria-expanded="false" aria-controls="collapseThree{{$loop->index}}">
                                                {{trans(__('permission.'.$keyPermission))}}
                                            </button>
                                        </h2>
                                        <div>
                                            <a class="check-all-group btn btn-primary text-light" >Check All</a>
                                            <a class="un-check-all-group btn btn-primary text-light" >Uncheck All</a>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseThree{{$loop->index}}" class="collapse" aria-labelledby="headingThree{{$loop->index}}" data-parent="#accordionExample">
                                    <div class="card-body bg-light">
                                        <div>
                                            <label for="">Permission</label>
                                            <div class="row">
                                                @if(!empty($getRolePermission[$keyPermission]))
                                                    @foreach($permission as $keyPermissionId =>$valuePermission)

                                                        <div class="col-md-3">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="{{$valuePermission->name}}" value="{{$valuePermission->id}}" name="permission[]"
                                                                @foreach($getRolePermission[$keyPermission] as $valueRolePermission)
                                                                    {{(!empty($valueRolePermission) && $valueRolePermission->id == $valuePermission->id)?'checked':''}}
                                                                    @endforeach
                                                                >
                                                                <label class="custom-control-label" for="{{$valuePermission->name}}">{{__('permission.'.$valuePermission->name)}}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    @foreach($permission as $keyPermissionId =>$valuePermission)
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" name="permission[]"
                                                                       value="{{$valuePermission->id}}" class="custom-control-input"
                                                                       id="{{$valuePermission->name}}">
                                                                <label class="custom-control-label"
                                                                       for="{{$valuePermission->name}}">{{ __('permission.'.$valuePermission->name)}}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="">Action</label>
                                            <div class="row">
                                                @if(!empty(config('myconfig.permission_see')))
                                                    @foreach(config('myconfig.permission_see') as $keyTypeSee =>$typeSee)
                                                        <div class="col-md-3">
                                                            <input type="radio" name="can_see[{{$keyPermission}}]" id="a{{$typeSee.$loop->index.$keyPermission}}" value="{{$keyTypeSee}}" {{$employeeAccessLists->where('permission_type',$keyPermission)->count()>0 && $employeeAccessLists->where('permission_type',$keyPermission)->first()->action_id == $keyTypeSee?'checked':''}}>
                                                            <label for="a{{$typeSee.$loop->index.$keyPermission}}">{{$typeSee}}</label><br>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class=" mt-5">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click','.check-all-group',function(e){
            let elementInputCheck = $(this).parent().parent().parent().next().find('input[type="checkbox"]');
            elementInputCheck.each(function(key,value){
                $(value).prop('checked', true);
            })
        })
        $(document).on('click','.check-all',function(e){
            let elementInputCheck = $(this).parents(4).next().find('input[type="checkbox"]');
            elementInputCheck.each(function(key,value){
                $(value).prop('checked', true);
            })
        })
        $(document).on('click','.un-check-all-group',function(e){
            let elementInputCheck = $(this).parent().parent().parent().next().find('input[type="checkbox"]');
            elementInputCheck.each(function(key,value){
                $(value).prop('checked', false);
            })
        })
        $(document).on('click','.un-check-all',function(e){
            let elementInputCheck = $(this).parents(4).next().find('input[type="checkbox"]');
            elementInputCheck.each(function(key,value){
                $(value).prop('checked', false);
            })
        })
    </script>
    @endpush
