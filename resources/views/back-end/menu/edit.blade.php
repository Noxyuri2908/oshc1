@extends('back-end.layouts.main')

@section('title')
Update : Menu Header
@endsection

@section('css')
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
				<form id="form" class="form-horizontal" role="form" action="{{route('menu.update',['id'=>$obj->id])}}" 
				enctype="multipart/form-data" method="POST">
				@method('PATCH')
				@csrf
					@include('back-end.menu.form')
					<div class="form-group">
						@include('back-end.partials.status')
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" >Reset</button>
							<button class="btn btn-primary" type="submit">Update</button>
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
@endsection