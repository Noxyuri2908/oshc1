@extends('back-end.layouts.main-2')

@section('title')
Tạo mới Apply
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
				@include('back-end.partials.alert-msg')
				<form id="form" class="form-horizontal" role="form" action="{{route('apply.store')}}" 
				enctype="multipart/form-data" method="POST">
				@csrf
					@include('back-end.apply.form')
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" >Làm mới</button>
							<button class="btn btn-primary" type="submit">Tạo mới</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>		
</div>
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
</script>
@endsection