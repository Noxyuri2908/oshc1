@extends('back-end.layouts.main-2')

@section('title')
Thay đổi Apply
@endsection

@section('css')
<link href="{{asset('backend/css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
@endsection

{{-- Page content --}}
@section('content')
<div class="wrapper wrapper-content">
	<div class="row animated fadeInRight">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Thông tin chi tiết</h5>
			</div>
			<div class="ibox-content">
				<form id="form" class="form-horizontal" role="form" action="{{route('apply.update',['id'=>$obj->id])}}" 
				enctype="multipart/form-data" method="POST">
				@method('PATCH')
				@csrf
					@include('back-end.apply.form')
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-default" >Reset</button>
							<button class="btn btn-warning" type="submit">Update</button>
							@if($obj->status == 1)
							<button class="btn btn-success action-status-apply" data-action="{{route('apply.action.update.status',['id'=>$obj->id])}}" data-value="2" type="button">Active</button>
							<button class="btn btn-danger action-status-apply" data-action="{{route('apply.action.update.status',['id'=>$obj->id])}}" data-value="3" type="button">Reject</button>
							@endif
							<button class="btn btn-danger" type="button">Delete</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>		
</div>
@include('back-end.partials.modals.apply-status')
@endsection
@section('js')
<script src="{{asset('js/slug.js')}}"></script>
<script src="{{asset('backend/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script>
	var ckeditor_path = $("#ckeditor_path").val();
	$(document).ready(function() {
		settingIframe("#iframe-btn-0", "#thumb_0", "#preview_0");
		CKEDITOR.replace('content' ,{
			filebrowserBrowseUrl : ckeditor_path,
			filebrowserUploadUrl : ckeditor_path,
			filebrowserImageBrowseUrl : ckeditor_path,
		});
		$('.chosen-select').chosen({width: "100%"});
	});

	$('.action-status-apply').click(function(){
		value = $(this).data('value');
		action = $(this).data('action');
		$('#value_apply_status').val(value);
		$('#modal-form-apply-status').attr('action', action);
		if(value == 2) $('#title_apply_status').html('Do you want active this apply?');
		else $('#title_apply_status').html('Do you want de-active this apply?');
		$('#applyModal').modal('show');
	});
</script>
@endsection