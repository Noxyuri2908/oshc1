@extends('CRM.layouts.default')

@section('title')
SCHOOL MANAGEMENT
@parent
@stop

@section('css')
@include('CRM.partials.css')
@stop
@section('content')
@include('CRM.elements.table-school')
@include('CRM.elements.modal-import')
@stop

@section('js')
<script src="{{asset('js/filemanage.js')}}"></script>
<script>
	var ajax_url = $("#ajax_crm_url").val();
	var editSchool = ajax_url + "ajax/editSchool";
	var searchSchool = ajax_url + "ajax/searchSchool";
	var export_url = ajax_url + "export/School";

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

		$("#mainContent").delegate(".export", "click", function(){
			window.open(export_url);
		});

		$("#mainContent").delegate(".import", "click", function(){
			$("#modal-form-import").attr('action', "{{route('import.School')}}");
			$("#importModal").modal('show');
		});

		$("#mainContent").delegate("#f_name, #f_country, #f_state, #f_city", "change", function(){
			_name = $('#f_name').val();
			_country = $('#f_country').val();
			_state = $('#f_state').val();
			_city = $('#f_city').val();
			$.get(searchSchool, {f_name: _name, f_country: _country, f_state: _state, f_city: _city}, function(data){
				$('#tbody_school').html(data);
			});
		});

		$("#mainContent").delegate(".add_new", "click", function(){

			$('#modal_school_add').modal('toggle');
		});

		$("#mainContent").delegate(".modal_edit", "click", function(){

			_id = $(this).data('id');
			$.get(editSchool, {id: _id}, function (data) {
				$('#div_edit_school').html(data);
				$('#modal_school_update').modal('toggle');
			});
		});


		$("#mainContent").delegate(".modal_delete", "click", function(){
			id = $(this).data('id');
			$('#school_id').val(id);
			$('#modal_delete').modal('toggle');
		});

		// CKEDITOR.replace('content' ,{
		// 	filebrowserBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// 	filebrowserUploadUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// 	filebrowserImageBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// });
		// CKEDITOR.replace('content_sp' ,{
		// 	filebrowserBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// 	filebrowserUploadUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// 	filebrowserImageBrowseUrl : "/oshc/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
		// });

	});
</script>
@stop