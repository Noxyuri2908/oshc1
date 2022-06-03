@extends('back-end.layouts.main-2')

@section('title')
Danh sách Apply
@parent
@stop

@section('css')
<link href="{{asset('backend/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				{{-- Header table --}}
				<div class="ibox-title">
					<h5>Bảng danh sách</h5>
				</div>
				{{-- END Header table --}}
				<div class="ibox-content">					
					@include('back-end.partials.alert-msg')
					@include('back-end.partials.select-box-update')
					<div class="table-responsive">
						@include('back-end.partials.tables.table-apply')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('back-end.partials.modals.delete')
@include('back-end.partials.modals.mutile-update')
@include('back-end.partials.modals.apply-status')
{{-- END Main content --}}
@stop
@section('js')
<!-- iCheck -->
<script src="{{asset('js/select-all.js')}}"></script>
<script src="{{asset('backend/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{asset('js/delete-modal.js')}}"></script>
<script src="{{asset('js/mutile-update.js')}}"></script>
<script>
	$(document).ready(function(){
		$('.dataTables-example').DataTable({
			pageLength: 10,
			responsive: true,
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
			{extend: 'excel', title: 'ExampleFile'},
		]
	});
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
@stop