@extends('back-end.layouts.main-2')

@section('title')
Report commission by month
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
					<h5>List infomation</h5>
				</div>
				{{-- END Header table --}}
				<div class="ibox-content">
					@include('back-end.report.fillter')
					@include('back-end.partials.alert-msg')
					<div class="table-responsive">
						@include('back-end.partials.tables.table-report')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('back-end.partials.modals.delete')
{{-- END Main content --}}
@stop
@section('js')
<!-- iCheck -->
<script src="{{asset('js/select-all.js')}}"></script>
<script src="{{asset('backend/js/plugins/dataTables/datatables.min.js')}}"></script>
<script src="{{asset('js/delete-modal.js')}}"></script>
<script src="{{asset('js/mutile-update.js')}}"></script>
<script>
	var admin_url = $('#admin_path').val();
	var get_by_month = admin_url + 'report/all/';
	var get_by_agent = admin_url + 'report/';
	$('#f_month').change(function(){
		get_data();
	});
	$('#f_agent').change(function(){
		get_data();
	});

	function  get_data(){
		_month = $('#f_month').val();
		_id = $('#f_agent').val();
		if(_id == 0) window.location.href = get_by_month + _month;
		else window.location.href = get_by_agent + _id + '/' + _month;
	}
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
</script>
@stop