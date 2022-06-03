@extends('back-end.layouts.main')

@section('title')
Create new: Template Mail
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
				<h5>Information</h5>
			</div>
			<div class="ibox-content">
				@include('back-end.partials.alert-msg')
				<form id="form" class="form-horizontal" role="form" action="{{route('temp-mail.store')}}" 
				enctype="multipart/form-data" method="POST">
				@csrf
					@include('back-end.temp-mail.form')
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" >Reset</button>
							<button class="btn btn-primary" type="submit">Add new</button>
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
		settingIframe("#iframe-btn-1", "#thumb_1", "#preview_1");
		CKEDITOR.replace('content' ,{
			filebrowserBrowseUrl : ckeditor_path,
			filebrowserUploadUrl : ckeditor_path,
			filebrowserImageBrowseUrl : ckeditor_path,
		});
		CKEDITOR.replace('content_cn' ,{
			filebrowserBrowseUrl : ckeditor_path,
			filebrowserUploadUrl : ckeditor_path,
			filebrowserImageBrowseUrl : ckeditor_path,
		});
		CKEDITOR.replace('content_vi' ,{
			filebrowserBrowseUrl : ckeditor_path,
			filebrowserUploadUrl : ckeditor_path,
			filebrowserImageBrowseUrl : ckeditor_path,
		});
		$('.chosen-select').chosen({width: "100%"});
	});
</script>
@endsection