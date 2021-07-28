@extends('CRM.layouts.default')

@section('title')
CAMPAIN MANAGEMENT
@parent
@stop

@section('css')
@include('CRM.partials.css')
@stop
@section('content')
@include('CRM.elements.table-campain')
@stop

@section('js')
<script src="{{asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('js/filemanage.js')}}"></script>
<script>
	var ajax_url = $("#ajax_crm_url").val();
	var editCampain = ajax_url + "ajax/editCampain";

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

			$('#modal_campain_add').modal('toggle');
		});

		$("#mainContent").delegate(".modal_edit", "click", function(){

			_id = $(this).data('id');
			$.get(editCampain, {id: _id}, function (data) {
				$('#div_edit_campain').html(data);
				$('#modal_campain_update').modal('toggle');
			});
		});


		$("#mainContent").delegate(".modal_delete", "click", function(){
			id = $(this).data('id');
			$('#campain_id').val(id);
			$('#modal_delete').modal('toggle');
		});

		CKEDITOR.replace('content' ,{
			filebrowserBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
			filebrowserUploadUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
			filebrowserImageBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		});
		CKEDITOR.replace('content_edit' ,{
			filebrowserBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
			filebrowserUploadUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
			filebrowserImageBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		});

	});
</script>
@stop