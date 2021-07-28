@extends('CRM.layouts.default')

@section('title')
PROMOTION MANAGEMENT
@parent
@stop

@section('css')
@include('CRM.partials.css')
@stop
@section('content')
@include('CRM.elements.table-promotion')
@include('CRM.elements.modal-import')
@stop

@section('js')
<script src="{{asset('js/filemanage.js')}}"></script>
<script>
	var ajax_url = $("#ajax_crm_url").val();
	var editPromotion = "{{route('crm.editPromotion')}}";
	var export_url = "{{route('export.Promotion')}}" ;

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

			$('#modal_promotion_add').modal('toggle');
		});

		$("#mainContent").delegate(".export", "click", function(){
			window.open(export_url);
		});

		$("#mainContent").delegate(".import", "click", function(){
			$("#modal-form-import").attr('action', "{{route('import.Promotion')}}");
			$("#importModal").modal('show');
		});

		$("#mainContent").delegate(".modal_edit", "click", function(){
			_id = $(this).data('id');
			$.get(editPromotion, {id: _id}, function (data) {
				$('#div_edit_promotion').html(data);
				$('#modal_promotion_update').modal('toggle');
			});
		});


		$("#mainContent").delegate(".modal_delete", "click", function(){
			id = $(this).data('id');
			$('#promotion_id').val(id);
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
