@extends('back-end.layouts.main-2')

@section('title')
Create agent
@endsection

@section('css')
<link href="{{asset('css/bootstrap-multiselect.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
@endsection

{{-- Page content --}}
@section('content')
<div class="wrapper wrapper-content">
	<div class="row animated fadeInRight">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Detail</h5>
			</div>
			<div class="ibox-content">
				<form id="form" class="form-horizontal" role="form" action="{{route('info.store')}}" 
				enctype="multipart/form-data" method="POST">
				@csrf
					@include('back-end.info.form')
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" type="reset">Reset</button>
							<button class="btn btn-primary" type="submit">Save</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@include('back-end.partials.modals.add-com')
@endsection
@section('js')
<script src="{{asset('backend/js/plugins/chosen/chosen.jquery.js')}}"></script>
<script src="{{asset('js/bootstrap-multiselect.js')}}"></script>
<script>
	$(document).ready(function() {
		$('#au_user').multiselect();
		$('#add_comm').click(function(){
			$('#addComm').modal('show');
		});
		$('.chosen-select').chosen({width: "100%"});
	});
</script>
@endsection