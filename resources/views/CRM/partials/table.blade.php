@extends('admin.layouts.default')

@section('content')
@include('admin.partials.top-table')
@yield('message-status')
<div class="card mb-3">
	@if($flag != "report")
	<div class="card-header">
		<form action="{{$url_add_new}}">
			<button class="btn btn-primary mr-1 mb-1" type="submit">
				<span class="fas fa-plus mr-1"data-fa-transform="shrink-3"></span>Thêm mới
			</button>
		</form>		
	</div>
	@else 
	<div class="card-header">
		<form id="form" class="form-horizontal" role="form" action="{{route('thongke.search')}}" 
            enctype="multipart/form-data" method="POST">
         @csrf
			<div class="row">
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="ngaybatdau">Ngày bắt đầu</label>
						<input value="{{isset($req_ngaybatdau) ? $req_ngaybatdau : ''}}" class="form-control datetimepicker" name="ngaybatdau" id="schedule-start-date" type="text" data-options='{"dateFormat":"d/m/Y","enableTime":false}'>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="product_name">Ngày kết thúc</label>
						<input value="{{isset($req_ngayketthuc) ? $req_ngaybatdau : ''}}" class="form-control datetimepicker" name="ngaykethuc" id="schedule-start-date" type="text" data-options='{"dateFormat":"d/m/Y","enableTime":false}'>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="tvv">Tư vấn viên</label>
						<select name="tvv" id="tvv" class="form-control">
							<option value="all" {{isset($req_tvv) ? ($req_tvv == 'all' ? 'selected' : ''): ''}}>Tất cả</option>
							@foreach($tvvs as $tvv)
							<option value="{{$tvv->id}}" {{isset($req_tvv) ? ($req_tvv == $tvv->id ? 'selected' : ''): ''}}>{{$tvv->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="loaihv">Loại học viên</label>
						<select name="loaihv" id="loaihv" class="form-control">
							<option value="all" {{isset($req_loaihv) ? ($req_loaihv == 'all' ? 'selected' : ''): ''}}>Tất cả</option>
							<option value="1" {{isset($req_loaihv) ? ($req_loaihv == 1 ? 'selected' : ''): ''}}>Học viên chính quy</option>
							<option value="2" {{isset($req_loaihv) ? ($req_loaihv == 2 ? 'selected' : ''): ''}}>Học viên liên thông</option>
							<option value="3" {{isset($req_loaihv) ? ($req_loaihv == 3 ? 'selected' : ''): ''}}>Học viên cập nhật dược</option>
						</select>
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						<label class="control-label">	&nbsp;</label>
						<button class="form-control btn btn-primary mr-1 mb-1" type="submit">
							Tìm kiếm
						</button>
					</div>
				</div>
			</div>
		</form>		
	</div>
	@endif

    <div class="card-body bg-light">
    	<div class="row">
    		<div class="col-12">
    			<table class="table table-sm table-dashboard data-table display responsive no-wrap mb-0 fs--1 w-100">
    				<thead class="bg-200">
    					<tr>
    						@yield('t-head')
    					</tr>
    				</thead>
    				<tbody class="bg-white">
    					@yield('t-body')						
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>
@include('admin.partials.modal-delete')
</div>
@stop

@section('js')
@yield('js-tb')
@stop

