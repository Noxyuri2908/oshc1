@extends('back-end.layouts.main-2')

@section('title')
Thay đổi câu hỏi
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
				<form id="form" class="form-horizontal" role="form" action="{{route('qa.update',['id'=>$obj->id])}}" 
				enctype="multipart/form-data" method="POST">
				@method('PATCH')
				@csrf
					@include('back-end.qa.form')
					<div class="form-group">
						@include('back-end.partials.status')
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" >Làm mới</button>
							<button class="btn btn-primary" type="submit">Cập nhật</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>		
</div>
@endsection
@section('js')
<script>
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
</script>	
@endsection