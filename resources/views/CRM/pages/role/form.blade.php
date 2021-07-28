@extends('CRM.layouts.default')

@section('title')
    {{!empty($role)?'Edit':'Create'}} role
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
        <div class="card-header border-bottom">
            <div class="d-flex justify-content-between">
                <p class="h4">{{!empty($role)?'Edit':'Create'}} role</p>
                <a href="{{route('roles.index')}}" class="btn btn-primary"><i class="fas fa-long-arrow-alt-left mr-2"></i>Back</a>
            </div>
        </div>
        <form action="{{!empty($role)?route('roles.update',['id'=>$role->id]):route('roles.store')}}" method="post">
            @csrf
            @if(!empty($role))
                <input type="hidden" name="_method" value="PUT">
                @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="name" value="{{!empty($role)?$role->name:''}}">
                            @if($errors->has('name'))
                                <small class="form-text text-danger">{{$errors->get('name')[0]}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Note</label>
                            <textarea class="form-control" name="note">{{!empty($role)?$role->note:''}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Member</label>
                            <select name="member[]" id="member-list" class="form-control" multiple="multiple">
                                @foreach($admins as $keyAdmin=>$valueAdmin)
                                    <option value="{{$keyAdmin}}" {{!empty($role) && !empty($role->users) && in_array($keyAdmin,$role->users->pluck('id')->toArray()) ? 'selected':''}}>{{$valueAdmin}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#member-list').select2({
                closeOnSelect: false
            });
        });
    </script>
@endpush
