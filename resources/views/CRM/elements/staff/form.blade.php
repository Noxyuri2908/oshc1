@extends('CRM.layouts.default')

@section('title')
    {{!empty($obj)?'Edit ':'Create '}}staff
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
        <form action="{{!empty($obj)?route('staff.update',$obj->id):route('staff.store')}}" method="POST">
            @csrf
            @if(!empty($obj))
                <input type="hidden" name="_method" value="PUT">
            @endif
            <div class="card-header">
                {{!empty($obj)?'Edit ':'Create '}}staff
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="email"
                                   value="{{(!empty($obj))?$obj->email:''}}" placeholder="Email">
                            @if($errors->has('email'))
                                <small class="form-text text-danger">{{$errors->get('email')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" autocomplete="off" name="username"
                                   value="{{(!empty($obj))?$obj->username:''}}" placeholder="Username">
                            @if($errors->has('username'))
                                <small class="form-text text-danger">{{$errors->get('username')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">ID</label>
                            <input type="text" class="form-control" autocomplete="off" name="admin_id" value="{{(!empty($obj))?$obj->admin_id:''}}"
                                   placeholder="ID">
                            @if($errors->has('admin_id'))
                                <small class="form-text text-danger">{{$errors->get('admin_id')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" autocomplete="off" name="password" value=""
                                   placeholder="Password">
                            @if($errors->has('password'))
                                <small class="form-text text-danger">{{$errors->get('password')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Date of birth</label>
                            <input type="text" class="form-control" autocomplete="off" id="date_of_birth"
                                   name="date_of_birth" value="{{(!empty($obj))?convert_date_form_db($obj->date_of_birth):''}}"
                                   placeholder="dd/mm/yyyy">
                            @if($errors->has('date_of_birth'))
                                <small class="form-text text-danger">{{$errors->get('date_of_birth')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" autocomplete="off" name="address" value="{{(!empty($obj))?$obj->address:''}}"
                                   placeholder="Address">
                            @if($errors->has('address'))
                                <small class="form-text text-danger">{{$errors->get('address')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" class="form-control" autocomplete="off" name="phone" value="{{(!empty($obj))?$obj->phone:''}}"
                                   placeholder="Number phone">
                            @if($errors->has('phone'))
                                <small class="form-text text-danger">{{$errors->get('phone')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Department</label>
                            <select name="department_id" id="" class="form-control">
                                <option value=""></option>
                                @foreach($department_ids as $department)
                                    <option value="{{$department->id}}" {{(!empty($obj) && $obj->department_id == $department->id)?'selected':''}}>{{$department->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('department_id'))
                                <small class="form-text text-danger">{{$errors->get('department_id')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Branch</label>
                            <select name="branch_id" id="" class="form-control">
                                <option value=""></option>
                                @foreach($branch_ids as $branch)
                                    <option value="{{$branch->id}}" {{(!empty($obj) && $obj->branch_id == $branch->id)?'selected':''}}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('branch_id'))
                                <small class="form-text text-danger">{{$errors->get('branch_id')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Position</label>
                            <select name="position_id" id="" class="form-control">
                                <option value=""></option>
                                @foreach($position_ids as $position)
                                    <option value="{{$position->id}}" {{(!empty($obj) && $obj->position_id == $position->id)?'selected':''}}>{{$position->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('position_id'))
                                <small class="form-text text-danger">{{$errors->get('position_id')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control m-b" name="status" id="status" required>
                                <option value="1" {{isset($obj) ? ($obj->status == 1 ? 'selected' : '') :
                                (old('status') == 1 ? 'selected' : '')}}>
                                    Sử dụng
                                </option>
                                <option value="0" {{isset($obj) ? ($obj->status == 0 ? 'selected' : '') :
                                (old('status') == 0 ? 'selected' : '')}}>
                                    Tạm ngưng sử dụng
                                </option>
                            </select>
                        </div>
                    </div>
                    {{--                    <div class="col-md-12">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            <label for="">Vai trò</label>--}}
                    {{--                            <select name="roles[]" id="role-list" class="form-control" multiple="multiple">--}}
                    {{--                                @foreach($roles as $roleKey=>$roleName)--}}
                    {{--                                    <option value="{{$roleKey}}" {{!empty($obj) && in_array($roleKey,$obj->roles->pluck('id')->toArray())?'selected':''}}>{{$roleName}}</option>--}}
                    {{--                                @endforeach--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                <div class="col-md-4">--}}
                    {{--                    <div class="form-group">--}}
                    {{--                        <label for="">Branch</label>--}}
                    {{--                        <select class="form-control m-b" name="branch_id" id="branch_id" required>--}}
                    {{--                            <option value=""></option>--}}
                    {{--                            --}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">{{!empty($obj)?'Update':'Create '}}</button>
                <a href="{{route('staff.index')}}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
@stop
@push('scripts')
    @include('CRM.partials.choose_date',['ids'=>[
    'date_of_birth'
]])
    <script>
        $(document).ready(function () {
            $('#role-list').select2();
        });
    </script>
@endpush
