
@extends('admin.layouts.default')

@section('css')
<link href="{{asset('assets/css/plugins/slick/slick.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/plugins/slick/slick-theme.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/plugins/jasny/jasny-bootstrap.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/fancybox/source/jquery.fancybox.css')}}">
<link href="{{asset('assets/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
<style type="text/css">
span.select2.select2-container.select2-container--default{
	width:100% !important;
}
</style>
@stop

{{-- Page content --}}
@section('content')
{{-- Breadcrumb --}}
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2>Tạo mới bài viết</h2>
		<ol class="breadcrumb">
			<li>
				<a href="{{route('dashboard')}}">Home</a>
			</li>
			<li>
				<a href="{{route('list-brand')}}">Danh sách bài viết</a>
			</li>
			<li class="active">
				<strong>Tạo mới bài viết</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-8">
		<div class="title-action">
			<a href="{{route('list-brand')}}" class="btn btn-primary">Trở về danh sách bài viết</a>
		</div>
	</div>
</div>
{{-- END Breadcrumb --}}

{{-- START Main Content --}}
<div class="wrapper wrapper-content ">
	<div class="row animated fadeInRight">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Thông tin bài viết mới</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			{{-- START FORM --}}
			<div class="ibox-content">
				@if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach($errors->all() as $err)
					<strong>{{$err}}</strong><br>
					@endforeach
				</div>
				@endif

				@if(session('error'))
				<div class="alert alert-danger">
					<strong>{{session('error')}}</strong>
				</div>
				@endif
				@if(session('thongbao'))
				<div class="alert alert-success">
					<strong>{{session('thongbao')}}</strong>
				</div>
				@endif
				<form id="form" class="form-horizontal" role="form" action="{{route('create-brand')}}"
				enctype="multipart/form-data" method="POST">
				@csrf
				<!--Panel -->
				<div class="panel-panel-default">
					<div id="info" class="panel-collapse-collapse">
						<div class="panel-body-c">
							<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
								<label class="col-sm-2 control-label">Tên bài viết (*) </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
								</div>
							</div>

							<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
								<label class="col-sm-2 control-label">Slug (*) </label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="slug" id="slug" value="{{old('slug')}}">
								</div>
							</div>

							<div class="form-group {{ $errors->has('des_s') ? 'has-error' : '' }}">
								<label class="col-sm-2 control-label">Miêu tả ngắn (*) </label>
								<div class="col-sm-10">
									<textarea name="des_s" id="des_s" class="form-control my-editor" rows="20" required>
									</textarea>
								</div>
							</div>

							<div class="form-group {{ $errors->has('des_f') ? 'has-error' : '' }}">
								<label class="col-sm-2 control-label">Miêu tả chi tiết (*) </label>
								<div class="col-sm-10">
									<textarea name="des_f" id="des_f" class="form-control my-editor" rows="20" required>

									</textarea>
								</div>
							</div>

							<div class="form-group {{ $errors->has('banner') ? 'has-error' : '' }}">
								<label class="col-sm-2 control-label">Ảnh đại diện (*)</label>
								<div class="col-sm-10">
									<div class="input-group">
										<span class="input-group-btn">
											<a href="{{\Config::get('lfm.URL_FILEMANAGE_0')}}" class="btn btn-primary red iframe-btn" id="iframe-create-brand">
											<i class="fa fa-picture-o"></i>Chọn ảnh</a>
										</span>
										<input id="thumb_0" class="form-control" type="text" name="image" required>
									</div>
									<div id="preview">

									</div>
								</div>
							</div>
							@include ('admin.partials.seo')
							<div class="form-group">
								<label class="col-sm-2 control-label">Trạng thái (*)</label>

								<div class="col-md-4">
									<select class="form-control m-b" name="status">
										<option value="1">Công khai</option>
										<option value="0">Không công khai</option>
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- -->
				<div class="form-group">
					<div class="col-sm-4 col-sm-offset-2">
						<button class="btn btn-white" type ="reset">Làm mới</button>
						<button class="btn btn-primary" type="submit">Tạo mới</button>
					</div>
				</div>
			</form>
		</div>
		{{-- END FORM --}}
	</div>
</div>
</div>
{{-- END Main Content --}}

@stop
{{-- Page content --}}

@section('script')
<!-- slick carousel-->
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('assets/js/plugins/slick/slick.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/hrm.js')}}"></script>
<script>

$(document).ready(function()
{
	$(".choose-style").on('click', function() {
		  //  ret = DetailsView.GetProject($(this).attr("#data-id"), OnComplete, OnTimeOut, OnError);
		  style = $(this).attr("data-style");
		  $(".choose-style").each(function( index ) {
		  	$( this ).removeClass("btn-success");
		  	$( this ).removeClass("btn-white");
		  	$( this ).addClass("btn-white");
		  });
		  $( this ).removeClass("btn-white");
		  $( this ).addClass("btn-success");
		  $("#dis_type").val(style);
	});

	CKEDITOR.replace( 'des_f' ,{
		filebrowserBrowseUrl : fmPath_2,
		filebrowserUploadUrl : fmPath_2,
		filebrowserImageBrowseUrl : fmPath_2,
	});

	CKEDITOR.replace( 'des_s' ,{
		filebrowserBrowseUrl : fmPath_2,
		filebrowserUploadUrl : fmPath_2,
		filebrowserImageBrowseUrl : fmPath_2,
	});

	$('.product-images').slick({
		dots: true
	});

	$(".select2_demo_2").select2();
	settingIframe("#iframe-create-brand");
});
</script>
@stop
