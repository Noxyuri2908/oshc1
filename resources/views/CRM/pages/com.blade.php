@extends('CRM.layouts.default')

@section('title')
COMMISSIONS MANAGEMENT
@parent
@stop

@section('css')
@include('CRM.partials.css')
@include('CRM.partials.css-font-size-12px')
@stop
@section('content')
@include('CRM.elements.table-com')
@stop

@section('js')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/filemanage.js')}}"></script>
<script>
	var ajax_url = $("#ajax_crm_url").val();
    // var editCom = ajax_url + "ajax/editCom";
	// var getProvider = ajax_url + "ajax/getProvider";
	// var getCom = ajax_url + "ajax/getCom";
	var editCom = "{{route('crm.editCom')}}";
	var getProvider = "{{route('crm.getProvider')}}";
	var getCom = "{{route('crm.getCom')}}";

	jQuery(document).ready(function($){
		$('#master').on('click', function(e) {
		    if($(this).is(':checked',true))
		    {
		      $(".sub_chk").prop('checked', true);
		    } else {
		      $(".sub_chk").prop('checked',false);
		    }
		});

		$(".sub_chk").on('click', function(e) {
		    if(!$(this).is(':checked',true))
		    {
		      $('#master').prop('checked', false);
		    }
		});

		$("#mainContent").delegate("#f_service", "change", function(){

			_id = $(this).val();
			$.get(getProvider, {id: _id}, function (data) {
				$('#f_provider').html(data);
				getData();
			});
		});

		$("#mainContent").delegate("#user_id", "change", function(){

			_obj = $('#user_id').find(":selected");
			_country = _obj.data('country');
			if(_country == null) _country = '';
			$('#country_service').val(_country);
		});

		$("#mainContent").delegate("#service_id", "change", function(){
			_id = $(this).val();
			$.get(getProvider, {id: _id}, function (data) {
				$('#type_service').html(data);
			});
		});
		$("#mainContent").delegate("#f_comm, #f_agent, #f_country, #f_provider, #f_time, #f_status, #f_unit", "change", function(){
			getData();
		});

		function getData(){
			_agent = $('#f_agent').val();
			_service = $('#f_service').val();
			_country = $('#f_country').val();
			_provider = $('#f_provider').val();
			_time = $('#f_time').val();
			_status = $('#f_status').val();
			_comm = $('#f_comm').val();
			_unit = $('#f_unit').val();
			$.get(getCom, {country: _country, agent: _agent, service: _service, provider: _provider, time: _time, status: _status, comm: _comm, unit: _unit}, function (data) {
				$('#table_com').html(data);
			});
		}

		$("#mainContent").delegate(".edit_all", "click", function(){
			var allVals = [];
			$(".sub_chk:checked").each(function() {
		      allVals.push($(this).attr('data-id'));
		    });
		    if(allVals.length <= 0){
		      alert('No data selected !');
		    }else{
		    	$('#arr_data').val(allVals);
		    	$('#modal_com_update_all').modal('toggle');
		    }
		});

		$("#mainContent").delegate(".del_all", "click", function(){
			var allVals = [];
			$(".sub_chk:checked").each(function() {
		      allVals.push($(this).attr('data-id'));
		    });
		    if(allVals.length <= 0){
		      alert('No data selected !');
		    }else{
		    	$('#com_id').val(allVals);
		    	$('#modal_delete').modal('toggle');
		    }
		});

		$("#mainContent").delegate(".add_new", "click", function(){

			$('#modal_com_add').modal('toggle');
		});

		$("#mainContent").delegate(".modal_edit", "click", function(){

			_id = $(this).data('id');
			$.get(editCom, {id: _id}, function (data) {
				$('#div_edit_com').html(data);
				$('#modal_com_update').modal('toggle');
			});
		});


		$("#mainContent").delegate(".modal_delete", "click", function(){
			id = $(this).data('id');
			$('#com_id').val(id);
			$('#modal_delete').modal('toggle');
		});
	});
</script>
@stop
