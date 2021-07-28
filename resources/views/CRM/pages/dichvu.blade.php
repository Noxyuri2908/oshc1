@extends('CRM.layouts.default')

@section('title')
SERVICE MANAGEMENT
@parent
@stop

@section('css')
@include('CRM.partials.css')
@stop
@section('content')
@include('CRM.elements.table-dichvu')
@stop

@section('js')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/filemanage.js')}}"></script>
<script src="{{asset('js/slug.js')}}"></script>
<script>
	var ajax_url = $("#ajax_crm_url").val();
	var editdichvu = ajax_url + "ajax/editService";

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

		$("#mainContent").delegate(".add_new", "click", function(){

			$('#modal_dichvu_add').modal('toggle');
		});

		$("#mainContent").delegate(".modal_edit", "click", function(){
			_id = $(this).data('id');
			$.get(editdichvu, {id: _id}, function (data) {
				$('#div_edit_dichvu').html(data);
				console.log(data);
				$('#modal_service_update').modal('toggle');
			});
		});


		$("#mainContent").delegate(".modal_delete", "click", function(){
			id = $(this).data('id');
			$('#dichvu_id').val(id);
			$('#modal_delete').modal('toggle');
		});
	});
</script>
@stop