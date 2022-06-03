@extends('back-end.layouts.main-3')

@section('title')
Thông tin HOA HỒNG
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
					<div class="table-responsive">
						@include('back-end.partials.tables.table-agent-commission')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- END Main content --}}
@stop
@section('js')
<!-- iCheck -->
<script src="{{asset('backend/js/plugins/dataTables/datatables.min.js')}}"></script>
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
</script>
@stop