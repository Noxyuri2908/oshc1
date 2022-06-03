@extends('back-end.layouts.main-2')

@section('title')
Update Agent Detail
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
				<h5>Detail</h5>
			</div>
			<div class="ibox-content">
			<form id="form" class="form-horizontal" role="form" action="{{route('info.update',['id'=>$obj->id])}}" 
				enctype="multipart/form-data" method="POST">
				@method('PATCH')
				@csrf
					@include('back-end.info.form')
					<div class="form-group">
						<div class="col-sm-4 col-sm-offset-2">
							<button class="btn btn-white" type="reset">Reset</button>
							<button class="btn btn-primary" type="submit">Update</button>
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
	var base_url = $('#base_url').val();
	var add_new_url = base_url + 'admin/add-new/comm/ajax';
	$(document).ready(function() {
		$('#au_user').multiselect();
		$('#add_comm').click(function(){
			$('#addComm').modal('show');
		});
		$('.add-new-btn-modal').click(function(){
			count_new = parseInt($('#count_new').val());
			id = $('#user_id').val();
			service_id = $('#new_service_id').val();
			policy = $('#new_policy_id').val();
			comm = $('#new_comm_id').val();
			end_date = $('#new_date_id').val();
			if(service_id == null || policy == null || 
			 	comm == null || comm == "" || end_date == null || end_date == ""){
				$('#addComm').modal('hide');
				return false;
			}
			$('#addComm').modal('hide');
			$('#count_new').val(parseInt(count_new) + 1);
			$.get(add_new_url, {user: id, service: service_id, policy: policy, comm: comm, end_date: end_date, count: count_new}, function (data) {
				console.log(data);
			 	$('#info_comm').html(data);
			});
			
		});
		$('.chosen-select').chosen({width: "100%"});
	});
</script>
@endsection