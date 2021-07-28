@extends('CRM.layouts.default')

@section('title')
TASKS
@parent
@stop

@section('css')
@include('CRM.partials.css')
@stop
@section('content')
@include('CRM.elements.task.table')
@stop

@section('js')
<script>
	function setDataTask(data){
		$('#task_name').val(data['task']);
		$('#task_type').val(data['task_type']);
		$('#leader').val(data['leader']);
		$('#process_by').val(data['process_by']);
		var values= data['person_in_charge'];
		$("#person_in_charge").val(values.split(";")).trigger('change');
		$('#level').val(data['level']);
		$('#service').val(data['service']);
		$('#type_service').html(data['opt']);
		$('#from_date').val(data['from_date']);
		$('#to_date').val(data['to_date']);
		$('#processing').val(data['processing']);
		$('#status').val(data['status']);
		$('#content').html(data['content']);
		$('#agent_id').val(data['agent_id']);
		$('#apply_id').val(data['apply_id']);
		$('#content').html(data['content']);
		$('#task_id').val(data['id']);
		$('.btn-delete-task').css('display', 'block');
	}

	function resetDataTask(){
		$('#task_name').val('');
		$('#task_type').val('');
		$('#leader').val('');
		$('#process_by').val('');
		var values= ';'
		$.each(values.split(";"), function(i,e){
			$("#person_in_charge option[value='" + e + "']").prop("selected", true);
		});
		$('#level').val('');
		$('#from_date').val('');
		$('#to_date').val('');
		$('#processing').val('');
		$('#status').val('');
		$('#content').val('');
		$('#task_id').html('');
		$('.btn-delete-task').css('display', 'none');
	}
	jQuery(document).ready(function($){
		$('#btn_add_new_task').click(function(){
			resetDataTask();
			$('#modal_task').modal('toggle');
		});

		$('#service').change(function(){
			var opt = $('#service option:selected');
			var data = opt.data('value');
			var arr_data = data.split(';');
			var str_opt = "";
			for(i = 0; i < arr_data.length; i++){
				str_opt += "<option value='" + arr_data[i] + "'>" + arr_data[i] + "</option>";
			}
			$('#type_service').html(str_opt);
		});

		$('.data_task').click(function(){
			var id = $(this).data('id');
			var url = "<?php echo route('task.edit'); ?>";
			$.get(url, {task_id : id}, function(data){
				if(data['status'] == 1){
					res = data['content'];
					setDataTask(res);
					$('#modal_task').modal('toggle');
				}else{
					alert('Can not find data');
				}
			});
		});
	});
</script>
@stop